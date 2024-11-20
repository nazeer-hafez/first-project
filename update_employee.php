<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "managemant";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("filed conection " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $department = $_POST['department'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $salary = $_POST['salary'];

  $sql = "UPDATE employees SET name='$name', department='$department', phone='$phone', email='$email', salary='$salary' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "done update data";
  } else {
    echo "error: update date" . $conn->error;
  }
}

$conn->close();
header("Location: employee.php");
exit();
?>
