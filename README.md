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

use Jundayw\LaravelEnumeration\Annotation\Attributes;
use Jundayw\LaravelEnumeration\Concerns\HasEnumeration;
use Jundayw\LaravelEnumeration\Contracts\Enumeration;

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
use App\Enums\Test;
use Jundayw\LaravelEnumeration\Annotation\Attributes;

dd([
    // Test[]
    Test::cases(),
    // string
    Test::NAME->name,
    // string
    Test::NAME->getName(),
    // string
    Test::NAME->value,
    // string
    Test::NAME->getValue(),
    // mixed
    Test::NAME->getAttribute(),
    // array
    Test::NAME->toArray(),
    // string
    Test::NAME->toJson(),
    // Attributes[]
    Test::values(),
    // string
    Test::valueOf('NAME', Test::NAME)->name,
    // string
    Test::valueOf('NAME', Test::NAME)->getName(),
    // string
    Test::valueOf('NAME', Test::NAME)->value,
    // string
    Test::valueOf('NAME', Test::NAME)->getValue(),
    // mixed
    Test::valueOf('NAME', Test::NAME)->getAttribute(),
    // string
    Test::valueOf('value')->name,
    // string
    Test::valueOf('value')->getName(),
    // string
    Test::valueOf('value')->value,
    // string
    Test::valueOf('value')->getValue(),
    // mixed
    Test::valueOf('value')->getAttribute(),
    // Test
    Test::valueOf('value')->getDeclaringClass(),
    // string
    Test::valueOf('value')->getDeclaringClass()->name,
    // string
    Test::valueOf('value')->getDeclaringClass()->getName(),
    // string
    Test::valueOf('value')->getDeclaringClass()->value,
    // string
    Test::valueOf('value')->getDeclaringClass()->getValue(),
    // mixed
    Test::valueOf('value')->getDeclaringClass()->getAttribute(),
]);
```
