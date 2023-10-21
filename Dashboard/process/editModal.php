<?php
include '../Connection/dbconn.php';

$userID = $_GET["userID"];

$sql = "SELECT * FROM `registertable` WHERE id = '$userID'";
$select = mysqli_query($connection, $sql);

if (mysqli_num_rows($select) != 0) {
    $row = mysqli_fetch_assoc($select); // Use mysqli_fetch_assoc to get an associative array
    echo json_encode($row);
} else {
    $result = json_encode("No user found");
    echo $result;
}
?>
