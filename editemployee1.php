<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Employee Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body class="page-portfolio">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="home.html">Home</a></li>
          <li><a href="employee.php" class="active">View Employee</a></li>
          <li><a href="services.html">Add Employee</a></li>
          <li><a href="portfolio.html">LogOut</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main">
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/team-header.jpg'); height: 400px;">
      <div class="container position-relative d-flex flex-column align-items-center">
        <h2>Edit / Delete</h2>
      </div>
    </div>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="fade-up">
        <h3 style="padding-right:70px; text-align: center; margin-top: -30px; color:#1b2f45; padding-left: 60px;"><b>Employee information</b></h3>
        <div class="row gy-4">
          <?php
          $servername = "localhost";
          $dbusername = "root";
          $dbpassword = "";
          $dbname = "managemant";
          $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

          if ($conn->connect_error) {
            die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
          }

          if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT name, department, salary, email, phone, image FROM employees WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $name = $row["name"];
              $department = $row["department"];
              $phone = $row["phone"];
              $email = $row["email"];
              $salary = $row["salary"];
              $image = $row["image"];
            } else {
              echo "لم يتم العثور على البيانات";
              exit;
            }
          } else {
            echo "لم يتم توفير معرف الموظف";
            exit;
          }
          ?>
          <section id="contact" class="contact">
            <div class="container position-relative" data-aos="fade-up">
              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <div class="col-lg-8">
                      <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/team/<?= $image ?>'); width: 400px; height: 400px; position: absolute; left: 670px;">
                      </div>
                    </div>
                  </div>
                  <form method="POST" action="update_employee.php">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group mt-3"><strong>Name</strong>:<input type="text" name="name" value="<?= $name ?>" class="form-control" id="name"></div>
                    <div class="form-group mt-3">
                      <p><strong>Department</strong>:<select class="form-control" name="department">
                          <option value="PM" <?= $department == 'PM' ? 'selected' : '' ?>>Project Manager</option>
                          <option value="SA" <?= $department == 'SA' ? 'selected' : '' ?>>System analysis</option>
                          <option value="SWE" <?= $department == 'SWE' ? 'selected' : '' ?>>Software Engineer</option>
                          <option value="IT" <?= $department == 'IT' ? 'selected' : '' ?>>IT</option>
                          <option value="HR" <?= $department == 'HR' ? 'selected' : '' ?>>HR</option>
                          <option value="CC" <?= $department == 'CC' ? 'selected' : '' ?>>Cell Center</option>
                          <option value="SV" <?= $department == 'SV' ? 'selected' : '' ?>>Supervisor</option>
                          <option value="AC" <?= $department == 'AC' ? 'selected' : '' ?>>Accountant</option>
                        </select></p>
                    </div>
                    <div class="form-group mt-3"><strong>Number</strong>:<input type="text" class="form-control" name="phone" value="<?= $phone ?>" id="subject"></div>
                    <div class="form-group mt-3"><strong>Email</strong>: <input type="email" class="form-control" name="email" value="<?= $email ?>"></div>
                    <div class="form-group mt-3"><strong>Salary</strong>: <input type="number" class="form-control" name="salary" value="<?= $salary ?>"></div>
                    <div><input style="background-color: #1b2f45; color: aliceblue; position: absolute; left:80px; margin-top: 40px; padding: 5px 40px;" type="submit" value="Edit"></div>
                  </form>
                  <form method="POST" action="delete_employee.php">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div><input style="background-color: #1b2f45; color: aliceblue; position: absolute; left:212px; margin-top: 40px; padding: 5px 40px;" type="submit" value="Delete"></div>
                  </form>
                  <form method="POST" action="employee.php">
                    <div><input style="background-color: #1b2f45; color: aliceblue; position: absolute; left:362px; margin-top: 40px; padding: 5px 40px;" type="submit" value="Cancel"></div>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer">
    <div class="footer-content">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="home.html" class="logo d-flex align-items-center">
              <span>Managemant</span>
            </a>
            <p>We always provide solutions for all types of management.</p>
            <div class="social-links d-flex  mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-dash"></i> <a href="home.html">Home</a></li>
              <li><i class="bi bi-dash"></i> <a href="employee.php">View Employee</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">Add Employee</a></li>
              <li><i class="bi bi-dash"></i> <a href="#">LogOut</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-dash"></i> <a href="home.html #o1">Comprehensive Business Solutions</a></li>
              <li><i class="bi bi-dash"></i> <a href="home.html #o2">Cutting-Edge Technology and Innovation</a></li>
              <li><i class="bi bi-dash"></i> <a href="home.html #o3">Exceptional Customer Support</a></li>
              <li><i class="bi bi-dash"></i> <a href="home.html #o4">Strategic Planning and Consulting</a></li>
              <li><i class="bi bi-dash"></i> <a href="home.html #o5">Tailored Marketing Solutions</a></li>
              <li><i class="bi bi-dash"></i> <a href="home.html #o6">Financial Management and Advisory</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Syria <br>
              <strong>Phone:</strong> +963948886073<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>Managemant</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
        </div>
      </div>
    </div>
  </footer>
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
