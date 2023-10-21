<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include "../Connection/dbconn.php";
    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: ../index.php");
    // }

    if (isset($_GET['log'])) {
        if ($_GET['log'] == 'true') {
            session_destroy();
            header("Location: ../index.php");
        }
    }
    ?>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Dashboard.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Dashboard</h1>
    <a href="../index.php" class="styled-link"> Log out </a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Nationality</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="listUsers">
    <?php
    $sql = "SELECT * FROM `registertable`";
    $result = $connection->query($sql);

    $counter = 0; // Initialize a counter variable

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counter++; // Increment the counter for each row
            ?>
            <tr>
                <td><?php echo $counter; ?></td> <!-- Display the counter -->
                <td><?php echo $row["first_name"]; ?></td>
                <td><?php echo $row["last_name"]; ?></td>
                <td><?php echo $row["gender"]; ?></td>
                <td><?php echo $row["nationality"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td>
                    <button type="button" data-toggle="modal" data-target="#editModal" data-user-id="<?php echo $row['id']; ?>" class="btn btn-primary editBtn">Edit</button>
                    <br>
                    <button type="button" data-user-id="<?php echo $row['id']; ?>" class="btn btn-danger deleteBtn">Delete</button>
                </td>
            </tr>
        <?php
        }
    } else {
        echo "<tr><td colspan='7'>No data available</td></tr>";
    }
    ?>
</tbody>

    </table>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userID" id="userID">
                    <div class "form-group">
                        <label for="FirstName">First Name</label>
                        <input type="text" class="form-control" id="FirstName" placeholder="First Name">
                        <label for="LastName">Last Name</label>
                        <input type="text" class="form-control" id="LastName" placeholder="Last Name">
                        <label for="Gender">Gender</label>
                        <input type="text" class="form-control" id="Gender" placeholder="Gender">
                        <label for="Nationality">Nationality</label>
                        <input type="text" class="form-control" id="Nationality" placeholder="Nationality">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveUser">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script>

$(document).ready(function () {
    $(document).on('click', '.saveUser', function (e) {
        e.preventDefault();

        // Get the user ID from the input field in the modal
        var userID = $('#userID').val();
        var firstname = $('#FirstName').val();
        var lastname = $('#LastName').val();
        var gender = $('#Gender').val();
        var nationality = $('#Nationality').val();
        var email = $('#userEmail').val();

        $.ajax({
            async: true,
            type: "GET",
            url: "process/updateUser.php?userID=" + userID + "&FirstName=" + firstname
                + "&LastName=" + lastname + "&Gender=" + gender + "&Nationality=" + nationality
                + "&userEmail=" + email,
            dataType: "json",
            success: function (response) {
                $('#editModal').modal('hide');

                Swal.fire(
                    'Updated!',
                    'User has been updated.',
                    'success'
                );

                var counter = 0;

                $('#listUsers').html('');

                for (let i = 0; i < response.length; i++) {
                    counter++;

                    var firstname, lastname, gender, nationality, email;

                    firstname = response[i][0];
                    lastname = response[i][1];
                    gender = response[i][2];
                    nationality = response[i][3];
                    email = response[i][4];

                    $('#listUsers').append('<tr>\
                        <th scope="row">' + counter + '</th >\
                        <td>' + firstname + '</td>\
                        <td>' + lastname + '</td>\
                        <td>' + gender + '</td>\
                        <td>' + nationality + '</td>\
                        <td>' + email + '</td>\
                        <td>\
                            <button type="button" value="' + userID + '" class="btn btn-primary editBtn">Edit</button>\
                            <button type="button" value="' + userID + '" class="btn btn-danger deleteBtn">Delete</button>\
                        </td >\
                    </tr>');
                }
            }
        });
    });
});

$(document).on('click', '.editBtn', function (e) {
    e.preventDefault();
    var userID = $(this).data('user-id'); // Get the user ID from the button's data attribute

    $.ajax({
        async: true,
        type: "GET",
        url: "process/editModal.php?userID=" + userID,
        dataType: "json",
        success: function (response) {
            var userId = response[0]; // Get user ID from the response
            var firstname = response[1];
            var lastname = response[2];
            var gender = response[3];
            var nationality = response[4];
            var email = response[5];

            $('#userID').val(userId);
            $('#FirstName').val(firstname);
            $('#LastName').val(lastname);
            $('#Gender').val(gender);
            $('#Nationality').val(nationality);
            $('#userEmail').val(email);

            $('#editModal').modal('show');
        }
    });
});


            $(document).on('click', '.deleteBtn', function (e) {
                e.preventDefault();
                var userID = $(this).data('user-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                $.ajax({
                    async: true,
                    type: "GET",
                    url: "process/deleteModal.php?userID=" + userID,
                    dataType: "json",
                    success: function (response) {

                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted.',
                                    'success'
                                );

                                var counter = 0;
                                $('#listUsers').html('');
                                for (let i = 0; i < response.length; i++) {
                                    counter++;
                                    var id, firstname, lastname, gender, nationality, email;

                                    id = response[i][0];
                                    firstname = response[i][1];
                                    lastname = response[i][2];
                                    gender = response[i][3];
                                    nationality = response[i][4];
                                    email = response[i][5];

                                    $('#listUsers').append('<tr>\
                                <th scope="row">'+ counter + '</th >\
                                <td>'+ firstname + '</td>\
                                <td>'+ lastname + '</td>\
                                <td>'+ gender + '</td>\
                                <td>'+ nationality + '</td>\
                                <td>'+ email + '</td>\
                            <td>\
                                <button type="button" value="'+ id + '" class="btn btn-primary editBtn">Edit</button>\
                                <button type="button" value="'+ id + '" class="btn btn-danger deleteBtn">Delete</button>\
                                </td >\
                            </tr>');


                                }

                            }

                        });

                    }
                })

            });
        
    </script>

</body>

</html>