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
        <title>Darling Canteen</title>
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
        <section class="section-features">
			<div class="row">
				<h2>Get food fast &mdash; not fast food.</h2>
            <br><br><br>
				<p class="long-feat">
					Hello, We’re a part of VITFoodServices (VITFS), your new premium food-ordering-from-canteen service. We know you’re always busy. No time for standing in long queues. So let us take care of that, we’re really good at it, we promise!
				</p>
			</div>
            <br><br><br>
			<div class="row">
				<div class="col span-1-of-4 box">
					<h3>Up to 365 days/year</h3>
					<p>
						Never wait in queues again! We really mean that. Our subscription plans include up to 365 days/year coverage. You can also choose to order more flexibly if that's your style.
					</p>
				</div>
				<div class="col span-1-of-4 box">
					<h3>Ready in 30 minutes</h3>
					<p>
						You're only thirty minutes away from your delicious and super healthy meals. We work with the best chefs in each canteens to ensure that you're 100% happy.
					</p>
				</div>
				<div class="col span-1-of-4 box">
					<h3>100% organic</h3>
					<p>
						All our vegetables are fresh, organic and local. Animals are raised without added hormones or antibiotics. Good for your health, the environment, and it also tastes better!
					</p>
				</div>
				<div class="col span-1-of-4 box">
					<h3>Order anything</h3>
					<p>
						We don't limit your creativity, which means you can order whatever you feel like. You can choose from our menu containing over 100 delicious meals. It's up to you!
					</p>
				</div>
			</div>
		</section>
        <section class="section-cant">
            <div class="row">
                <h2>ALAcarte</h2>
            </div>
            <div class="row">
                <form method="post" id="sjt" name="sjt" action="<?php $_PHP_SELF ?>">
                <table>
                    <tr>
                        <td width=150><strong>Item</strong></td>
                        <td width=15><strong>Price (in Rupees)</strong></td>
                        <td width=15><strong>Quantity</strong></td>
                    </tr>
                    <?php
                        $ala = "SELECT * from dalacarte";
                        $res = mysqli_query($db,$ala);
                        while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            echo "<tr><td>".$item['name']."</td><td>".$item['price']."</td><td align=\"center\"><input type=\"numeric\" class=\"btnsmall\" id=\"".$item['iid']."\" name =\"".$item['iid']."\"></td>";
                        }
                        if(isset($_POST['Submit'])){
                            $ala = "SELECT * from dalacarte";
                            $res = mysqli_query($db,$ala);
                            $x = 0;
                            while($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $it = $item['iid'];
                                $pr = $item['price'];
                                if($_POST[$it]!=NULL){
                                    $ord[$x]=$it;
                                    $pri[$x]=$pr;
                                    $qty[$x++]=$_POST[$it];
                                }
                            }
                            $cost = 0;
                            for($y=0;$y<$x;$y++){
                                $cost = $cost+$pri[$y]*$qty[$y];
                            }
                            if($row['wallet']>=$cost){
                                echo "<script>alert('Order Placed!');</script>";
                                $date = date("Y-m-d");
                                $cust = $row['custid'];
                                $add = "INSERT into ord(cid,custid,odate,cost,status) values ('2299','$cust','$date','$cost','Received')";
                                $retval = mysqli_query($db,$add);
                                $m = mysqli_query($db,"select max(oid) from ord");
                                $max = mysqli_fetch_array($m,MYSQLI_ASSOC);
                                $oid = $max['max(oid)'];
                                for($y=0;$y<$x;$y++){
                                    $add = "insert into orderdet values('$oid','$ord[$y]','$qty[$y]')";
                                    $retval = mysqli_query($db,$add);
                                }
                                $balance=$row['wallet']-$cost;
                                $add="update customer set wallet='$balance' where custid='$cust'";
                                $retval = mysqli_query($db,$add);
                            }
                            else{
                                echo "<script>alert('Not enough Balance in your wallet');</script>";
                            }
                        }
                    ?>
                </table>
                <div class="section-plans">
                <div class="row">
                <a style="text-decoration: none; color:#18314f;" href="homepage.php">
                    <div class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(72, 39, 10, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;">
                        GO BACK
                    </div>
                </a>
                <div class="col"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<!--                <button style="text-decoration: none; color: white;" href="#">-->
                    <button class="col span-5-of-11" style="box-shadow: 4px 4px 10px rgba(12, 10, 72, 0.15); text-align: center; padding: 1%;border: 2px solid #18314f;background-color: #18314f; color: white; font-family: 'Lato','Arial', sans-serif;font-weight: 300;font-size: 20px;" type="submit" id="Submit" name="Submit" for="sjt">
                        CONTINUE
                    </button>
<!--                </button>-->
                </div>
                </div>
                </form>
            </div>
        </section>
        <section class="section-meals">
			<ul class="meals-show clearfix">
				<li>
					<figure class="meal-photo">
						<img src="images/1.jpg" alt="Korean bibimbap with egg and vegetables">
					</figure>
				</li>
				<li>
					<figure class="meal-photo">
						<img src="images/2.jpg" alt="Simple italian pizza with cherry tomatoes">
					</figure>
				</li>
				<li>
					<figure class="meal-photo">
						<img src="images/3.jpg" alt="Chicken breast steak with vegetables">
					</figure>
				</li>
				<li>
					<figure class="meal-photo">
						<img src="images/4.jpg" alt="Autumn pumpkin soup">
					</figure>
				</li>
			</ul>
			<ul class="meals-show clearfix">
				<li>
					<figure class="meal-photo">
						<img src="images/5.jpg" alt="Paleo beef steak with vegetables">
					</figure>
				</li>
				<li>
					<figure class="meal-photo">
						<img src="images/6.jpg" alt="Healthy baguette with egg and vegetables">
					</figure>
				</li>
				<li>
					<figure class="meal-photo">
						<img src="images/7.jpg" alt="Burger with cheddar and bacon">
					</figure>
				</li>
				<li>
					<figure class="meal-photo">
						<img src="images/8.jpg" alt="Granola with cherries and strawberries">
					</figure>
				</li>
			</ul>
		</section>
   </body>
</html>
