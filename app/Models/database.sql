 personalCREATE DATABASE personal_notes;

USE personal_notes;

CREATE TABLE tb_users (
    IDUSER INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    passwd VARCHAR(100) NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    permission CHAR(1) NOT NULL
);

CREATE TABLE tb_notes (
    IDNOTES INT PRIMARY KEY AUTO_INCREMENT,
    ID_SUBJECT INT NOT NULL,
    note_title VARCHAR(200) NOT NULL,
    type_of_note ENUM('I', 'F', 'C', 'T', 'B'),
    note TEXT NOT NULL,
    note_date DATE
);

CREATE TABLE tb_subject (
    IDSUBJECT INT PRIMARY KEY AUTO_INCREMENT,
    subject VARCHAR(100)
);
-- I - Installation
-- F - Configuration
-- C - Command
-- T - Text Information
-- B - Command Block

ALTER TABLE tb_notes ADD CONSTRAINT FK_SUBJECT_NOTE
FOREIGN KEY(ID_SUBJECT) REFERENCES tb_subject(IDSUBJECT);