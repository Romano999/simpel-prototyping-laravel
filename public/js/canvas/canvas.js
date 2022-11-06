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
var panning = false;

window.addEventListener('DOMContentLoaded', (event) => {

    // Create a new instance of Canvas
    canvas = new fabric.Canvas("canvas");

    // Render all page objects
    for (let pageObject of pageObjects) {
        render(pageObject);
    }

    // Gather all editor divs
    editor_divs = []; 
    editor_divs.push(document.getElementById('canvas-edit-text'));
    editor_divs.push(document.getElementById('canvas-edit-image'));
    editor_divs.push(document.getElementById('canvas-edit-rectangle'));
    editor_divs.push(document.getElementById('canvas-edit-circle'));
    editor_divs.push(document.getElementById('canvas-edit-triangle'))

    canvas.on('mouse:down', function(event){
        if (event.target) {
            selectedObject = event.target;
            for (element of editor_divs) {
                element.style.display = 'none';
            }
            document.getElementById('canvas-editor').style.display = 'block';
            display_canvas_edit(selectedObject);
        } else  {
            panning = true;
            selectedObject = null;
            document.getElementById('canvas-editor').style.display = 'none';
        }
    });

    document.getElementById('canvas-editor').style.display = 'none';
    
    // Create default page objects
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

    // Canvas editor object setting
    document.getElementById('text-font-size').onchange = function() {
        canvas.getActiveObject().set("fontSize", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('text-fill-color').onchange = function() {
        canvas.getActiveObject().set("fill", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('rectangle-stroke-width').onchange = function() {
        canvas.getActiveObject().set("strokeWidth", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('rectangle-fill-color').onchange = function() {
        canvas.getActiveObject().set("fill", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('rectangle-stroke-color').onchange = function() {
        canvas.getActiveObject().set("stroke", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('circle-stroke-width').onchange = function() {
        canvas.getActiveObject().set("strokeWidth", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('circle-fill-color').onchange = function() {
        canvas.getActiveObject().set("fill", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('circle-stroke-color').onchange = function() {
        canvas.getActiveObject().set("stroke", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('triangle-stroke-width').onchange = function() {
        canvas.getActiveObject().set("strokeWidth", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('triangle-fill-color').onchange = function() {
        canvas.getActiveObject().set("fill", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('triangle-stroke-color').onchange = function() {
        canvas.getActiveObject().set("stroke", this.value);
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };


    // Canvas edit z-index
    document.getElementById('text-z-index').onchange = function() {
        canvas.getActiveObject().set("z_index", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('image-z-index').onchange = function() {
        canvas.getActiveObject().set("z_index", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('rectangle-z-index').onchange = function() {
        canvas.getActiveObject().set("z_index", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('circle-z-index').onchange = function() {
        canvas.getActiveObject().set("z_index", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    document.getElementById('triangle-z-index').onchange = function() {
        canvas.getActiveObject().set("z_index", parseInt(this.value));
        post_object(canvas.getActiveObject());
        canvas.renderAll();
    };

    // Canvas editor delete object
    document.getElementById('delete-text-button').onclick = function() {
        delete_object(canvas.getActiveObject());
    };

    document.getElementById('delete-image-button').onclick = function() {
        delete_object(canvas.getActiveObject());
    };

    document.getElementById('delete-rectangle-button').onclick = function() {
        delete_object(canvas.getActiveObject());
    };

    document.getElementById('delete-circle-button').onclick = function() {
        delete_object(canvas.getActiveObject());
    };

    document.getElementById('delete-triangle-button').onclick = function() {
        delete_object(canvas.getActiveObject());
    };

    // Canvas actions
    canvas.on('object:modified', function(event){
        post_object(event);
        z_index_placement(event.target);
    });

    // Canvas Panning
    canvas.on('mouse:up', function (e) {
        panning = false;
    });
    
    // canvas.on('mouse:down', function (e) {
    //     panning = true;
    // });

    canvas.on('mouse:move', function (e) {
        if (panning && e && e.e) {
            var units = 10;
            var delta = new fabric.Point(e.e.movementX, e.e.movementY);
            canvas.relativePan(delta);
        }
    });
    
    // Canvas zoom
    canvas.on('mouse:down', function(opt) {
        var evt = opt.e;
        if (evt.altKey === true) {
            this.isDragging = true;
            this.selection = false;
            this.lastPosX = evt.clientX;
            this.lastPosY = evt.clientY;
        }
    });

    canvas.on('mouse:move', function(opt) {
        if (this.isDragging) {
            var e = opt.e;
            var vpt = this.viewportTransform;
            vpt[4] += e.clientX - this.lastPosX;
            vpt[5] += e.clientY - this.lastPosY;
            this.requestRenderAll();
            this.lastPosX = e.clientX;
            this.lastPosY = e.clientY;
        }
    });

    canvas.on('mouse:up', function(opt) {
        // on mouse up we want to recalculate new interaction
        // for all objects, so we call setViewportTransform
        this.setViewportTransform(this.viewportTransform);
        this.isDragging = false;
        this.selection = true;
    });

    canvas.on('mouse:wheel', function(opt) {
        var delta = opt.e.deltaY;
        var zoom = canvas.getZoom();
        zoom *= 0.999 ** delta;
        if (zoom > 20) zoom = 20;
        if (zoom < 0.01) zoom = 0.01;
        canvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
        opt.e.preventDefault();
        opt.e.stopPropagation();
    });
});

let display_canvas_edit = function(page_object) {
    let object_type = page_object.object_type;

    if (object_type == 'text_box') {
        document.getElementById('canvas-edit-text').style.display = 'block';
        document.getElementById('text-font-size').value = page_object.fontSize;
        document.getElementById('text-z-index').value = page_object.z_index;
        document.getElementById('text-fill-color').value = page_object.fill;
    } else if (object_type == 'image') {
        document.getElementById('canvas-edit-image').style.display = 'block';
        document.getElementById('image-z-index').value = page_object.z_index;
    } else if (object_type == 'rectangle') {
        document.getElementById('canvas-edit-rectangle').style.display = 'block';
        document.getElementById('rectangle-stroke-width').value = page_object.strokeWidth;
        document.getElementById('rectangle-z-index').value = page_object.z_index;
        document.getElementById('rectangle-fill-color').value = page_object.fill;
        document.getElementById('rectangle-stroke-color').value = page_object.stroke;
    } else if (object_type == 'circle') {
        document.getElementById('canvas-edit-circle').style.display = 'block';
        document.getElementById('circle-stroke-width').value = page_object.strokeWidth;
        document.getElementById('circle-z-index').value = page_object.z_index;
        document.getElementById('circle-fill-color').value = page_object.fill;
        document.getElementById('circle-stroke-color').value = page_object.stroke;
    } else if (object_type == 'triangle') {
        document.getElementById('canvas-edit-triangle').style.display = 'block';
        document.getElementById('triangle-stroke-width').value = page_object.strokeWidth;
        document.getElementById('triangle-z-index').value = page_object.z_index;
        document.getElementById('triangle-fill-color').value = page_object.fill;
        document.getElementById('triangle-stroke-color').value = page_object.stroke;
    }
}

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
    fabric.Image.fromURL(`../../media/${pageObject.image}`, function(img, isError) {
        if (isError) {
            console.error("Error occured!")
        } else {
            let oImg = img.set({
                left: pageObject.pos_x,  
                top: pageObject.pos_y,
                angle: pageObject.angle,
                height: pageObject.height,
                width: pageObject.width,
                object_id: pageObject.object_id,
                object_type: pageObject.object_type,
                z_index: pageObject.z_index,
            });
            canvas.add(oImg);
            z_index_placement(oImg);
        }
    });
}

let render_text_box = function(pageObject) {
    // Create a new Text instance
    var text = new fabric.Textbox(pageObject.text, {
        id: pageObject.id,
        object_id: pageObject.object_id,
        fontSize: pageObject.font_size,
        left: pageObject.pos_x,
        top: pageObject.pos_y,
        angle: pageObject.angle,
        height: pageObject.height * pageObject.scaleY,
        width: pageObject.width * pageObject.scaleX,
        object_type: pageObject.object_type,
        z_index: pageObject.z_index,
        fill: pageObject.fill,
    });

    // Render the Text on Canvas
    canvas.add(text);
    z_index_placement(text);
    // canvas.setActiveObject(text);
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
        strokeWidth: pageObject.stroke_width,
        object_type: pageObject.object_type,
        z_index: pageObject.z_index,
        padding: 0,
        strokeUniform: true,
    });

    canvas.add(rectangle);
    z_index_placement(rectangle);
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
        strokeWidth: pageObject.stroke_width,
        object_type: pageObject.object_type,
        z_index: pageObject.z_index,
        padding: 0,
        strokeUniform: true,
    });

    canvas.add(circle);
    z_index_placement(circle);
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
        strokeWidth: pageObject.stroke_width,
        object_type: pageObject.object_type,
        z_index: pageObject.z_index,
        padding: 0,
        strokeUniform: true,
    });

    canvas.add(triangle);
    z_index_placement(triangle);
}

let post_object = function(event) {
    let object;
    let object_type;

    if (typeof event.target === "undefined") {
        object = event;
        object_type = event.object_type;
    } else {
        object = event.target;
        object_type = event.target.object_type;
    }

    console.log(`Whole object to post: ${JSON.stringify(object)}`)

    let object_data = { 
        id: object.object_id, 
        page_id: page.id, 
        angle: object.angle,
        object_type: object.object_type, 
        pos_x: object.left, 
        pos_y: object.top,
        height: object.height * object.scaleY,
        width: object.width * object.scaleX,
        z_index: object.z_index,
    };

    console.log(`Relevant object to post: ${JSON.stringify(object_data)}`)

    console.log(JSON.stringify(object_data))
    post_object_data(object_data)

    if (object_type === 'text_box') {
        let text_box = { id: object.id, text: object.text, font_size: object.fontSize, fill: object.fill }
        console.log(`Textbox to post: ${JSON.stringify(text_box)}`)
        post_text_box(text_box)
    } else if (object_type == 'image') {
        let image = {};
        console.log(`Image to post: ${JSON.stringify(image)}`)
        post_image(image);
    } else if (object_type == 'rectangle') {
        let rectangle = { id: object.id, fill: object.fill, stroke: object.stroke, stroke_width: object.strokeWidth, fill: object.fill, stroke: object.stroke, };
        console.log(`Rectangle to post: ${JSON.stringify(rectangle)}`)
        post_rectangle(rectangle);
    } else if (object_type == 'circle') {
        let circle = { id: object.id, radius: object.radius * object.scaleX, fill: object.fill, stroke: object.stroke, stroke_width: object.strokeWidth, fill: object.fill, stroke: object.stroke, };
        console.log(`Circle to post: ${JSON.stringify(circle)}`)
        post_circle(circle);
    } else if (object_type == 'triangle') {
        let triangle = { id: object.id, fill: object.fill, stroke: object.stroke, stroke_width: object.strokeWidth, fill: object.fill, stroke: object.stroke, };
        console.log(`Triangle to post: ${JSON.stringify(triangle)}`)
        post_triangle(triangle);
    }

}

let post_text_box = function(text_box) {
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
    }).catch(function (error) {  
        console.error(error);  
    });
}

let post_image = function() {
    // console.error("Not implemented yet!");
}

let post_rectangle = function(rectangle) {
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
    }).catch(function (error) {  
        console.error(error);  
    });
}

let post_circle = function(circle) {
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
    }).catch(function (error) {  
        console.error(error);  
    });
}

let post_triangle = function(triangle) {
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
    }).catch(function (error) {  
        console.error(error);  
    });
}



let post_object_data = function(object_data) {
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
        axios.post( `/rectangles`, { "object_id": object.id })
        .then(async function (response) {
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
        axios.post( `/circles`, { "object_id": object.id })
        .then(async function (response) {
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
        axios.post( `/triangles`, { "object_id": object.id })
        .then(async function (response) {
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
    let object_type = object.object_type;
    let object_data = { id: object.object_id, page_id: page.id, angle: object.angle, object_type: object.object_type, pos_x: object.left, pos_y: object.top };
    delete_object_data(object_data)

    // if (object_type === 'text_box') {
    //     let text_box = { id: object.id, text: object.text, }
    //     delete_text_box(text_box)
    // } else if (object_type == 'image') {
    //     let image = {};
    //     delete_image(image);
    // } else if (object_type == 'rectangle') {
    //     let rectangle = { id: object.id, fill: object.fill, stroke: object.stroke, stroke_width: object.strokeWidth,};
    //     delete_rectangle(rectangle);
    // } else if (object_type == 'circle') {
    //     let circle = { id: object.id, radius:object.radius, fill: object.fill, stroke: object.stroke, stroke_width: object.strokeWidth,};
    //     delete_circle(circle);
    // } else if (object_type == 'triangle') {
    //     let triangle = { id: object.id, fill: object.fill, stroke: object.stroke, stroke_width: object.strokeWidth,};;
    //     delete_triangle(triangle);
    // }

    canvas.remove(object);
}

// let delete_text_box = function(text_box) {
//     axios.delete(
//         `/text_boxes/${text_box.id}`, 
//         text_box,
//     ).then(async function (response) {
//     }).catch(function (error) {  
//         console.error(error);  
//     });
// }

// let delete_image = function(image) {
//     console.error("Not implemented yet!");
// }

// let delete_rectangle = function(rectangle) {
//     axios.delete(
//         `/rectangles/${rectangle.id}`, 
//         rectangle,
//     ).then(async function (response) {
//     }).catch(function (error) {  
//         console.error(error);  
//     });
// }

// let delete_triangle = function(triangle) {
//     axios.delete(
//         `/triangles/${triangle.id}`, 
//         triangle,
//     ).then(async function (response) {
//     }).catch(function (error) {  
//         console.error(error);  
//     });
// }

// let delete_circle = function(circle) {
//     axios.delete(
//         `/circles/${circle.id}`, 
//         circle,
//     ).then(async function (response) {
//     }).catch(function (error) {  
//         console.error(error);  
//     });
// }


let delete_object_data = function(object_data) {
    axios.delete(
        `/page_objects/${object_data.id}`, 
        object_data,
    ).then(async function (response) {
    }).catch(function (error) {  
        console.error(error);  
    });
}

let z_index_placement = function(page_object) {
    let z_index = page_object.z_index;

    if (z_index === 0) {
        canvas.bringForward(page_object);
    } else {
        canvas.moveTo(page_object, z_index);
    } 
}
