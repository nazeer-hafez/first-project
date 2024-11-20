<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "managemant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$department = $_POST['department'];
$phone = $_POST['phone'];
$salary = $_POST['salary'];
$image = $_FILES['image']['name'];

// تعديل المسار ليتضمن الشرطات البديلة
$target = "C:\\laragon\\www\\ITW\\assets\\img\\team\\" . basename($image);

// تحقق من وجود المجلد المستهدف، وإن لم يكن موجودًا فأنشئه
if (!file_exists("C:\\laragon\\www\\ITW\\assets\\img\\team\\")) {
    mkdir("C:\\laragon\\www\\ITW\\assets\\img\\team\\", 0777, true);
}

move_uploaded_file($_FILES['image']['tmp_name'], $target);

$sql = "INSERT INTO employees (name, department,salary, email, phone, image) VALUES ('$name','$department', '$salary', '$email', '$phone', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "Done Add Employee has been sent.";
    
} else {
    error_log("Error: " . mysqli_error($conn));
    echo "Form submission failed. Please try again later.";
}

$conn->close();
?>