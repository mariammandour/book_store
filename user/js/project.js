$(document).ready(function () {

    $.fn.lightspeedBox();


});
$(window).on('load', function () {

    $('.loading-overlay .lds-ring').fadeOut(2000, function () {
        $('.loading-overlay').fadeOut(2000);
        this.remove();
    });
    $('body').css('overflow-y', 'auto');
});
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// When the user clicks the button, open the modal 
btn.onclick = function() {
modal.style.display = "block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
    modal.style.display = "none";
}
}
// tel international
var input = document.querySelector("#phone2");
window.intlTelInput(input, {
    preferredCountries: ['Eg', 'us'],
    utilsScript: "../js/utils.js",
});

var input = document.querySelector("#phone3");
window.intlTelInput(input, {
    preferredCountries: ['Eg', 'us'],
    utilsScript: "../js/utils.js",
});