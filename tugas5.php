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
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// =======================
// PROSES UPDATE
// =======================
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $asal_baru = $_POST['asal_negara'];

    $sql = "UPDATE ras_kucing SET asal_negara = :asal WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':asal' => $asal_baru,
        ':id' => $id
    ]);

    echo "<script>alert('Data berhasil diupdate!'); window.location='kucing.php';</script>";
    exit;
}

// =======================
// AMBIL DATA UNTUK SHOW
// =======================
$stmt = $pdo->query("SELECT * FROM ras_kucing");
?>

<h2>Data Ras Kucing</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Ras</th>
        <th>Asal Negara</th>
        <th>Update</th>
    </tr>

    <?php foreach ($stmt as $row): ?>
    <tr>
        <form method="POST">
            <td>
                <?= $row['id'] ?>
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
            </td>

            <td><?= $row['nama_ras'] ?></td>

            <td>
                <input type="text" name="asal_negara" value="<?= $row['asal_negara'] ?>">
            </td>

            <td>
                <button type="submit" name="update">Update</button>
            </td>
        </form>
    </tr>
    <?php endforeach; ?>
</table>