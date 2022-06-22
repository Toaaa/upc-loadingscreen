<?php
$login = 0;
if((isset($_POST["pw"]) && $_POST["pw"] == "daspasswortistadmin") || (isset($_SESSION["login"]) && $_SESSION["login"] == 1)) {
    $login = 1;
    session_start();
    $_SESSION["login"] = 1;
    /*
    $dirname = "../img";
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
    $images = '[';
    $i = 0;
    foreach ($files as $img){
        $images .= '"' . $img . '",';
        $i++;
    }
    $images = substr($images, 0, -1);
    $images .= ']';
    */
    $time = file_get_contents("../time.txt");
    $logo = explode("x",file_get_contents("../logo/logo.txt"));
    $width = $logo[0];
    $height = $logo[1];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/main.css.php">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../tips.js"></script>
    <script src="../api/img/img.js"></script>
    <title>SRP-Loadingscreen | Administrator</title>
</head>
<body>
    <?php
    if($login == 0) {
    ?>
    <form id="login-form" action="" method="post" class="hide">
        <input id="pw" type="password" name="pw">
        <script>
            function login() {
                var pw = prompt("Enter your Password.");
                document.getElementById("pw").value = pw;
                document.getElementById("login-form").submit();
            }
            
            login();
        </script>
    </form>
    <?php
    }
    if($login == 1) {
    ?>
    <input type="file" id="file" class="hide" onchange="uploadImg(this.files[0])">
    <input type="file" id="logo" class="hide" onchange="uploadLogo(this.files[0])">
    <h1>SRP-Loadingscreen | Administrator</h1>
    <h2>Logo</h2>
    <div class="logo"></div>
    <button onclick="changeLogo()">Change Logo</button>
    </br>
    Resolution
    <div class="res-div">
        <input oninput="changeRes()" type="number" class="logo-res" id="logo-width" value="<?=$width?>">
        <div>x</div>
        <input oninput="changeRes()" type="number" class="logo-res" id="logo-height" value="<?=$height?>">
    </div>
    <h2>Images</h2>
    <div class="images-box">
        <div class="images"></div>
        <div class="add-img img">
            <i class="fas fa-plus fa-2x" onclick="addImage()"></i>
        </div>
    </div>
    <h2>Tips</h2>
    <div class="tips"></div>
    <input type="text" id=tip placeholder="New Tip">
    <button onclick="addTip()">Add Tip</button>
    <h2>Time</h2>
    <div class="number-div">
        <input type="number" id="time" value="<?=$time?>" oninput="changeTime(this.value)">milliseconds
    </div>
    <script>
        for (let i = 0; i < images.length; i++) {
            addImgDiv(images[i]);
        }

        for (let t = 0; t < tips.length; t++) {
            addTipDiv(tips[t]);
        }

        function addImage() {
            document.getElementById("file").click();
        }

        function changeLogo() {
            document.getElementById("logo").click();
        }

        function changeRes() {
            openApi("../api/change_res.php?res="+document.getElementById("logo-width").value+"x"+document.getElementById("logo-height").value);
        }

        function uploadImg(file) {
            answer = openApi('../api/upload_img.php', 'POST', fileFormData(file));
            var status = answer.status;
            for (let i = 0; i < answer.messages; i++) {
                if(answer["message"+i] == "File already exist.") {
                    status = "succes";
                }
            }
            if(status == "succes") {
                images.push(answer.name);
                overwriteImg();
                addImgDiv(answer.name);
            }else if(status == "error") {
                for (let i = 0; i < answer.messages; i++) {
                    myLittleAlert(answer["message"+i]);
                }
            }
            document.getElementById('image-file').value = "";
        }

        function uploadLogo(file) {
            answer = openApi('../api/change_logo.php', 'POST', fileFormData(file));
            var status = answer.status;
            for (let i = 0; i < answer.messages; i++) {
                if(answer["message"+i] == "File already exist.") {
                    status = "succes";
                }
            }
            if(status == "succes") {
                document.getElementsByClassName("logo")[0].style.backgroundImage = "url('../logo/"+answer.name+"')";
            }else if(status == "error") {
                for (let i = 0; i < answer.messages; i++) {
                    myLittleAlert(answer["message"+i]);
                }
            }
            document.getElementById('logo').value = "";
        }

        function removeImage(image) {
            var answer = openApi("../api/delete_img.php?img="+image);
            if(answer.status == "success") {
                var index = images.indexOf(image);
                if (index > -1) {
                    images.splice(index, 1);
                }
                document.getElementById(image).remove();
                overwriteImg();
            }
        }

        function fileFormData(file) {
            var file_data = file;   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            return form_data;
        }

        function addTip() {
            addTipDiv(document.getElementById("tip").value);
            tips.push(document.getElementById("tip").value);
            document.getElementById("tip").value = "";
            overwriteTips();
        }

        function removeTip(element,tip) {
            var index = tips.indexOf(tip);
            if (index > -1) {
            tips.splice(index, 1);
            }
            element.remove();
            overwriteTips();
        }

        function overwriteImg() {
            var new_img = JSON.stringify(images);
            openApi("../api/overwrite_img.php?img="+new_img);
        }

        function overwriteTips() {
            var new_tips = JSON.stringify(tips);
            openApi("../api/overwrite_tips.php?tips="+new_tips);
        }

        function addImgDiv(file) {
            var img = document.createElement('div');
            img.style.backgroundImage = "url('../api/img/"+file+"')";
            img.classList.add("img");
            img.id =  file;
            document.getElementsByClassName("images")[0].appendChild(img);
            var del = document.createElement('i');
            del.classList.add("far");
            del.classList.add("fa-times-circle");
            del.setAttribute("onclick","removeImage('"+file+"')");
            img.appendChild(del);
        }

        function addTipDiv(tip_content) {
            var tip_div = document.createElement('div');
            tip_div.classList.add("tip-div");
            document.getElementsByClassName("tips")[0].appendChild(tip_div);
            var tip = document.createElement("div");
            tip.innerHTML = tip_content;
            tip_div.appendChild(tip);
            var del = document.createElement('i');
            del.classList.add("far");
            del.classList.add("fa-times-circle");
            del.setAttribute("onclick","removeTip(this.parentElement,'"+tip_content+"')");
            tip_div.appendChild(del); 
        }

        function changeTime(time) {
            openApi("../api/change_time.php?time="+time);
        }

        function openApi(link, method = "GET", data = "") {
            var xhttp = new XMLHttpRequest();
            xhttp.open(method, link, false);
            xhttp.send(data);
            var obj_raw = xhttp.responseText;
            var obj = JSON.parse(obj_raw);
            return obj;
        }
    </script>
    <?php
    }
    ?>
</body>
</html>