<?php

session_start();

    // リツイートbot by eax(https://b.eax.jp/?p=4485) 2013年6月15日
    // 元ソース　http://webmage.pro/blog/archives/352
    // twitteroauth.phpを読み込む。
     require_once 'twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

        // Consumer keyの値 @@@@@@
        $consumer_key = "McAoCYwWenhseXhjV6VZTc1Lm";
        // Consumer secretの値 @@@@@@
        $consumer_secret = "JIW5iPZLoEhxgL9E8nFtliMA72JVCmatvAdWatWdi0LSD1k38m";
        // Access Tokenの値 @@@@@@
        $access_token = "4375980312-WsprOBscWLZB6bDEWdtKHEQnAcdgffgt4aHh3qE";
        // Access Token Secretの値 @@@@@@
        $access_token_secret = "OsMv02cXFaFaiwo33MnMCmHKeuWqZ0pfL8pfO5AftjtdO";

    // TwitterへRTする。 最新ツイートのみリツイート、リツイート済はエラーとなる。
     $connection = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

    

     $result = $connection->post("statuses/update", array("status" => "askldjalksdmlaksmklsaddasklmlm;almadsklm;dsalmdsadsadslmaksd"));

//セッションに入れておいたさっきの配列
$access_token = $_SESSION['access_token'];
//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
$connection2 = new TwitterOAuth("k7Ltqna3agxeWtDDi0W5nbJVZ", "mcpV68T2T26pEdJc4KM9hID7FOh9Y7xfEdBvE1CpGCFjHwZ8At", $access_token['oauth_token'], $access_token['oauth_token_secret']);

 $result2 = $connection2->post("statuses/retweet", array("id" => $result->id));

?>