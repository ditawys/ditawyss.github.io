<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Form Anggota</title>
</head>
<body>
    <form action="aksi_simpan.php" class="form-horizontal" method="$_POST">
        <table align="center">
            <tr>
                <td>Kode Anggota</td>
                <td><input type="text" name="kd_anggota class="form-control"></input></td>
            </tr>
            <tr>
                <td>nama</td>
                <td><input type="text" name="nama" class="from-control</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <select name="jnk" class="form-select">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>telp</td>
                <td><input type="Number" name="telp" class="form-control"></td>
            </tr>
            <tr>
                <td>alamat</td>
                <td><textarea name="alamat" cols="30" rows="10></textarea>"</td>
            </tr>
            <tr>
                <td>email</td>
                <td><input type="email" nama="email" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="btn btn-primary value="simpan">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>