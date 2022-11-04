<?php
const TOKEN = '5758056382:AAFcsmB4bzbJPV8hqRI9m8ZD21z6WuUMey8';
const BASE_URL = 'https://api.telegram.org/bot' . TOKEN . '/';


function sendRequest($method, $params = [])
{
    if (!empty($params)) {
        $url = BASE_URL . $method . '?' . http_build_query($params);
    } else {
        $url = BASE_URL . $method;
    }
    return json_decode(
        file_get_contents($url),
        JSON_OBJECT_AS_ARRAY
    );
}
$updates = sendRequest('getUpdates');

foreach ($updates['result'] as $update) {
    $chat_id = $update['message']['chat']['id'];
    $text = strrev($update['message']['text']);
    sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => $text]);
}
