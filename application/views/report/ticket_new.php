<!DOCTYPE html>
<html>
<head>
	<title>Tiket Baru</title>
	<style>
		/* Gaya CSS untuk tiket */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			max-width:100%;
			max-height:100%;
		}
		.ticket {
			width: 100%;
			height: 300px;
			/* margin: 0px auto;
			padding: 0px; */
			border: 1px solid #ccc;
			/* background-color: #f9f9f9; */
			background-image: url('<?= base_url('/assets/img/rm222batch2-mind-03.jpg') ?>');

		}
		.ticket h1 {
			text-align: center;
			margin-bottom: 20px;
		}
		.ticket p {
			margin-bottom: 10px;
			text-align: justify;
		}
		.ticket .ticket-info {
			margin-bottom: 20px;
		}
		.ticket .ticket-info span {
			font-weight: bold;
		}
		.ticket .column1 {
			width: 30%;
			float: left;
			/* padding: 10px; */
		}
		.ticket .column2 {
			width: 40%;
			float: left;
			/* padding-left: 5px; */
			/* margin-left: 10px; */
			/* padding: 10px; */
		}
		.ticket .column3 {
			border-left: 1px dashed black;
			width: 25%;
			float: left;
			margin: 25px;
			padding-right: 50px;
			margin-right: 20px;
			padding: 10px;
		}
		/* .rotate {
			transform: rotate(-90deg);
			-webkit-transform: rotate(-90deg);
			-moz-transform: rotate(-90deg);
			-o-transform: rotate(-90deg);
			-ms-transform: rotate(-90deg);
		} */
		.barcode {			
			/* position: absolute; */
			/* text-align: center; */
			/* margin-top: 100px; */
		}
	</style>
</head>
<?php foreach ($list as $key): ?>
<body>
	<div class="ticket">
		<div class="column1">
			<img src="<?= $imageData ?>" height="100%">
			<!-- <img src="/assets/img/sss.jpg" height="100%"> -->
		</div>
		<div class="column2">
			<div class="ticket-info">
				<p><span> Ticket Code :</span> <?php echo $key->idOrder ?>-<?php echo $key->codeTicket ?></p>
				<p><?php echo $key->name ?> <br>By <?php echo $key->artist ?></p>
				
        <pre><?php echo $key->venue; ?>,&nbsp; <?php echo $key->city; ?>,&nbsp;<?php echo $key->country; ?><br></pre>
        <?php $dates =  $key->date; $ubah = date_format(new dateTime($dates),' D M Y');?>
        <pre><?php echo $ubah?>&nbsp;- &nbsp;<?php echo $key->startTime?><br></pre>
				<pre><span class="label">Section : </span><span><?php echo $key->seatZone ?></span></pre>
			</div>
		</div>
		<div class="column3">
			<div class="rotate">
				<p>Data Pembeli:</p>
				<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, </p>
			</div>
			<div class="barcode">
				<pre>Barcode<br></pre>
				<?= $bc_generator->getBarcode($key->codeTicket, $bc_generator::TYPE_CODE_128) ?>
			</div>
		</div>
	</div>
</body>
<?php endforeach ?>
</html>
