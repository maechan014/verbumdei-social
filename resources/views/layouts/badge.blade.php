<!DOCTYPE html>
<html>
<head>
	<title>Print Identification</title>
	<style type="text/css">
		.container {width: 100%;/*height: 100%;*/font-family: "Times New Roman", Georgia, Serif;}.badge {clear:both; border: 1px solid black;height: 350px;width: 250;margin: auto;padding: 20px;position: relative;}.profilepic {height: 125px;width: 125px;display: block; margin-top: 20px; margin-left: 100px; border: 1px solid;border-radius: 10px;}.firstname {font-size: 40px;text-transform: uppercase;text-align: center;font-weight: bold; margin: auto;padding-top: 20px;}.lastname {font-size: 30px;padding-top: 20px;text-transform: uppercase;font-weight: bold;margin-left: auto;margin-right: auto;text-align: center;left: 20;right: 0;position: absolute; top: 210px;}.qrcode {position: absolute;height: 70px;width: 70px;bottom: 20;left: 110;margin-left: auto;margin-right: auto;right: 100;display: block;}
	</style>
</head>
<body>
<div class="container">
	  <div class="badge">
    <img class="profilepic" src="{{$user['picture']}}" />
	    <p class="firstname">{{$user['firstname']}}</p>
	    <p class="lastname">{{$user['lastname']}}</p>
    <img class="qrcode" src="data:image/png;base64,{{$user['qrcode']}}" alt="barcode"/>
  </div>
</div>
</body>
</html>


