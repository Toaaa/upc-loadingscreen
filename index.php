<html lang="de">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/main.css.php">
        <script src="tips.js"></script>
        <script src="api/img/img.js"></script>
    </head>
<body style="background-image: url('api/img/garage.jpg');">
    <div id="last-img" class="" style="background-image: url('api/img/gbay.jpg');"></div>
    <div class="tip-box">
        <div class="tip">Deine Fahrzeuge findest du in deiner persönlichen Garage. Du kannst in der Bank neue Garagen kaufen, falls du mehr Platz benötigst.</div>
    </div>
    <div class="logo"></div>
    <div class="avoro">
        <p>hosted by</p>
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

</body></html>