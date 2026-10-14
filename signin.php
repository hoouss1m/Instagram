<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO signin(email, password)
            VALUES('$email', '$password')";

    if (mysqli_query($conn, $sql)) {

        header("Location: w2.html");
        exit();

    } else {

        echo "❌ Error";
    }
}

?>