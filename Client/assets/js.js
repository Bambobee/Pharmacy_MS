//variables
// let thumbails = document.getElementsByClassName("thumbnail");
let slider = document.getElementById("slider");
let buttonRight= document.getElementById("slide-right");
let buttonLeft= document.getElementById("slide-left");


buttonLeft.addEventListener("click", () => {
    slider.scrollLeft -= 125;

});
buttonRight.addEventListener("click", () => {
    slider.scrollLeft += 125;

});
const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
//alert(maxScrollLeft);

// Autoplay slider

function autoplay() {
    if (slider.scrollLeft > (maxScrollLeft - 1)) {
        slider.scrollLeft -= maxScrollLeft;
    } else {
        slider.scrollLeft += 1;
    }
}
let play = setInterval(autoplay, 50);