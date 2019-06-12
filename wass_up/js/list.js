function play_black(x){
    x.src="https://i.imgur.com/P3DW52n.png";
}
function play_white(x){
    x.src="https://i.imgur.com/T1iuPh7.png";
}
function jump(id, table){
    var obj = {"table":table, "id":id-1};
    parent.frames[3].play_music(obj);
}
function bubble(event){
    event.cancelBubble = true;
}