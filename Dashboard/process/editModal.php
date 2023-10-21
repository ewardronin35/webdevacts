<?php
include '../Connection/dbconn.php';

$userID = $_GET["userID"];

$sql = "SELECT * FROM registertable WHERE id = '$userID'";
$select = mysqli_query($connection, $sql);

if (mysqli_num_rows($select) != 0) {
    $row = mysqli_fetch_array($select);
    $result = json_encode($row);
    echo $result;
} else {
    $result = json_encode("No users found");
    echo $result;
}
?>
