function color_deep(x) {
    x.style.borderColor = 'red';
}
function jump(x){
    parent.frames[2].location = x;
}
function show_form(){
    var hid = document.getElementById("hidden_form");
    hid.hidden = !(hid.hidden);
}

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}