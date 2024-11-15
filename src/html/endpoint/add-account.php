<?php
include ('../conn/conn.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountName = $_POST['account_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $link = $_POST['link'];

    try {
        $stmt = $conn->prepare("SELECT `account_name` FROM `tbl_accounts` WHERE `account_name` = :account_name");
        $stmt->execute([
            'account_name' => $accountName
        ]);
        $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($userExists)) {
            $conn->beginTransaction();

            $insertStmt = $conn->prepare("INSERT INTO `tbl_accounts` (`account_name`, `username`, `password`, `link`) VALUES (:account_name, :username, :password, :link)");
            $insertStmt->bindParam(':account_name', $accountName, PDO::PARAM_STR);
            $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam(':password', $password, PDO::PARAM_STR);
            $insertStmt->bindParam(':link', $link, PDO::PARAM_STR);
            $insertStmt->execute();

            echo "
            <script>
                alert('Registered Successfully');
                window.location.href = 'http://localhost/account-manager-app/index.php';
            </script>
            ";

            $conn->commit();
        } else {
            echo "
            <script>
                alert('Account Already Exists');
                window.location.href = 'http://localhost/account-manager-app/index.php';
            </script>
            ";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "
    <script>
        alert('Account Registration Failed!');
        window.location.href = 'http://localhost/account-manager-app/index.php';
    </script>
    ";
}

?>
