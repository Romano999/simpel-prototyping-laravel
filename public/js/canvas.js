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

window.addEventListener('DOMContentLoaded', (event) => {

    // Create a new instance of Canvas
    canvas = new fabric.Canvas("canvas");
 

    // Render all page objects
    for (let pageObject of pageObjects) {
        render(pageObject)
    }

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
    }
}

let render_image = function() {
    // fabric.Image.fromURL('my_image.png', function(img) {
    //     canvas.add(img);
    // });
}

let render_text_box = function(pageObject) {
    // Create a new Text instance
    var text = new fabric.Text(pageObject.text, {
        id: pageObject.id,
        object_id: pageObject.object_id,
        font: pageObject.font,
        left: pageObject.pos_x,
        top: pageObject.pos_y,
        angle: pageObject.angle,
        object_type: pageObject.object_type,
    });

    // Render the Text on Canvas
    canvas.add(text);
}

let post_object = function(event) {
    console.log(event);
    let object_type = event.target.object_type;
    

    if (object_type === 'text_box') {
        let object_data = { id: event.target.object_id, page_id: page.id, angle: event.target.angle, object_type: event.target.object_type, pos_x: event.target.left, pos_y: event.target.top };
        let text_box = { text: event.target.text, }
        post_text_box(text_box)
        post_object_data(object_data)
    }
}

let post_text_box = function(text_box) {
    // console.log(`Text box: ${JSON.stringify(text_box)}`);
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

