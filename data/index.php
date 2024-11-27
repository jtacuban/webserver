<?php include ('./conn/conn.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Manager App</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, #323232 0%, #3F3F3F 40%, #1C1C1C 150%), linear-gradient(to top, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.25) 200%);
            background-blend-mode: multiply;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .accounts-container {
            width: 90%;
            background-color: #ffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }

        .accounts-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .task-list {
            font-size: 13px;
            max-height: 600px !important;
            height: 560px !important;
        }

        .table-responsive {
            overflow-y: auto !important;
            max-height: 690px !important;
        }

        .table button {
            width: 30px;
            font-size: 17px;
        }

        .password-input {
            border: none;
            background-color: transparent;
            text-align: center;
            cursor: pointer;
        }
    </style>

</head>
<body>

    <div class="main">
        <div class="accounts-container">
            <div class="accounts-header">
                <h3>Accounts Manager App</h3>

                <button type="button" class="btn btn-dark mb-3 float-right" data-toggle="modal" data-target="#addAccountModal">
                    Add Account
                </button>
            </div>

            <!-- All Accounts Table -->
            <div class="table-responsive">
                <table class="table table-sm   table-hover task-list" style="max-height: 300px; overflow-y: auto;">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th style="display:none;"></th>    
                            <th scope="col">URL</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php  
                        $stmt = $conn->prepare("SELECT * FROM `tbl_accounts`");
                        $stmt->execute();
                        $result = $stmt->fetchAll();

                        foreach ($result as $row) {
                            $accountID = $row['tbl_account_id'];
                            $accountName = $row['account_name'];
                            $username = $row['username'];
                            $password = $row['password'];
                            $link = $row['link'];
                        ?>
                        <tr>
                            <td id="accountID-<?= $accountID ?>"><?php echo $accountID ?></td>
                            <td id="accountName-<?= $accountID ?>"><?php echo $accountName ?></td>
                            <td id="username-<?= $accountID ?>"><?php echo $username ?></td>
                            <td id="password-<?= $accountID ?>" style="display:none;"><?php echo $password ?></td>
                            <td><input class="password-input" type="password" value="<?php echo $password ?>" onclick="togglePasswordVisibility(<?php echo $accountID ?>)" id="password-input-<?= $accountID ?>" readonly></td>
                            <td id="link-<?= $accountID ?>"><a href="../../<?php echo $link ?>" target="_blank"><?php echo $link ?></a></td>
                            <td>
                                <button id="editBtn" onclick="update_account(<?php echo $accountID ?>)" title="Edit"><i class="fa-solid fa-pencil"></i></button>
                                <button id="deleteBtn" onclick="delete_account(<?php echo $accountID ?>)" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Add Account Modal -->
    <div class="modal fade mt-5" id="addAccountModal" tabindex="-1" aria-labelledby="addAccount" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccount">Add Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/add-account.php" method="POST">
                        <div class="form-group">
                            <label for="accountName">Account Name</label>
                            <input type="text" class="form-control" id="accountName" name="account_name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Save Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Account Modal -->
    <div class="modal fade mt-5" id="updateAccountModal" tabindex="-1" aria-labelledby="updateAccount" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAccount">Update Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/update-account.php" method="POST">
                        <input type="text" id="updateAccountID" name="tbl_account_id" hidden>
                        <div class="form-group">
                            <label for="updateAccountName">Account Name</label>
                            <input type="text" class="form-control" id="updateAccountName" name="account_name">
                        </div>
                        <div class="form-group">
                            <label for="updateUsername">Username</label>
                            <input type="text" class="form-control" id="updateUsername" name="username">
                        </div>
                        <div class="form-group">
                            <label for="updatePassword">Password</label>
                            <input type="text" class="form-control" id="updatePassword" name="password">
                        </div>
                        <div class="form-group">
                            <label for="updateLink">Link</label>
                            <input type="text" class="form-control" id="updateLink" name="link">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Script JS -->
    <script src="http://localhost/password-manager-app/assets/script.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <!-- Datatable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        // Initialize DataTables
        $(document).ready(function () {
            $('.task-list').DataTable({
                "order": [[0, "asc"]]
            });
        });

        
        // Update account
        function update_account(id) {
            $("#updateAccountModal").modal("show");

            let updateAccountID = $("#accountID-" + id).text();
            let updateAccountName = $("#accountName-" + id).text();
            let updateUsername = $("#username-" + id).text();
            let updatePassword = $("#password-" + id).text();
            let updateLink = $("#link-" + id).text();
            let updateDescription = $("#description-" + id).text();

            $("#updateAccountID").val(updateAccountID);
            $("#updateAccountName").val(updateAccountName);
            $("#updateUsername").val(updateUsername);
            $("#updatePassword").val(updatePassword);
            $("#updateLink").val(updateLink);
            $("#updateDescription").val(updateDescription);
        }



        // Delete account
        function delete_account(id) {
            if (confirm("Do you want to delete this account?")) {
                window.location = "./endpoint/delete-account.php?account=" + id;
            }
        }

        // Show password
        function togglePasswordVisibility(accountID) {
            var passwordInput = document.getElementById("password-input-" + accountID);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>