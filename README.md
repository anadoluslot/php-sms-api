# Toplu Sms Apisi

# Bu PHP kodu, bir API'ye istek göndermek için kullanılan bir fonksiyon (send_request) ve bu fonksiyonun kullanıldığı bir main fonksiyonundan oluşmaktadır. Kodun işleyişi ve kullanımı aşağıda açıklanmıştır:

# 1. send_request Fonksiyonu
# Bu fonksiyon, bir URL'ye belirli veriler ($data) ve başlıklar ($headers) ile HTTP POST isteği göndermek için kullanılır. Fonksiyonun adım adım açıklaması:

# curl_init($url): Belirtilen URL'ye bir cURL oturumu başlatır.
# curl_setopt($ch, CURLOPT_POST, true): HTTP POST isteği yapılacağını belirtir.
# curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)): POST isteğiyle gönderilecek verileri JSON formatında ayarlar.
# curl_setopt($ch, CURLOPT_HTTPHEADER, $headers): İsteğe özel başlıklar ekler (örneğin, içerik türü ve kullanıcı ajanı).
# curl_setopt($ch, CURLOPT_RETURNTRANSFER, true): İsteğin sonucunun doğrudan çıktılanmasını değil, fonksiyon tarafından döndürülmesini sağlar.
# curl_exec($ch): İsteği yürütür ve sonuçları $response değişkenine kaydeder.
# curl_getinfo($ch, CURLINFO_HTTP_CODE): HTTP durum kodunu alır ve $httpcode değişkenine kaydeder.
# curl_errno($ch): cURL'de bir hata olup olmadığını kontrol eder. Varsa hata mesajını döndürür.
# $httpcode !== 200: HTTP durum kodunun 200 (başarılı) olup olmadığını kontrol eder. Eğer değilse, bir HTTP hata mesajı döndürür.
# curl_close($ch): cURL oturumunu kapatır.
# json_decode($response, true): Dönen JSON verilerini PHP dizisine dönüştürür ve fonksiyonun sonucunu döndürür.

# 2. main Fonksiyonu
# Bu fonksiyon, API ile bağlantı kurmak ve toplu SMS göndermek için gerekli adımları içerir.

# $token_value: Sağlayıcıdan alınan token anahtarıdır. Bu, API'ye kimlik doğrulama için gereklidir.
# $data: İlk istek için gönderilen veriler. Bu örnekte, API'nin bağlantısını test etmek için "status" değeri "account" olarak ayarlanmıştır.
# $url: API'nin URL'si. Bu, gerçek bir URL ile değiştirilmelidir (örneğin, 'https://api.example.com').
# $headers: İsteğin başlıklarıdır. Bu örnekte, içerik türü application/json ve kullanıcı ajanı Sms-Api olarak ayarlanmıştır.

# Adımlar:
# Bağlantı Testi: send_request fonksiyonu çağrılır ve API'ye bağlantı testi yapılır. Eğer başarılıysa (error == "false" ve info == "CONNECTED_API"), toplu SMS gönderme işlemi başlatılır.

# Toplu SMS Gönderme: API bağlantısı başarılı olduğunda, bulk_data dizisi hazırlanır ve bir sonraki istekle API'ye toplu SMS gönderilir. Bu dizide şunlar yer alır:
# to: SMS gönderilecek numaralar (virgülle ayrılmış).
# sender_id: SMS başlığı.
# message_content: Gönderilecek mesajın içeriği.
# unicode: Mesajın Türkçe karakter içerip içermediği (doğruysa true, değilse false).

# Sonuçların Yazdırılması: send_request fonksiyonu tekrar çağrılır ve sonucu yazdırılır.

# Kullanımı
# Bu kodu PHP dosyası olarak kaydedin (örneğin, sms_api.php).
# Dosya içerisinde, $token_value, $url, ve diğer parametreleri kendi API'nize göre güncelleyin.
# Ardından, terminalden veya tarayıcıdan bu dosyayı çalıştırarak toplu SMS gönderimini test edin.
