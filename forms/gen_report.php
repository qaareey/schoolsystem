
<?php 

session_start();

require("../php/conn.php");

require("../php/function.php");
extract($_GET);

$sql = "call link_info_sp('$id', '$_SESSION[user_id]')";
$ress = $conn->query($sql);
$col = $ress->fetch_assoc();

if(!empty($col['permision'])){

    echo $col['permision'];
    return false;
}





 ?>

 <style>
     
     .hide{
        display: none;
     }
     .ibox-body{

     }
 </style>


<div class="row">
<div  class="col-md-12">
<div class="ibox">

  <div class="user-response"></div>
<div class="ibox-head">

  

<div class="ibox-title"><?php echo $col['name'] ?></div>

</div>
<div class="ibox-body">
<form action="<?php echo $col['action'] ?>" class="form-data report" method="post">
  <div class="row">

    <input type="hidden" name="sp" value="<?php echo $col['sp'] ?>">

 <?php 
require("../php/conn.php");

 $sq = "call form_input_sp('$id')";
 $res = $conn->query($sq);
 while($row = $res->fetch_array()){
 extract($row);

 if($type == "hidden"){

 ?>

    <input type="<?php echo $type ?>" name="<?php echo $name ?>" value="<?php echo $_SESSION['user_id'] ?>">

    <?php


 }elseif($type == "dropdown"){


   ?>   


   <div class="col-md-2">

     <div class="form-group">
        <label><?php echo $label ?></label>
       <select name="<?php echo $name ?>" class="form-control <?php echo $class ?>">
           <option value="%">Choose One</option>

           <?php dropdown($action,'')?>
       </select>
        
    </div>
     

   </div>

<?php 

}else if($type == "autocomplete"){

?>

    <div class="col-md-2">

      <div class="form-group">
        <label><?php echo $label ?></label>
        <input type="<?php echo $type ?>" action="<?php echo $action ?>" class="form-control autocomplete <?php echo $class ?>" placeholder="<?php echo $placeholder ?>">

        <ul class="hide list-group">

        
    </ul>

      <input type="hidden" class="autocomplete-value" name="<?php echo $name ?>">
        
    </div>
      
    </div>

    

  

    <?php

}else{
   
    ?>

    <div class="col-md-2">

      <div class="form-group">
        <label><?php echo $label ?></label>
        <input type="<?php echo $type ?>" name="<?php echo $name ?>" class="form-control" placeholder="<?php echo $placeholder ?>">
        
    </div>
      
    </div>

    <?php
}
}
 
  ?>   

    <div style="margin-top: 27px;" class="col-md-2">
      
      <input type="submit" class="btn btn-primary " value=" <?php echo $col['button'] ?>">


    </div>
  </div>
</form>

<div style="margin-top: 10px;" class="form-response"></div>
</div>
</div>
</div>
</div>


