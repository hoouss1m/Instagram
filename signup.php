<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // التحقق من تطابق كلمات المرور
    if ($password !== $confirm_password) {
        die("❌ Passwords do not match");
    }

    // التحقق من طول كلمة المرور
    if (strlen($password) < 12) {
        die("❌ Password must be at least 12 characters");
    }

    // تشفير كلمة المرور
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات
    $sql = "INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sss",
        $username,
        $email,
        $hashedPassword
    );

    if ($stmt->execute()) {

        header("Location: w2.html");
        exit();

    } else {

        echo "❌ Error";
    }
}

?>