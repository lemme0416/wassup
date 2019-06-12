var loop_or_single = false;                   // 單曲or連續
var i = 0,x=0;                                // counter
var length;
var obj, dbParam, xmlhttp;
obj = { "table":"music", "id":1, "lan":2};//0->eu 1->asia 2->all
var play_mode = "loop";                       //播放模式
var myObj
window.onload = play_music(obj)               //開場先讀一次資料庫的資料
function play_music(obj){                     //放音樂的func
  dbParam = JSON.stringify(obj);              
  var xmlhttp = new XMLHttpRequest();
  i = obj.id;                                 
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {   
    myObj = JSON.parse(this.responseText);    
    length = myObj.length;
    var music_name = "something bad";           
    //O(n) search id 
    for (x in myObj){
      if(myObj[x].id == i){ 
        music_name = myObj[x].name;
        i = x;
        break;
      }
    }
    //撥放器的相關設定
    //document.getElementById("l").innerHTML = i;
    document.getElementById("music").src = "music/"+music_name+".mp3";
    document.getElementById("music").loop = false;                                            //是否單曲循環
    document.getElementById("test").innerHTML = music_name;                                   //show music name
    document.getElementById("music").addEventListener('ended',playendedhandler, false);
    document.getElementById("music").play();                                                  //自動播放
    
  }
};
xmlhttp.open("GET", "music.php?x="+dbParam, true);
xmlhttp.send();
}
//produce random number
function getRandom(x){
    return Math.floor(Math.random()*x)+1;
};
//上一首
function backsong(){
  if (play_mode == "random") i = getRandom(length);                                 //if random
      else if (i == 0)i =length-1;                                                  //if first song
      else i--;                                     
      document.getElementById("music").loop = false;                                //輪流播放
      document.getElementById("music").src = "music/"+myObj[i].name+".mp3";         
      document.getElementById("test").innerHTML = myObj[i].name;                    //music name
      //document.getElementById("l").innerHTML =i;                                    
      document.getElementById("music").play();
      
}
//when sond ended
function playendedhandler(){
      //random
      if (play_mode == "random") i = getRandom(length);
      //回到第一首
      else if (i == length-1)i =0;
      else i++;
      document.getElementById("music").loop = false;                                 //輪流播放
      document.getElementById("music").src = "music/"+myObj[i].name+".mp3";          
      document.getElementById("test").innerHTML = myObj[i].name;                     
      //document.getElementById("l").innerHTML =i;
      document.getElementById("music").play();                                        //音樂自動播放
      
    }
// control play mode;
function showCustomer(str){
  play_mode = str;
  if (str == "single"){
    document.getElementById("music").loop = true; 
    document.getElementById("loop").src = "https://i.imgur.com/LvIr9Uu.png";
    document.getElementById("single").src = "https://i.imgur.com/D0bt3KD.png";
    document.getElementById("random").src = "https://i.imgur.com/u09pKuP.png";
  }
  else if(str == "loop"){
    document.getElementById("music").loop = false;
    document.getElementById("loop").src = "https://i.imgur.com/er0TBWN.png";
    document.getElementById("single").src = "https://i.imgur.com/D0bt3KD.png";
    document.getElementById("random").src = "https://i.imgur.com/u09pKuP.png";
  }
  else{
    document.getElementById("loop").src = "https://i.imgur.com/LvIr9Uu.png";
    document.getElementById("single").src = "https://i.imgur.com/j1jzgdj.png";
    document.getElementById("random").src = "https://i.imgur.com/Z3ZLLhP.png";
  }
}
function next(x){
  x.src="https://i.imgur.com/NvVbqcF.png";
}
function previous(x){
  x.src="https://i.imgur.com/Ou0uTxe.png";
}
function repeat(x){
  x.src="https://i.imgur.com/LvIr9Uu.png";
}
function shuffle(x){
  x.src="https://i.imgur.com/u09pKuP.png";
}
function single(x){
  x.src="https://i.imgur.com/j1jzgdj.png";
}

function next_hover(x){
  x.src="https://i.imgur.com/gjTSx0j.png";
}
function previous_hover(x){
  x.src="https://i.imgur.com/xJzQBta.png";
}
function repeat_hover(x){
  x.src="https://i.imgur.com/er0TBWN.png";
}
function shuffle_hover(x){
  x.src="https://i.imgur.com/Z3ZLLhP.png";
}
function single_hover(x){
  x.src="https://i.imgur.com/D0bt3KD.png";
}