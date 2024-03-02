$(document).ready(function () {
    const modal_1 = document.getElementById('modal_1');
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    //var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // open the modal 
    /*let appear = (function () {
        let done = false;
        return function () {
            if (!done) {
                done = true;
                console.log("Function Call one time");
                modal.style.display = "block";
            }
        };
    })();
    appear();*/
    //modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    var save = "";

    setInterval(function () {
        $.ajax({
            type: "GET",
            url: "../assets/php/visitor_record.php",
            data: "",
            dataType: "html",
            success: function (data) {
                var result = data.replace( / +/g, "");
                //console.log(result);
                if (data != save) {
                    if (result.includes("visitor")){
                        var check = "../visitor/" + result + ".jpg";
                        modal_1.src = check;
                        modal.style.display = "block";  
                        console.log("appear");
                    }
                    else{
                        modal.style.display = "none";   
                        console.log("remove");
                    }
                    save = data;
                    
                }
            }
        });
    }, 1000);

    

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

});