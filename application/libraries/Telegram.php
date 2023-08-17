<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Telegram
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function sendTelegramMessage($chatId, $text)
    {
        $botToken = '6048941815:AAE6oiBrldHON1MQ61XQ1FbO66jH6DSXBEQ';
        $apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

        $data = http_build_query([
            'chat_id' => $chatId,
            'text' => $text
        ]);

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === false) {
            return "Error: " . curl_error($curl);
        } else {
            return "Pesan berhasil dikirim!";
        }
    }
}
