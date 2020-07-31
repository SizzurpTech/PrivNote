<?php
session_start();
if(!isset($_SESSION["CSRF"])) {
    $_SESSION["CSRF"] = md5(mt_rand(PHP_INT_MIN, PHP_INT_MAX));
}

$dir = __DIR__.DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR;

$modules = glob($dir."*.php");
foreach($modules as $mod) {
    include $mod;
}

$db = new Database("localhost", "root", "", "privnote");

if(isset($_SESSION["u"]) && count($db->getUser($_SESSION["u"]["id"])) > 0) $_USER = $db->getUser($_SESSION["u"]["id"])[0];
?>