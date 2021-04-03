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
                <div class="col span-1-of-12"><a style="text-decoration: none; background-color: #18314f; padding: 10% 20%; color: white; vertical-align: text-bottom; margin-top: 20%; margin-bottom: 20%; box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15)" href="homepage.php">Home</a></div>
                <div class="col span-1-of-12"><a style="text-decoration: none; background-color: #18314f; padding: 10% 20%; color: white; vertical-align: text-bottom; margin-top: 20%; margin-bottom: 20%; box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15)" href="index.php">Logout</a></div>

            </div>
        </section>
        <section class="section-cant">
            <div class="row">
                <h2>Personal Details</h2>
            </div>
            <?php
                echo "<li style=\"margin-left:25vw; width:30vw;\"><strong>Wallet Balance: </strong><div style=\"float:right;\">".$row['wallet']."</div></li>";
                echo "<li style=\"margin-left:25vw; width:30vw;\"><strong>Address: </strong><div style=\"float:right;\">".$row['hblock']." ".$row['hroom']."</div></li>";
                echo "<li style=\"margin-left:25vw; width:30vw;\"><strong>Phone Number: </strong><div style=\"float:right;\">".$row['phone']."</div></li>";
            ?>
        </section>
        <section class="section-plans">
            <div class="row">
                <h2>Change Password</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" action="<?php $_PHP_SELF ?>">
                    <?php
                        $custid = $row['custid'];
                        if(isset($_POST['Submit'])){
                            $custid = $row['custid'];
                            $q="select pwd from sauth where custid='$custid'";
                            $res = mysqli_query($db,$q);
                            $item = mysqli_fetch_array($res,MYSQLI_ASSOC);
                            $o = $_POST['oldpwd'];
                            $n = $_POST['newpwd'];
                            if(strcmp($o,$item['pwd'])==0){
                                $add = "update sauth set pwd='$n' where custid='$custid'";
                                $retval = mysqli_query($db,$add);
                                echo "<script>alert('Password Successfully Updated!')</script>";
                                header('Location: index.php');
                            }
                            else{
                                echo "<script>alert('Enter Correct Password!')</script>";
                            }
                        }
                    ?>
                    <label for="oldpwd" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your Old Password</label>
                    <input type="password" placeholder="Old Password" id="oldpwd" name="oldpwd" style="margin:2vw 4vw; width:60vw; padding: 0.5vw;" required>
                    <br>
                    <label for="newpwd" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your New Password</label>
                    <input type="password" placeholder="New Password" id="newpwd" name="newpwd" style="margin:2vw 4vw; width:60vw; padding: 0.5vw;" required>
                    <br>
                    <input type="submit" for="sjt" value="Submit" id="Submit" name="Submit" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;margin-left:35vw; margin-botton:4vw;"><br>
                </form>
            </div>
        </section>
   </body>
</html>
