<?php
$host = 'localhost';
$db   = 'pbp2026';
$user = 'root';
$pass = '';

$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Koneksi DB gagal: " . $e->getMessage());
}

/* ==========================
   CREATE USER
========================== */
if(isset($_POST['create'])){
    $username = $_POST['username'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("
        INSERT INTO user (username,email,password_hash,auth_key,status,created_at,updated_at)
        VALUES (:username,:email,:password_hash,:auth_key,:status,:created_at,:updated_at)
    ");

    $stmt->execute([
        ':username'=>$username,
        ':email'=>$email,
        ':password_hash'=>$password,
        ':auth_key'=>bin2hex(random_bytes(16)),
        ':status'=>10,
        ':created_at'=>time(),
        ':updated_at'=>time()
    ]);
}

/* ==========================
   DELETE USER
========================== */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM user WHERE id=:id");
    $stmt->execute([':id'=>$id]);
}

/* ==========================
   UPDATE USER
========================== */
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("
        UPDATE user 
        SET username=:username,email=:email,updated_at=:updated_at
        WHERE id=:id
    ");

    $stmt->execute([
        ':username'=>$username,
        ':email'=>$email,
        ':updated_at'=>time(),
        ':id'=>$id
    ]);
}

/* ==========================
   READ USER
========================== */
$users = $pdo->query("SELECT * FROM user")->fetchAll();
?>

<h2>CRUD USER</h2>

<h3>Tambah User</h3>
<form method="POST">
    Username<br>
    <input type="text" name="username" required><br><br>

    Email<br>
    <input type="email" name="email" required><br><br>

    Password<br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="create">Tambah</button>
</form>

<hr>

<h3>Data User</h3>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Username</th>
<th>Email</th>
<th>Aksi</th>
</tr>

<?php foreach($users as $row): ?>
<tr>
<form method="POST">
<td>
<?= $row['id'] ?>
<input type="hidden" name="id" value="<?= $row['id'] ?>">
</td>

<td>
<input type="text" name="username" value="<?= $row['username'] ?>">
</td>

<td>
<input type="text" name="email" value="<?= $row['email'] ?>">
</td>

<td>
<button name="update">Update</button>
<a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus user?')">Delete</a>
</td>
</form>
</tr>
<?php endforeach; ?>

</table>