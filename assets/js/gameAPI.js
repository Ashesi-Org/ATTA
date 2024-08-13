var gameKey = "apiKey_7b324759ebd282437cc18f46782d91a4ba313eded7bb438b67dbfd895e97a6d8";

function callApi() {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set the request URL and method
    xhr.open("POST", "https://papergames.io/api/v2/game-session/player-vs-random");

    // Set the request headers
    xhr.setRequestHeader("Content-Type", "application/json");

    // Set the request body
    var requestBody = {
        // "key": gameKey,
        "gameType": "TicTacToe",
        "language": "en",
        "userId": "user-1234",
        "username": "John Doe"

    };
    xhr.send(JSON.stringify(requestBody));
}