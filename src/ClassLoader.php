<?php
/**
 * PSR-4 class loader.
 *
 * @package   Peraleks\Autoload
 * @copyright 2017 Aleksey Perevoshchikov <aleksey.perevoshchikov.n@gmail.com>
 * @license   https://github.com/peraleks/autoload/blob/master/LICENSE.md MIT
 * @link      https://github.com/peraleks/autoload
 */

declare(strict_types=1);

namespace Peraleks\Autoload;

/**
 * Class ClassLoader. PSR-4 загрузчик классов.
 *
 * Использование.
 *
 * Например структура папок вашего приложения такая:
 *     project_dir
 *          vendor
 *          index.php
 *
 * В index.php подключаем и инстанцируем ClassLoader:
 *
 * require __DIR__.'/vendor/peraleks/autoload/src/ClassLoader.php';
 *
 * $loader = new \Peraleks\Autoload\ClassLoader(__DIR__);
 *
 * Если вам нужно добавить в автозагрузку классы библиотеки symfony/var-dumper,
 * которые находятся в project_dir/vendor/symfony/var-dumper выполите:
 *
 * $loader->add('Symfony\Component\VarDumper', '/vendor/symfony/var-dumper');
 */
class ClassLoader
{
    /**
     * Соответствие пространсв имён путям в файдовой системе.
     *
     * @var array.
     */
    private $nameSpace = [];

    /**
     * Корневая директория приложения.
     *
     * @var string
     */
    private $baseDir;

    /**
     * Регистрирует функцию-загрузчик. Устанавливает корневую директорию приложения.
     *
     * @var string $baseDir Корневая директория приложения
     */
    public function __construct(string $baseDir)
    {
        spl_autoload_register(array($this, 'loader'), false, true);
        $this->baseDir = $baseDir;
    }

    /**
     * Загрузчик. Подключает файл с требуемым классом.
     *
     * @param  string $className полное имя класса
     * @return void
     */
    private function loader($className)
    {
        foreach ($this->nameSpace as $key => $value) {
            if (0 !== strpos($className, $key)) continue;

            $spaceEnd = str_replace('\\', '/', substr($className, strlen($key)));

            for ($i = 0, $c = count($value); $i < $c; ++$i) {

                $file = $this->baseDir.$value[$i].$spaceEnd.'.php';

                if ($i == ($c - 1)) {
                    include $file;
                    return;

                } elseif (file_exists($file)) {
                    include $file;
                    return;
                }
            }
        }
    }

    /**
     * Регистрирует пару: пространство имён => путь.
     *
     * Путь указывается относительно корневой директории,
     * переданной параметром $baseDir в конструктор ClassLoader.
     *
     * $loader->add('Symfony\Component\VarDumper', '/vendor/symfony/var-dumper');
     *
     * @param  string       $nameSpace пространство имён
     * @param  string|array $path      путь, соответствующий пространсту имён
     * @return ClassLoader
     */
    public function add(string $nameSpace, string $path): ClassLoader
    {
        $this->nameSpace[$nameSpace][] = $path;

        return $this;
    }
}