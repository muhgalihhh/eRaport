CREATE TABLE
    users (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) NOT NULL,
        FOREIGN KEY (role) REFERENCES roles (role_name)
    );

CREATE TABLE
    roles (
        role_name ENUM ('admin', 'walikelas', 'siswa') PRIMARY KEY
    );

CREATE TABLE
    kelas (
        kelas_id INT PRIMARY KEY AUTO_INCREMENT,
        nama_kelas VARCHAR(10) NOT NULL
    );

CREATE TABLE
    siswa_profiles (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        nama VARCHAR(100),
        NIS VARCHAR(10),
        alamat VARCHAR(100),
        jk ENUM ('L', 'P'),
        tempat_lahir VARCHAR(100),
        tanggal_lahir DATE,
        notelp VARCHAR(15),
        kelas_id INT,
        FOREIGN KEY (user_id) REFERENCES users (user_id),
        FOREIGN KEY (kelas_id) REFERENCES kelas (kelas_id)
    );

CREATE TABLE
    walikelas_profiles (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        nip VARCHAR(10),
        nama VARCHAR(100),
        alamat VARCHAR(100),
        jk ENUM ('L', 'P'),
        notelp VARCHAR(15),
        kelas_id INT,
        foto VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES users (user_id),
        FOREIGN KEY (kelas_id) REFERENCES kelas (kelas_id)
    );

CREATE TABLE
    admin_profiles (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        nama VARCHAR(100),
        foto VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES users (user_id)
    );

CREATE TABLE
    tahun_semester (
        tahun_semester_id INT PRIMARY KEY AUTO_INCREMENT,
        nama_tahun VARCHAR(20) NOT NULL,
        nama_semester VARCHAR(10) NOT NULL
    );

CREATE TABLE
    ujian (
        ujian_id INT PRIMARY KEY AUTO_INCREMENT,
        nama_ujian VARCHAR(50) NOT NULL,
        tanggal DATE NOT NULL,
        kelas_id INT,
        tahun_semester_id INT,
        FOREIGN KEY (kelas_id) REFERENCES kelas (kelas_id),
        FOREIGN KEY (tahun_semester_id) REFERENCES tahun_semester (tahun_semester_id)
    );

CREATE TABLE
    nilai_ujian (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        ujian_id INT,
        mapel_id INT,
        nilai INT,
        FOREIGN KEY (user_id) REFERENCES siswa_profiles (user_id),
        FOREIGN KEY (ujian_id) REFERENCES ujian (ujian_id),
        FOREIGN KEY (mapel_id) REFERENCES mata_pelajaran (mapel_id)
    );

CREATE TABLE
    mata_pelajaran (
        mapel_id INT PRIMARY KEY AUTO_INCREMENT,
        nama_mapel VARCHAR(50) NOT NULL
    );

CREATE TABLE
    guru (
        guru_id INT PRIMARY KEY AUTO_INCREMENT,
        nama_guru VARCHAR(100) NOT NULL,
        nip VARCHAR(10) NOT NULL,
        jk ENUM ('L', 'P'),
        notelp VARCHAR(15),
        alamat VARCHAR(255),
        tanggal_lahir DATE,
        mapel_id INT,
        FOREIGN KEY (mapel_id) REFERENCES mata_pelajaran (mapel_id)
    );

-- Change delimiter to handle semicolons within the trigger
DELIMITER / /
-- Create trigger to delete user when admin_profiles record is deleted
CREATE TRIGGER after_delete_admin_profiles AFTER DELETE ON admin_profiles FOR EACH ROW BEGIN
DELETE FROM users
WHERE
    user_id = OLD.user_id;

END;

/ /
-- Reset delimiter back to semicolon
DELIMITER;