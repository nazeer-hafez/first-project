
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>
<?php
$pathImage = 'C:/laragon/www/ITW/assets/img/team/';
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
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

// فحص وجود البيانات
if ($result->num_rows > 0) {
    // عرض البيانات داخل عناصر HTML
    while($row = $result->fetch_assoc()) {
       echo '<div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">';
        echo  '<div class="card-item">';
            echo '<div class="row">';
                   echo '<div class="col-xl-5">';
                   echo '<a href="editemployee1.php?id=' . $row['id'] . '">';
                     echo '<div class="card-bg" style="background-image: url(assets/img/team/' . $row['image'] . '); width: 260px;"></div>';
                    echo '</div>';
                    echo '<div class="col-xl-7 d-flex align-items-center">';
                        echo '<div class="card-body">';
                           echo '<b><h4 class="card-title">Name: ' . $row['name']. '</h4><b>';
                           echo '<h4> Department: '.$row['department'].'</h4>';
                           echo '<h4> Number: '.$row['phone'].'</h4>';
                           echo '<h4> Email:'.$row['email'].'</h4>';
                           echo '<h4> Salary: '.$row['salary'].'</h4>';
                       echo '</div>';
                       echo '</a>';
                   echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
} else {
    // يجب عليك استخدام الدالة die() بعد رسالة التوجيه لمنع استمرار تشغيل الكود
    header("Location: employee.html?error=invalid_credentials");
    die();
}
// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
</body>
</html>