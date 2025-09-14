<?php
$passwordToHash = 'Admin-27'; // <-- Put the password you want to hash here

$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

echo "Password to hash: " . htmlspecialchars($passwordToHash) . "<br><br>";
echo "Generated Hash:<br>";
echo htmlspecialchars($hashedPassword);

// You can now copy this hash and paste it directly into the `password`
// column for your 'admin' user in the database.
?>