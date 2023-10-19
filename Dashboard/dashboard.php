<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    include "../Connection/dbconn.php";
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
    }

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
                $sql = "SELECT * FROM registertable";
                $select = mysqli_query($connection, $sql);


                if (mysqli_num_rows($select) != 0) {
                    $counter = 0;


                    while ($row = mysqli_fetch_array($select)) {
                        $counter++;

                        ?>

                        <tr>
                            <th scope="row">
                                <?php echo $counter; ?>
                            </th>
                            
                            <td>
                                <?php echo $row['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['gender']; ?>
                            </td>
                            <td>
                                <?php echo $row['nationality']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>

                            <td>
                                <button value="<?php echo $row['user_id']; ?>" class="btn btn-primary editBtn">Edit</button>
                                <button type="button" data-user-id="<?php echo $row['user_id']; ?>" class="btn btn-danger deleteBtn">Delete</button>
                            </td>

                        </tr>


                        <?php

                    }
                }
                ?>
            </tbody>
        </table>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        var userID = $('#userID').val();
        var firstname = $('#FirstName').val();
        var lastname = $('#LastName').val();
        var gender = $('#Gender').val();
        var nationality = $('#Nationality').val();
        var email = $('#userEmail').val();

        $.ajax({
            type: "POST",
            url: "process/updateUser.php",
            data: {
                userID: userID,
                FirstName: firstname,
                LastName: lastname,
                Gender: gender,
                Nationality: nationality,
                userEmail: email
            },
            dataType: "json",
            success: function (response) {
                $('#editModal').modal('hide');

                Swal.fire(
                    'Updated!',
                    'User has been updated.',
                    'success'
                );

                // Update the table
                updateTable(response);
            }
        });
    });

    $(document).on('click', '.editBtn', function (e) {
        e.preventDefault();
        var userID = $(this).val();

        $.ajax({
            type: "GET",
            url: "process/editUser.php?userID=" + userID,
            dataType: "json",
            success: function (response) {
                // Updated variable names here
                var id, firstname, lastname, gender, nationality, email;

                id = response[0];
                firstname = response[1];
                lastname = response[2];
                gender = response[3];
                nationality = response[4];
                email = response[5];

                $('#userID').val(id);
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
                    type: "GET",
                    url: "process/deleteUser.php?userID=" + userID,
                    dataType: "json",
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                        );

                        // Update the table
                        updateTable(response);
                    }
                });
            }
        });
    });

    // Function to update the table
    function updateTable(response) {
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
                <th scope="row">' + counter + '</th >\
                <td>' + firstname + '</td>\
                <td>' + lastname + '</td>\
                <td>' + gender + '</td>\
                <td>' + nationality + '</td>\
                <td>' + email + '</td>\
                <td>\
                    <button type="button" value="' + id + '" class="btn btn-primary editBtn">Edit</button>\
                    <button data-user-id="' + id + '" class="btn btn-danger deleteBtn">Delete</button>\
                </td >\
            </tr>');
        }
    }
});
</script>

</body>
</html>