use cyberbullism;
CREATE TABLE if not exists psyco (
  email varchar(50) NOT NULL primary key,
  nome varchar(50) NOT NULL,
  cognome varchar(50) NOT NULL,
  password varchar(100) NOT NULL
);

CREATE TABLE if not exists utente (
  email varchar(50) NOT NULL primary key,
  nome varchar(50) NOT NULL,
  cognome varchar(50) NOT NULL,
  password varchar(100) NOT NULL
);

CREATE TABLE if not exists messaggio (
  user_email varchar(50) NOT NULL,
  psyco_email varchar(50) DEFAULT NULL,
  testo varchar(5000) NOT NULL,
  data datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  send_by_user boolean DEFAULT false,
  gravita bit(2) DEFAULT NULL,
	foreign key (user_email) references utente(email),
	foreign key (psyco_email) references psyco(email)
);

delete from messaggio; delete from psyco; delete from utente;


INSERT INTO `psyco` (`email`, `nome`, `cognome`, `password`) VALUES
('p@1.it', 'p', '1', '$2b$10$9ic4zJ8DFwSdl83iq09Io.TLoSPEgRmhgadPTulMxUyAhNLJDV50G');


INSERT INTO `utente` (`email`, `nome`, `cognome`, `password`) VALUES
('l@1.it', 'luca', 'rossi', '$2b$10$9ic4zJ8DFwSdl83iq09Io.t9Sj9.dj6cYpHxEx6WbcHAefXhEc4aG');

INSERT INTO `messaggio` (`user_email`, `psyco_email`, `testo`, `data`, `send_by_user`, `gravita`) VALUES
('l@1.it', NULL, 'ho dei problemi con i miei compagni di classe  \n', '2022-11-02 18:31:31', 0, b'10'),
('l@1.it', 'p@1.it', 'ciao', '2022-11-10 19:01:05', 0, NULL),
('l@1.it', 'p@1.it', 'prova', '2022-11-10 19:04:33', 0, NULL),
('l@1.it', 'p@1.it', 'prova', '2022-11-10 19:06:10', 0, NULL),
('l@1.it', 'p@1.it', 'prova11', '2022-11-10 19:06:18', 0, NULL),
('l@1.it', 'p@1.it', 'provafinale', '2022-11-10 19:07:28', 0, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-11-10 19:25:19', 1, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-11-13 22:00:55', 0, NULL),
('l@1.it', 'p@1.it', 'come va', '2022-11-13 22:00:58', 0, NULL),
('l@1.it', 'p@1.it', 'a me tutti bene', '2022-11-13 22:01:09', 0, NULL),
('l@1.it', 'p@1.it', 'hey?', '2022-11-13 22:04:34', 1, NULL),
('l@1.it', 'p@1.it', 'ora va bene', '2022-11-13 22:09:40', 1, NULL),
('l@1.it', 'p@1.it', 'hello', '2022-11-13 22:11:56', 0, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-11-16 14:59:50', 1, NULL),
('l@1.it', 'p@1.it', 'hello', '2022-11-16 15:01:09', 0, NULL),
('l@1.it', 'p@1.it', 'come va?', '2022-11-16 15:01:29', 1, NULL),
('l@1.it', 'p@1.it', 'come va?', '2022-11-16 15:07:35', 1, NULL),
('l@1.it', 'p@1.it', 'come va?', '2022-11-16 15:07:56', 1, NULL),
('l@1.it', 'p@1.it', 'va tutto beneeee', '2022-11-16 15:09:40', 1, NULL),
('l@1.it', 'p@1.it', 'hello', '2022-11-16 15:18:00', 0, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-11-20 00:31:18', 0, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-11-20 00:38:42', 0, NULL),
('l@1.it', NULL, 'ciao ciao ciao', '2022-12-14 10:54:53', 0, b'00'),
('l@1.it', 'p@1.it', 'hello', '2022-12-20 09:54:39', 0, NULL),
('l@1.it', NULL, 'Segnalazione di test prima dell’ESAME', '2022-12-20 09:58:06', 0, b'10'),
('l@1.it', NULL, 'Segnalazione test per noi', '2022-12-20 10:25:51', 0, b'00'),
('l@1.it', 'p@1.it', 'Come posso aiutarti ', '2022-12-20 10:27:44', 1, NULL),
('l@1.it', 'p@1.it', 'Mi serve una mano', '2022-12-20 10:28:16', 0, NULL),
('l@1.it', NULL, 'Mi sento tanto male', '2022-12-20 12:20:21', 0, b'10');


DROP VIEW IF EXISTS segnalazioni;
create view segnalazioni as
SELECT
    user_email,
    nome,
    cognome,
    testo,
    CAST(gravita as signed) as gravita,
    data
FROM
    messaggio
JOIN utente ON user_email = email
WHERE
    psyco_email IS NULL
    AND gravita IS NOT NULL
    AND send_by_user = 0
ORDER BY
    gravita
DESC