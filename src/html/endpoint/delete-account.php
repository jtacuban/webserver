<?php
include ('../conn/conn.php');

if (isset($_GET['account'])) {
    $account = $_GET['account'];

    try {

        $query = "DELETE FROM tbl_accounts WHERE tbl_account_id = '$account'";

        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            header("Location: http://localhost/account-manager-app/index.php");
        } else {
            header("Location: http://localhost/account-manager-app/index.php");
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>