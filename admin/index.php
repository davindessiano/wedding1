<?php
session_start();
require '../firebase/firebase.php';  // Pastikan path sesuai

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');  // Redirect ke login jika bukan admin
    exit();
}

// Ambil data undangan dari Firebase
$undanganRef = $firebase->getReference('undangan');
$data = $undanganRef->getValue();

// Ambil undangan aktif
$activeInvitationRef = $firebase->getReference('undangan/active_invitation');
$activeInvitation = $activeInvitationRef->getValue();

// Jika data tidak ada, inisialisasi dengan array kosong
$data = $data ? $data : [];

// Menangani perubahan undangan aktif
if (isset($_GET['set_active']) && !empty($_GET['set_active'])) {
    $id = $_GET['set_active'];

    if (isset($data[$id])) {
        try {
            // Set undangan aktif
            $activeInvitationRef->set($data[$id]);

            // Redirect kembali ke dashboard dengan pesan sukses
            header('Location: index.php?status=active_set');
            exit();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    } else {
        die("Undangan tidak ditemukan.");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        }
        .card-header {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            color: #fff;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }
        .btn-success {
            background: linear-gradient(135deg, #11998e, #38ef7d);
            border: none;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #38ef7d, #11998e);
        }
        .btn-danger {
            background: linear-gradient(135deg, #ff6a00, #ee0979);
            border: none;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #ee0979, #ff6a00);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-header text-center">
                <h1>Dashboard Admin</h1>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <a href="tambah.php" class="btn btn-primary">Tambah Undangan</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>

                <!-- Menampilkan pesan jika ada status -->
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'deleted'): ?>
                        <div class="alert alert-success">Data undangan berhasil dihapus.</div>
                    <?php elseif ($_GET['status'] === 'active_set'): ?>
                        <div class="alert alert-success">Undangan aktif berhasil diatur.</div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama Pengantin Pria</th>
                                <th>Nama Pengantin Wanita</th>
                                <th>Tanggal Pernikahan</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $id => $undangan): ?>
                                <tr>
                                    <td><?= htmlspecialchars($undangan['namaPengantinPria']) ?></td>
                                    <td><?= htmlspecialchars($undangan['namaPengantinWanita']) ?></td>
                                    <td><?= htmlspecialchars($undangan['tanggalPernikahan']) ?></td>
                                    <td><?= htmlspecialchars($undangan['alamat']) ?></td>
                                    <td>
                                        <?php if ($activeInvitation && $activeInvitation['namaPengantinPria'] === $undangan['namaPengantinPria']): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?= $id ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete.php?id=<?= $id ?>" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                        <?php if (!$activeInvitation || $activeInvitation['namaPengantinPria'] !== $undangan['namaPengantinPria']): ?>
                                            <a href="?set_active=<?= $id ?>" class="btn btn-sm btn-success"
                                               onclick="return confirm('Jadikan undangan ini sebagai aktif?');">Set Aktif</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
