
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Hata: " . $e->getMessage());
}

$stmt = $conn->prepare("SELECT first_name, last_name, email FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıtlı Kullanıcılar</title>
</head>
<body>
    <h2>Kullanıcılar</h2>
    <table border="1">
        <thead>
            <tr>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>E-posta</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
