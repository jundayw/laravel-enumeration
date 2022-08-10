# 安装方法

命令行下, 执行 composer 命令安装:

````shell
composer require jundayw/laravel-enumeration
````

# 命令行

## 发布配置文件

```shell
php artisan vendor:publish --tag=enumeration
```

## 生成

```shell
php artisan make:enumeration Test
```

# 使用方法

## 枚举配置

```php
namespace App\Enums;

use App\Annotation\Attributes;
use App\Concerns\HasEnumeration;
use App\Contracts\Enumeration;

enum Test: string implements Enumeration
{
    use HasEnumeration;

    #[Attributes(attribute: '正常')]
    case NORMAL = 'NORMAL';
    #[Attributes(attribute: '禁用')]
    case DISABLE = 'DISABLE';
    #[Attributes(attribute: 'Attribute')]
    case NAME = 'VALUE';

}
```

## 模型配置

```php
namespace App\Models;

use App\Enums\Test;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    /**
     * @var string[]
     */
    protected $casts = [
        'state' => Test::class,
    ];

}
```

## 枚举集合

```php
use App\Enums\Test;

dd(Test::cases());
dd(Test::values());
```

## 修改器

```php
use App\Enums\Test;
use App\Models\Manager;

$manager = new Manager();
$manager->state = Test::NAME;
$manager->state = Test::from('VALUE');
$manager->state = Test::valueOf('value')->getDeclaringClass();
$manager->state = Test::valueOf('VALUE')->getDeclaringClass();
$manager->state = Test::valueOf('VALUE')->getDeclaringClass()->value;
```

## 拾取器

```php
use App\Enums\Test;
use App\Models\Manager;

$manager = (new Manager())->find(1);;
dd($manager->state);
```

## 枚举方法集合

```php
use App\Enums\TestEnum;

dd([
    Test::cases(),
    Test::NAME->name,
    Test::NAME->getName(),
    Test::NAME->value,
    Test::NAME->getValue(),
    Test::NAME->getAttribute(),
    Test::NAME->toArray(),
    Test::NAME->toJson(),
    Test::values(),
    Test::valueOf('NAME', Test::NAME)->name,
    Test::valueOf('NAME', Test::NAME)->getName(),
    Test::valueOf('NAME', Test::NAME)->value,
    Test::valueOf('NAME', Test::NAME)->getValue(),
    Test::valueOf('NAME', Test::NAME)->getAttribute(),
    Test::valueOf('value')->name,
    Test::valueOf('value')->getName(),
    Test::valueOf('value')->value,
    Test::valueOf('value')->getValue(),
    Test::valueOf('value')->getAttribute(),
    Test::valueOf('value')->getDeclaringClass(),
    Test::valueOf('value')->getDeclaringClass()->name,
    Test::valueOf('value')->getDeclaringClass()->getName(),
    Test::valueOf('value')->getDeclaringClass()->value,
    Test::valueOf('value')->getDeclaringClass()->getValue(),
    Test::valueOf('value')->getDeclaringClass()->getAttribute(),
]);
```
