<?php 

//echo count($_POST);

require("conn.php");
require("function.php");

$sql = gen_sql($_POST);
//echo $sql;

$ress = $conn->query($sql);

if($ress){

	$msg = $ress->fetch_array();
	$msg2 = explode("|", $msg[0]);
	
	// echo $msg2[0];

	if(!empty($msg['msg_only'])){
    
     //echo $msg2[0];
	
	
	 echo $msg[0];

	}else{

	?>

	 <button class="btn btn-<?php echo $msg2[0]?> btn-block "><?php echo @$msg2[1] ?></button>
	
	

	<?php

	}


}else{

	echo $conn->error;
}



 ?>