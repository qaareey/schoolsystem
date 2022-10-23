<?php 

require('conn.php');
require('function.php');
$sql = "call search_row_sp('$_POST[action]','$_POST[id]')";
$ress = $conn->query($sql);
if(!$ress){
	echo $conn->error;

}elseif(@$ress->num_rows < 1){

	echo "no option to edit go to search_row_sp and add query to show";

	return false;
}

$column = $ress->fetch_fields();
while($r = $ress->fetch_assoc()){

	?>

	<div class="row">
		
   <?php 

   foreach($column as $k){

   $key = explode("~",$k->name);
   $label = $key[0];
   $type = @$key[1];
   $action = @$key[2];

   if($type == "dropdown"){

   	?>

   

   		<div class="col-sm-12">
   			<form class="update-form" method="post" action="php/save.php">

   				<input type="hidden" name="sp" value="da_edit_sp">
   				<input type="hidden" name="id" value=" <?php echo $_POST['id'] ?>">
   				<input type="hidden" name="table" value=" <?php echo $k->orgtable ?>">
   				<input type="hidden" name="setcolumn" value=" <?php echo $k->orgname ?>">
   				<input type="hidden" name="column" value=" <?php echo $_POST['column'] ?>">


   				
   				  <div class="row">

   				  <div class="col-sm-10">

   						<div class="form-group">
   							<label><?php echo $label ?></label>
   							<select class="form-control update-field" name=" <?php echo $k->name ?>" > 
   							<option>choose one</option>
   							<?php 	echo dropdown($action,$r[$k->name]) ?>
   							</select>
   						</div>
   						
   					</div>

   					<input type="submit" value="Update" class="btn btn-primary hide btn-update">	



   				  </div>
   					

   					
   					
   			

   			</form>
   			
   		</div>
   		
 

   <?php

   }else{

   	?>

   
   		<div class="col-sm-12">
   			<form class="update-form" method="post" action="php/save.php">

   				<input type="hidden" name="sp" value="da_edit_sp">
   				<input type="hidden" name="id" value=" <?php echo $_POST['id'] ?>">
   				<input type="hidden" name="table" value=" <?php echo $k->orgtable ?>">
   				<input type="hidden" name="setcolumn" value=" <?php echo $k->orgname ?>">
   				<input type="hidden" name="column" value=" <?php echo $_POST['column'] ?>">


   				<div class="row">
   					<div class="col-sm-10">

   						<div class="form-group">
   							<label><?php echo $label ?></label>
   							<input class="form-control update-field" type=" <?php echo $type ?>" name=" <?php echo $k->name ?>" value=" <?php echo $r[$k->name] ?>">
   						</div>
   						
   					</div>

   					<input type="submit" value="Update" class="btn btn-primary hide btn-update">
   					
   				</div>

   			</form>
   			
   		</div>
   		
 

   	<?php
   }
 

   }

  ?>
	


<?php
}
?>

</div>

<div class="update-response">
	
</div>

<style type="text/css">
	
	.btn-update{
		height: 30px;
		margin-top:30px;
	}

	.hide{
		display: none;
	}
</style>