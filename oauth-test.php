<?php
require 'vendor/autoload.php';
require 'config.php';

$twitter = new tmhOAuth(array(
    'consumer_key'    => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_SECRET
));

session_start();
$callbackUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] .'?act=callback';

if (empty($_GET['act'])) {
    $twitter->request('POST', $twitter->url('oauth/request_token', ''), array('oauth_callback' => $callbackUrl));
    $_SESSION['token'] = $twitter->extract_params($twitter->response['response']);
    header('Location: '. $twitter->url('oauth/authorize', ''). '?oauth_token='. $_SESSION['token']['oauth_token']);
}

// callbackしてきた
$twitter->config['user_token'] = $_SESSION['token']['oauth_token'];
$twitter->config['user_secret'] = $_SESSION['token']['oauth_token_secret'];
$twitter->request('POST', $twitter->url('oauth/access_token', ''), array('oauth_verifier' => $_GET['oauth_verifier']));
$token = $twitter->extract_params($twitter->response['response']);
var_dump($token);
$twitter->config['user_token'] = $token['oauth_token'];
$twitter->config['user_secret'] = $token['oauth_token_secret'];
$twitter->request('GET', $twitter->url('1.1/account/verify_credentials'));
var_dump($twitter->response['response']);
session_unset();
