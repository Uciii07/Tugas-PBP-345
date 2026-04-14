<?php
$host = 'localhost';
$db   = 'pbp2026';
$user = 'root';
$pass = '';

// ==========================
// KONFIGURASI DATABASE
// ==========================
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Koneksi DB gagal: " . $e->getMessage());
}

// ==========================
// INPUT DARI CLI
// ==========================
$id = readline("Masukkan ID user yang ingin diupdate: ");
$usernameBaru = readline("Masukkan username baru: ");
$emailBaru = readline("Masukkan email baru: ");

function update_user(){
    global $pdo, $id, $usernameBaru, $emailBaru;

    // ==========================
    // PREPARED STATEMENT UPDATE
    // ==========================
    $updateUser = $pdo->prepare("
        UPDATE user 
        SET username = :username, 
            email = :email,
            updated_at = :updated_at
        WHERE id = :id
    ");

    try {

        $updateUser->execute([
            ':username' => $usernameBaru,
            ':email' => $emailBaru,
            ':updated_at' => time(),
            ':id' => $id
        ]);

        if ($updateUser->rowCount() > 0) {
            echo "\nUser berhasil diupdate!\n";
            echo "ID: $id\n";
            echo "Username Baru: $usernameBaru\n";
            echo "Email Baru: $emailBaru\n";
        } else {
            echo "User dengan ID tersebut tidak ditemukan.\n";
        }

    } catch (Exception $e) {
        die("Update gagal: " . $e->getMessage());
    }
}

function main(){
    update_user();
}

main();
?>