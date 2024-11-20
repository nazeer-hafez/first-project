<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "managemant";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام بيانات النموذج
    $username = $_POST['username'];
    $password = $_POST['password'];

    // حماية من حقن SQL
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // البحث عن المستخدم في قاعدة البيانات
    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // استلام بيانات المستخدم
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // التحقق من كلمة المرور
        if (password_verify($password, $hashed_password)) {
            // بيانات صحيحة، إعادة التوجيه إلى الصفحة المطلوبة
            header("Location: home.html");
            exit();
        } 
        else {
            // كلمة مرور غير صحيحة
            header("Location: index.html?error=invalid_credentials");
        }
    } else {
        // اسم المستخدم غير موجود
        header("Location: index.html?error=invalid_credentials");
    }
}

$conn->close();
?>