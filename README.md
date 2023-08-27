# Symfony Messenger ile Asenkron Pub-Sub Tasarımı Örneği

Bu repository, "PHPKonf - Türkiye" konferansında sunulan "Symfony Messenger ile Asenkron Pub-Sub Tasarımı" başlıklı sunumun parçasıdır. Bu README.md dosyası, projenin nasıl kurulup çalıştırılacağına dair adım adım talimatları içermektedir.
Bu proje, Symfony 6.3 ve PHP 8.1 kullanılarak geliştirilmiştir.

## Kullanılan Teknolojiler

- PHP 8.1
- Symfony 6.3
- Symfony Messenger Component
- Docker
- RabbitMQ

## Başlamadan Önce

Projeyi yerel makinenizde çalıştırmak için aşağıdaki adımları takip edebilirsiniz:

1. Projeyi bilgisayarınıza klonlayın:
```
git clone https://github.com/yasincetintas/symfony-messenger.git
cd symfony-messenger
```

2. Gerekli bağımlılıkları yüklemek için:
```
composer install
```

3. Docker konteynerlarını başlatmak için:
```
docker-compose up -d
```

4. Veritabanını oluşturmak için:
```
docker exec -it symfony-app bash -c "bin/console doctrine:migrations:migrate"
```

5. Uygulama şimdi http://localhost/ adresinden erişilebilir olmalıdır.

6. RabbitMQ yönetim arayüzüne erişmek için http://localhost:15672 adresini ziyaret edebilirsiniz. Kullanıcı adı: `admin`, şifre: `123456`.

7. Veritabanı erişimi için kullanıcı adı: `user`, şifre: `password` kullanılabilir.

## Uyarı

Bu proje bir örnek amacıyla oluşturulmuştur. Gerçek bir uygulama geliştirilirken güvenlik ve performans önlemlerinin alınması önemlidir.

## İletişim

Herhangi bir soru veya geri bildiriminiz varsa, lütfen [ysnctnts@gmail.com](mailto:ysnctnts@gmail.com) adresine e-posta göndermekten çekinmeyin.
Etkinlik adresi: https://phpkonf.org/

Sunum İçeriği: https://docs.google.com/presentation/d/1mq3kE7GQNqAHAIZUtk1JVRgjqxyDu33zeCNFuCw41oE/edit?usp=sharing