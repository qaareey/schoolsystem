<?php 

session_start();

require("conn.php");

extract($_POST);

$sql = " call login_sp('$username','$password')";

$ress = $conn->query($sql);

$msg = $ress->fetch_array();

//$msg1 = $error1;

if($msg['error']){

	header("location: ../index.php?error=$msg[0]");

}elseif($msg['error1']){

	header("location: ../index.php?error=$msg[0]");


}else{

	foreach($msg as $name => $value){

		$_SESSION[$name] = $value;
	}

	header("location: ../home.php");
}

 





 ?>