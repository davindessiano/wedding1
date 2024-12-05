<?php
require_once 'C:/laragon/www/wedding/rdb-firebase/vendor/autoload.php';

use Kreait\Firebase\Factory;

// Path ke file kredensial JSON
$firebase = (new Factory)
    ->withServiceAccount(__DIR__ . '/../firebase/firebase-credentials.json')  // Menggunakan file JSON langsung
    ->withDatabaseUri('https://wedingnew-702bd-default-rtdb.asia-southeast1.firebasedatabase.app/')
    ->createDatabase();
?>
