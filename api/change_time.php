<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    if(isset($_GET["time"])) {
        if(file_put_contents("../../time.txt",$_GET["time"]) != "false") {
            echo '{"status":"success","message":"Time overwritten"}';
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