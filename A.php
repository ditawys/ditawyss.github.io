<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "f55121098";
$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$tgl        = "";
$nama       = "";
$keluhan    = "";
$namadok    = "";
$error      = "";
$sukses     = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from rekammediss where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from rekammediss where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $tgl        = $r1['tgl'];
    $nama       = $r1['nama'];
    $keluhan    = $r1['keluhan'];
    $namadok    = $r1['namadok'];

    if ($tgl == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $tgl        = $_POST['tgl'];
    $nama       = $_POST['nama'];
    $keluhan     = $_POST['keluhan'];
    $namadok   = $_POST['namadok'];

    if ($tgl && $nama && $keluhan && $namadok) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update rekammediss set tgl = '$tgl',nama='$nama',keluhan = '$keluhan',namadok='$namadok' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into rekammediss(tgl,nama,keluhan,namadok) values ('$tgl','$nama','$keluhan','$namadok')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
    .mx-auto {
        width: 800px
    }

    .card {
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:2;url=A.php");//2 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:2;url=A.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="tgl" class="col-sm-2 col-form-label">Tanggal Periksa</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $tgl ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                        <div class="col-sm-10">
                            <input type="textarea" class="form-control" id="keluhan" name="keluhan"
                                value="<?php echo $keluhan ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="namadok" class="col-sm-2 col-form-label">Nama Dokter</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namadok" name="namadok" value="<?php echo $namadok ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                <center>Data Rekam Medis</center>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Periksa</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from rekammediss order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $tgl        = $r2['tgl'];
                            $nama       = $r2['nama'];
                            $keluhan    = $r2['keluhan'];
                            $namadok    = $r2['namadok'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $tgl ?></td>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $keluhan ?></td>
                            <td scope="row"><?php echo $namadok ?></td>
                            <td scope="row">
                                <a href="A.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                class="btn btn-info">Edit</button></a>
                                <a href="A.php?op=delete&id=<?php echo $id?>"
                                    onclick="return confirm('Yakin mau delete data?')"><button type="button"
                                        class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>

</html>