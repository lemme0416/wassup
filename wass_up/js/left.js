function color_deep(x) {
    x.style.borderColor = 'red';
}
function jump(x){
    parent.frames[2].location = x;
}

var nono = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == nono) {
        nono.style.display = 'none';
        console.log("QAQ");
    }
    console.log("AAA");

}