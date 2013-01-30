<html>
	<head>
		<title>BroQode</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>media/css/style.css" />
		<script type="text/javascript" src="<?=base_url();?>js/jquery.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/script.js"></script>
	</head>
	<body>
		<div id="head">BroQode - All you need is one</div>
		<center>
			<br />
		<div id="qrStream">
			<img src='https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=<?=$url?>&choe=UTF-8&chld=L|0'/>
			<form id='url_<?=$code?>' action='' onSubmit='return dd("<?=$code?>")' id='qrupdate'>
				<br />
				<input name='data' id='data' type='text' value='<?=$data?>'/>
				<input type='hidden' name='id' value='<?=$code?>'><br />
				<input type='submit' class='updtqr' value='Connect to BroQode' />
			</form>
			<small>You will need this to access this page again from another computer. You should bookmark it!</small><br>
			Your secret admin link:
			<a href="<?=$secret_url?>"><?=$secret_url?></a>
			<br>
			E-mail this to me: <form action="" method="post"><input type="text" name="email" id="email"> </form>
			<p>Total views: <?=$views?></p> 
			
		</div>
		</center>
	<!--<div style="float: right;"><iframe src="http://www.facebook.com/plugins/like.php?href=www.broqode.me"
        scrolling="no" frameborder="0"
        style="border:none; width:200px; height:80px float: right;"></iframe></div> -->
	</body>
</html>