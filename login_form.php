<?php
session_start();
$password = $_POST["password"];
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

$sql = "SELECT * FROM users WHERE email_id = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    ?>
<html>
<body>
  <h1 style="text-align:center;">You have loged in Successfully.</h1>
  <div style="width:100%;">
    <div style="display:flex; justify-content: space-between; width:100%;">
        <div style="width:50%;text-align:center;">Your Name: <?php echo $row["name"] ?> </div>
        <div style="width:50%;text-align:center;">Your Email ID: <?php echo $row["email_id"] ?></div>
    </div>
    <div style="display:flex; justify-content: space-between; width:100%;">
        <div style="width:50%;text-align:center;">Your Date of Birth: <?php echo $row['dob'] ?> </div>
        <div style="width:50%;text-align:center;">Your Phone Number: <?php echo $row['phNumber'] ?></div>
    </div>
    <div style="text-align:center;">Your Password: <?php echo $row['password'] ?></div>
  </div>
  <div style="text-align:center;margin-top:20px;">
  <a href="index.html">Log Out</a>
  </div>
</body>
</html>
<?php
  }
  
} else {

    $sql = "SELECT * FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            if ( $row["password"] != $password )
            {
                 echo "Your password is Incorrect.";
                 session_destroy();
                 exit();
            }
        }
    }

    else
    {
        echo "Your data is not exist.Please Register yorself.";
        ?>
        <a href="index.html">Sign Up</a><?php
        session_destroy();
        exit();
    }
}

mysqli_close($conn);
?>