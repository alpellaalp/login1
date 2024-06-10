
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];


if ($password !== $confirmPassword) {
    die("Şifreler eşleşmiyor.");
}

if (strlen($password) < 6) {
    die("Şifre en az 6 karakter olmalıdır.");
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
if ($stmt->fetchColumn() > 0) {
    die("Bu e-posta adresi zaten kayıtlı.");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, birthdate, gender) VALUES (:first_name, :last_name, :email, :password, :birthdate, :gender)");
$stmt->bindParam(':first_name', $firstName);
$stmt->bindParam(':last_name', $lastName);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashedPassword);
$stmt->bindParam(':birthdate', $birthdate);
$stmt->bindParam(':gender', $gender);

if ($stmt->execute()) {
    echo "Kayıt başarılı!";
} else {
    echo "Kayıt sırasında bir hata oluştu.";
}
?>
