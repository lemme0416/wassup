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