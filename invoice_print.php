  <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    
<?php 

require('php/conn.php');

extract($_GET);
$sql = "call get_invoice_sp('$id','$action')";
$ress = $conn->query($sql);
if(!$ress){

	echo $conn->error.$sql;
	return false;

}

$r = $ress->fetch_assoc();

?>

<style type="text/css">
	
	@media print{

		.invoice,#copy{

		width: 90%;
			height: 46%;
			margin: 25px auto;
			
			
		}

		


		.all-box{

			padding: 8px;
			
			border: 1px solid black;
		}

	}

</style>

<div class="container">


	<div class="invoice">
    <center><img style=" width: 100%; height: 150px" src="logo.png"></center>
    <hr>
	<div class="row">

<?php 

$copy = "false";

foreach($r as $key => $v){

	$k = explode("~", $key);

	if($k[0] == "copy"){

		$copy = "true";

		continue;
	}

elseif(@$k[1] == "title"){

	?>

 <center><h2 class="title"><?php //echo $v ?></h2></center>


	<?php
}elseif($key == $v){


	?>

	<div>
		
		<ul><?php echo $k[0] ?></ul>
	</div>


	<?php
}else{


	?>

	<div class="col-<?php echo !empty($k[1]) ? $k[1] : '6' ?> all-box">
		
		<?php echo "<b>" .$k[0]. "</b> :" . $v; ?>
	</div>


	<?php
}





}



 ?>		
		
	</div>
  <p>Signature:<br>___________________________</p>
	<center style="color:blue;">Prepared By Eng Abdirizaak Xidig</center>
	
</div>

	
</div>

<div id="copy">


	
</div>

 <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script>
	
	var copy = <?php echo @$copy ?>;

	if($.trim(copy) == 'true'){
		var copyfrom = $(".invoice").html();
		$("#copy").html("<hr>"+copyfrom);

	}

	window.print();
</script>
