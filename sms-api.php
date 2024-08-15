<?php

function send_request($url, $data, $headers) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        return "Error: " . curl_error($ch);
    }

    if ($httpcode !== 200) {
        return "HTTP Error: " . $httpcode;
    }

    curl_close($ch);
    return json_decode($response, true);
}

function main() {
    $token_value = "YOURTOKENHERE"; // Sağlayıcıdan aldığınız token anahtarı

    $data = [
        "token" => $token_value,
        "status" => "account",
    ];

    $url = 'api.example.com';
    $headers = [
        "User-Agent: Sms-Api",
        "Content-Type: application/json"
    ];

    $response = send_request($url, $data, $headers);

    if (is_array($response) && $response["error"] == "false" && $response["info"] == "CONNECTED_API") {
        $bulk_data = [
            "token" => $token_value,
            "send" => "bulk",
            "to" => "905329991199",  // Örnek yazılış: 905329991199,905329991199,905329991199
            "sender_id" => "SMS",  // Mesaj başlığı
            "message_content" => "Mesaj içeriği", 
            "unicode" => false // Türkçe karakter içeriyorsa true yapın
        ];

        $response = send_request($url, $bulk_data, $headers);
        print_r($response);
    } else {
        echo "Hata Mesajı";
    }
}

main();

?>
