# Php Toplu SMS API

Bu proje, bir SMS API kullanarak toplu SMS göndermeyi sağlayan bir PHP betiği içerir. Bu betik, belirli bir sağlayıcıdan alınan token ile SMS gönderimi yapmanızı sağlar.

## Özellikler

* **Kolay Entegrasyon**: Bu betik, SMS API'si ile kolayca entegre olmanızı sağlar. API'ye gönderilen istekler ve gelen yanıtlar cURL ile yönetilir.
  
* **Toplu SMS Gönderimi**: Birden fazla telefon numarasına aynı anda SMS gönderebilirsiniz. Mesajlarınızı bir liste halinde belirleyebilir ve toplu olarak gönderebilirsiniz.

* **Başlık ve Mesaj İçeriği Yönetimi**: SMS başlığı ve mesaj içeriğini dinamik olarak ayarlayabilirsiniz.

* **Türkçe Karakter Desteği**: Mesajlarınız Türkçe karakter içeriyorsa, Unicode desteğini aktif hale getirebilirsiniz.

## Başlarken

### Gereksinimler

Bu betiği çalıştırabilmek için aşağıdaki gereksinimlere ihtiyacınız vardır:

- PHP 7.0 veya daha üstü
- cURL uzantısı yüklü olmalıdır

## Kullanım

Bu PHP betiği, API ile bağlantı kurup toplu SMS göndermek için aşağıdaki adımları izler:

1. API'ye bağlantı testi yapılır.
2. Bağlantı başarılı ise, belirlediğiniz numaralara toplu SMS gönderilir.
3. İşlemin sonucu ekrana yazdırılır.

### Örnek Kod

Aşağıda, betiğin temel çalışma mantığını gösteren bir kod örneği verilmiştir:

```php
$token_value = "YOURTOKENHERE"; // Sağlayıcıdan aldığınız token anahtarı
$url = 'https://api.example.com';

$data = [
    "token" => $token_value,
    "status" => "account",
];

$headers = [
    "User-Agent: Sms-Api",
    "Content-Type: application/json"
];

// API bağlantı testi
$response = send_request($url, $data, $headers);

if ($response && $response["error"] == "false" && $response["info"] == "CONNECTED_API") {
    $bulk_data = [
        "token" => $token_value,
        "send" => "bulk",
        "to" => "905329991199",  // Örnek numaralar
        "sender_id" => "SMS",  // Mesaj başlığı
        "message_content" => "Mesaj içeriği", 
        "unicode" => false // Türkçe karakter içeriyorsa true yapın
    ];

    $response = send_request($url, $bulk_data, $headers);
    print_r($response);
} else {
    echo "API Bağlantı Hatası";
}


