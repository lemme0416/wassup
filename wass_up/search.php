<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        
        <link rel="stylesheet" href="css/search.css">

    </head> 
    <body> 
        <ul class="text">
            <li>W</li>
            <li>a</li>
            <li>s</li>
            <li>s</li>
            <li>U</li>
            <li>p</li>
            <li>!</li>
        </ul>
        <div>
            <form method="get" action="search.php" class="search-box"> 
                <input type="text" id="search" name="search" required="true" placeholder="Search" class="search-txt">
                <button type="submit" name="submit" class="search-btn" onclick="jump()">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        <div> 
    </body> 
</html>

<script>
	function jump(){
        var x = document.getElementById("search").value;
		parent.frames[2].location = "show_search_result.php?search="+x;
	}
</script>