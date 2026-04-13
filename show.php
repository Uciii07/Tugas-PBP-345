<?php
$host = 'localhost';
$db   = 'kucing_db';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    echo "Koneksi berhasil!\n\n";

    // Query menampilkan semua data
    $sql = "SELECT * FROM ras_kucing";
    $stmt = $pdo->query($sql);

    echo "Daftar Ras Kucing:\n";
    echo "---------------------------------\n";

    foreach ($stmt as $row) {
        echo "ID          : " . $row['id'] . "\n";
        echo "Nama Ras    : " . $row['nama_ras'] . "\n";
        echo "Asal Negara : " . $row['asal_negara'] . "\n";
        echo "---------------------------------\n";
    }

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>