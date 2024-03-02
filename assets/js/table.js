$(document).ready(function () {
    setInterval(function () {
        $.ajax({
            type: "GET",
            url: "../assets/php/table.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#table").html(data);

            }
        });


        $.ajax({
            type: "GET",
            url: "../assets/php/authorize.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#authorize").html(data);

            }
        });

        $.ajax({
            type: "GET",
            url: "../assets/php/visitor.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#visitor").html(data);

            }
        });

        $.ajax({
            type: "GET",
            url: "../assets/php/enter.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#enter").html(data);

            }
        });

        $.ajax({
            type: "GET",
            url: "../assets/php/exit.php",
            data: "",
            dataType: "html",
            success: function (data) {
                $("#exit").html(data);

            }
        });


    }, 1000);

});