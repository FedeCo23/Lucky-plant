
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Plant</title>
    <link rel="stylesheet" href="../css/style.css?v=3">

</head>

<body>
    <div class="div_contenitore" id="home">

        <!-- HEADER-->
        <header>
            <div class="logo-wrapper">
                <img src="../img/Asset 1@3x.png" alt="Logo Lucky Plant" class="logo">
                <h1>Lucky Plant</h1>
            </div>
        </header>

       <!--TEMI-->
        <div class="temi">
            <button type="button" id="tema-natura" aria-label="Tema Natura">🌿</button>
            <button type="button" id="tema-floreale" aria-label="Tema Floreale">🌸</button>
            <button type="button" id="tema-dark" aria-label="Tema Dark">🌙</button>
        </div>


        <!-- NAV-->
        <nav>
            <ul class="topmenu">
                <li><a href="home.php">Home</a></li>
                <li><a href="chi-siamo.php">Chi siamo</a></li>
                <li><a href="recensioni.php">Recensioni</a></li>
            </ul>
        </nav>
        <main>
            <!--ABOUT US-->
            <section id="about_us">
                <h3>Chi siamo</h3>
                <hr>
                <div class="layout">
                    <div><img src="../img/Asset 2@3x.png" alt="Logo"></div>
                    <div class="text">
                        <h2>Ciao, noi siamo Silvia e Maria ❤️🌿</h2>
                        <p> Siamo una realtà nata dalla nostra passione per il mondo delle piante e per tutto ciò che permette di rendere gli spazi più verdi e accoglienti. <br>
                            Il nostro obiettivo è aiutare ogni cliente a trovare le piante più adatte ai propri spazi e a trasformare balconi, terrazzi e giardini in piccoli angoli di natura e cura per se stessi✨. <br>

                            Lucky Plant nasce dall'idea di unire creatività, cura e passione per il verde, offrendo un servizio attento e pensato per accompagnare i nostri clienti nella scelta e nella cura delle loro piante. </p>
                    </div>
                </div>
            </section>
        </main>
        <a href="#home" id="home_icon"><img src="../img/uparrow_120588.webp"
                        alt="icona freccia cliccabile che riporta alla sezione principale della pagina"></a>

        <!--FOOTER-->
        <footer>
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="../img/Asset 2@3x.png" alt="Logo Lucky Plant">
                </div>
                <ul>
                    <li><a href="chi-siamo.php">Chi siamo</a></li>
                    <li><a href="mailto:info@aziendaexample.it">Lavora con noi</a></li>
                    <li><a href="mailto:info@aziendaexample.it">Contattaci</a></li>
                </ul>
                <div class="footer-contact">
                    <p>Silvia e Maria</p>
                    <p>Padova, Italia</p>
                    <p>+39 12345678</p>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright Lucky Plants</p>
        </footer>

    </div>
</body>
<script>
    //CAMBIO TEMA 
    const temaNatura = document.querySelector("#tema-natura");
    const temaFloreale = document.querySelector("#tema-floreale");
    const temaDark = document.querySelector("#tema-dark");

    const body = document.querySelector("body"); //definizione costante body


    function cambiaTema(tema) {
        body.classList.remove("tema-floreale", "tema-dark");

        if (tema === "floreale") {
            body.classList.add("tema-floreale");
        }

        if (tema === "dark") {
            body.classList.add("tema-dark");
        }
          localStorage.setItem("tema", tema);
    }


    temaNatura.addEventListener("click", function() {
        cambiaTema("natura");
    });

    temaFloreale.addEventListener("click", function() {
        cambiaTema("floreale");
    });

    temaDark.addEventListener("click", function() {
        cambiaTema("dark");
    });

    const temaSalvato = localStorage.getItem("tema");

if (temaSalvato) {
    cambiaTema(temaSalvato);
}
</script>
</html>