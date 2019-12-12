<?php

session_start();

header('Content-Type: application/json');
require_once 'vendor/autoload.php';

$clientId = '658769113920-qk85svdu0j8prlhtht81an21de22n5k8.apps.googleusercontent.com';
$idToken = isset($_POST['id_token']) ? (string) $_POST['id_token'] : null;

if(!$idToken) {
  http_response_code(406);
  echo json_encode([
    'error' => "Le token n'existe pas !",
  ]);
  die;
}

$client = new Google_Client([
  'client_id' => $clientId
]);

try {
  $payload = $client->verifyIdToken($idToken);

} catch (Exception $e) {
  http_response_code(401);
  echo json_encode([
    'error' => "Token invalide !",
  ]);
  die;
}
$userId = $payload['sub'];

$_SESSION['uid'] = $userId;
$_SESSION['name'] = $payload['name'];
$_SESSION['email'] = $payload['email'];
$_SESSION['picture'] = $payload['picture'];

echo json_encode($payload);
?>
