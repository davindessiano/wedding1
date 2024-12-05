<?php
require '../firebase/firebase.php';

// Pastikan ada parameter id yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Ambil data undangan berdasarkan ID
        $undangan = $firebase->getReference("undangan/$id")->getValue();

        if (!$undangan) {
            die("Data tidak ditemukan.");
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("ID tidak ditemukan.");
}

// Proses penyimpanan data yang diperbarui
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "namaPengantinPria" => $_POST['namaPengantinPria'],
        "namaPengantinWanita" => $_POST['namaPengantinWanita'],
        "tanggalPernikahan" => $_POST['tanggalPernikahan'],
        "alamat" => $_POST['alamat'],
        "tema" => $_POST['tema']
    ];

    try {
        // Simpan data yang diperbarui
        $firebase->getReference("undangan/$id")->update($data);

        // Redirect ke halaman utama setelah update
        header("Location: ../admin/index.php?status=updated");
        exit();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Undangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ff6f61;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff4a3b;
        }
        h1 {
            color: #ff6f61;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Edit Data Undangan</h1>
        <form method="POST">
            <!-- Nama Pengantin Pria -->
            <div class="mb-3">
                <label for="namaPengantinPria" class="form-label">Nama Pengantin Pria</label>
                <input type="text" class="form-control" id="namaPengantinPria" name="namaPengantinPria" 
                       value="<?= htmlspecialchars($undangan['namaPengantinPria']) ?>" required>
            </div>

            <!-- Nama Pengantin Wanita -->
            <div class="mb-3">
                <label for="namaPengantinWanita" class="form-label">Nama Pengantin Wanita</label>
                <input type="text" class="form-control" id="namaPengantinWanita" name="namaPengantinWanita" 
                       value="<?= htmlspecialchars($undangan['namaPengantinWanita']) ?>" required>
            </div>

            <!-- Tanggal Pernikahan -->
            <div class="mb-3">
                <label for="tanggalPernikahan" class="form-label">Tanggal Pernikahan</label>
                <input type="date" class="form-control" id="tanggalPernikahan" name="tanggalPernikahan" 
                       value="<?= htmlspecialchars($undangan['tanggalPernikahan']) ?>" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($undangan['alamat']) ?></textarea>
            </div>

            <!-- Tema -->
            <div class="mb-3">
                <label for="tema" class="form-label">Tema</label>
                <input type="text" class="form-control" id="tema" name="tema" 
                       value="<?= htmlspecialchars($undangan['tema']) ?>" required>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary w-100">Simpan</button>

            <!-- Tombol Kembali -->
            <a href="../admin/index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
