<?php //form per lasciare una recensione che viene mandato al database e restituito nella home

require_once __DIR__ . '/../includes/db.php'; // chiamata per la connessione al DB

$errori = []; //se la validazione non da esito positivo viene restituito un errore

if ($_SERVER['REQUEST_METHOD'] === "POST") { //se si utilizza il metodo post (e quindi i dati non si vedono nella barra) allora si fa quanto segue 


    //HONEYPOT: il campo "sito_web" è nascosto agli umani, quindi se è compilato a scrivere è stato un bot
    //al bot facciamo credere che sia andato tutto bene, ma non salviamo niente
    if (trim($_POST['sito_web'] ?? '') !== '') {
        header("Location: recensioni.php?ok=1");
        exit;
    }


    //trasforma i dati ricevuti in variabili (meglio non usare sanitize spechial chars all'ingresso ma solo quando vengono restituiti)
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $titolo    = trim($_POST['titolo'] ?? '');
    $contenuto = trim($_POST['contenuto'] ?? '');



    //validazione dei valori dei campi
    //si usa === '' invece di empty() perché empty() considera vuoto anche "0"

    if ($nome === '') { //se è vuoto errore
        $errori[] = "Il campo NOME è obbligatorio";
    }


    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) { //se la mail è piena E ANCHE non valida allota fa quanto segue
        $errori[] = "Il campo EMAIL non è valido";
    }

    if ($titolo === '') { //se è vuoto errore
        $errori[] = "Il campo TITOLO è obbligatorio";
    }
    if ($contenuto === '') { //se è vuoto errore
        $errori[] = "Il campo CONTENUTO è obbligatorio";
    }


    //controllo lunghezza dei campi (già presente nel form ma facilmente aggirabile)
    if (mb_strlen($nome) > 150) {
        $errori[] = "Il campo NOME non può superare 150 caratteri";
    }
    if (mb_strlen($email) > 255) {
        $errori[] = "Il campo EMAIL non può superare 255 caratteri";
    }
    if (mb_strlen($titolo) > 255) {
        $errori[] = "Il campo TITOLO non può superare 255 caratteri";
    }
    if (mb_strlen($contenuto) > 5000) {
        $errori[] = "Il campo CONTENUTO non può superare 5000 caratteri";
    }


    if (empty($errori)) { //se l'array errori è vuoto procediamo con il salvataggio nel DB

        if ($email === '') { //se è null si evita di salvare una stringa vuota
            $email = null;
        }

        //IP dell'utente: REMOTE_ADDR è l'unico valore affidabile (X-Forwarded-For lo può falsificare chiunque)
        //non salviamo l'IP in chiaro ma solo il suo hash
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $ip_hash = hash('sha256', $ip);

        try { //con mysqli moderno gli errori sono eccezioni, quindi vanno gestiti con try/catch

            //LIMITE DI INVII: contiamo le recensioni inviate da questo IP negli ultimi 10 minuti
            $stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM recensioni WHERE ip_hash = ? AND created_at > (NOW() - INTERVAL 10 MINUTE)");
            mysqli_stmt_bind_param($stmt, "s", $ip_hash);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $conteggio);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if ($conteggio >= 3) { //massimo 3 recensioni ogni 10 minuti
                $errori[] = "Troppi invii ravvicinati, riprova tra qualche minuto.";
            } else {

                $stmt = mysqli_prepare($conn, "INSERT INTO recensioni (nome, email, titolo, contenuto, ip_hash) VALUES (?,?,?,?,?)"); //query SQL e definiamo in quale tabella vogliamo inserire i dati (recensioni) e quali colonne compilare
                //definiamo quali valori vogliamo inserire ma lasciando dei segnaposto (?)
                //"approvata" non serve: di default vale 0, quindi la recensione resta nascosta finché non viene approvata


                mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $titolo, $contenuto, $ip_hash); //diamo i valori effetti nei segnaposto


                mysqli_stmt_execute($stmt); // se c'è un errore viene lanciata un'eccezione e si passa al catch
                mysqli_stmt_close($stmt);  //chiude la query SQL
                header("Location: recensioni.php?ok=1"); //Post/Redirect/Get: evita che ricaricando la pagina la recensione venga reinviata
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage()); //l'errore vero va nei log, all'utente un messaggio generico
            $errori[] = "Errore durante l'inserimento della recensione. Riprova più tardi.";
        }
    }



    /**-----------------------------TEST EFFETTUATI
     * 
     * Tutto valido -> "recensione inserita" e creazione recensione nel DB
     * 
     * Nome vuoto ->  "complia questo campo" (nome era REQUIRED nel form quindi HTML blocca in partenza)
     * 
     * Email vuota -> con un controllo diventa null quindi non verrà stampata
     * 
     * Titolo vuoto ->  "compila questo campo" (titolo era REQUIRED nel form quindi HTML blocca in partenza)
     * 
     * Contenuto vuoto ->  "Il campo CONTENUTO è obbligatorio" (contenuto NON ERA REQUIRED nel form ma era obbligatorio nella VALIDAZIONE)
     * 
     * Email sbagliata -> "aggiungi un simbolo @ ecc" (era presente la validazione della mail)
     * 
     * Caratteri speciali ( & <3 ) -> "recensione inserita" e trasformata nel DB in &#38 e &#60;  (è stato utilizzato SANITIZE_SPECIAL_CHARS già quando vengono ricevuti i valori) 
     * 
     * //RETTIFICA, TOLTO SANITIZE ALL'INGRESSO E INSERITO QUANDO SI STAMPANO I VALORI DAL DB QUINDI NEL DB I VALORI NON SONO SANITIZE
     */




    /**
     * 
     * ---------------------------TEST EFFETTUATI DOPO AVER TOLTO REQUIRED
     * 
     * Nome, email, titolo vuoto -> "Il campo NOME è obbligatorio" e "Il campo TITOLO è obbligatorio" (tolto il required da nome e titolo ma era obbligatorio nella VALIDAZIONE)
     * 
     */


    /**
     * 
     * ---------------------------DA TESTARE DOPO LE ULTIME MODIFICHE (moderazione, honeypot, limite IP)
     * 
     * Invio normale -> messaggio "sarà visibile dopo l'approvazione", la recensione è nel DB con approvata = 0 e NON compare nella lista
     * 
     * UPDATE recensioni SET approvata = 1 WHERE id = ...  -> la recensione compare nella lista
     * 
     * Honeypot: da DevTools togliere la classe "hp" e scrivere nel campo nascosto -> messaggio di successo ma nessuna riga nel DB
     * 
     * Limite IP: inviare 4 recensioni di fila -> la quarta mostra "Troppi invii ravvicinati"
     * 
     * DB spento / password sbagliata -> pagina con messaggio generico e nessun dettaglio (host, utente) visibile
     */
}

//----------------------------------PRENDIAMO LE RECENSIONI DAL DB E LE INSERIAMO NELLA PAGINA

$sql = "SELECT id, nome, email, titolo, contenuto, DATE_FORMAT(created_at, '%d/%m/%Y') AS data_corretta FROM recensioni WHERE approvata = 1 ORDER BY created_at DESC"; //prende le colonne dalla tabella recensione usando la data di creazione, dalla più recente alla più vecchia
//WHERE approvata = 1 -> vengono mostrate solo le recensioni approvate
//il formato della data corretto viene salvato in data_corretta


try {
    $result = mysqli_query($conn, $sql); //result contiene il risultato della query SELECT
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    $result = false; //se la query fallisce la pagina si vede comunque, senza recensioni
}

$recensioni = []; // array di recensioni inizialmente vuoto a cui poi verrà aggiunto una recsnione (che sarà un'array di dati (le row))

if ($result) { //se la query è stata eseguita correttamente allora fai quanto segue

    while ($row = mysqli_fetch_assoc($result)) { //WHILE prende una riga alla volta dalla query SELECT (ovvero una recensione perchè ogni $row rappresenta una singola recensione ) 

        $recensioni[] = [ //aggiunge all'array $recensioni una nuova recensione (ovvero il nuovo array associativo $row che a loro volta sono un'array di dati formato dai singoli campi della recensione)

            'id' => $row['id'],
            'nome' => $row['nome'],
            'email' => $row['email'],
            'titolo' => $row['titolo'],
            'contenuto' => $row['contenuto'],
            'data' => $row['data_corretta']
        ];
    }


    mysqli_free_result($result); // libera la memoria occupata dal risultato della query DOPO che while ha finitp di prendere le row


}

/**
 * 
 * --------------TEST EFFETTUATI
 * 
 * FOREACH STAMPA NELLA PAGINA
 * 
 * SE ELIIMINO DAL DB SI ELIMINA DALLA PAGINA
 * 
 * SE INSERISCO I DATI NEL FORM STAMPA IMMEDIATAMENTE LA NUOVA RECENSIONE IN ORDINE DI DATA (prima della moderazione: ora serve l'approvazione)
 * 
 * 
 * 
 */





?>




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
        <main class="form_recommendation">

            <?php if (!empty($errori)): ?>
                <div class="errori">
                    <?php foreach ($errori as $errore): ?>
                        <p><?= htmlspecialchars($errore, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['ok'])): ?> <!--compare dopo il redirect (?ok=1) fatto dopo l'inserimento-->
                <p class="successo">Grazie! La tua recensione sarà visibile dopo l'approvazione.</p>
            <?php endif; ?>


            <form action="" method="post">
                <fieldset>
                    <legend>Lascia una recensione</legend>

                    <!--Avviso: progetto didattico-->
                    <p>Progetto didattico: non inserire dati personali reali.</p>

                    <label for="nome">Nome: *</label>
                    <input type="text" name="nome" id="nome" required maxlength="150" placeholder="Inserisci il tuo nome">

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" maxlength="255" placeholder="Inserisci la tua email">

                    <label for="titolo">Titolo: *</label>
                    <input type="text" name="titolo" id="titolo" required maxlength="255" placeholder="Inserisci il titolo">

                    <label for="contenuto">Contenuto: *</label>
                    <textarea name="contenuto" id="contenuto" required placeholder="Lascia una recensione" maxlength="5000"></textarea>

                    <!--HONEYPOT: campo nascosto con CSS (classe hp), gli umani non lo vedono ma i bot lo compilano-->
                    <div class="hp" aria-hidden="true">
                        <label for="sito_web">Non compilare questo campo</label>
                        <input type="text" name="sito_web" id="sito_web" tabindex="-1" autocomplete="off">
                    </div>

                    <button type="submit">Invia</button>
                </fieldset>

            </form>


            <section class="lista-recensioni">
                <h2> Le nostre recensioni</h2>

                <?php if (!empty($recensioni)): ?> <!--Se l'array recensioni non è vuoto  -->

                    <?php foreach ($recensioni as $recensione): ?> <!--parte il ciclo foreach che, per ogni recensione trovata, la inserisce qui-->

                        <section class="recensione">

                            <h3><?= htmlspecialchars($recensione['titolo'], ENT_QUOTES, 'UTF-8') ?></h3>

                            <p><?= htmlspecialchars($recensione['contenuto'], ENT_QUOTES, 'UTF-8') ?></p>
                            <p>
                                Scritto da <?= htmlspecialchars($recensione['nome'], ENT_QUOTES, 'UTF-8') ?>
                                il <?= $recensione['data'] ?>
                            </p>
                        </section>

                    <?php endforeach; ?> <!--Fine del ciclo foreach-->

                <?php else: ?> <!--Se l'array recensione è vuoto allora stampa -->

                    <p>Non ci sono ancora recensioni.</p>

                <?php endif; ?><!--Fine dell'IF-->


            </section>

        </main>
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