<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//  Include the core.php file
include(__DIR__ . '/../Settings/core.php');

// INclude the general functions
include_once(__DIR__ . '/../Functions/general_function.php');

if (!logged_in()) {
    header('Location: ../index.php');
    exit();
}

// get user first name
$user_first_name = get_user_first_name($_SESSION['user_id']);

$user_id = $_SESSION['user_id'];
$first_name = $user_first_name;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://papergames.io/api/v2/game-session/player-vs-random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode(array(
        "gameType" => "TicTacToe",
        "language" => "en",
        "userId" => $user_id,
        "username" => $first_name
    )),
    CURLOPT_HTTPHEADER => array(
        "accept: /",
        "x-api-key: apiKey_778c587a42f3a40e2cd008c0720a647a2cec20561dc855d49830989cbf599b0a",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$response = json_decode($response);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    header("Location: " . $response->baseUrl);
    exit();
}
?>
