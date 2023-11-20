<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
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

    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";

    if (!empty($gambar)) {
        $sql .= ", gambar = '{$gambar}' ";
    }

    $sql .= "WHERE id_barang = '{$id}'";

    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error: Data tidak tersedia');
}

$data = mysqli_fetch_array($result);

function is_selected($var, $val) {
    return ($var == $val) ? 'selected="selected"' : '';
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

        .input {
            margin-bottom: 15px;
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
    <title>Ubah Barang</title>
</head>

<body>
    <div class="container">
        <h1>Ubah Barang</h1>
        <div class="main">
            <form method="post" action="ubah.php" enctype="multipart/form-data">
                <div class="input">
                    <label for="nama">Nama Barang</label>
                    <input type="text" name="nama" id="nama" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" />
                </div>
                <div class="input">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori">
                        <option <?php echo is_selected('Komputer', isset($data['kategori']) ? $data['kategori'] : ''); ?> value="Komputer">Komputer</option>
                        <option <?php echo is_selected('Elektronik', isset($data['kategori']) ? $data['kategori'] : ''); ?> value="Elektronik">Elektronik</option>
                        <option <?php echo is_selected('Hand Phone', isset($data['kategori']) ? $data['kategori'] : ''); ?> value="Hand Phone">Hand Phone</option>
                    </select>
                </div>
                <div class="input">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" name="harga_jual" id="harga_jual" value="<?php echo isset($data['harga_jual']) ? $data['harga_jual'] : ''; ?>" />
                </div>
                <div class="input">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" name="harga_beli" id="harga_beli" value="<?php echo isset($data['harga_beli']) ? $data['harga_beli'] : ''; ?>" />
                </div>
                <div class="input">
                    <label for="stok">Stok</label>
                    <input type="text" name="stok" id="stok" value="<?php echo isset($data['stok']) ? $data['stok'] : ''; ?>" />
                </div>
                <div class="input">
                    <label for="file_gambar">File Gambar</label>
                    <input type="file" name="file_gambar" id="file_gambar" />
                </div>
                <div class="submit">
                    <input type="hidden" name="id" value="<?php echo isset($data['id_barang']) ? $data['id_barang'] : ''; ?>" />
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
