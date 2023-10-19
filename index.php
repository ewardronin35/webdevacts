<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "Connection/dbconn.php";
    if (isset($_SESSION['user_id'])) {
        header("Location: Dashboard/dashboard.php");
    }
    
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);
        $sql = "SELECT * FROM registertable WHERE username = '$username' AND password = '$password'";
        $select = mysqli_query($connection, $sql);
    
        if (mysqli_num_rows($select) != 0) {
            $user = mysqli_fetch_array($select);
            $_SESSION['user_id'] = $user['id'];
            header("Location: Dashboard/dashboard.php");
        } else {
            echo "Failed to login";
        }
    }
    ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login/style.css">
    <title>Web Dev</title>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="index.php" method="POST">
        <h3>Welcome</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Username" id="username" name="username" required autofocus>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required autofocus>

        <button type="submit" name="login">Log In</button> <br>
        <br>
        <a href="Register/register.php" class="register-button"><center>Register</center></a>

    </form>
</body>
</html>
