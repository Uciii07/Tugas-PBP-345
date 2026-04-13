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

    echo "Koneksi berhasil!\n";

    // Input dari CLI
    $nama_ras = readline("Masukkan nama ras kucing yang ingin diubah: ");
    $asal_baru = readline("Masukkan asal negara baru: ");

    // Query update
    $sql = "UPDATE ras_kucing SET asal_negara = :asal WHERE nama_ras = :nama";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':asal' => $asal_baru,
        ':nama' => $nama_ras
    ]);

    if ($stmt->rowCount() > 0) {
        echo "Data berhasil diperbarui!\n";
    } else {
        echo "Data tidak ditemukan atau tidak ada perubahan.\n";
    }

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>