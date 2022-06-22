<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    if(isset($_GET["img"])) {
        $content = "var images = " . $_GET["img"] . ";";
        if(file_put_contents("img/img.js", $content) != "false") {
            echo '{"status":"success","message":"Imgs overwritten"}';
        }else {
            echo '{"status":"error","message":"Error"}';
        }
    }else {
        echo '{"status":"error","message":"No input"}';
    }
}else {
    echo '{"status":"error","message":"No permission"}';
}
?>