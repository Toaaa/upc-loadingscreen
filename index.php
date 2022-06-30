<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UPC-Loadingscreen | Administrator</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/materialize.css">
	<script src="../assets/js/jquery-3.min.js"></script>
	<script src="../assets/js/cycle2.min.js"></script>
	<script src="../assets/js/loadingScreen.js"></script>
	<link rel="stylesheet" href="/assets/css/main.css.php">
	<script src="../title.js"></script>
	<script src="../sub.js"></script>
	<script src="../tips.js"></script>
    <script src="../api/img/img.js"></script>
</head>

<body style="background-image: url('api/img/garage.jpg');">
    <div id="last-img" class="" style="background-image: url('api/img/gbay.jpg');"></div>
    <div class="tip-box">
        <div class="tip">Deine Fahrzeuge findest du in deiner persönlichen Garage. Du kannst in der Bank neue Garagen kaufen, falls du mehr Platz benötigst.</div>
    </div>
    <div class="logo"></div>
    <div class="avoro">
        <p>Hosted by</p>
        <img src="img/avoro.png" alt="A">
        <p>VORO</p>
    </div>
    <script>
        async function test() {
            var i = 0;
            var t = 0;
            while (true) {
                if(i == images.length) i = 0;
                if(t == tips.length) t = 0;
                if(document.body.style.backgroundImage != "") document.getElementById("last-img").style.backgroundImage = document.body.style.backgroundImage;
                document.getElementById("last-img").classList.add("last-img");
                setTimeout(function() {document.getElementById("last-img").classList.remove("last-img");}, 1000);
                document.body.style.backgroundImage = "url('api/img/"+images[i]+"')";
                document.getElementsByClassName("tip")[0].innerHTML = tips[t];
                await Sleep(13000);
                i++;
                t++;
            }
        }

        function Sleep(milliseconds) {
            return new Promise(resolve => setTimeout(resolve, milliseconds));
        }

        test();
    </script>

</body>
</html>