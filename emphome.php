<!DOCTYPE html>
<?php 
    include('sessionemp.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from employee where eid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <title>Student</title>
    </head>
    <body>
        <section class="section-plans">
            <div class="row">
                <div class="col span-10-of-12">
                    <?php       
                        $cid = $row['cid'];
                        $canteen = "SELECT * from canteen where cid='$cid'";
                        $res = mysqli_query($db,$canteen);
                        $cantrow = mysqli_fetch_array($res,MYSQLI_ASSOC);
                    ?>
                    <img src="images/person.png" style="border-radius: 20%; width: 5vw;">
                    <div style="display: inline-block; vertical-align: super"><?php echo $row['name']?><br>
                        <?php 
                            $cant=$cantrow['name'];
                            $loc=$cantrow['location'];
                            echo "$cant, $loc" 
                        ?></div>
                </div>
                <div class="col span-1-of-12"><a style="text-decoration: none; background-color: #18314f; padding: 10% 20%; color: white; vertical-align: text-bottom; margin-top: 20%; margin-bottom: 20%; box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15)" href="empprof.php">Profile</a></div>
                <div class="col span-1-of-12"><a style="text-decoration: none; background-color: #18314f; padding: 10% 20%; color: white; vertical-align: text-bottom; margin-top: 20%; margin-bottom: 20%; box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15)" href="index.php">Logout</a></div>

            </div>
        </section>
        <section class="section-cant" id="cities">
            <div class="row">
            <br><br><br>
                <h2>Best Employee</h2>
            </div>
            <div class="row">
                <div class="row">
                    <?php 
                        $q = "select max(jo) from (select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid) as t";
                        $m = mysqli_query($db,$q);
                        $cost = mysqli_fetch_array($m, MYSQLI_ASSOC);
                        $qb = "select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid";
                        $mb = mysqli_query($db,$qb);
                        while($item = mysqli_fetch_array($mb, MYSQLI_ASSOC)){
                            if ($cost['max(jo)']==$item['jo']){
                                $eid = $item['eid'];
                                $name = "select * from employee where eid='$eid'";
                                $r = mysqli_query($db,$name);
                                $nm = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                $cid = $nm['cid'];
                                $c = "select name from canteen where cid=".$cid."";
                                $s = mysqli_query($db,$c);
                                $cant = mysqli_fetch_array($s, MYSQLI_ASSOC);
                                echo "<li style=\"margin-left:30vw;\">Name of employee : ".$nm['name']."</li><li style=\"margin-left:30vw;\"> Canteen : ".$cant['name']."</li><li style=\"margin-left:30vw;\"> Average sale : ".round($cost['max(jo)'])."</li><br><br>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="row">
            <br><br><br>
                <h2>Leaderboard</h2>
            </div>
            <div class="row">
                <div class="row">
                    <table>
                        <tr>
                            <td width=15><strong>Name of Employee</strong></td>
                            <td width=15><strong>Canteen</strong></td>
                            <td width=15><strong>Average Sale</strong></td>
                        </tr>
                    <?php 
                        $qb = "select * from (select eid, sum(cost)/count(eid) as jo from ord where status = 'Completed' group by eid) as t order by jo desc";
                        $mb = mysqli_query($db,$qb);
                        while($item = mysqli_fetch_array($mb, MYSQLI_ASSOC)){
                            $eid = $item['eid'];
                            $name = "select * from employee where eid='$eid'";
                            $r = mysqli_query($db,$name);
                            $nm = mysqli_fetch_array($r,MYSQLI_ASSOC);
                            $cid = $nm['cid'];
                            $c = "select name from canteen where cid=".$cid."";
                            $s = mysqli_query($db,$c);
                            $cant = mysqli_fetch_array($s, MYSQLI_ASSOC);
                            echo "<tr><td>".$nm['name']."</td><td>".$cant['name']."</td><td>".round($item['jo'])."</td></tr>";
                        }
                    ?>
                    </table>
                </div>
            </div>
        </section>
        <section class="section-plans">
            <div class="row">
                <h2>DASHBOARD</h2>
            </div>
            <div class="row">
                <a style="text-decoration: none; color:#18314f;" href="emordstat.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                        Pending Orders
                    </div>
                </a>
                <div class="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <a style="text-decoration: none; color: white;" href="emordview.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                        Completed Orders
                    </div>
                </a>
            </div>
        </section>
   </body>
</html>
