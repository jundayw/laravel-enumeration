<?php

namespace Jundayw\LaravelEnumeration\Concerns;

use Jundayw\LaravelEnumeration\Annotation\Attributes;
use Jundayw\LaravelEnumeration\Contracts\Enumeration;
use JetBrains\PhpStorm\ArrayShape;
use ReflectionClassConstant;
use ValueError;

trait HasEnumeration
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return strtolower($this->name);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return strtolower($this->value);
    }

    /**
     * @return mixed
     */
    public function getAttribute(): mixed
    {
        $reflection = new ReflectionClassConstant($this, $this->name);

        foreach ($reflection->getAttributes(Attributes::class) as $attribute) {
            return $attribute->newInstance()->getAttribute();
        }

        return null;
    }

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string", 'value' => "string", 'attribute' => "null|string"])]
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'attribute' => $this->getAttribute(),
        ];
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return Attributes[]
     */
    public static function values(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[$case->value] = new Attributes(attribute: $case->getAttribute(), value: $case->value, name: $case->name, enumeration: $case);
        }
        return $values;
    }

    /**
     * @param string $value
     * @param Enumeration|null $default
     * @return Attributes
     */
    public static function valueOf(string $value, Enumeration $default = null): Attributes
    {
        foreach (self::values() as $attribute) {
            if (in_array($value, [$attribute->value, $attribute->getValue()])) {
                return $attribute;
            }
        }

        if ($default) {
            return self::valueOf($default->value);
        }

        throw new ValueError(sprintf('"%s" is not a valid backing value for enum "%s"', $value, get_called_class()));
    }

}
