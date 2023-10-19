<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registration Form</title>
</head>
<body>
    
    <div class="container">
        <h2>Registration Form</h2>
        <form action="assign.php" method="POST">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required><br><br>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required><br><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Register">
        </form>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = md5();

    // Check if the username contains "bsit"
    if (strpos($username, 'bsit') !== false) {
        // Database connection parameters
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $dbname = "webdev";

        // Create a connection to the database
        $conn = new mysqli_connect($servername, $username_db, $password_db, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to insert user data into the database
        $sql = "INSERT INTO users (FirstName, LastName, Age, Email, PhoneNumber, Username, Password)
                VALUES ('$firstName', '$lastName', '$email', '$phone', '$age', '$username', '$password')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Username must contain 'bsit' to register.";
    }
}
?>

    </div>  
</body>
</html>
