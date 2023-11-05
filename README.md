<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laundry Admin Panel untuk course BWA Full Stack FLutter Laravel: Laundry Market App

-   [x] Laravel Splade
-   [x] Roles and Permissions ['Admin', 'Manager', 'Customer']
-   [x] User Dashboard Management
-   [x] Shop Dashboard Management
-   [x] Promo Dashboard Management
-   [x] Laundry Dashboard Management
-   [x] API

#### Installing
Lakukan sedikit perubahan pada aplikasi flutter seperti instruksi berikut:

Ubah 2 field pada `laundry_model.dart` seperti berikut:

```dart
class LaundryModel {
  String? pickupAddress;
  String? deliveryAddress;
}

 LaundryModel({
    this.pickupAddress,
    this.deliveryAddress,
  });
```

Ubah 2 line code pada `detail_laundry_view.dart` seperti berikut:

```dart
if (laundry.withPickup) itemDescription(laundry.pickupAddress ?? 'Address Not Found'),
if (laundry.withDelivery) itemDescription(laundry.deliveryAddress ?? 'Address Not Found'),

```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
