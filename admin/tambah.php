<?php
require '../firebase/firebase.php'; // Mengimpor file koneksi Firebase

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $data = [
        "namaPengantinPria" => $_POST['namaPengantinPria'],
        "namaPengantinWanita" => $_POST['namaPengantinWanita'],
        "tanggalPernikahan" => $_POST['tanggalPernikahan'],
        "alamat" => $_POST['alamat'],
        "tema" => $_POST['tema']
    ];

    $id = uniqid(); // Membuat ID unik untuk setiap undangan

    // Simpan data ke Firebase
    $firebase->getReference("undangan/$id")->set($data);

    // Redirect ke halaman index.php setelah berhasil menyimpan
    header("Location: ../admin/index.php");
    exit(); // Pastikan untuk menghentikan eksekusi script setelah redirect
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Undangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: #fff;
        }
        .card {
            background: linear-gradient(135deg, #ffffff, #f7f7f7);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #fff;
            background: -webkit-linear-gradient(#ff9a9e, #fad0c4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(42, 89, 255, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            border: none;
            color: #000;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-secondary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(105, 182, 255, 0.4);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Tambah Undangan</h1>
        <div class="card p-4 shadow-sm">
            <form method="POST">
                <div class="mb-3">
                    <label for="namaPengantinPria" class="form-label">Nama Pengantin Pria</label>
                    <input type="text" class="form-control" id="namaPengantinPria" name="namaPengantinPria" required>
                </div>
                <div class="mb-3">
                    <label for="namaPengantinWanita" class="form-label">Nama Pengantin Wanita</label>
                    <input type="text" class="form-control" id="namaPengantinWanita" name="namaPengantinWanita" required>
                </div>
                <div class="mb-3">
                    <label for="tanggalPernikahan" class="form-label">Tanggal Pernikahan</label>
                    <input type="date" class="form-control" id="tanggalPernikahan" name="tanggalPernikahan" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="tema" class="form-label">Tema</label>
                    <input type="text" class="form-control" id="tema" name="tema" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                <a href="../admin/index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
