<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<style>
    body {
        background-color: #f8f9fa; /* Warna latar belakang */
        background-image: url('background.jpg'); /* URL gambar latar belakang */
        background-size: cover; /* Membuat gambar menutupi seluruh area */
        background-repeat: no-repeat; /* Mencegah pengulangan gambar */
        background-attachment: fixed; /* Membuat gambar tetap pada posisinya saat di-scroll */
        color: #333; /* Warna font untuk seluruh halaman */
    }
    table {
        width: 100%; /* Melebarkan tabel ke seluruh lebar container */
    }
    th, td {
        text-align: center; /* Mengatur teks menjadi rata tengah */
    }
</style>
</head>
<title>
    Tugas Akhir
</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Data Mahasiswa</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR MAHASISWA</center></h4>
        <?php
        include "koneksi.php";

        //Cek apakah ada kiriman form dari method post
        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);

            $sql = "delete from peserta where id_peserta='$id_peserta' ";
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>
        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Universitas</th>
                    <th>Jurusan</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                $sql = "select * from peserta order by id_peserta desc";

                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["universitas"]; ?></td>
                        <td><?php echo $data["jurusan"]; ?></td>
                        <td><?php echo $data["no_hp"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>
</html>
