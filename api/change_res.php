<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    if(isset($_GET["res"])) {
        if(file_put_contents("../../logo/logo.txt",$_GET["res"]) != "false") {
            echo '{"status":"success","message":"Res overwritten"}';
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