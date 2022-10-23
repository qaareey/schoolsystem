<?php 


function Company(){

	return "School System";
}

function dropdown($action,$val){

	require('conn.php');

	$sql = "call get_dropdown_sp('$action')";
	$ress = $conn->query($sql);
	if($ress){

	   if($ress->num_rows > 0){

		while($row = $ress->fetch_array()){
         $v = explode("|", $row[1]);
		?>

		<option value="<?php echo $row[0] ?>" <?php echo $row[0] == $val ? 'selected' : '' ?>><?php echo $row[1] ?></option>


		<?php

	}
   }else{

   	   ?>
   	   <option>no option to select go to get_dropdown and add action</option>

   	   <?php
   }


	}else{

		echo $conn->error;
	}
}


function gen_sql($post){

	$sql = " call ";

	$i=0;
	$input = count($post);
	foreach($post as $val){
		$i++;

		if($i == 1){
			$sql .= $val. "(";

		}elseif($i == $input){
			$sql .= "'" . $val . "')";
		}else{

			$sql .= "'" . $val . "',";
		}
	}

	return $sql;
}

function table_row($ress){

	$col = $ress->fetch_fields();

	?>

	<thead>
		<?php 

		foreach($col as $val){

			$c = explode("~", $val->name);

         
         ?>

         <th class="<?php echo @$c[1] ?>"><?php echo $c[0] ?></th>

         <?php

		}

		 ?>
	</thead>


	<tbody>

		<?php 

		while($row = $ress->fetch_assoc()){




		 ?>
		
		<tr>

			<?php 

			foreach($row as $key => $val ){

				$r = explode("~", $key);

				if(@$r[3] == "dropdown"){


					?>

					<td class=" <?php echo $r[1] ?> select">

					<select title=" <?php echo $val ?>" style="border: none;width: 100%;background: transparent;">
						<option value="">Choose one</option>
						<?php dropdown(@$r[4],$val)?>
						
					</select>
						
					</td>


					<?php


				}else{

			 ?>

			 <td class="<?php echo @$r[1] ?> <?php echo @$r[2] ?>" 
			 	action="<?php echo @$r[4] ?>" <?php echo @$r[2]?> alt="<?php echo @$r[3]?>"><?php echo $val ?></td>
			
		<?php

	}
		
		}
		

		?>

		</tr>

	<?php
	}

	?>
	</tbody>


	<?php
}




 ?>