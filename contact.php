<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Feedback - YOLO.com</title>
<style>
.pl{background-repeat: repeat-y;}
.img1{margin-top: 2vh; margin-left: 11vw;}
.menu{display:inline-block;width:auto;position:absolute;top:4vh; left:42vw;}
.home{padding:8px 16px; float:left; width:auto; border:none; outline:none; display:block; border:none; display:inline-block; outline:0; padding:8px 16px; vertical-align:middle; text-decoration:none; text-align:center;border-color:#fff;border-bottom:7px solid #fff;font-family:Candara; font-size:20; margin-top:7vh;}
.home:hover{box-shadow:none;border-color:#a64dff;transition:1s;}
.top{padding:8px 16px; float:left; width:auto; border:none; outline:none; display:block; border:none; display:inline-block; outline:0; padding:8px 16px; vertical-align:middle; text-decoration:none; text-align:center;border-color:#fff;border-bottom:7px solid #fff;font-family:Candara; font-size:20; margin-top:7vh;position:fixed;top:85vh;right:1vw;}
.top:hover{box-shadow:none;border-color:#a64dff;transition:1s;display:inline-block;width:auto;}
.colour{padding:0.01em 16px;background-color:#a64dff;color:#fff;text-align:center;font-size:24;}
.container{padding:0.01em 16px;}
.text{color:#a64dff;font-size:20;}
.input{padding:8px;display:block;border:none;border-bottom:1px solid #ccc;width:100%;border:1px solid #ccc;}
.button{border:none;display:inline-block;outline:0;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#FFFFFF;background-color:#a64dff;text-align:center;cursor:pointer;border-radius:0.5em;}
.button:hover{box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)}
.form{position:absolute;top:25vh;left:30vw;width:650;text-align:left;background-color:#f1f1f1;}
.error{color:#ff0000;}
</style>
<?php
$error=0;
$nameErr = $emailErr = $phoneErr = "" ;
$name = $email = $comment = $phone = "" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
$error=1;
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
$error=1;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
$error=1;
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
$error=1;
    }
  }
    
  if (empty($_POST["phone"])) {
    $phoneErr = "phone is required";
$error=1;
  } else {
    $phone = test_input($_POST["phone"]);
    }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</head>
<body link="gray" vlink="gray" alink="gray" background="background.jpg" class="pl" style="font-family:Candara; font-size:20px">
<a name="top" href="home.html"><img src="logo.jpg" height="120px" width="250px" align="left" class="img1"></a>
<p class="top"><a href="#top" style="text-decoration:none;">Back to Top</a></p><br>
<center>
<div class="menu">
<a href="home.html" class="home">Home</a>
<a href="eat.html" class="home">Eat</a>
<a href="play.html" class="home">Play</a>
<a href="relax.html" class="home">Relax</a>
<a href="online.html" class="home">Book Online</a>
<a href="feedback.html" class="home">Contact Us</a>
</div>
<table  cellspacing="5" rules="rows">
<tr>
<td>
<div class="form">
<div class="colour"><h2>Reach Out !</h2></div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="container">  
 <p>
<label class="text"><b>Name:</b></label>
 <span class="error">* <?php echo $nameErr;?></span></p>
<input type="text" name="name" value="<?php echo $name;?>" size="45" class="input">
  <p>
<label class="text"><b>E-mail:</b></label>
  <span class="error">* <?php echo $emailErr;?></span></p>
<input type="text" name="email" value="<?php echo $email;?>" size="45" class="input">
  <p>
<label class="text"><b>Phone:</b></label>
  <span class="error">*<?php echo $phoneErr;?></span></p>
<input type="text" name="phone" value="<?php echo $phone;?>" size="45" class="input">
  <p class="text"><b>Message:</b><br>
<textarea name="comment" rows="5" cols="40" class="input"><?php echo $comment;?></textarea>
<p><span class="error">* required field.</span></p>
<?php
if (isset($_POST["submit"]) && $error==0)
{ if(isset($_POST['submit'])) 
	{
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = "";
	    $dbname='yolo_feedback';
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
             
            if(!$conn) {
               die('Could not connect: ' . mysqli_error());
            }	
	else { echo "connected succcessfully <br>"; }

$sql = "INSERT INTO yolo_guest (Name, Email, Phone, Comment) VALUES
('$name','$email','$phone','$comment')";

if(mysqli_query($conn,$sql))
{ echo "entered data";}
else{ echo "not entered";}
}}
?>
<center><input type="submit" name="submit" value="Submit" class="button">  
<input type="reset" name="reset" value="Reset" class="button"></center>
</form>
<br>
<br>
</div>
<hr size="1" color="#bfbfbf" noshade width="70%" style="position:absolute;top:130vh;left:17vw;">
<img src="logo.jpg" height="100px" width="250px" style="position:absolute;top:135vh; left:15vw;">
<pre style="position:absolute;top:133vh;left:35vw;font-family:Gabriola;font-size:28;">Follow us on:<br><i class="fa fa-facebook-square" style="font-size:36px; color:#002db3;"></i> <i class="fa fa-google-plus-official" style="font-size:36px;color:#ff0000;"></i> <i class="fa fa-instagram" style="font-size:36px"></i> <i class="fa fa-twitter" style="font-size:36px;color:#00ccff;"></i></pre>
<pre style="position:absolute;top:132vh;left:51vw;font-family:Gabriola;font-size:28;">Or visit us at:</pre><p style="position:absolute;top:138vh;left:48vw;font-family:Gabriola;font-size:22;">214, Inner Circle,<br>Connaught Place, New Delhi</p>
<p style="position:absolute;top:143vh;left:65vw;font-family:Gabriola;font-size:14">&copy All copyrights reserved. Plagiarism is a punishable offense.</p>
</center>
</body>
</html>