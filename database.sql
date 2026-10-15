-- creazione del DB lucky_plant
 
CREATE DATABASE IF NOT EXISTS lucky_plant
    CHARACTER SET utf8mb4;
 
-- chiamata al DB appena creato
USE lucky_plant;
 
-- creazione tabella recensioni
CREATE TABLE IF NOT EXISTS recensioni(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(255),
    titolo VARCHAR(255) NOT NULL,
    contenuto TEXT NOT NULL,
    approvata TINYINT(1) NOT NULL DEFAULT 0, -- 0 = in attesa di moderazione, 1 = visibile sul sito
    ip_hash CHAR(64),                        -- hash dell'IP (non l'IP in chiaro), serve per il limite di invii
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
 
-- SE LA TABELLA ESISTE GIA' (creata con la vecchia versione) si può aggiornare con:
-- ALTER TABLE recensioni RENAME COLUMN create_at TO created_at;
-- ALTER TABLE recensioni
--     ADD COLUMN approvata TINYINT(1) NOT NULL DEFAULT 0,
--     ADD COLUMN ip_hash CHAR(64);
-- UPDATE recensioni SET approvata = 1;   -- per rendere visibili quelle già presenti
 

-- PER APPROVARE UNA RECENSIONE (da phpMyAdmin):
-- approva una sola recensione (sostituisci il numero con l'id)
-- UPDATE recensioni SET approvata = 1 WHERE id = 5;

-- approva tutte quelle in attesa
-- UPDATE recensioni SET approvata = 1 WHERE approvata = 0;

-- per nascondere una recensione rimetti approvata a 0, oppure cancellala
-- UPDATE recensioni SET approvata = 0 WHERE id = 5;
-- DELETE FROM recensioni WHERE id = 5;