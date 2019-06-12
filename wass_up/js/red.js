function play_black(x){
    x.src="https://i.imgur.com/P3DW52n.png";
}
function play_white(x){
    x.src="https://i.imgur.com/T1iuPh7.png";
}
function jump(x){
    var address = "music2.php?id=" + x;
    var obj = {"table":"music", "id":x};
    parent.frames[3].play_music(obj);
}
function bubble(event){
    event.cancelBubble = true;
}