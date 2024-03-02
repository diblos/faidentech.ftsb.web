$(document).ready(function () {
    function change_image() {

        $.ajax({
            type: "GET",
            url: "../assets/php/result_1.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#result_1").html(data);

            }
        });

        $.ajax({
            type: "GET",
            url: "../assets/php/result_2.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#result_2").html(data);

            }
        });

        //image1();
        //image2();
        
    }

    function image1(){
        const image = document.getElementById('image_1');

        if (!image.src.includes('?')) {
            image.src = `${image.src}?${Date.now()}`;
        } else {
            image.src =
                image.src.slice(0, image.src.indexOf('?') + 1) +
                Date.now();
        }

        console.log('image refreshed');

        console.log(image.src);
    }

    function refresh() {
        location.reload();
    }

    function image2(){
        const image2 = document.getElementById('image_2');

        if (!image2.src.includes('?')) {
            image2.src = `${image2.src}?${Date.now()}`;
        } else {
            image2.src =
                image2.src.slice(0, image2.src.indexOf('?') + 1) +
                Date.now();
        }

        console.log('image refreshed');

        console.log(image2.src);
    }

    function refresh() {
        location.reload();
    }

    setInterval(function () { change_image(); }, 1000);
    // setInterval(function() {refresh();}, 5000);
});
