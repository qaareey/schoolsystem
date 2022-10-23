<?php 
require("conn.php");
require("function.php");
 $sql = gen_sql($_POST);
$ress = $conn->query($sql);
if(!$ress){
	echo $conn->error;
	return false;
}
if($_POST['_user_id'] == "%" || $_POST['_user_id'] == 0){
	?>
   <div class="alert alert-warning">Fadlan dooro Userka</div>
	<?php
	return false;
}
?>

<div class="container">
	<div class="row">
		<?php 
		while($r = $ress->fetch_array()){
			?>
	<div class="col-md-3">
		<h6><?php echo $r['name'] ?></h6>
		<ul>
		<?php 
        require("conn.php");
        $sql1 = "call show_permisions_sp('$r[id]','$_POST[_user_id]')";
        $res = $conn->query($sql1);
        while($rl = $res->fetch_array()){
        	?>
<li  style="list-style: none;">
	<input id="<?php echo $rl['id'] ?>" ltype="<?php echo $rl['link'] ?>" gotuser="<?php echo $rl['_user_id'] ?>" user_id="<?php echo $_POST['_user_id'] ?>" class="checklink" type="checkbox" <?php echo $rl['type'] ?>><?php echo $rl['name'] ?></li>

        	<?php
        }
		?>
	</ul>
	</div>
	<?php
		}
		?>
	</div>
</div>