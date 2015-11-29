<?php

     require_once 'tw/twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;



    session_start();
    if( !$_SESSION['USERID'] ) header( 'location: index.php' );

    if (isset($_POST["login"])) {
        
        if( !empty($_POST['title']) && !empty($_POST['description']) &&  !empty($_POST['locate']) ){
        

            
            
            $mysqli = new mysqli( "localhost", "root", "pass");
            if ($mysqli->connect_errno) {
                $errorMessage = 'データベースへの接続に失敗しました';
                exit();
            }

            $mysqli->select_db( "gooch" );

                $aaaaa = $mysqli->query( "insert into article ( title, description, locate, user_id ) values ('". $_POST['title'] ."','". $_POST['description']."','". $_POST['locate'] ."','". $_SESSION['USERID'] ."')" );
            $mysqli->query( "insert into iine ( user, iine ) values ( '', 0 )" );
            
            if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
            
        $imagesize = getimagesize($_FILES['upfile']['tmp_name']); 
            
            if( $imagesize['mine'] == 'image/gif' || $imagesize['mime'] == 'image/jpeg' || $imagesize['mime'] == 'image/png' ){
                
                switch( $imagesize['mime'] ){
                    case  'image/gif':
                        $a = '.gif';
                        break;
                    case 'image/jpeg':
                        $a = '.jpg';
                        break;
                    case 'image/png':
                        $a = '.png';
                        break;
                }
                
                $link = mysqli_connect( "localhost", "root", "pass", "gooch" );
    
                if( mysqli_connect_errno() ){
                    echo "Faild";
                    exit();
                }
                
                $i = 0;
                $x = mysqli_query( $link, 'select count(id) from article' );

                if( $x ){
                    $i = $x->fetch_assoc()['count(id)'];

                if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "uploads/" . ( $i + 1 ). $a)) {
                    chmod("files/" . $_FILES["upfile"]["name"], 0644);
                    $errorMessage = $_FILES["upfile"]["name"] . "をアップロードしました。";
                } else $errorMessage = "ファイルをアップロードできません。";
                }
                }
                
                /* ---------- */

                
                
                /* ------ */

                
            } else echo "ファイルが選択されていません。";
            
                // リツイートbot by eax(https://b.eax.jp/?p=4485) 2013年6月15日
    // 元ソース　http://webmage.pro/blog/archives/352
    // twitteroauth.phpを読み込む。
        // Consumer keyの値 @@@@@@
        $consumer_key = "McAoCYwWenhseXhjV6VZTc1Lm";
        // Consumer secretの値 @@@@@@
        $consumer_secret = "JIW5iPZLoEhxgL9E8nFtliMA72JVCmatvAdWatWdi0LSD1k38m";
        // 公式トークン
        $access_token = "xxxxxxxxxxxxxxxxxxx";
        // Access Token Secretの値 @@@@@@
        $access_token_secret = "xxxxxxxxxxxxxxx";

    // TwitterへRTする。 最新ツイートのみリツイート、リツイート済はエラーとなる。
     $connection = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

    

     $result = $connection->post("statuses/update", array("status" => $_POST['description']));

//セッションに入れておいたさっきの配列
$access_token = $_SESSION['access_token'];
//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
$connection2 = new TwitterOAuth("k7Ltqna3agxeWtDDi0W5nbJVZ", "mcpV68T2T26pEdJc4KM9hID7FOh9Y7xfEdBvE1CpGCFjHwZ8At", $access_token['oauth_token'], $access_token['oauth_token_secret']);

 $result2 = $connection2->post("statuses/retweet", array("id" => $result->id));
                
                

            if( $aaaaa ) header( 'location: index.php' );
            
            }else $errorMessage =  "未入力";
        
            
        
            
        }
        
?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>

        <meta charset="utf-8">
        <title>Gooch - 投稿</title>

        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="content-script-type" content="application/javascript">

        <link rel="stylesheet" href="resources/css/base.css">
        <link rel="stylesheet" href="resources/css/style.css">

        <script>
            window.onload = function () {
                document.getElementById('g').addEventListener('click', function(){
                navigator.geolocation.watchPosition(
                    function (position) {
                        
                        document.getElementById('locate').value = position.coords.latitude + ',' + position.coords.longitude
                        
                  
                    
                    }
                );
            })
            }
        </script>


    </head>

    <body>

        <div id="container">

            <header>
                <div id="logo" class="f-red" style="text-align:center">Gooch</div>
            </header>

            <section id="pickup" class="category">
                <div class="center">
                    <h2 class="f-red">投稿</h2>
                </div>
            </section>

            <div class="center reg-form" style="width:450px;">
                <div>
                    <?php echo $errorMessage ?>
                </div>

                <form id="loginForm" name="loginForm"  enctype="multipart/form-data"  action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST" class="p20x30">
                    <div>
                        <div class="label">タイトル</div>
                        <input type="text" name="title" value="a">
                    </div>
                    <div class="pd">
                        <div class="label">説明</div>
                        <input type="text" name="description" value="a" style="height:200px;">
                    </div>
                    <div class="pd">
                        <div class="label">場所</div>
                        <input type="text" id="locate" name="locate" value="a" style="border-radius: 3px 3px 0 0">
                        <div id="g" class="b-red">現在位置を設定</div>
                    </div>
                    
                    <div class="pd">
                    <div class="label">画像</div>
                    <input type="file" name="upfile" size="30" />
                    </div>
                    
                    <input type="submit" id="login" name="login" class="b-red" value="投稿">

                </form>
            </div>

            <footer>
                <address>Copyright 2015 Gooch.</address>
            </footer>

        </div>

    </body>

    </html>
