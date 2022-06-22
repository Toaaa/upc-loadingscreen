<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    if(isset($_GET["img"])) {
        $img = "img/" . $_GET["img"];
	#$img = "../jobs.jpg";
#echo $img;
#echo file_exists($img);
        if(unlink($img)) {
            echo '{"status":"success","message":"' . $_GET["img"] . ' deleted"}';
        }else {
            echo '{"status":"error","message":"Error"}';
        }
    }else {
        echo '{"status":"error","message":"Image not found"}';
    }
}else {
    echo '{"status":"error","message":"No permission"}';
}
?>