<?php
require '../firebase/firebase.php'; // Pastikan path sesuai

// Ambil data undangan aktif dari Firebase
try {
    $activeInvitationRef = $firebase->getReference('undangan/active_invitation');
    $activeInvitation = $activeInvitationRef->getValue();

    if (!$activeInvitation) {
        die("Tidak ada undangan yang aktif.");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .undangan-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        .undangan-container::before, .undangan-container::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 234, 234, 0.5);
            border-radius: 50%;
            z-index: -1;
        }
        .undangan-container::before {
            top: -50px;
            left: -50px;
        }
        .undangan-container::after {
            bottom: -50px;
            right: -50px;
        }
        h1 {
            font-family: 'Dancing Script', cursive;
            color: #fff;
            font-size: 36px;
            margin-bottom: 20px;
        }
        h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 32px;
            color: #e91e63;
        }
        .details {
            font-size: 18px;
            margin-top: 15px;
            color: #555;
        }
        .details strong {
            color: #e91e63;
        }
        .undangan-container img {
            width: 100%;
            border-radius: 15px;
            margin-bottom: 20px;
            border: 5px solid #fad0c4;
        }
        footer {
            margin-top: 30px;
            font-size: 14px;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang di Undangan Pernikahan</h1>
    <div class="undangan-container">
        <!-- Foto Pengantin (opsional) -->
        <?php if (!empty($activeInvitation['fotoPengantin'])): ?>
            <img src="<?= htmlspecialchars($activeInvitation['fotoPengantin']) ?>" alt="Foto Pengantin">
        <?php endif; ?>

        <!-- Nama Pengantin -->
        <h2><?= htmlspecialchars($activeInvitation['namaPengantinPria']) ?> & <?= htmlspecialchars($activeInvitation['namaPengantinWanita']) ?></h2>

        <!-- Tanggal Pernikahan -->
        <div class="details">
            <strong>Tanggal Pernikahan:</strong> <?= htmlspecialchars($activeInvitation['tanggalPernikahan']) ?>
        </div>

        <!-- Alamat -->
        <div class="details">
            <strong>Alamat:</strong> <?= htmlspecialchars($activeInvitation['alamat']) ?>
        </div>

        <!-- Tema -->
        <div class="details">
            <strong>Tema Pernikahan:</strong> <?= htmlspecialchars($activeInvitation['tema']) ?>
        </div>
    </div>

    <footer>
        <p>Terima kasih telah menjadi bagian dari hari spesial kami!</p>
    </footer>
</body>
</html>
