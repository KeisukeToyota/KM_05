<?php

    session_start();
     
?>
<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <title>Gooch</title>

    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="application/javascript">

    <link rel="stylesheet" href="resources/css/base.css">
    <link rel="stylesheet" href="resources/css/style.css">
    
    <script src="resources/js/main.js"></script>

</head>

<body>

    <div id="container">

        <header>

            <!-- Logo -->
            <div class="f_l">
                <div id="logo" class="f-red f_l">Gooch</div>
                <nav class="f_l">
                    <div class="menu f_l">
                       <a href="post.php">
                        <span class="c f-red">J&nbsp;</span>始める
                        </a>
                    </div>
                    <div class="menu f_l">
                        <span class="c f-red">[&nbsp;</span>探す
                    </div>
                </nav>
            </div>

            <div class="f_r">
                <?php if( $_SESSION['USERID'] ){ ?>
                    <div class="btn f_l b-red">
                        <?php echo $_SESSION['USERID']; ?>
                    </div>
                <?php }else{ ?>
                    <a href="signup.php">
                        <div class="btn f_l f-red" id="signup">新規登録</div>
                    </a>
                    <div class="btn f_l b-red" id="signin">ログイン</div>
                <?php } ?>
            </div>

        </header>

        <section id="pickup" class="category">
            <div class="center center-shadow clearfix">
                <h2 class="f-red">ピックアップ</h2>
                <div class="f_l box box-img"></div>
                <div class="f_l box">
                    <div id="title">
                        <div class="p20x30 clearfix">
                            <div class="f_l">
                                タイトル
                                <br>
                                <span class="description">説明</span>
                            </div>
                            <div class="f_r right-side">
                                <span class="c">¢&nbsp;</span>0人
                                <br>
                                <span class="c">˘&nbsp;</span>ユーザ名
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
        </section>

        <section class="category">
            <div class="center clearfix">

                <h3 class="f-red">カテゴリ</h3>

                <!-- 横列 -->
                <div class="row">
                    
<?php

    $a = $_GET['flg'];
    $b = $_GET['flg2'];
                    
    $id = $_GET['id'];

    $link = mysqli_connect( "localhost", "root", "pass", "gooch" );
    
    if( mysqli_connect_errno() ){
        echo "Faild";
        exit();
    }

if( $id ){                    
    $result = mysqli_query( $link, "select * from article inner join iine on article.id = iine.id where article.id=". $id ); 
}else if( $a && $b ) {
    $result = mysqli_query( $link, "select * from article inner join iine on article.id = iine.id limit ". $a. ",". $b );
}else $result = mysqli_query( $link, "select * from article inner join iine on article.id = iine.id;" ); 

    if( $result ){
        
        while( $row = mysqli_fetch_assoc( $result ) ){
?>
              
              
                    <div class="f_l box" style="margin-bottom:30px;width:182px;">
                        <div class="box-img" style="background: url(<?php echo "uploads/". $row['id']. ".png"; ?>);background-size:cover;"></div>
                        <div class="p20">
                            <h4><?php echo $row['title']; ?></h4>
                        </div>
                        <div class="description add">
                            <span class="c">˘&nbsp;</span><?php echo $row['user_id']; ?>
                        </div>
                        <a href="resources/module/post.php?id=<?php echo $row['id']; ?>">
                        <div class="overview">
                            <span class="c">¢&nbsp;</span><?php echo $row['iine']; ?>人
                        </div>
                        </a>
                    </div>
            
<?php
        }
        
        mysqli_free_result( $result );
        
    }

    mysqli_close( $link );

?>

                </div>

            </div>
        </section>

        <footer>
            <address>Copyright 2015 Gooch.</address>
        </footer>

    </div>

    <!-- Login Screen -->
    <div id="login-background">
        <div id="login-form">
            
            <div id="close" class="b-red">
                <span class="c">ò</span>
            </div>

            <div id="login-logo" class="f-red">Gooch</div>

            <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST" class="p20x30">
                <div>
                    <div class="label">ログイン ID</div>
                    <input type="text" id="userid" name="userid" style="box-shadow:0;" value="">
                </div>
                <div class="pd">
                    <div class="label">パスワード</div>
                    <input type="password" id="password" name="password" value="">
                </div>

                <input type="submit" id="login" name="login" class="b-red" value="ログイン">

            </form>


        </div>
    </div>

</body>

</html>