// right frame location
function jump(x){
    parent.frames[2].location = x;
}
function input_box(){
    document.getElementById('modal-wrapper').style.display = 'block';
    document.getElementById('input').focus();
}