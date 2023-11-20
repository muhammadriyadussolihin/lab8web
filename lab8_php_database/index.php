<?php
include("koneksi.php");
// query untuk menampilkan data
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Data Barang</title>
    <style>
        /* Tambahkan CSS untuk memberi garis pada sel dan kolom tabel */
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff; /* Warna putih */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #333; /* Warna hitam */
        }

        .main {
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            background-color: #3498db; /* Warna biru */
            color: #fff; /* Warna putih */
            padding: 8px 12px;
            border-radius: 4px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya untuk link "Ubah" */
        .ubah-link {
            background-color: #2ecc71; /* Warna hijau */
        }

        /* Gaya untuk link "Hapus" */
        .hapus-link {
            background-color: #e74c3c; /* Warna merah */
        }

        /* Gaya untuk link "Ubah" dan "Hapus" */
        .ubah-hapus-link {
            display: inline-block;
            margin-right: 5px;
            color: #fff; /* Warna putih */
            padding: 6px 10px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Barang</h1>
        <div class="main">
            <a href="tambah.php">Tambah Barang</a>
            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Ubah Hapus</th>
                </tr>
                <?php if ($result) : ?>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>"></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= $row['harga_beli']; ?></td>
                            <td><?= $row['harga_jual']; ?></td>
                            <td><?= $row['stok']; ?></td>
                            <td>
                                <a class="ubah-hapus-link ubah-link" href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a>
                                <a class="ubah-hapus-link hapus-link" href="hapus.php?id=<?= $row['id_barang']; ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>

</html>
