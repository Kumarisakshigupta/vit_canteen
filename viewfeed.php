<!DOCTYPE html>
<?php 
    include('sessioncust.php');
    $uname = $_SESSION['login_user'];
    $sql = "SELECT * from customer where custid='$uname'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>SJT Canteen</title>
    </head>
    <body>
        <section class="section-plans">
            <div class="row">
                <div class="col span-10-of-12">
                    <img src="images/person.png" style="border-radius: 20%; width: 5vw;">
                    <div style="display: inline-block; vertical-align: super"><?php echo $row['name']?><br><?php echo $row['custid']?></div>
                </div>
                <div class="col span-1-of-12"><a style="text-decoration: none; background-color: #18314f; padding: 10% 20%; color: white; vertical-align: text-bottom; margin-top: 20%; margin-bottom: 20%; box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15)" href="profile.php">Profile</a></div>
                <div class="col span-1-of-12"><a style="text-decoration: none; background-color: #18314f; padding: 10% 20%; color: white; vertical-align: text-bottom; margin-top: 20%; margin-bottom: 20%; box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15)" href="index.php">Logout</a></div>

            </div>
        </section>
        <section class="section-cant">
            <div class="row">
                <h3 style="margin-left:32vw;"><strong>SJT CANTEEN</strong></h3>
                    <?php
                        $q = "Select * from feedback where cid=919";
                        $res = mysqli_query($db,$q);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<li style=\"margin-left:18vw; width:40vw;\">".$item['content']."<div style=\"float:right;\">".$item['rating']."</div></li>";
                        }
                    ?>
            </div>
            <div class="row">
                <h3 style="margin-left:32vw;"><strong>DC</strong></h3>
                    <?php
                        $q = "Select * from feedback where cid=943";
                        $res = mysqli_query($db,$q);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<li style=\"margin-left:18vw; width:40vw;\">".$item['content']."<div style=\"float:right;\">".$item['rating']."</div></li>";
                        }
                    ?>
            </div>
            <div class="row">
                <h3 style="margin-left:32vw;"><strong>FC (Non AC)</strong></h3>
                    <?php
                        $q = "Select * from feedback where cid=2015";
                        $res = mysqli_query($db,$q);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<li style=\"margin-left:18vw; width:40vw;\">".$item['content']."<div style=\"float:right;\">".$item['rating']."</div></li>";
                        }
                    ?>
            </div>
            <div class="row">
                <h3 style="margin-left:32vw;"><strong>FC (AC)</strong></h3>
                    <?php
                        $q = "Select * from feedback where cid=2038";
                        $res = mysqli_query($db,$q);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<li style=\"margin-left:18vw; width:40vw;\">".$item['content']."<div style=\"float:right;\">".$item['rating']."</div></li>";
                        }
                    ?>
            </div>
            <div class="row">
                <h3 style="margin-left:32vw;"><strong>Darling</strong></h3>
                    <?php
                        $q = "Select * from feedback where cid=2299";
                        $res = mysqli_query($db,$q);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<li style=\"margin-left:18vw; width:40vw;\">".$item['content']."<div style=\"float:right;\">".$item['rating']."</div></li>";
                        }
                    ?>
            </div>
        </section>
        <section class="section-plans">
            <div class="row">
                <a style="text-decoration: none; color:#18314f;" href="homepage.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;">
                        GO BACK
                    </div>
                </a>
                <div class="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <a style="text-decoration: none; color: white;" href="givefeed.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                        GIVE FEEDBACK
                    </div>
                </a>
            </div>
        </section>
   </body>
</html>
