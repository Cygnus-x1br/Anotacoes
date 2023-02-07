CREATE DATABASE personal_notes;
USE personal_notes;
CREATE TABLE tb_users (
    IDUSER INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    passwd VARCHAR(100) NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    permission CHAR(1) NOT NULL
);
CREATE TABLE tb_notes (
    IDNOTE INT PRIMARY KEY AUTO_INCREMENT,
    ID_SUBJECT INT NOT NULL,
    note_title VARCHAR(200) NOT NULL,
    type_of_note ENUM('I', 'F', 'C', 'T', 'B'),
    note TEXT NOT NULL,
    note_date DATE
);
CREATE TABLE tb_subject (
    IDSUBJECT INT PRIMARY KEY AUTO_INCREMENT,
    subject VARCHAR(100),
    subject_image VARCHAR(100),
    subject_link VARCHAR(100)
);
-- I - Installation
-- F - Configuration
-- C - Command
-- T - Text Information
-- B - Command Block
ALTER TABLE tb_notes
ADD CONSTRAINT FK_SUBJECT_NOTE FOREIGN KEY(ID_SUBJECT) REFERENCES tb_subject(IDSUBJECT);
INSERT INTO tb_users(username, passwd, user_name, permission)
VALUES('jean', sha1('@Czf0704'), 'Jean Marcel', 'A');
-- Ajustar tabelas para o novo db
CREATE TABLE tb_schools (
    IDSCHOOL INT PRIMARY KEY AUTO_INCREMENT,
    school_name VARCHAR(100) NOT NULL,
    school_link VARCHAR(100) NOT NULL,
    school_logo VARCHAR(150)
);
CREATE TABLE tb_curses (
    IDCURSE INT PRIMARY KEY AUTO_INCREMENT,
    curse_title VARCHAR(250) NOT NULL,
    curse_description TEXT NOT NULL,
    ID_SCHOOL INT NOT NULL
);
ALTER TABLE tb_curses
ADD CONSTRAINT FK_SCHOOL_CURSE FOREIGN KEY(ID_SCHOOL) REFERENCES tb_schools(IDSCHOOL);
--Substituir pela tb_subject
-- CREATE TABLE tb_assuntos (
--     IDASSUNTO INT PRIMARY KEY AUTO_INCREMENT,
--     ASSUNTO VARCHAR(100) NOT NULL
-- );
CREATE TABLE tba_curse_subject (
    ID_CURSE INT,
    ID_SUBJECT INT,
    PRIMARY KEY(ID_CURSE, ID_SUBJECT)
);
ALTER TABLE tba_curse_subject
ADD CONSTRAINT FK_CURSE_SUBJECT FOREIGN KEY(ID_CURSE) REFERENCES tb_curses(IDCURSE);
ALTER TABLE tba_curse_subject
ADD CONSTRAINT FK_SUBJECT_CURSE FOREIGN KEY(ID_SUBJECT) REFERENCES tb_subject(IDSUBJECT);
CREATE TABLE tb_class_path (
    IDCLASSPATH INT PRIMARY KEY AUTO_INCREMENT,
    class_path VARCHAR(300) NOT NULL
);
CREATE TABLE tb_class_images (
    IDCLASSIMAGE INT PRIMARY KEY AUTO_INCREMENT,
    class_image_path VARCHAR(300) NOT NULL
);
CREATE TABLE tb_classes (
    IDCLASS INT PRIMARY KEY AUTO_INCREMENT,
    class_number INT NOT NULL,
    class_title VARCHAR(300) NOT NULL,
    class_notes TEXT,
    see_again BOOLEAN DEFAULT 0,
    ID_CURSE INT,
    ID_SUBJECT INT,
    ID_CLASSPATH INT,
    ID_CLASSIMAGE INT,
    ID_USER INT
);
ALTER TABLE tb_classes
ADD CONSTRAINT FK_CLASS_CURSE FOREIGN KEY(ID_CURSE) REFERENCES tb_curses(IDCURSE);
ALTER TABLE tb_classes
ADD CONSTRAINT FK_CLASS_SUBJECT FOREIGN KEY(ID_SUBJECT) REFERENCES tb_subjects(IDSUBJECT);
ALTER TABLE tb_classes
ADD CONSTRAINT FK_CLASS_CLASSPATH FOREIGN KEY(ID_CLASSPATH) REFERENCES tb_class_path(IDCLASSPATH);
ALTER TABLE tb_classes
ADD CONSTRAINT FK_CLASS_CLASSIMAGE FOREIGN KEY(ID_CLASSIMAGE) REFERENCES tb_class_images(IDCLASSIMAGE);
ALTER TABLE tb_classes
ADD CONSTRAINT FK_CLASS_USER FOREIGN KEY(ID_USER) REFERENCES tb_users(IDUSER);
-- CREATE TABLE tba_aula_assunto (
--     ID_AULA INT,
--     ID_ASSUNTO INT,
--     PRIMARY KEY(ID_AULA, ID_ASSUNTO),
--     FOREIGN KEY(ID_AULA) REFERENCES tb_aulas(IDAULA),
--     FOREIGN KEY(ID_ASSUNTO) REFERENCES tb_assuntos(IDASSUNTO)
-- );
ALTER TABLE tb_subject
ADD COLUMN subject_link VARCHAR(100);
ALTER TABLE tb_curses DROP COLUMN curse_subtitle VARCHAR(250);
CREATE TABLE tb_curse_subtitle(
    IDSUBTITLE INT PRIMARY KEY AUTO_INCREMENT,
    subtitle VARCHAR(250) NOT NULL,
    subtitle_description TEXT,
    ID_CURSE INT
);
ALTER TABLE tb_curse_subtitle
ADD CONSTRAINT FK_SUBTITLE_CURSE FOREIGN KEY(ID_CURSE) REFERENCES tb_curses(IDCURSE);
ALTER TABLE tb_curse_subtitle
ADD COLUMN subtitle_number INT NOT NULL;
ALTER TABLE tb_curse_subtitle
ADD COLUMN ID_SUBJECT INT NOT NULL;
ALTER TABLE tb_classes
ADD COLUMN ID_SUBTITLE INT NOT NULL;
ALTER TABLE tb_curses
ADD COLUMN review BOOLEAN DEFAULT 0;
--
SELECT cl.IDCLASS,
cl.class_title
FROM tb_classes as cl
WHERE cl.class_title LIKE '%PHP%'
    OR cl.class_notes LIKE '%PHP%';
--
SELECT *,
s.ID_SUBJECT as subject
FROM tb_curses
    INNER JOIN tba_curse_subject as s ON ID_CURSE = IDCURSE
WHERE ID_SUBJECT = *
    AND ID_SCHOOL = *;
--
SELECT IDCLASS, class_number, c.curse_title as curse, c.IDCURSE as idcurse
FROM tb_classes
    INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
WHERE IDCURSE = 4;
--
SELECT IDCLASS, class_number,
c.curse_title as curse,
c.IDCURSE as idcurse
FROM tb_classes
    INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
WHERE IDCURSE = 4
    AND class_number = 432;
SELECT IDCLASS,
    class_number,
    c.curse_title as curse,
    c.IDCURSE as idcurse
FROM tb_classes
    INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
WHERE IDCURSE = 4
    AND class_number > (432 -10)
LIMIT 2;
--Aula anterior
SELECT IDCLASS,
    class_number,
    c.curse_title as curse,
    c.IDCURSE as idcurse
FROM tb_classes
    INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
WHERE IDCURSE = 4
    AND class_number < 22
ORDER BY class_number DESC
LIMIT 1;
--Proxima aula
SELECT IDCLASS,
    class_number,
    c.curse_title as curse,
    c.IDCURSE as idcurse
FROM tb_classes
    INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
WHERE IDCURSE = 4
    AND class_number > 22
ORDER BY class_number ASC
LIMIT 1;