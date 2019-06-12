<html>
<head>
    <link rel="shortcut icon" href="https://imgur.com/G4KMHP3.png" type="image/x-icon" />
    
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    
    <link rel="stylesheet" href="index.css">
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>        
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>   
</head>
<body onload="startGame()">
<script>
var myGameArea;
var myGamePiece;
var myObstacles = [];
var myScore;
var pause = false; //if the game is paused set it to true
var speed = 5;
var life = 3;
var spark = 0; // control the time of invincible status
var bump = false; // if bump into obstacle set it to truth
var points=0; // points of passing Obstacles
var up = false;
var down = false;
var left = false;
var right = false;
var space = false;
var fly = 0;
var add_point;
var over = false;


function startGame() {
    myGameArea.start();
    myGamePiece = new component(50, 50, "startup.png", 10, 225, "image"); 
    myScore = new textcomponent("20px", "Arial", "black", 380, 20);
    myLife = new textcomponent("20px", "serif", "blue", 380, 40);
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    title : document.createElement("h3"),

    start : function() {
        /*var node = document.createTextNode("Star War 87");
        this.title.appendChild(node);
        document.body.insertBefore(this.title, document.body.childNodes[0]);*/

        this.canvas.width = 500;
        this.canvas.height = 500;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0;
        this.interval = setInterval(updateGameArea, 20);

        window.addEventListener('keydown', function (e) {
            //record of every pressed down keyboards
            if (e.keyCode == 32) {
                if (space == false) {
                    myGameArea.stop();
                }
                space = true;
            }
            else if (e.keyCode == 37) {
                left = true;
            }
            else if (e.keyCode == 13 && over) {
                myGameArea.restart();
            }
            else if (e.keyCode == 38) {
                up = true;
            }
            else if (e.keyCode == 39) {
                right = true;
            }
            else if (e.keyCode == 40) {
                down = true;
            }
            else if (e.keyCode == 82) {
                myGameArea.restart();
            }
        })
        window.addEventListener('keyup', function (e) {        
            //reset the record of every keyup buttons on keyboards
            if (e.keyCode == 32) {
                space = false;
            }
            else if (e.keyCode == 37) {
                left = false;
            }
            else if (e.keyCode == 38) {
                up = false;
            }
            else if (e.keyCode == 39) {
                right = false;
            }
            else if (e.keyCode == 40) {
                down = false;
            }
        })    
    },

    clear : function() {
        //clear the current canvas status
        ctx = myGameArea.context;
        ctx.fillStyle = '#1b2735';
        ctx.fillRect(0, 0, 500, 500);
    },
    stop : function() {
        //implement pause function
        pause = !pause;
    },
    restart : function(){
        //implement restart function
        location.reload();
    }
}







//function of creating component
function component(width, height, color, x, y, type) {
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;
    this.add = false;


    this.type = type;
    if (type == "image") {
        this.image = new Image();
        this.image.src = color;
    }

    this.update = function () {
        ctx = myGameArea.context;
        if (type == "image") {
            if (fly == 0) {
                this.width = 70;
                this.height = 70;
            }
            else {
                this.width = 50;
                this.height = 50;
            }
            ctx.drawImage(this.image, this.x, this.y, this.width, this.height);
        } 
        else {
            this.x -= speed;
            this.y += this.speedY;
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }

    }
    //update component's position
    this.newPos = function() {
        var borderx = myGameArea.canvas.width - this.width;
        var bordery = myGameArea.canvas.height - this.height;
        if(this.x<0){this.x=0};
        if(this.x>borderx){this.x=borderx};
        if(this.y<0){this.y=0};
        if(this.y>bordery){this.y=bordery};

        this.x += this.speedX;
        this.y += this.speedY;        
    }

    //crash function detect function
    this.crashWith = function(otherobj) {
        var myleft = this.x;
        var myright = this.x + (this.width);
        var mytop = this.y + 15;
        var mybottom = this.y + (this.height) - 15;
        var otherleft = otherobj.x;
        var otherright = otherobj.x + (otherobj.width);
        var othertop = otherobj.y;
        var otherbottom = otherobj.y + (otherobj.height);
        var crash = true;
        if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
            crash = false;
        }
        if (this.x + this.width / 2 > otherobj.x + otherobj.width / 2 && otherobj.add == false) {
            otherobj.add = true;
            add_point = true;
        }
        return crash;
    }
}

//function of creating text as a component
function textcomponent(size, family, color, x, y) {
    this.size = size;
    this.family = family;
    this.color = color;
    this.x = x;
    this.y = y;    
    this.update = function() {
        ctx = myGameArea.context;
        ctx.font = this.size + " " + this.family;
        ctx.fillStyle = color;
        ctx.fillText(this.text, this.x, this.y);
    }
}

//The everyinterval function returns true if the current framenumber corresponds with the given interval.
function everyinterval(n) {
    if ((myGameArea.frameNo / n) % 1 == 0) {
        return true;
    }
  return false;
}


function kbcontrol(){
    //implement different keyboard control
    if (left == true && right == false) {
        myGamePiece.speedX = -5;
        myGamePiece.image.src = "startup_back.png";
        fly = 0;
    }
    else if (right == true && left == false) {
        myGamePiece.speedX = 5;
        myGamePiece.image.src = "startup_forward.png";
        fly = 0;
    }
    else {
        myGamePiece.speedX = 0;
    }
    if (up == true && down == false) {
        myGamePiece.speedY = -5;
        myGamePiece.image.src = "startup_up.png";
        fly = 1;
    }
    else if (down == true && up == false) {
        myGamePiece.speedY = 5;
        myGamePiece.image.src = "startup_down.png";
        fly = 2;
    }
    else if ((left == true && right == true) || (left == false && right == false)) {
        myGamePiece.speedY = 0;
        myGamePiece.image.src = "startup.png";
        fly = 0;
    }
    else {
        myGamePiece.speedY = 0;
    }
    if ((spark / 5) % 3 < 2 && spark!=0) {
        myGamePiece.image.src = "";
    }
}


function updateGameArea() {
    if (pause && !over) {
        myGamePiece.update();
        return;
    }
    myGameArea.clear();
    if (over) {
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, 500, 500);
        over = new textcomponent("40px", "serif", "black", 210, 60);
        over.text = "Over!";
        over.update();
        score = new textcomponent("20px", "serif", "black", 195, 230);
        score.text = "Your score: " + points.toString();
        score.update();
        hint = new textcomponent("20px", "serif", "black", 140, 270);
        hint.text = "Press enter to start a new game";
        hint.update();
        return;
    }
    var x, height, gap, minHeight, maxHeight, minGap, maxGap;
    if (bump == true) {
        spark++;
        if (spark == 100) {
            bump = false;
            spark = 0;
        }
    }
    add_point = false;
    for (i = 0; i < myObstacles.length; i += 1) {
        if (myGamePiece.crashWith(myObstacles[i])) {
            //implement action when crash into obstacle
            if (bump == false) {
                bump = true;
                life--;
                if (life == 0) {
                    over = true;
                    return;
                }
            }
        } 
    }

    if (add_point) points++;


    //update Obstacles  
    myGameArea.frameNo += 1;
    if ((myGameArea.frameNo == 1 || everyinterval(50))) {
        //implement random moving obstacles
        if (myGameArea.frameNo == 1) {
            myObstacles.push(new component(10, 300, "green", 400, 0));
            pause = true;
        }
        else if (myGameArea.frameNo > 1000 && Math.random() > 0.5) {
            if (Math.random() > 0.5) {
                length = 200 + Math.random() * 100;
                move_down = new component(10, length, "yellow", 500, 0 - length)
                move_down.speedY = 6 + Math.random() * 5;
                myObstacles.push(move_down);
            }
            else {
                length = 200 + Math.random() * 100;
                move_up = new component(10, length, "orange", 500, 500 + length);
                move_up.speedY = -6 - Math.random() * 5;
                myObstacles.push(move_up);
            }
        }
        else {
            var gap = Math.random() * 50 + 90;
            var gap_y = Math.random() * (500 - gap + 20) - 25;
            myObstacles.push(new component(10, gap_y, "green", 510, 0));
            myObstacles.push(new component(10, 500 - (gap_y + gap), "green", 510, gap_y + gap));
        }
    }
    for (i = 0; i < myObstacles.length; i += 1) {
        myObstacles[i].update();
    }





    //update gamepiece
    //implement of making gamepiece invincible state when bumping into obstacle
    myGamePiece.newPos();
    myGamePiece.update();
    



    //update score and life
    myScore.text = "SCORE: " + points.toString();
    myScore.update();
    myLife.text = "Life: " + life.toString();
    myLife.update();


    //function of keyboard control
    kbcontrol();

}



</script>
</body>
</html>
