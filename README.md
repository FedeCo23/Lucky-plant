# 🌱 Lucky Plant — Sito web per un vivaio

Lucky Plant è un progetto personale realizzato per sviluppare le mie competenze nello sviluppo web, con particolare attenzione all'integrazione tra PHP e MySQL.

Il sito presenta un vivaio e include un sistema di recensioni che permette agli utenti di condividere le proprie opinioni attraverso un modulo dedicato.

> **Progetto didattico:** non inserire dati personali reali nel modulo delle recensioni. Alcune sezioni del sito (ad esempio "Il nostro vivaio" e gli articoli del blog) sono dimostrative e non hanno ancora una pagina dedicata.

## ✨ Funzionalità

- **Sito web responsive:** struttura delle pagine e interfaccia realizzate con HTML5 e CSS3.
- **Tre temi grafici:** natura, floreale e dark, selezionabili dall'utente tramite JavaScript. La scelta viene salvata nel browser (`localStorage`).
- **Sistema di recensioni:** modulo per l'inserimento di nome, email, titolo e contenuto della recensione.
- **Validazione dei dati:** controlli sui dati ricevuti dal modulo lato server.
- **Database MySQL:** salvataggio e recupero delle recensioni.
- **Query preparate:** interazione con il database per ridurre il rischio di SQL injection.
- **Protezione antispam:** campo honeypot per individuare alcuni invii automatici e limite di 3 invii ogni 10 minuti per indirizzo IP (salvato solo come hash).
- **Moderazione delle recensioni:** ogni recensione viene salvata come "in attesa" e compare sul sito solo dopo l'approvazione, che al momento si effettua manualmente da phpMyAdmin (non esiste ancora una pagina di amministrazione).

## 🛠️ Tecnologie utilizzate

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- phpMyAdmin
- Apache tramite XAMPP

## 📂 Struttura del progetto

```
Lucky-plant/
├── index.php            (reindirizza a pages/home.php)
├── pages/
│   ├── home.php
│   ├── chi-siamo.php
│   └── recensioni.php
├── includes/
│   └── db.php           (connessione al database)
├── css/
│   └── style.css
├── img/
├── database.sql
└── README.md
```

## ⚙️ Installazione in locale

### 1. Requisiti

- PHP
- MySQL
- Apache
- XAMPP o un ambiente equivalente

### 2. Clonare la repository

```
git clone https://github.com/FedeCo23/Lucky-plant.git
```

### 3. Configurare il progetto

Sposta la cartella del progetto nella directory `htdocs` di XAMPP.

Avvia Apache e MySQL dal pannello di controllo di XAMPP.

### 4. Creare il database

Apri phpMyAdmin, vai nella scheda **Importa** e carica il file `database.sql`: crea automaticamente il database `lucky_plant` e la tabella `recensioni`.

### 5. Configurare la connessione

Le credenziali di connessione a MySQL si trovano in `includes/db.php`. I valori predefiniti sono quelli di XAMPP (`root`, password vuota, database `lucky_plant`) e vanno modificati solo se la tua configurazione è diversa.

Non pubblicare password o altre credenziali personali nella repository.

### 6. Avviare il sito

Apri il browser e visita:

```
http://localhost/Lucky-plant/
```

Il percorso potrebbe richiedere modifiche in base al nome della cartella e alla configurazione locale.

### 7. Approvare le recensioni

Le recensioni inviate dal modulo non sono subito visibili. Per pubblicarle, apri la tabella `recensioni` in phpMyAdmin e imposta `approvata` a `1` (da **Modifica** sulla riga oppure con una query, vedi i commenti in `database.sql`).

## 🔒 Sicurezza

Il progetto affronta alcuni aspetti fondamentali della sicurezza delle applicazioni web:

- Validazione dei dati ricevuti dal form.
- Query preparate per le operazioni sul database.
- Escape dell'output prima di mostrare contenuti inseriti dagli utenti.
- Campo honeypot e limite di invii per IP come misure antispam.
- Moderazione delle recensioni prima della pubblicazione.
- Gestione degli errori del database: i dettagli vengono scritti nei log del server e all'utente viene mostrato solo un messaggio generico.

Queste misure contribuiscono a ridurre alcuni rischi comuni, ma non sostituiscono una verifica completa della sicurezza dell'applicazione.

## 🎯 Obiettivi formativi

Questo progetto mi ha permesso di esercitarmi con:

- Sviluppo di pagine web con HTML e CSS.
- Gestione dei temi grafici con JavaScript.
- Elaborazione dei form tramite PHP.
- Connessione tra PHP e MySQL.
- Inserimento e lettura dei dati dal database.
- Validazione degli input e sicurezza di base.
- Organizzazione di un progetto web.

*Lucky Plant — Un progetto per mettere in pratica le competenze di sviluppo web.*
