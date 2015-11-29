<?php

session_start();

require_once 'common.php';
require_once 'twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

//セッションに入れておいたさっきの配列
$access_token = $_SESSION['access_token'];

//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

//ユーザー情報をGET
$user = $connection->get("account/verify_credentials");
//(ここらへんは、Twitter の API ドキュメントをうまく使ってください)


// $result = $connection->post("statuses/retweet", array("id" => 670417970816901121));
// 返ってきた内容を確認してみる
// var_dump($result);

$link = mysqli_connect( "localhost", "root", "pass", "gooch" );

if( !mysqli_query( $link, "select * from oauth where id=". $user->id. ";" ) ) mysqli_query( $link, "insert into oauth ( id, token, stoken ) values ( '".$user->id ."', '". $access_token['oauth_token'] ."', '". $access_token['oauth_token_secret'] ."')" );

echo $user->id;

header( 'location: ../index.php' );

?>