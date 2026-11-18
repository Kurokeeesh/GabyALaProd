<?php
require_once("models/pdoModel.php");

$pdo = setDB();

$username = "gabyalaprod";
$passwordHash = password_hash("Kuroko2004&**", PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (username, password) VALUES (:user, :pass)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    "user" => $username,
    "pass" => $passwordHash
]);

echo "✅ Admin inséré avec succès.";
?>
