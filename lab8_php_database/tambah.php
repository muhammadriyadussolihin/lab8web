<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;

        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = 'INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) ';
    $sql .= "VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";

    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #3498db; /* Warna biru */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #fff; /* Warna putih */
        }

        .main {
            margin-top: 20px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff; /* Warna putih */
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <title>Tambah Barang</title>
</head>

<body>
    <div class="container">
        <h1>Tambah Barang</h1>
        <div class="main">
            <form method="post" action="tambah.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label>Nama Barang</label></td>
                        <td><input type="text" name="nama" /></td>
                    </tr>
                    <tr>
                        <td><label>Kategori</label></td>
                        <td>
                            <select name="kategori">
                                <option value="Komputer">Komputer</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Hand Phone">Hand Phone</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Harga Jual</label></td>
                        <td><input type="text" name="harga_jual" /></td>
                    </tr>
                    <tr>
                        <td><label>Harga Beli</label></td>
                        <td><input type="text" name="harga_beli" /></td>
                    </tr>
                    <tr>
                        <td><label>Stok</label></td>
                        <td><input type="text" name="stok" /></td>
                    </tr>
                    <tr>
                        <td><label>File Gambar</label></td>
                        <td><input type="file" name="file_gambar" /></td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
