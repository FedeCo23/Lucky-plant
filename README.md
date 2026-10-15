# 🌱 Lucky Plant — Sito web per un vivaio

Lucky Plant è un progetto personale realizzato per sviluppare le mie competenze nello sviluppo web, con particolare attenzione all'integrazione tra PHP e MySQL.

Il sito presenta un vivaio e include un sistema di recensioni che permette agli utenti di condividere le proprie opinioni attraverso un modulo dedicato.

## ✨ Funzionalità

- **Sito web responsive:** struttura delle pagine e interfaccia realizzate con HTML5 e CSS3.
- **Sistema di recensioni:** modulo per l'inserimento di nome, email, titolo e contenuto della recensione.
- **Validazione dei dati:** controlli sui dati ricevuti dal modulo lato server.
- **Database MySQL:** salvataggio e recupero delle recensioni.
- **Query preparate:** interazione con il database per ridurre il rischio di SQL injection.
- **Protezione antispam:** utilizzo di un campo honeypot per individuare alcuni invii automatici.
- **Moderazione delle recensioni:** gestione dello stato di approvazione prima della pubblicazione.

## 🛠️ Tecnologie utilizzate

- HTML5
- CSS3
- PHP
- MySQL
- phpMyAdmin
- Apache tramite XAMPP

## 📂 Struttura del progetto

La struttura può variare in base all'organizzazione effettiva dei file.

```text
Lucky-plant/
├── index.php
├── recensioni.php
├── css/
├── Immagini/
├── config/
└── README.md
```

## ⚙️ Installazione in locale

### 1. Requisiti

- PHP
- MySQL
- Apache
- XAMPP o un ambiente equivalente

### 2. Clonare la repository

```bash
git clone https://github.com/FedeCo23/Lucky-plant.git
```

### 3. Configurare il progetto

Sposta la cartella del progetto nella directory `htdocs` di XAMPP.

Avvia Apache e MySQL dal pannello di controllo di XAMPP.

### 4. Creare il database

Apri phpMyAdmin e crea il database utilizzato dal progetto.

Esegui lo script SQL per creare la tabella delle recensioni, se presente nel repository.

### 5. Configurare la connessione

Imposta le credenziali di connessione a MySQL nel file di configurazione previsto dal progetto.

Non pubblicare password o altre credenziali personali nella repository.

### 6. Avviare il sito

Apri il browser e visita:

```text
http://localhost/Lucky-plant/
```

Il percorso potrebbe richiedere modifiche in base al nome della cartella e alla configurazione locale.

## 🔒 Sicurezza

Il progetto affronta alcuni aspetti fondamentali della sicurezza delle applicazioni web:

- Validazione dei dati ricevuti dal form.
- Query preparate per le operazioni sul database.
- Escape dell'output prima di mostrare contenuti inseriti dagli utenti.
- Campo honeypot come misura antispam.
- Moderazione delle recensioni prima della pubblicazione.

Queste misure contribuiscono a ridurre alcuni rischi comuni, ma non sostituiscono una verifica completa della sicurezza dell'applicazione.

## 🎯 Obiettivi formativi

Questo progetto mi ha permesso di esercitarmi con:

- Sviluppo di pagine web con HTML e CSS.
- Elaborazione dei form tramite PHP.
- Connessione tra PHP e MySQL.
- Operazioni CRUD e gestione dei dati.
- Validazione degli input e sicurezza di base.
- Organizzazione di un progetto web.

## 👩‍💻 Autrice

Progetto personale realizzato da **FedeCo23** nell'ambito del mio percorso di apprendimento dello sviluppo web.

- GitHub: https://github.com/FedeCo23

---

*Lucky Plant — Un progetto per mettere in pratica le competenze di sviluppo web.*
