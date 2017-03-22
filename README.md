<a href="https://packagist.org/packages/peraleks/autoload"><img src="https://poser.pugx.org/peraleks/autoload/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/peraleks/autoload"><img src="https://poser.pugx.org/peraleks/autoload/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/peraleks/autoload"><img src="https://poser.pugx.org/peraleks/autoload/license.svg" alt="License"></a>
# Autoload
PSR-4 загрузчик классов для PHP7.

## Установка
```bash
$ composer require peraleks/autoload
```
Или скачайте [ZIP][link-zip].

## Использование
Например структура папок вашего приложения такая:
```
      project_dir
          vendor
          index.php
```

В index.php подключаем и инстанцируем ClassLoader:

```php
require __DIR__.'/vendor/peraleks/autoload/src/ClassLoader.php';

$loader = new \Peraleks\Autoload\ClassLoader(__DIR__);
```
Если вам нужно добавить в автозагрузку классы библиотеки **symfony/var-dumper**,
которые находятся в **project_dir/vendor/symfony/var-dumper** выполите:

 ```php
$loader->add('Symfony\Component\VarDumper', '/vendor/symfony/var-dumper');
```

## Лицензия

The MIT License ([MIT](LICENSE.md)).

[link-zip]: https://github.com/peraleks/autoload/releases
[link-wiki]: https://github.com/peraleks/autoload/wiki
[link-author]: https://github.com/peraleks

