<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration or Sign Up form in HTML CSS | CodingLab </title> 
    <link rel="stylesheet" href="register.css">
    <?php
  include "../Connection/dbconn.php";
  include 'registrationprocess.php';
  ?>
   </head>
<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="register.php" method="POST">
      <div class="input-box">
      <input type="number" placeholder="User_ID" class="user_id" id="user_id" name="user_id" required />
      </div>
      <div class="input-box">
      <input type="text" placeholder="First Name" class="FirstName" id="FirstName" name="FirstName" required />      </div>
      <div class="input-box">
      <input type="text" placeholder="Last Name" class="LastName" id="LastName" name="LastName" required />
      </div>
      <div class="input-box">
      <input type="text" placeholder="Gender" class="gender" id="gender" name="gender" required />
      </div>
      <div class="input-box">
      <input type="text" placeholder="nationality" class="textbox" name="nationality" required />
      </div>
      <div class="input-box">
      <input type="text" placeholder="Email" class="textbox" name="Email" required />
      </div>
      <div class="input-box">
      <input type="text" placeholder="username" class="textbox" name="username" required />
      </div>
      <div class="input-box">
      <input type="password" placeholder="password" class="textbox" name="password" required />
      </div>

      <div class="input-box button">
        <input type="Submit"id='submit' class='submit' value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="../index.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>