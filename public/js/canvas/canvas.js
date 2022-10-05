// Runs when DOM content is finished loading.
let shapes = [];
let is_dragging = false;
let startX;
let startY;
let current_shape_index;
let ctx;
let canvas_width;
let canvas_height;
// Passed on by blade file
var page = page;
var pageObjects = pageObjects;
var selectedObject;

window.addEventListener('DOMContentLoaded', (event) => {

    // Create a new instance of Canvas
    canvas = new fabric.Canvas("canvas");

    console.log(`Object type: ${JSON.stringify(pageObjects)} found.`)

    // Render all page objects
    for (let pageObject of pageObjects) {
        render(pageObject);
    }

    canvas.on('mouse:down', function(event){
        if (event.target) {
            selectedObject = event.target;
            document.getElementById('canvas-edit').style.display = 'block';
        } else  {
            selectedObject = null;
            document.getElementById('canvas-edit').style.display = 'none';
        }
    });
    
    document.getElementById('create-text-button').onclick = function() {
        create_default_text()
    };

    document.getElementById('create-image-button').onclick = function() {
        create_default_image()
    };

    document.getElementById('create-rectangle-button').onclick = function() {
        create_default_rectangle()
    };

    document.getElementById('create-circle-button').onclick = function() {
        create_default_circle()
    };

    document.getElementById('create-triangle-button').onclick = function() {
        create_default_triangle()
    };

    document.getElementById('text-font-size').onchange = function() {
        canvas.getActiveObject().set("fontSize", this.value);
        canvas.renderAll();
    };

    document.getElementById('delete-text-button').onclick = function() {
        delete_object(canvas.getActiveObject());
    };

    canvas.on('object:modified', function(event){
        post_object(event);
    });
});

let render = function(pageObject) {
    let object_type = pageObject.object_type;

    if (object_type == 'text_box') {
        render_text_box(pageObject);
    } else if (object_type == 'image') {
        render_image(pageObject);
    } else if (object_type == 'rectangle') {
        render_rectangle(pageObject);
    } else if (object_type == 'circle') {
        render_circle(pageObject);
    } else if (object_type == 'triangle') {
        render_triangle(pageObject);
    }
}

let render_image = function(pageObject) {
    console.log(pageObject)
    fabric.Image.fromURL(`../../media/${pageObject.image}`, function(img, isError) {
        if (isError) {
            console.log("Error occured!")
        } else {
            let oImg = img.set({
                left: pageObject.pos_x,  
                top: pageObject.pos_y,
                angle: pageObject.angle,
                height: pageObject.height,
                width: pageObject.width,
                object_id: pageObject.object_id,
            });
            canvas.add(oImg);
        }
    });
}

let render_text_box = function(pageObject) {
    // Create a new Text instance
    var text = new fabric.Textbox(pageObject.text, {
        id: pageObject.id,
        object_id: pageObject.object_id,
        font: pageObject.font,
        left: pageObject.pos_x,
        top: pageObject.pos_y,
        angle: pageObject.angle,
        height: pageObject.height,
        width: pageObject.width,
        object_type: pageObject.object_type,
    });

    // Render the Text on Canvas
    canvas.add(text);

    canvas.setActiveObject(text);
}

let render_rectangle = function(pageObject) {
    var rectangle = new fabric.Rect({
        id: pageObject.id,
        object_id: pageObject.object_id,
        left: pageObject.pos_x,
        top: pageObject.pos_y,
        angle: pageObject.angle,
        height: pageObject.height,
        width: pageObject.width,
        fill: pageObject.fill,
        stroke: pageObject.stroke,
        stroke_width: pageObject.stroke_width,
        object_type: pageObject.object_type,
    });

    canvas.add(rectangle);
}

let render_circle = function(pageObject) {
    var circle = new fabric.Circle({
        id: pageObject.id,
        object_id: pageObject.object_id,
        left: pageObject.pos_x,
        top: pageObject.pos_y,
        angle: pageObject.angle,
        height: pageObject.height,
        width: pageObject.width,
        radius: pageObject.radius,
        fill: pageObject.fill,
        stroke: pageObject.stroke,
        stroke_width: pageObject.stroke_width,
        object_type: pageObject.object_type,
    });

    canvas.add(circle);
}

let render_triangle = function(pageObject) {
    var triangle = new fabric.Triangle({
        id: pageObject.id,
        object_id: pageObject.object_id,
        left: pageObject.pos_x,
        top: pageObject.pos_y,
        angle: pageObject.angle,
        height: pageObject.height,
        width: pageObject.width,
        fill: pageObject.fill,
        stroke: pageObject.stroke,
        stroke_width: pageObject.stroke_width,
        object_type: pageObject.object_type,
    });

    canvas.add(triangle);
}

let post_object = function(event) {
    let object_type = event.target.object_type;
  
    let object_data = { 
        id: event.target.object_id, 
        page_id: page.id, 
        angle: event.target.angle,
        object_type: event.target.object_type, 
        pos_x: event.target.left, 
        pos_y: event.target.top,
        height: event.target.getScaledHeight(),
        width: event.target.getScaledWidth(),
    };

    post_object_data(object_data)

    console.log(`${event.target}`)

    if (object_type === 'text_box') {
        let text_box = { id: event.target.id, text: event.target.text, }
        post_text_box(text_box)
    } else if (object_type == 'image') {
        let image = {};
        post_image(image);
    } else if (object_type == 'rectangle') {
        let rectangle = { id: event.target.id, fill: event.target.fill, stroke: event.target.stroke, stroke_width: event.target.stroke_width,};
        post_rectangle(rectangle);
    } else if (object_type == 'circle') {
        let circle = { id: event.target.id, radius:event.target.radius, fill: event.target.fill, stroke: event.target.stroke, stroke_width: event.target.stroke_width,};
        post_circle(circle);
    } else if (object_type == 'triangle') {
        let triangle = { id: event.target.id, fill: event.target.fill, stroke: event.target.stroke, stroke_width: event.target.stroke_width,};;
        post_triangle(triangle);
    }

}

let post_text_box = function(text_box) {
    console.log(`Textbox data: ${JSON.stringify(text_box)}`)

    let config = {
        headers: {
            'Content-Type': "application/json"
        }
    }

    axios.put(
        `/text_boxes/${text_box.id}`, 
        text_box,
        config
    ).then(async function (response) {
        // console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}

let post_rectangle = function(rectangle) {
    console.log(`Rectangle data: ${JSON.stringify(rectangle)}`)

    let config = {
        headers: {
            'Content-Type': "application/json"
        }
    }

    axios.put(
        `/rectangles/${rectangle.id}`, 
        rectangle,
        config
    ).then(async function (response) {
        console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}

let post_circle = function(circle) {
    console.log(`Circle data: ${JSON.stringify(circle)}`)

    let config = {
        headers: {
            'Content-Type': "application/json"
        }
    }

    axios.put(
        `/circles/${circle.id}`, 
        circle,
        config
    ).then(async function (response) {
        // console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}

let post_triangle = function(triangle) {
    console.log(`Triangle data: ${JSON.stringify(triangle)}`)

    let config = {
        headers: {
            'Content-Type': "application/json"
        }
    }

    axios.put(
        `/triangles/${triangle.id}`, 
        triangle,
        config
    ).then(async function (response) {
        // console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}



let post_object_data = function(object_data) {
    console.log(`Object data: ${JSON.stringify(object_data)}`)

    let config = {
        headers: {
            'Content-Type': "application/json"
        }
    }

    axios.put(
        `/page_objects/${object_data.id}`, 
        object_data,
        config
    ).then(async function (response) {
        //console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}


let create_default_text = function() {
    axios.post( `/page_objects`, { "page_id": page.id, "object_type": "text_box"})
    .then(async function (response) {
        let object = response.data;
        axios.post( `/text_boxes`, { "object_id": object.id })
        .then(async function (response) {
            let text_box = response.data;
            let data = Object.assign(object, text_box);
            render_text_box(data);
        })
        .catch(function (error) {  
            console.error(error);  
        });
    })
    .catch(function (error) {  
        console.error(error);  
    });
}

let create_default_image = function() {
    return console.error("Not yet implemented");

    // axios.post( `/page_objects`, { "page_id": page.id, "object_type": "image"})
    // .then(async function (response) {
    //     let object = response.data;
    //     axios.post( `/images`, { "object_id": object.id })
    //     .then(async function (response) {
    //         let image = response.data;
    //         let data = Object.assign(object, image);
    //         render_image(data);
    //     })
    //     .catch(function (error) {  
    //         console.error(error);  
    //     });
    // })
    // .catch(function (error) {  
    //     console.error(error);  
    // });
}

let create_default_rectangle = function() {
    axios.post( `/page_objects`, { "page_id": page.id, "object_type": "rectangle"})
    .then(async function (response) {
        let object = response.data;
        console.log(JSON.stringify(object.id));
        axios.post( `/rectangles`, { "object_id": object.id })
        .then(async function (response) {
            console.log(response);
            let rectangle = response.data;
            let data = Object.assign(object, rectangle);
            render_rectangle(data);
        })
        .catch(function (error) {  
            console.error(error);  
        });
    })
    .catch(function (error) {  
        console.error(error);  
    });
}

let create_default_circle = function() {
    axios.post( `/page_objects`, { "page_id": page.id, "object_type": "circle"})
    .then(async function (response) {
        let object = response.data;
        console.log(JSON.stringify(object.id));
        axios.post( `/circles`, { "object_id": object.id })
        .then(async function (response) {
            console.log(response);
            let circle = response.data;
            let data = Object.assign(object, circle);
            render_circle(data);
        })
        .catch(function (error) {  
            console.error(error);  
        });
    })
    .catch(function (error) {  
        console.error(error);  
    });
}

let create_default_triangle = function() {
    axios.post( `/page_objects`, { "page_id": page.id, "object_type": "triangle"})
    .then(async function (response) {
        let object = response.data;
        console.log(JSON.stringify(object.id));
        axios.post( `/triangles`, { "object_id": object.id })
        .then(async function (response) {
            console.log(response);
            let triangle = response.data;
            let data = Object.assign(object, triangle);
            render_triangle(data);
        })
        .catch(function (error) {  
            console.error(error);  
        });
    })
    .catch(function (error) {  
        console.error(error);  
    });
}



let delete_object = function(object) {
    let object_data = { id: object.object_id, page_id: page.id, angle: object.angle, object_type: object.object_type, pos_x: object.left, pos_y: object.top };

    if (object.object_type === 'text_box') {
        let text_box = { id: object.id, text: object.text, }
        delete_text_box(text_box)
        delete_object_data(object_data)
    }

    canvas.remove(object);
}

let delete_text_box = function(text_box) {
    axios.delete(
        `/text_boxes/${text_box.id}`, 
        text_box,
    ).then(async function (response) {
        console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}

let delete_object_data = function(object_data) {
    axios.delete(
        `/page_objects/${object_data.id}`, 
        object_data,
    ).then(async function (response) {
        console.log(await response);
    }).catch(function (error) {  
        console.error(error);  
    });
}

// let draw_shapes = function() {
//     context.clearRect(0, 0, canvas_width, canvas_height);

//     for (let shape of shapes) {
//         context.fillStyle = shape.color;
//         context.fillRect(shape.x, shape.y, shape.width, shape.height);
//     }
// }

