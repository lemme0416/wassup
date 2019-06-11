function color_deep(x) {
    x.style.borderColor = 'red';
}
function jump(x){
    parent.frames[2].location = x;
}
// function show_form(){
//     var hid = document.getElementById("hidden_form");
//     hid.hidden = !(hid.hidden);
// }

// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}