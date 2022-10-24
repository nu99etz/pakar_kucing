CREATE TABLE ms_gejala (
    id_ms_gejala int AUTO_INCREMENT PRIMARY KEY,
    kode_gejala varchar(255),
    nama_gejala varchar(255)
);

CREATE TABLE ms_penyakit (
    id_ms_penyakit int AUTO_INCREMENT PRIMARY KEY,
    kode_penyakit varchar(255),
    nama_penyakit varchar(255),
    solusi_penyakit text
);

CREATE TABLE rule (
    id_rule int AUTO_INCREMENT PRIMARY KEY,
    id_ms_penyakit int,
    gejala varchar(255),
    FOREIGN KEY(id_ms_penyakit) REFERENCES ms_penyakit(id_ms_penyakit)
);

CREATE TABLE rule_breadth (
    id_rule_breadth int AUTO_INCREMENT PRIMARY KEY,
    id_rule int,
    parent_ms_gejala int,
    child_ms_gejala int,
    id_ms_penyakit int,
    is_primary int,
    is_priority int,
    FOREIGN KEY(id_rule) REFERENCES rule(id_rule),
    FOREIGN KEY(parent_ms_gejala) REFERENCES ms_gejala(id_ms_gejala),
    FOREIGN KEY(child_ms_gejala) REFERENCES ms_gejala(id_ms_gejala),
    FOREIGN KEY(id_ms_penyakit) REFERENCES ms_penyakit(id_ms_penyakit)
);

CREATE TABLE role (
    id int AUTO_INCREMENT PRIMARY KEY,
    nama_role varchar(255)
);

CREATE TABLE users (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_role int,
    nama_user varchar(255),
    username varchar(255),
    password varchar(255),
    created_at timestamp,
    FOREIGN KEY(id_role) REFERENCES role(id)
);

INSERT INTO role VALUES
(1, "Super Admin"),
(2, "User");

INSERT INTO users VALUES
(1, 1, "Aan Super Admin", "aan_admin", md5("123456"), "2022-10-15 22:24:00"),
(2, 2, "Aan User", "aan_user", md5("123456"), "2022-10-15 22:24:00");