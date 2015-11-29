<?php
    session_start();
    //if( $_SESSION['USERID'] ) header( 'location: '. $_SERVER['HTTP_REFERER'] );

    if (isset($_POST["login"])) {
        
        if( !empty($_POST['userid']) && !empty($_POST['mail']) &&  !empty($_POST['password']) && !empty($_POST['phone']) ){
            
            
            $mysqli = new mysqli( "localhost", "root", "pass");
            if ($mysqli->connect_errno) {
                $errorMessage = 'データベースへの接続に失敗しました';
                exit();
            }

            $mysqli->select_db( "gooch" );
            
            $i = 0;
            
            $u = $mysqli->query( "select * from auth where id='". $_POST['userid'] ."'" );
            while( $row = $u->fetch_assoc() ) $i++;
            $u = $mysqli->query( "select * from auth where phone='". $_POST['phone'] ."'" );
            while( $row = $u->fetch_assoc() ) $i++;
            $u = $mysqli->query( "select * from auth where mail='". $_POST['mail'] ."'" );
            while( $row = $u->fetch_assoc() ) $i++;
            
            if( !$i ){
                
                echo $a = $mysqli->query( "insert into auth ( id, mail, phone, pass ) values ('". $_POST['userid'] ."','". $_POST['mail']."','". $_POST['phone'] ."','". $_POST['password'] ."')" );
                if( $a ){
                    session_regenerate_id(true);
                $_SESSION["USERID"] = $_POST["userid"];
                    header( 'location: index.php');
                exit;
                }
                
            }else $errorMessage =  "既に登録されています";
            
        }
        
    }
?>
<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <title>Gooch - 新規登録</title>

    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="application/javascript">

    <link rel="stylesheet" href="resources/css/base.css">
    <link rel="stylesheet" href="resources/css/style.css">
    

</head>

<body>

    <div id="container">

        <header>
            <div id="logo" class="f-red" style="text-align:center">Gooch</div>
        </header>

        <section id="pickup" class="category">
            <div class="center">
                <h2 class="f-red">新規登録</h2>
            </div>
        </section>
          
          <div class="center reg-form" style="width:450px;">
            <div><?php echo $errorMessage ?></div>

            <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST" class="p20x30">
                <div>
                    <div class="label">ログイン ID</div>
                    <input type="text" id="userid" name="userid" value="a">
                </div>
                <div class="pd">
                    <div class="label">パスワード</div>
                    <input type="password" id="password" name="password" value="a">
                </div>
                <div class="pd">
                    <div class="label">メールアドレス</div>
                    <input type="text" id="mail" name="mail" value="a">
                </div>
                <div class="pd">
                    <div class="label">電話番号</div>
                    <input type="text" id="phone" name="phone" value="a">
                </div>

                <input type="submit" id="login" name="login" class="b-red" value="登録">

            </form>
        </div>

        <footer>
            <address>Copyright 2015 Gooch.</address>
        </footer>

    </div>

</body>

</html>