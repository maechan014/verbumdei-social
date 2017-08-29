<!DOCTYPE html>
<html>
  <head>
    <style>
	@font-face {
		font-family: 'Bebas Neue';
		font-style: normal;
		font-weight: normal;
		src: local('Bebas Neue'), url('fonts/BebasNeue.woff') format('woff');
	}
	@page { margin: 0px; padding: 0px;}
    body {
	  margin: 0;
	  padding: 0;
	  -webkit-print-color-adjust:exact;
	  /*width: 1000px;*/
	}
/*	page {
	  background: white;
	  display: block;
	  width: 2550px;
	  height: 3300px;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}*/

	.card {
		float: left;
		margin: 10px 5px;
		position: relative;
		border: 1px solid black;
		width: 250px;
		height: 327px;


		background: url('/images/card2.png');
		

		background-size: contain;
		page-break-after: always;
        page-break-inside: avoid;
	}
	.card .qrcode {
		position: absolute;
		right: 3px;
		bottom: 3px;
		padding: 5px;
		background-color: #fff;
		width: 65px;
		height: 65px;
		-webkit-filter: hue-rotate(180deg); filter: hue-rotate(180deg);
		-webkit-print-color-adjust: exact;
		/*-webkit-filter: grayscale(100%); filter: grayscale(100%);*/
	}

	.card .name {
		position: absolute;
		top: 330px;
		left: 3px;
		font-size: 11px;
		z-index: 5;
	}

	.clearfix {
	    clear: both;
	}


    </style>
  </head>
  <body>
  	<?php $count = 0; ?>

  	@foreach($users as $user)
  		<?php if($count > 2) { $count = 0; echo "<br class='clearfix'>"; }?>
  		<div class="card">
			<img class="qrcode" src="data:image/png;base64,{{ $user['qrcode'] }}">
			<span class="name">{{ $user['name'] }}</span>
	  	</div>
	  	<?php $count++; ?>
  	@endforeach
  </body>

  <script type="text/javascript">
  	window.print();
  </script>
</html>