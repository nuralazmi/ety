## Proje Özeti

Güncel kur bilgisini veren 2 ayrı api ye istek atarak kur bilgilerini aldıktan sonra verileri veri tabanına kaydeder. Ardından veri tabanından okuyarak en ucuz olan para biriminin çıktısını verir.

## Kullanılanlar

- Docker
- PHP 8.3
- Redis:latest - (for cache)
- Mysql:latest
- Laravel 11
- Adapter Pattern
- Repository Pattern

## Bilgilendirme

- Kur bilgilerini veren api ye erişim sağlanamadığı durumda (yaşandı) daha önce kaydedilen response mock olarak kullanıldı.
- Veri tabanından okuyarak çıktı elde eden rota cache ile senkron ilerler. Eğer kur bilgileri güncellenirse cache yenilenir. Yüksek istek dikkate alınarak db isteği azaltıldı. Cache için redis kullanıldı.
- Para birimi isimleri dil seçeneğine göre dinamik hale getirildi. Dil parametresi get ile alındı.  
- Kur bilgilerine istek atan dosya için cron eklendi ve docker ile birlikte ayakta olacaktır.

## Çalıştırma

Terminal ekranında sırasıyla aşağıdaki komutlar çalıştırılması gerekir.

- git clone https://github.com/nuralazmi/ety.git
- cd ety
- cd api && cp .env.example .env
- docker exec -it ety_php bash
- composer install
- php artisan migrate
- service cron restart
- (Opsiyonel) php artisan fetch:exchange-data
  - Kur apilere istek atan komut. Ayrıca dil ve tarih parametrelerini de öneri olarak verecektir.

http://127.0.0.1:8011/api/exchange adresinden uygulama görüntülenir.


## Bağlantı Bilgileri


### Mysql

- HOST: 127.0.0.1
- DATABASE: ety_case 
- USER: ety_case 
- PASSWORD: ety_case
- PORT: 3311

### Redis

- HOST: 127.0.0.1
- USER: default
- PASSWORD:
- MYSQL_PORT: 6379








