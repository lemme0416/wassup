var loop_or_single = false;
var i = 0,x=0;
var length;
var obj, dbParam, xmlhttp;
obj = { "table":"music", "id":1 };
var play_mode = "loop";
var myObj
window.onload = play_music(obj)
function play_music(obj){
  dbParam = JSON.stringify(obj);
  var xmlhttp = new XMLHttpRequest();
  i = obj.id;
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    myObj = JSON.parse(this.responseText);
    length = myObj.length;
    var music_name = "something bad";
    for (x in myObj){
      if(myObj[x].id == i){ 
        music_name = myObj[x].name;
        i = x;
        break;
      }
      //document.write()
    }
    //document.getElementById("l").innerHTML = i;
    document.getElementById("music").src = "music/"+music_name+".mp3";
    document.getElementById("music").loop = false;
    document.getElementById("test").innerHTML = music_name;
    document.getElementById("music").addEventListener('ended',playendedhandler, false);
    document.getElementById("music").play();
    
  }
};
xmlhttp.open("GET", "music.php?x="+dbParam, true);
xmlhttp.send();
}
function getRandom(x){
    return Math.floor(Math.random()*x)+1;
};
function backsong(){
  if (document.getElementById("playmode").value == "random") i = getRandom(length);
      else if (i == 0)i =length-1;
      else i--;
      document.getElementById("music").loop = false;
      document.getElementById("music").src = "music/"+myObj[i].name+".mp3";
      document.getElementById("test").innerHTML = myObj[i].name;
      document.getElementById("l").innerHTML =i;
      document.getElementById("music").play();
      
}
function playendedhandler(){
      //random
      if (play_mode == "random") i = getRandom(length);
      //回到第一手
      else if (i == length-1)i =0;
      else i++;
      document.getElementById("music").loop = false;
      document.getElementById("music").src = "music/"+myObj[i].name+".mp3";
      document.getElementById("test").innerHTML = myObj[i].name;
      document.getElementById("l").innerHTML =i;
      document.getElementById("music").play();
      
    }
function showCustomer(str){
  play_mode = str;
  if (str == "single"){
    document.getElementById("music").loop = true;
  }
  else {
    document.getElementById("music").loop = false;
  }
}
