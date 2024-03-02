$(document).ready(function(){   
    var result = "";
    setInterval(function() {
        $.ajax({    
            type: "GET",
            url: "../assets/php/visitor_table.php",             
            data:"",
            dataType: "html",                  
            success: function(data){            
                if (result != data){
                    $("#visitor_table").html(data); 
                    result = data;
                }        
                 
               
            }
        });
    }, 1000);
});