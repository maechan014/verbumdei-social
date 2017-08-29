<!DOCTYPE html>
<html>
<head>
  <title>Print QR Code</title>
  <style type="text/css">
    .container {width: 100%;/*height: 100%;*/font-family: "Times New Roman", Georgia, Serif; padding: 10px; margin-top: 5px;}
    .data { width: 150px; margin: 10px; display: inline-block; text-align: center; }
    .data p {text-align: center;word-wrap: break-word; width: 90%;}
    .data .qrcode {width: 150px;}
  </style>
</head>
<body>
  <div class="container">
  <?php $count = 0; ?>
  @foreach($users as $user)
  @if($count >= 5)
  <br><br>
  <div class="data">
      <img class="qrcode" src="data:image/png;base64,{{ $user['qrcode'] }}" alt="barcode"/>
    <p class="name">{{ $user['name'] }}</p>
    </div>
     <?php $count = 0; ?>
  @else
    <div class="data">
      <img class="qrcode" src="data:image/png;base64,{{ $user['qrcode'] }}" alt="barcode"/>
    <p class="name">{{ $user['name'] }}</p>
    </div>
    <?php $count++; ?>
  @endif
  @endforeach
  </div>
</body>
</html>


