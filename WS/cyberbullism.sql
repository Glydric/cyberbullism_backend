use cyberbullism
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

INSERT INTO psyco (email, nome, cognome, password) VALUES
('mario.aldovini.976@psypec.it', 'mario', 'Aldovini', '2630fabad985e94553fc238db4f4787e6b2dad52fa970564d572b1b08c024fbc'),
('mario.mazza@psypec.it', 'Mario', 'Mazza', 'ccb711f092ac8ef1805b5045fab7e8a6189cb97ad04565e21b5fbcfc9e542e42'),
('p@1.it', 'p', '1', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153'),
('paolatartaro12@gmail.com', 'paola', 'tartaro', '9e0acae050b45553a76013dfe3602b37d97cea50a791d71d3046bddca0157a64'),
('annini@psypec.it', 'Alice', 'Annini', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'),
('p@2.it', 'p', '1', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153');

INSERT INTO utente (email, nome, cognome, password) VALUES
('lorisminetti1997@gmail.com', 'Loris', 'Minetti', '9e0acae050b45553a76013dfe3602b37d97cea50a791d71d3046bddca0157a64'),
('l@1.it', 'l', '1', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153'),
('l@2.it', 'l', '2', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153'),
('l@3.it', 'l', '3', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153'),
('leo.miglio@outlook.com', 'Leonardo', 'Migliorelli', '8c5205a40dfe79d3a9d89366c333526214a54014c7f28f50abda5f5f8d535a74'),
('user@user.com', 'user', 'prova', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb'),
('l@5.it', 'l', '1', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153'),
('l@4.it', 'l', '4', '2ad8a7049d7c5511ac254f5f51fe70a046ebd884729056f0fe57f5160d467153');

INSERT INTO messaggio (user_email, psyco_email, testo, data, send_by_user, gravita) VALUES
('l@1.it', 'p@1.it', 'ciao, come va?', '2022-08-19 11:40:59', true, NULL),
('l@1.it', 'p@1.it', 'tutto bene per ora però...', '2022-08-24 16:28:40', false, NULL),
('l@1.it', 'p@2.it', 'ciao anche a te', '2022-08-24 16:29:28', true, NULL),
('user@user.com', 'p@1.it', 'Ho ricevuto un pugno in bagno stamattina.\nMi vergogno quando sono in classe ora.', '2022-09-20 15:30:56', false, b'00'),
('l@1.it', 'p@1.it', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Morbi tempus iaculis urna id volutpat lacus laoreet non. Ac tincidunt vitae semper quis lectus nulla. Viverra adipiscing at in tellus. Cursus eget nunc scelerisque viverra mauris in aliquam sem fringilla. Lacinia quis vel eros donec ac. Tempus urna et pharetra pharetra massa massa ultricies. Quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Dis parturi', '2022-08-31 12:16:18', true, NULL),
('l@1.it', 'p@2.it', 'em ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Morbi tempus iaculis urna id volutpat lacus laoreet non. Ac tincidunt vitae semper quis lectus nulla. Viverra adipiscing at in tellus. Cursus eget nunc scelerisque viverra mauris in aliquam sem fringilla. Lacinia quis vel eros donec ac. Tempus urna et pharetra pharetra massa massa ultricies. Quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Dis parturi', '2022-08-31 12:19:27', true, NULL),
('l@1.it', 'p@2.it', 'ciao', '2022-09-02 21:22:28', false, NULL),
('l@1.it', 'p@1.it', 'wela', '2022-09-02 17:37:39', false, NULL),
('l@1.it', 'p@1.it', 'yeyeey', '2022-09-02 17:39:14', false, NULL),
('l@1.it', 'p@1.it', 'messaggio', '2022-09-02 17:39:03', false, NULL),
('l@1.it', 'p@1.it', 'ok, come stay?', '2022-09-02 17:38:50', false, NULL),
('l@1.it', 'p@1.it', 'ok', '2022-09-03 10:30:11', false, NULL),
('l@1.it', 'p@1.it', 'bene tutto funziona', '2022-09-03 10:30:42', false, NULL),
('l@1.it', 'p@1.it', 'messaggio', '2022-09-05 14:52:35', false, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-09-07 12:19:33', false, NULL),
('l@1.it', 'p@1.it', 'prima segnalazione messaggio', '2022-09-14 11:51:32', false, b'00'),
('l@1.it', 'p@1.it', 'seconda seg messaggio', '2022-09-14 12:02:59', false, b'00'),
('l@1.it', 'p@2.it', 'come va?', '2022-09-14 12:45:55', true, NULL),
('l@1.it', 'p@1.it', 'test con segnalazione personalizzata', '2022-09-19 09:26:06', false, b'01'),
('l@1.it', 'p@1.it', 'come va', '2022-09-20 17:31:49', true, NULL),
('l@1.it', 'p@1.it', 'ciao', '2022-09-20 17:31:42', true, NULL),
('l@1.it', 'annini@psypec.it', 'Voluptas quia ex omnis enim iure dolor consectetur. Facilis et ut aliquam nam quo. Qui sunt tempora ut.\nAd voluptates temporibus velit veniam quis a voluptas. Ea iusto sit saepe qui quo et. Eius corrupti cumque dignissimos cumque consequatur. Necessitatibus magni delectus odit consequatur tempore. Dolorem voluptas ipsum fugit sint sit. Beatae eveniet pariatur et sit ut et.\nFugit aut omnis sed labore neque aliquam. Odio aliquam eius molestias dolorum consequatur facere sunt. Ullam quo enim aliquid quod quis. Repellat non sed distinctio natus in omnis ut. Blanditiis explicabo et dolor.\nEos aut ipsa voluptas recusandae nemo ut amet. Eius ad amet ea molestiae alias. Ut rerum quasi dolor et. Cupiditate quibusdam quae molestiae. Eos enim aliquid pariatur nemo assumenda.\nLaborum dolorum aut sit delectus sunt vel dolorem. Omnis libero qui sint ex dolore id architecto repudiandae. Asperiores praesentium magni libero laudantium maxime quae. Libero autem beatae voluptas ipsa harum et.', '2022-08-12 18:53:53', false, b'00'),
('l@1.it', 'p@1.it', 'il problema peggiora ', '2022-08-10 16:44:10', false, b'01'),
('l@1.it', 'annini@psypec.it', 'ho un problema', '2022-08-10 16:34:35', false, b'00'),
('user@user.com', 'p@1.it', 'ciao', '2022-09-13 19:43:38', false, b'00'),
('user@user.com', 'p@1.it', 'ciao', '2022-09-19 10:04:55', true, NULL),
('l@1.it', NULL, 'segnalazione con problema minimo', '2022-09-20 11:50:48', false, b'00'),
('l@1.it', 'p@1.it', 'nuova segnalazione', '2022-09-20 17:30:12', false, b'00'),
('l@1.it', 'p@1.it', 'SEGNALAZIONE FINALE', '2022-09-20 12:44:30', false, b'10'),
('l@1.it', 'p@1.it', 'ciao', '2022-09-20 12:44:52', true, NULL),
('user@user.com', 'p@1.it', 'sono stato pestato per la 5 volta questo mese.\n', '2022-09-20 15:31:16', false, b'01'),
('user@user.com', NULL, 'Credo di non trovare più il senso di questa vita. Nessuno apprezza come sono', '2022-09-20 15:31:45', false, b'10'),
('user@user.com', 'p@1.it', 'ciao', '2022-09-20 15:33:17', true, NULL),
('user@user.com', 'p@1.it', 'salve, può aiutarmi?', '2022-09-20 15:34:18', false, NULL),
('user@user.com', 'p@1.it', 'va bene', '2022-09-20 17:06:15', true, NULL),
('l@1.it', 'p@1.it', 'ok', '2022-09-20 17:07:00', true, NULL),
('l@1.it', 'p@1.it', 'tutto bene bro', '2022-09-20 17:31:55', false, NULL),
('l@1.it', 'p@1.it', 'perfetto', '2022-09-20 17:32:04', true, NULL),
('l@1.it', NULL, 'urgentissimo', '2022-09-21 18:49:08', false, b'00'),
('l@1.it', 'annini@psypec.it', 'SEGNALAZIONE NON DEFINITA', '2022-09-21 18:50:34', false, b'01'),
('l@1.it', 'annini@psypec.it', 'mi danno il buongiorno con degli schiaffi e mi pestano appena arrivo a scuola, a merenda mi rubano il cibo ed anche i soldi, suonata l ultima ora mi salutano dandomi 4 schiaffi', '2022-09-21 18:51:47', false, b'10'),
('l@1.it', 'annini@psypec.it', 'ciao', '2022-09-23 17:32:09', true, NULL),
('l@1.it', 'p@1.it', 'segnalazione con carattere    un pò strano', '2022-09-22 19:32:29', false, b'01'),
('l@1.it', 'p@1.it', 'segnalazione con carattere    un pò strano', '2022-09-22 19:32:03', false, b'01'),
('l@1.it', NULL, 'segnalazione con carattere    un pò strano', '2022-09-22 19:31:08', false, b'01'),
('l@1.it', 'p@1.it', 'ciao', '2022-09-26 19:58:27', true, NULL),
('l@1.it', 'p@1.it', 'jj', '2022-09-26 19:59:26', true, NULL),
('l@1.it', 'p@1.it', 'ciao ', '2022-09-26 19:59:30', true, NULL),
('l@1.it', 'p@1.it', 'c', '2022-09-26 20:02:29', true, NULL),
('l@1.it', 'p@1.it', 'c ', '2022-09-26 20:02:31', true, NULL),
('l@1.it', 'p@1.it', 'ok ora va tutti been', '2022-09-26 20:03:46', true, NULL),
('l@1.it', 'p@1.it', ' ok ora va tutti been ', '2022-09-26 20:03:53', true, NULL),
('l@1.it', 'p@1.it', 'ok', '2022-09-26 20:06:06', true, NULL),
('l@1.it', 'p@1.it', 'probably con spazi', '2022-09-26 20:06:11', true, NULL),
('l@1.it', 'p@1.it', ' space before and after ', '2022-09-26 20:06:21', true, NULL),
('l@1.it', 'p@1.it', '', '2022-09-27 12:52:04', false, NULL),
('l@1.it', 'annini@psypec.it', 'ciao', '2022-09-27 16:49:20', true, NULL),
('user@user.com', NULL, 'Nessuno mi ascolta quando ho un problema', '2022-09-27 17:39:02', false, b'00');

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