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
                <h2>GIVE FEEDBACK</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" action="<?php $_PHP_SELF ?>">
                    <?php
                        $custid = $row['custid'];
                        if(isset($_POST['Submit'])){
                            $cid = $_POST['canteen'];
                            $rat = $_POST['rating'];
                            $fd = $_POST['comment'];
                            if(1>0){
                            $add = "INSERT into feedback(cid,custid,content,rating) values ('$cid','$custid','$fd','$rat')";
                            $retval = mysqli_query($db,$add);  
//                            if(! $retval ) 
//                            {
//                                die('Could not enter data: ' . mysqli_error($db));
//                            }
//                            echo  nl2br("\nCould Not place Order\n"); 
                            }
                        }
                    ?>
                    <label for="canteen" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">CHOOSE CANTEEN</label>
                    <select name="canteen" id="canteen" style="margin:2vw 4vw; width:60vw;">
                        <option value="919">SJT Canteen</option>
                        <option value="943">DC</option>
                        <option value="2015">FC (Non AC)</option>
                        <option value="2038">FC (AC)</option>
                        <option value="2299">Darling</option>
                    </select>
                    <br>
                    <label for="comment" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your Feedback</label>
                    <input type="text" placeholder="Enter your feedback here" id="comment" name="comment" style="margin:2vw 4vw; width:60vw;" required>
                    <br>
                    <label for="rating" style="font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px; margin-left:4vw;">Your Rating<br></label>
                    <input type="radio" name="rating" value=0 style="margin:2vw 0.5vw 2vw 4vw;">0
                    <input type="radio" name="rating" value=1 style="margin:2vw 0.5vw 2vw 0.5vw;">1
                    <input type="radio" name="rating" value=2 style="margin:2vw 0.5vw 2vw 0.5vw;">2
                    <input type="radio" name="rating" value=3 style="margin:2vw 0.5vw 2vw 0.5vw;">3
                    <input type="radio" name="rating" value=4 style="margin:2vw 0.5vw 2vw 0.5vw;">4
                    <input type="radio" name="rating" value=5 style="margin:2vw 0.5vw 2vw 0.5vw;">5
                    <input type="radio" name="rating" value=6 style="margin:2vw 0.5vw 2vw 0.5vw;">6
                    <input type="radio" name="rating" value=6 style="margin:2vw 0.5vw 2vw 0.5vw;">7
                    <input type="radio" name="rating" value=8 style="margin:2vw 0.5vw 2vw 0.5vw;">8
                    <input type="radio" name="rating" value=9 style="margin:2vw 0.5vw 2vw 0.5vw;">9
                    <input type="radio" name="rating" value=10 style="margin:2vw 0.5vw 2vw 0.5vw;" checked>10<br>
                    <input type="submit" for="sjt" value="Submit" id="Submit" name="Submit" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;margin-left:35vw; margin-botton:4vw;"><br>
                </form>
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
                <a style="text-decoration: none; color: white;" href="viewfeed.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f;">
                        VIEW FEEDBACK
                    </div>
                </a>
            </div>
        </section>
   </body>
</html>
