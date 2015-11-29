<?php
    session_start();

    $errorMessage = "";

    if (isset($_POST["login"])) {
        if (empty($_POST["userid"])) $errorMessage = "ユーザIDが未入力です";
        else if (empty($_POST["password"])) $errorMessage = "パスワードが未入力です";

        if (!empty($_POST["userid"]) && !empty($_POST["password"])) {

            $mysqli = new mysqli( "localhost", "root", "pass");
            if ($mysqli->connect_errno) {
                $errorMessage = 'データベースへの接続に失敗しました';
                exit();
            }

            $mysqli->select_db( "gooch" );
            $userid = $mysqli->real_escape_string($_POST["userid"]);

            $query = "SELECT * FROM auth WHERE id = '" . $userid . "'";
            $result = $mysqli->query($query);
            if (!$result) {
                $errorMessage = 'クエリーが失敗しました。';
                $mysqli->close();
                exit();
            }

            while ($row = $result->fetch_assoc()) {
                $db_hashed_pwd = $row['pass'];
            }

            $mysqli->close();

            if ($_POST["password"] == $db_hashed_pwd) {
                session_regenerate_id(true);
                $_SESSION["USERID"] = $_POST["userid"];
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                $errorMessage = "ユーザIDあるいはパスワードに誤りがあります";
            } 

        }

        if( $errorMessage ){
            echo "<script>alert('". $errorMessage. "')</script>";
            $errorMessage = '';
        }
    }
?>