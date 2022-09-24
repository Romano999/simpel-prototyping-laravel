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
    for (let object of pageObjects) {
        if (object.object_type == 'text_box') {
            render_text_box(object);
        }
    }
});

let render_text_box = function(pageObject) {
    let givenText = pageObject.text;
    let x = pageObject.pos_x;
    let y = pageObject.pos_y;
    let font = pageObject.font;

    console.log(`Rendering text box at (${x},${y}) with text '${givenText}' and font '${font}'`)
    // Create a new Text instance
    var text = new fabric.Text(givenText, {
        font: font,
        left: x,
        top: y,
    });

    // Render the Text on Canvas
    canvas.add(text);
}

let draw_shapes = function() {
    context.clearRect(0, 0, canvas_width, canvas_height);

    for (let shape of shapes) {
        context.fillStyle = shape.color;
        context.fillRect(shape.x, shape.y, shape.width, shape.height);
    }
}

