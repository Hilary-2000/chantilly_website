function cObj(id) {
    return document.getElementById(id);
}

function isJson(jsonString) {
    if (typeof jsonString !== "string" || jsonString.trim() === "") {
        return false; // Not a string or empty
    }

    try {
        JSON.parse(jsonString); // Attempt to parse JSON
        return true; // Valid JSON
    } catch (e) {
        return false; // Invalid JSON
    }
}

window.onload = function () {
    setCarouselListener();
}

// JavaScript function to redirect to a section of the page by ID
function redirectToSection(sectionId, form_id) {
    // Use location.hash to change the URL
    window.location.hash = sectionId;
    
    cObj(form_id).classList.add("highlight");
    setTimeout(() => {
        cObj(form_id).classList.remove("highlight");
    }, 1000);

    // Ensure the section is scrolled into view
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

function setCarouselListener() {
    var edit_carrousel = document.getElementsByClassName("edit_carrousel");
    for (let index = 0; index < edit_carrousel.length; index++) {
        const element = edit_carrousel[index];
        element.addEventListener("click", function (){
            redirectToSection("carrousel_section", "edit_carrousels");
            var carousel = cObj("carrousel_"+element.id.substring(15)).value;
            if(isJson(carousel)){
                // fill the fields
                var datapass = JSON.parse(carousel);
                cObj("download_carrousel").classList.remove("d-none");
                cObj("carrousel_title").value = datapass['carrousel_title'];
                cObj("carrousel_description").value = datapass['carrousel_description'];
                cObj("download_carrousel").href = datapass['carousel_image'];
                cObj("carrousel_id").value = datapass['carrousel_id'];
            }
        });
    }

    var delete_carrousel = document.getElementsByClassName("delete_carrousel");
    for (let index = 0; index < delete_carrousel.length; index++) {
        const element = delete_carrousel[index];
        element.addEventListener("click", function () {
            var carousel = cObj("carrousel_"+element.id.substring(17)).value;
            if(isJson(carousel)){
                // fill the fields
                var datapass = JSON.parse(carousel);
                cObj("confirmDeleteCorrousel").href = "/Homepage/deleteCarousel/"+datapass['carrousel_id'];
            }
        })
    }
}