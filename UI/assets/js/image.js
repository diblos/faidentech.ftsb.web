// Select the image element using its ID
const image_1 = document.getElementById('image_1');
const image_2 = document.getElementById('image_2');

var count=0;

function change_image(){
    // Update the image source
    image_1.src = '../cam_out/result_out.jpg';
    image_2.src = '../cam_in/result_in.jpg';  
    count += 1
}


setInterval(function() {change_image(); console.log(count)}, 1000);