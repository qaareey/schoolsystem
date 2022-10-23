<?php 

require('conn.php');
require('function.php');
$sql = gen_sql($_POST);
$ress = $conn->query($sql);


 ?>

<div class="page-content fade-in-up">
<div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Table</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">


                        	<?php table_row($ress) ?>
                          
                        </table>
                    </div>
                </div>

            </div>

<?php require("../updatemodal.php"); ?>


         <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
                //"ajax": './assets/demo/data/table_data.json',
                /*"columns": [
                    { "data": "name" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]*/
            });
        })
    </script>