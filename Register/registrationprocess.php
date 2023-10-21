<?php

include "../Connection/dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $user_id = isset($_POST['id']) ? $_POST['id'] : null;
    $firstname = isset($_POST['FirstName']) ? $_POST['FirstName'] : null;
    $lastname = isset($_POST['LastName']) ? $_POST['LastName'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $nationality = isset($_POST['nationality']) ? $_POST['nationality'] : null;
    $email = isset($_POST['Email']) ? $_POST['Email'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? md5($_POST['password']) : null;

    if ($user_id && $firstname && $lastname && $gender && $nationality && $email && $username && $password) {
        // Use prepared statements to insert data into the database
        $stmt = $connection->prepare("INSERT INTO `registertable`(`id`, `first_name`, `last_name`, `gender`, `nationality`, `email`, `username`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $user_id, $firstname, $lastname, $gender, $nationality, $email, $username, $password);

        if ($stmt->execute()) {
            echo "Registered Successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Incomplete or invalid data provided";
    }

    $connection->close();
}
?>
