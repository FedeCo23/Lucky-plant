<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Plant</title>
    <link rel="stylesheet" href="../css/style.css?v=3">
    <link rel="stylesheet" href="../css/style-trova-pianta">
</head>

<body>
    <div class="div_contenitore" id="home">

        <!-- HEADER-->
        <header>
            <div class="logo-wrapper">
                <img src="../img/Logo1.png" alt="Logo Lucky Plant" class="logo">
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
        <!-- HERO -->
        <section class="hero">
            <div class="hero-content">
                <h2>Trasforma il tuo spazio in un'oasi</h2>
                <p>Progettazione di giardini, manutenzione del paesaggio e un vivaio ricco di piante da interno ed
                    esterno: tutto quello che serve per creare l'angolo verde che hai sempre sognato.</p>
            </div>
        </section>
        <!--TRE CARD-->
        <section class="cards">
            <div class="card">
                <img src="../img/Logo2.png" alt="logo">
                <h3>Chi siamo</h3>
                <p>Un'azienda a conduzione familiare che unisce progettazione di giardini e cura del paesaggio.</p>
                <a href="chi-siamo.php">Scopri di più</a>
            </div>
            <div class="card">
                <img src="../img/Logo2.png" alt="logo">
                <h3>Il nostro vivaio</h3>
                <p>Piante da interno, da esterno, grasse, bulbi e semi selezionati per il tuo giardino.</p>
                <span class="fake_link">Scopri il nostro vivaio</span>
            </div>
            <div class="card">
                <img src="../img/Logo2.png" alt="logo">
                <h3>Recensioni</h3>
                <p>Vieni a scoprire cosa pensano di noi o lascia una recensione</p> <!--Sistemare-->
                <a href="recensioni.php">Leggi le recensioni</a> <!--Sistemare-->
            </div>
        </section>

        <!--CONTENUTO PRINCIPALE + COLONNA LATERALE-->
        <div class="home-layout">
             <!--TROVA LA TUA PIANTA: il modulo invia il nome cercato (metodo GET) alla pagina dei risultati-->
            <aside class="trova-pianta" aria-labelledby="titolo-trova-pianta">
                <h3 id="titolo-trova-pianta">Trova la tua pianta</h3>
                <hr>
                <p>Cerca una pianta per nome e scopri come prendertene cura.</p>

                <form action="pianta.php" method="get" role="search" class="ricerca-pianta">
                    <label for="q" class="solo-lettori">Nome della pianta</label>
                    <input type="search" name="q" id="q" required minlength="2" maxlength="60"
                        placeholder="Es. monstera, basilico, rosa...">
                    <button type="submit" aria-label="Cerca">
                        <!--lente d'ingrandimento (SVG, prende il colore del tema)-->
                        <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
                            <circle cx="10.5" cy="10.5" r="6.5"></circle>
                            <line x1="15.5" y1="15.5" x2="21" y2="21"></line>
                        </svg>
                    </button>
                </form>
                <p class="nota-ricerca">Puoi scrivere il nome italiano, inglese o scientifico.</p>

                <!--FOTO: il caricamento di una fotografia per riconoscere la pianta si aggiunge al punto 4 (Pl@ntNet)-->
            </aside>
            <main>
                <!--BLOG-->
                <section id="blog">
                    <h3>Blog</h3>
                    <hr>
                    <h4>Il valore delle piante</h4>
                    <article>
                        <p>Le piante arricchiscono gli spazi, migliorano la qualità dell'ambiente e contribuiscono al
                            nostro
                            benessere quotidiano. Dai giardini ai balconi, ogni specie dona colore, equilibrio e
                            armonia,
                            trasformando qualsiasi luogo in uno spazio più accogliente. Prendersene cura significa
                            riscoprire il contatto con la natura e valorizzare gli ambienti in cui viviamo, creando
                            un'atmosfera piacevole e rilassante <span class="fake_link">Leggi l'articolo →</span></p>
                    </article>
                    <h4>Le piante della salute</h4>
                    <article>
                        <p>Molte piante sono apprezzate da secoli per le loro proprietà benefiche e per il loro utilizzo
                            nella tradizione erboristica. Aromatiche, officinali e medicinali rappresentano un prezioso
                            alleato per il benessere, grazie alle loro caratteristiche naturali. Inserirle nella vita di
                            tutti i giorni significa riscoprire il valore della natura e il piacere di uno stile di vita
                            più
                            equilibrato e consapevole...<span class="fake_link">Leggi l'articolo →</span>
                        </p>
                    </article>
                </section>
            </main>
        </div>
        <a href="#home" id="home_icon"><img src="../img/uparrow_120588.webp"
                alt="icona freccia cliccabile che riporta alla sezione principale della pagina"></a>


        <!--FOOTER-->
        <footer>
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="../img/Logo2.png" alt="Logo Lucky Plant">
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