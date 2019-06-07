<html>
<head>
    <meta charset="utf-8" />
    <title>left</title>
	<style>
		div{
			overflow: hidden;
			background-color: gray;
		}
		body{
			background-color: gray;
			margin: 0px;
		}
		p{
			text-align: center;
			color: white;
		}
	</style>
</head>
<body>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump()">
		<p>修改密碼</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump()">
		<p>上傳音樂</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump()">
		<p>排行榜</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump()">
		<p>list1</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump()">
		<p>list2</p>
	</div>
	<div onmouseover="color_deep(this)" onmouseout="color_shallow(this)" onclick="jump()">
		<p>list3</p>
	</div>

    <script>
        function interact() {
			var x = document.getElementsByName("text")[0].value;
			var address = "right.php?text=" + x;
			parent.frames[1].location = address;
        }
		function color_deep(x) {
			x.style.backgroundColor = 'DimGray';
		}
		function color_shallow(x) {
			x.style.backgroundColor = 'gray';
		}
		function jump(){
			var address = "right.php?text=123";
			parent.frames[1].location = address;
		}
    </script>
</body>
</html>