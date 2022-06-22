<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    if(isset($_GET["tips"])) {
        $content = "var tips = " . $_GET["tips"] . ";";
        if(file_put_contents("../tips.js", $content) != "false") {
            echo '{"status":"success","message":"Tips overwritten"}';
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