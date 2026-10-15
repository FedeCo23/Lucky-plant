-- creazione del DB -- creazione del DB lucky_plants

CREATE DATABASE IF NOT EXISTS lucky_plant
    CHARACTER SET utf8mb4;

-- chiamata al DB appena creato
USE lucky_plant;

-- creazione tabella utenti
CREATE TABLE IF NOT EXISTS recensioni(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(255),
    titolo VARCHAR(255) NOT NULL,
    contenuto TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


