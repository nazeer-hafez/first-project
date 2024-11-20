<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "managemant";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];

  $sql = "DELETE FROM employees WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "تم حذف البيانات بنجاح";
  } else {
    echo "خطأ في حذف البيانات: " . $conn->error;
  }
}

$conn->close();
header("Location: employee.php");
exit();
?>
