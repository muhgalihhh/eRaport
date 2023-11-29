<!-- Buat nyetak nilai raport file php ke pdf -->

<?php
require_once "../../koneksi.php";
$semesterType = "ganjil";
if(isset($_GET['id'])){
    $StudenID = $_GET['id'];
     $kelasSiswa = "SELECT DISTINCT nama_kelas FROM kelas JOIN siswa_profiles ON kelas.kelas_id = siswa_profiles.kelas_id WHERE siswa_profiles.user_id = '$StudenID';";
    $resultKelas = mysqli_query($koneksi, $kelasSiswa);
    $rowKelas = mysqli_fetch_assoc($resultKelas);
    $query = "SELECT DISTINCT
                siswa_profiles.foto,
                siswa_profiles.NIS,
                siswa_profiles.nama AS nama_siswa,
                kelas.nama_kelas,
                ujian.nama_ujian,
                tahun_semester.nama_tahun,
                tahun_semester.nama_semester,
                nilai_ujian.nilai
            FROM 
                siswa_profiles
            JOIN 
                nilai_ujian ON siswa_profiles.user_id = nilai_ujian.user_id
            JOIN 
                ujian ON nilai_ujian.ujian_id = ujian.ujian_id
            JOIN 
                kelas ON ujian.kelas_id = kelas.kelas_id
            JOIN 
                tahun_semester ON ujian.tahun_semester_id = tahun_semester.tahun_semester_id
            WHERE
                kelas.nama_kelas LIKE 'VII__' AND tahun_semester.nama_semester LIKE '%$semesterType%' AND siswa_profiles.user_id = '$StudenID';";

}
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <style>
    body {
        font-family: sans-serif;
    }

    .raport {
        width: 1000px;
        margin: auto;
    }

    h1 {
        text-align: center;
    }

    table {
        margin: auto;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 3px 8px;
    }

    .left {
        text-align: left;
        width: 120px;
    }

    .colon {
        width: 10px;
    }

    .ttd {
        display: flex;
        justify-content: space-between;
    }
    </style>
</head>

<body>
    <div class="raport">
        <h1>Nilai Raport</h1>
        <table width="100%">
            <tr>
                <td class="left">Nama</td>
                <td class="colon">:</td>
                <td class="left"><?= $row['nama_siswa'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="left">NIS</td>
                <td class="colon">:</td>
                <td class="left"><?= $row['NIS'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="left">Kelas</td>
                <td class="colon">:</td>
                <td class="left"><?= $rowKelas['nama_kelas'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="left">Tahun</td>
                <td class="colon">:</td>
                <td class="left"><?= $row['nama_tahun'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="left">Semester</td>
                <td class="colon">:</td>
                <td class="left"><?= $row['nama_semester'] ?></td>
                <td></td>
            </tr>
        </table>
        <br>
        <hr>
        <br>
        <table border="1" width="100%">
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Jumlah Nilai</th>
                <th>Nilai Rata-rata</th>

            </tr>
            <?php
            $no = 1;
            $queryMapel = "SELECT DISTINCT
                            mata_pelajaran.nama_mapel
                        FROM 
                            siswa_profiles
                        JOIN 
                            nilai_ujian ON siswa_profiles.user_id = nilai_ujian.user_id
                        JOIN 
                            ujian ON nilai_ujian.ujian_id = ujian.ujian_id
                        JOIN 
                            kelas ON ujian.kelas_id = kelas.kelas_id
                        JOIN 
                            tahun_semester ON ujian.tahun_semester_id = tahun_semester.tahun_semester_id
                        JOIN
                            mata_pelajaran ON nilai_ujian.mapel_id = mata_pelajaran.mapel_id
                        WHERE
                            kelas.nama_kelas LIKE 'VII__' AND tahun_semester.nama_semester LIKE '%$semesterType%' AND nilai_ujian.user_id = '$StudenID';";
            $resultMapel = mysqli_query($koneksi, $queryMapel);
            while ($rowMapel = mysqli_fetch_assoc($resultMapel)) {
                $queryNilai = "SELECT DISTINCT
                                    nilai_ujian.nilai
                                FROM 
                                    siswa_profiles
                                JOIN 
                                    nilai_ujian ON siswa_profiles.user_id = nilai_ujian.user_id
                                JOIN 
                                    ujian ON nilai_ujian.ujian_id = ujian.ujian_id
                                JOIN 
                                    kelas ON ujian.kelas_id = kelas.kelas_id
                                JOIN 
                                    tahun_semester ON ujian.tahun_semester_id = tahun_semester.tahun_semester_id
                                JOIN
                                    mata_pelajaran ON nilai_ujian.mapel_id = mata_pelajaran.mapel_id
                                WHERE
                                    kelas.nama_kelas LIKE 'VII__' AND tahun_semester.nama_semester LIKE '%$semesterType%' AND mata_pelajaran.nama_mapel LIKE '$rowMapel[nama_mapel]' AND nilai_ujian.user_id = '$StudenID';";
                $resultNilai = mysqli_query($koneksi, $queryNilai);
                $uts = 0;
                $uas = 0;
                $nilai = 0;
                while ($rowNilai = mysqli_fetch_assoc($resultNilai)) {
                    if ($uts == 0) {
                        $uts = $rowNilai['nilai'];
                    } else {
                        $uas = $rowNilai['nilai'];
                    }
                    $nilai = ($uts + $uas) / 2;
                }
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $rowMapel['nama_mapel'] ?></td>
                <td><?= $uts ?></td>
                <td><?= $uas ?></td>
                <td><?= $uts+$uas ?></td>
                <td><?= $nilai ?></td>
            </tr>
            <?php
                                $no++;
                            }
                            ?>

        </table>
        <div class="container-ttd">
            <div class="ttd">
                <div class="ttd-kepsek">
                    <p>Mengetahui,</p>
                    <br>
                    <br>
                    <br>
                    <p>Kepala Sekolah</p>
                </div>
                <div class="ttd-siswa">
                    <p>Mengetahui,</p>
                    <br>
                    <br>
                    <br>
                    <p><?= $row['nama_siswa'] ?></p>
                </div>
            </div>
        </div>
        <p align="center">

            <input type="button" value="Export PDF" onclick="window.print()">
        </p>
    </div>


</body>

</html>