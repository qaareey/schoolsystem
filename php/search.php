<?php 

require('conn.php');

extract($_POST);
$sql = "call autocomplete_sp('$text','$action')";
$ress = $conn->query($sql);

if($ress){

	if($ress->num_rows > 0){

		while($r = $ress->fetch_array()){


			?>

			<li class="	hoverme" id="<?php echo $r[0] ?>"><?php echo $r[1] ?></li>



			<?php
		}


	}else{

		echo "<div>not found </div>";
	}


}else{

	echo $conn->error;
}


 ?>








<style>
	

	.hoverme{

		border: 1px solid;
		list-style: none;
		cursor: pointer;
	}
</style>