<?php
session_start(); // بدء الجلسة

// تدمير جميع متغيرات الجلسة
$_SESSION = array();

// إذا كان هناك ملف كوكيز للجلسة، قم بحذفه
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// تدمير الجلسة
session_destroy();

// إعادة التوجيه إلى صفحة تسجيل الدخول بعد تسجيل الخروج
header("Location: index.html");
exit;
?>