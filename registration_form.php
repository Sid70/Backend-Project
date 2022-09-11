<?php
session_start();
$password = $_POST["password"];
$Cpassword = $_POST["Cpassword"];
$name = $_POST["name"];
$phNumber = $_POST["phNumber"];
$dob = $_POST["dob"];
$email = $_POST["email"];

$servername = "127.0.0.1";
$username = "root";
$pass = "";
$db_name = "siddhanta";

// Create connection
$conn = mysqli_connect($servername, $username, $pass,$db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT email_id FROM users WHERE email_id = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo "<script>alert('Your Email id is already exist!');</script>";
  session_destroy();
  mysqli_close($conn);
  return (include("index.html"));
}

$sql = "INSERT INTO users (`name`,`email_id`,`phNumber`,`dob`,`password`,`Cpassword`)
VALUES ('$name','$email','$phNumber','$dob','$password','$Cpassword')";
if (mysqli_query($conn, $sql)) {
?>
<html>
<body>
  <h1 style="text-align:center;">You have registered Successfully.</h1>
  <div style="width:100%;">
    <div style="display:flex; justify-content: space-between; width:100%;">
        <div style="width:50%;text-align:center;">Your Name: <?php echo $name ?> </div>
        <div style="width:50%;text-align:center;">Your Email ID: <?php echo $email ?></div>
    </div>
    <div style="display:flex; justify-content: space-between; width:100%;">
        <div style="width:50%;text-align:center;">Your Date of Birth: <?php echo $dob ?> </div>
        <div style="width:50%;text-align:center;">Your Phone Number: <?php echo $phNumber ?></div>
    </div>
    <div style="text-align:center;">Your Password: <?php echo $password ?></div>
  </div>
  <div style="text-align:center;margin-top:20px;">
  <a href="index.html">Log Out</a>
  </div>
  <?php 
  session_destroy();
  session_cache_expire(1);
  exit(); ?>
</body>
</html>
<?php
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>