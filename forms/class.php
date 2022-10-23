<div class="row">


	<div style="margin: auto;" class="col-md-8">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Class Form</div>
                                
                            </div>
                            <div class="ibox-body">
                                <form action="forms/saveclass.php" class="form-data" method="post">
                                    
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input name="class" class="form-control" type="text" placeholder="Enter Level Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Level</label>
                                        <select name="level" class="form-control">
                                            <option>Choose One</option>

<?php 

require("../php/conn.php");

$sql = "select id,name from level";

$ress = $conn->query($sql);
while($r = $ress->fetch_array()){



 ?> 

 <option value="<?php echo $r[0] ?>"><?php echo $r[1] ?></option>

 <?php 

}

?>    
    </select>


                                    </div>
                                    
                                    <div class="form-group">
                                        <button class="btn btn-success btn-block" type="submit">Save</button>
                                    </div>
                                </form>

                                <div class="form-response"></div>
                            </div>
                        </div>
                    </div>
	

</div>