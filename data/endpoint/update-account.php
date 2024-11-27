<?php
include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_POST['tbl_account_id'];
    $accountName = $_POST['account_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $link = $_POST['link'];

    try {
        $conn->beginTransaction(); // Start transaction

        $updateStmt = $conn->prepare("UPDATE `tbl_accounts` SET `account_name` = :account_name, `username` = :username, `password` = :password, `link` = :link WHERE `tbl_account_id` = :accountID");
        $updateStmt->bindParam(':account_name', $accountName, PDO::PARAM_STR);
        $updateStmt->bindParam(':username', $username, PDO::PARAM_STR);
        $updateStmt->bindParam(':password', $password, PDO::PARAM_STR);
        $updateStmt->bindParam(':link', $link, PDO::PARAM_STR);
        $updateStmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
        $updateStmt->execute();

        $conn->commit(); // Commit transaction

        echo "
        <script>
            alert('Account Updated Successfully');
            window.location.href = 'http://localhost/account-manager-app/index.php';
        </script>
        ";
    } catch (PDOException $e) {
        $conn->rollBack(); // Rollback transaction
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "
    <script>
        alert('Account Update Failed!');
        window.location.href = 'http://localhost/account-manager-app/index.php';
    </script>
    ";
}
?>
