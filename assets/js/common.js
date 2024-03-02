function setRow(rowclass, bool) {
    const rows = document.getElementsByClassName(rowclass);
    for (let i = 0; i < rows.length; i++) {
        // rows[i].style.display = bool ? "block" : "none";
        
            // rows[i].classList.add("d-block");
            // rows[i].classList.remove("d-none");
            // console.log(rows[i]);
        
    }
}

function editMode(objectId, bool) {
    if (!objectId) {
        return;
    }
    // console.log(objectId, bool);
    toggleObjectEnablity(`${objectId}-edit`, !bool);
    toggleObjectEnablity(`${objectId}-save`, bool);

    toggleObjectVisibility(`${objectId}-nameV`, !bool);
    toggleObjectVisibility(`${objectId}-nameI`, bool);

    toggleObjectVisibility(`${objectId}-licenseV`, !bool);
    toggleObjectVisibility(`${objectId}-licenseI`, bool);

    toggleObjectVisibility(`${objectId}-categoryV`, !bool);
    toggleObjectVisibility(`${objectId}-categoryI`, bool);

    // VISITOR REG ONWARDS

    toggleObjectVisibility(`${objectId}-phoneV`, !bool);
    toggleObjectVisibility(`${objectId}-phoneI`, bool);

    toggleObjectVisibility(`${objectId}-purposeV`, !bool);
    toggleObjectVisibility(`${objectId}-purposeI`, bool);

    toggleObjectVisibility(`${objectId}-time_limitV`, !bool);
    toggleObjectVisibility(`${objectId}-time_limitI`, bool);

    toggleObjectVisibility(`${objectId}-expired_dateV`, !bool);
    toggleObjectVisibility(`${objectId}-expired_dateI`, bool);

    return false;
}

function toggleObjectVisibility(objectId, show) {
    const object = document.getElementById(objectId);
    if (object) {
        // console.log(object);
        // object.style.display = show ? "block" : "none";
        // object.style.visibility = show ? "visible" : "hidden";

        if(show) {
            object.classList.add("d-block");
            object.classList.remove("d-none");
        }else{
            object.classList.add("d-none");
            object.classList.remove("d-block");
        }
    }
}

function toggleObjectEnablity(objectId, show) {
    const object = document.getElementById(objectId);
    if (object) {
        if(show) {
            object.classList.remove("disabled");
        }else{
            object.classList.add("disabled");
        }
    }
}

function resetMode() {
    return false;
}

// receive array of properties and values, submit to php page
function submitForm(formId, properties) {
    const form = document.getElementById(formId);
    if (form) {
        properties.forEach((property) => {
            const input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", property.name);
            input.setAttribute("value", property.value);
            form.appendChild(input);
        });
        form.submit();
    }
}

function submitPostForm(formData) {
    const processUrl = "update_1.php";
    try {
        $.ajax({   
            type: "POST",
            data : $(formData).serialize(),
            url: processUrl,   
            success: function(data){
                console.log(data);
                $("#results").html(data);
                return true;
            }   
        });   
        return false;
    } catch (error) {
        console.log(error);
        return false;
    }
}