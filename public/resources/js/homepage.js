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
    setCurrillumListerner();
}

function setCurrillumListerner() {
    let curriculum_data = document.getElementsByClassName("curriculum_data");
    for (let index = 0; index < curriculum_data.length; index++) {
        const element = curriculum_data[index];
        element.addEventListener("click", function () {
            let elem_data = cObj("edit_curriculum_data_"+element.id.substring(17)).value;
            if (isJson(elem_data)) {
                var element_data = JSON.parse(elem_data);
                cObj("curriculum_title").value = element_data['curriculum_title'];
                cObj("curriculum_age_range").value = element_data['curriculum_age_range'];
                cObj("curriculum_classes").value = element_data['curriculum_classes'];
                cObj("curriculum_description").value = element_data['curriculum_description'];
                cObj("download_curricullum_image").href = element_data['curriculum_image'];
                cObj("curricullum_image_thumbnail").src = element_data['curriculum_image'];
                cObj("curriculum_id").value = element_data['curriculum_id'];
            }
        });
    }

    var delete_curriculum = document.getElementsByClassName("delete_curriculum");
    for (let index = 0; index < delete_curriculum.length; index++) {
        const element = delete_curriculum[index];
        element.addEventListener("click", function () {
            var url = "/Homepage/deleteCurricullum/"+element.id.substring(18);
            cObj("confirmDeleteCurricullum").href = url;
        });
    }
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
