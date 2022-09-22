// Runs when DOM content is finished loading.
let shapes = [];
let canvas;
let is_dragging = false;
let startX;
let startY;
let current_shape_index;
let context;
let canvas_width;
let canvas_height;
// Passed on by blade file
var page = page;
var pageObjects = pageObjects;

window.addEventListener('DOMContentLoaded', (event) => {

    console.log(page);
    console.log(pageObjects);

    canvas = document.getElementById("canvas");
    context = canvas.getContext("2d");
    
    canvas.width = canvas.width;
    canvas.height = canvas.height;
    
    canvas.style.border = '5px solid red';

    shapes.push({ x: 200, y: 0, width: 200, height: 200, color:'red' });
    shapes.push({ x: 0, y: 0, width: 100, height: 100, color:'blue' });
    
    canvas.onmousedown = mouse_down;
    canvas.onmouseup = mouse_up;
    canvas.onmouseout = mouse_out;
    canvas.onmousemove = mouse_move;

    canvas_width = canvas.width;
    canvas_height = canvas.height;

    draw_shapes();
});

let is_mouse_in_shape = function(x, y, shape) {
    let shape_left = shape.x;
    let shape_right = shape.x + shape.width;
    let shape_top = shape.y;
    let shape_bottom = shape.y + shape.height;

    console.log(`Shape has the following coords: left ${shape_left}, right ${shape_right}, top ${shape_top}, bottom ${shape_bottom} `)

    // Check if coords are in the given shape
    if (x > shape_left && x < shape_right && y > shape_top && y < shape_bottom) {
        return true
    }

    return false;
}

let mouse_down = function(event) {
    event.preventDefault();

    let rect = canvas.getBoundingClientRect();
    startX = parseInt(event.clientX - rect.left);
    startY = parseInt(event.clientY - rect.top);

    // console.log(`Clicked at position: (${x}, ${y})`)



    let index = 0;
    for (let shape of shapes) {
        if (is_mouse_in_shape(startX, startY, shape)) {
            current_shape_index = index;
            is_dragging = true;
            return;
        } else {

        }
        
        index++;
    }
}

let mouse_up = function(event) {
    if (!is_dragging) {
        return;
    }

    event.preventDefault();
    is_dragging = false;
}

let mouse_out = function(event) {
    if (!is_dragging) {
        return;
    }

    event.preventDefault();
    is_dragging = false;
}

let mouse_move = function(event) {
    console.log(startX);
    console.log(startY);
    if(!is_dragging) {
        return
    } else {
        event.preventDefault();
        let rect = canvas.getBoundingClientRect();
        let offsetX = rect.left;
        let offsetY = rect.top;

        let mouseX = parseInt(event.clientX - offsetX);
        let mouseY = parseInt(event.clientY - offsetY);

        let dx = mouseX - startX;
        let dy = mouseY - startY;

        let current_shape = shapes[current_shape_index];
        current_shape.x += dx;
        current_shape.y += dy;

        draw_shapes();

        startX = mouseX;
        startY = mouseY;
    }
}

let draw_shapes = function() {
    context.clearRect(0, 0, canvas_width, canvas_height);

    for (let shape of shapes) {
        context.fillStyle = shape.color;
        context.fillRect(shape.x, shape.y, shape.width, shape.height);
    }
}

