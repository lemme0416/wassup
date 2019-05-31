// when i move my mouse on the page, do something

$(document).on("mousemove",function(ev){
    var mouseX = ev.originalEvent.pageX
    var mouseY = ev.originalEvent.pageY

    //go through all of the image and work out the angle
    $("img").each(function(){
        var imgX = $(this).position().left + 70
        var imgY = $(this).position().top + 70

        var diffX = mouseX - imgX
        var diffY = mouseY - imgY

        var radians = Math.atan2(diffY, diffX)

        var angle = radians*180/Math.PI

        $(this).css("transform","rotate(" + angle + "deg)")

    })
})
var x = 0;
function weed() {
    var weed_change = document.getElementById("weed_img");
    var change_all_img = document.getElementsByTagName("img");
    if(weed_change.src == "https://imgur.com/OCPuJWd.png" || weed_change.src == "https://imgur.com/nu6kddk.png" || weed_change.src == "https://imgur.com/oHRDOIX.png"){
        var i
        x = 1;
        for(i=0;i<12;i++) change_all_img[i].src = "https://imgur.com/o0W8f4A.png"
        document.getElementsByTagName("body")[0].style.background = "green"
        $('.box').css('background', 'green');
        document.getElementById("music").play();
    }
    else{
        x = 0;
        for(i=0;i<12;i++) change_all_img[i].src = "https://imgur.com/OCPuJWd.png"
        document.getElementsByTagName("body")[0].style.background = "red"
        $('.box').css('background', 'red');
        document.getElementById("music").pause();


    }
}
//every 3 seconds change the music_icon

var count = 0
var images = ["https://imgur.com/OCPuJWd.png", "https://imgur.com/nu6kddk.png", "https://imgur.com/oHRDOIX.png"]
var weed_images = ["https://imgur.com/o0W8f4A.png", "https://imgur.com/MhR0e2x.png", "https://imgur.com/k85JeqU.png"]
setInterval(function(){
    if(x == 0){
        count += 1
        count = count % images.length
        var image = images[count];

        $("img").attr("src",image)        
    }
    else{
        count += 1
        count = count % weed_images.length
        var image = weed_images[count];

        $("img").attr("src",image)          
    }
}, 1500)