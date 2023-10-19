<?php
include '../Connection/dbconn.php';

$userID = $_GET["userID"];
$firstname = $_GET["FirstName"];
$lastname = $_GET["LastName"];
$gender = $_GET["Gender"];
$nationality = $_GET["Nationality"];
$email = $_GET["userEmail"];

$sql = "UPDATE `registertable` SET `first_name` = '$firstname', `last_name` = '$lastname', `gender` = '$gender', `nationality` = '$nationality', `email` = '$email' WHERE `user_id` = '$userID'";

$update = mysqli_query($connection, $sql);

if ($update) {
    $sql = "SELECT * FROM registertable";
    $selectAll = mysqli_query($connection, $sql);

    if (mysqli_num_rows($selectAll) != 0) {
        $users = array();
        while ($row = mysqli_fetch_array($selectAll)) {
            array_push($users, $row);
        }
        $result = json_encode(array("success" => true, "message" => "User updated successfully", "data" => $users));
        echo $result;
    }
}

else {
    $result = json_encode(array("success" => false, "message" => "Failed to update user info"));
    echo $result;
}

?>
