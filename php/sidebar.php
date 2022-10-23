 <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['name'] ?></div><small><?php echo $_SESSION['username'] ?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="home.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    
<?php 

require("conn.php");

$sql = "SELECT c.id,c.name,c.icon FROM link l JOIN user_link ul on l.id=ul.link_id
JOIN category c on c.id=l.category_id where ul.got_user= '$_SESSION[user_id]' and ul.type='link' group by c.name order by c.id asc";
$ress = $conn->query($sql);

while($rc = $ress->fetch_array()){

?>
                    
                 <li>
                        <a href="javascript:;"><i class="sidebar-item-icon <?php echo $rc['icon']  ?>"></i>
                            <span class="nav-label"><?php echo $rc['name'] ?></span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">


<?php 

require("conn.php");

$sql1 = "SELECT l.id,l.name,l.href FROM link l JOIN user_link ul on l.id=ul.link_id
JOIN category c on c.id=l.category_id where ul.got_user= '$_SESSION[user_id]' and ul.type='link' and c.id='$rc[id]'";
$ress1 = $conn->query($sql1);
while($row = $ress1->fetch_array()){

 ?>

                            <li>
                                <a class="getlink" href="<?php echo $row['href'] .'?id=' .$row['id'] ?>"><?php echo $row['name'] ?></a>
                            </li>
                           
                           <?php 

                       }


                            ?>
                            
                            
                            
                        </ul>
                    </li>

                    <?php 

                }



                     ?>

                  
                    
                    
                   
                   
                   
                    
                    
                    
                </ul>
            </div>
        </nav>