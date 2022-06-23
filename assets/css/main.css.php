<?php
header('Content-Type: text/css');
$logo = explode("x",file_get_contents("../logo/logo.txt"));
$width = $logo[0];
$height = $logo[1];
$dirname = "../logo";
$ext = array("jpg", "png", "jpeg", "gif");
$files = array();
if($handle = opendir($dirname)) {
    while(false !== ($file = readdir($handle)))
        for($i=0;$i<sizeof($ext);$i++)
        if(strstr($file, ".".$ext[$i]))
            $files[] = $file;
            closedir($handle);
}
$amount = count($files);
$i = 0;
foreach ($files as $img){
    $logo = $img;
    $i++;
}
$delay = 1000;
?>
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
@import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";

html {
    height: 100%;
    width: 100%;
}

body {
    font-family: 'Roboto', sans-serif;
    background-color: black;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    margin: 0;
}

#last-img {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    background-color: black;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    opacity: 0;
}

.tip-box {
      width: 30%;
      position: absolute;
      top: 140px;
      padding-left: 20px;
      left: 25px;
      background: rgba(100,100,100,0.4);
      border-top: 3px ridge #729DFF;
      border-bottom: 3px ridge #729DFF;

}

.tip {
      padding: 30px;
      font-size: 25px;
      height: 250px;
      color: white;
}

.logo {
      height: <?=$height?>px;
      width: <?=$width?>px;
      margin: 30px;
      background-image: url("../logo/<?=$logo?>");
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      position: fixed;
}

@keyframes background {
  from {opacity: 1;}
  to {opacity: 0;}
}

.last-img {
  animation-name: background;
  animation-duration: <?=$delay?>ms;
}

.avoro {
    width: 170px;
    padding: 5px;
    height: 40px;
    background: #444;
    position: fixed;
    bottom: 20px;
    left: 20px;
    border-top: 3px ridge #729DFF;
}

.avoro p:first-child {
    display: inline-block;
    position: absolute;
    font-size: 14px;
    margin: 0;
    left: 13px;
    top: 16px;
}

.avoro img {
    display: inline-block;
    height: 100%;
    width: auto;
    position: absolute;
    left: 70px;
    top: 0;
}