<?php
declare(strict_types=1);

require __DIR__ . '/../database/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));

    if ($name === '' || $email === '') {
        $message = 'Name and email are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
    } else {
        try {
            $stmt = $conn->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
            $stmt->execute(['name' => $name, 'email' => $email]);
            $message = 'User added with id ' . $conn->lastInsertId() . '.';
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $message = 'That email is already registered.';
            } else {
                throw $e;
            }
        }
    }
}

$stmt = $conn->prepare('SELECT id, name, email FROM users WHERE id = :id');
$stmt->execute(['id' => 1]);
$user = $stmt->fetch();

if ($user) {
    echo "User: {$user['name']} ({$user['email']})";
} else {
    echo 'User not found';
}
?>

<h2>Add User</h2>
<?php if ($message !== ''): ?>
    <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<form method="post" action="">
    <label>
        Name:
        <input type="text" name="name" required>
    </label>
    <label>
        Email:
        <input type="email" name="email" required>
    </label>
    <button type="submit">Add User</button>
</form>
<h1
<h2>Users List </h2>
<ul>
<?php
$stmt = $conn->query('SELECT id, name, email FROM users ORDER BY id DESC');
foreach ($stmt as $row) {
    $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
    echo "<li>#{$row['id']} - {$name} ({$email})</li>";
}
?>
</ul>
