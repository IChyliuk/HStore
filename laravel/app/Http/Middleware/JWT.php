<?php
use Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST["email"];
$password = $_POST["password"];

    $pdo = '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    global $secret_key;
    $jwt = generate_jwt($user['id'], $secret_key);

setcookie("access_token", $jwt, time() + 3600, "/", "", false, true); // HttpOnly
header("Location: /dashboard.php");
exit;
} else {
echo "Неверный логин или пароль.";
}
}


function generate_jwt($user_id, $secret) {
    $payload = [
        'iss' => 'localhost',
        'sub' => $user_id,
        'iat' => time(),
        'exp' => time() + 3600 // 1 час
    ];
    return JWT::encode($payload, $secret, 'HS256');
}

function check_JWT($secret_key, $jwt)
{
    $token = $_COOKIE['access_token'] ?? null;

    if (!$token) {
        header("Location: /login.php");
        exit;
    }

    try {


        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        $user_id = $decoded->sub;
        // Пользователь аутентифицирован
    } catch (Exception $e) {
        // Неверный токен
        header("Location: /login.php");
        exit;
    }
}
