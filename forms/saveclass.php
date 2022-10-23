<?php 

require('../php/conn.php');
extract($_POST);
$sql = "call class_sp('$class','$level')";
$ress = $conn->query($sql);
$msg = $ress->fetch_array();
$msg2 = explode("|", $msg[0]);

//echo $msg[0];

 ?>

 <button class="btn btn-<?php echo $msg2[0] ?> btn-block"><?php echo $msg2[1] ?></button>