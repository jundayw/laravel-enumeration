<?php

namespace Jundayw\LaravelEnumeration\Annotation;

use Jundayw\LaravelEnumeration\Contracts\Enumeration;
use Attribute;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JetBrains\PhpStorm\ArrayShape;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final class Attributes implements Arrayable, Jsonable
{
    public function __construct(
        public  readonly mixed $attribute,
        public  readonly mixed $value = null,
        public  readonly mixed $name = null,
        private readonly ?Enumeration $enumeration = null,
    )
    {
        //
    }

    /**
     * @return mixed|null
     */
    public function getName(): mixed
    {
        return $this->name ? strtolower($this->name) : $this->name;
    }

    /**
     * @return mixed|null
     */
    public function getValue(): mixed
    {
        return $this->value ? strtolower($this->value) : $this->value;
    }

    /**
     * @return mixed
     */
    public function getAttribute(): mixed
    {
        return $this->attribute;
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    #[ArrayShape(['name' => "mixed|null", 'value' => "mixed|null", 'attribute' => "mixed"])]
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'attribute' => $this->getAttribute(),
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options | JSON_UNESCAPED_UNICODE);
    }

    /**
     * 返回与此枚举常量的枚举类型相对应的 enum 对象
     *
     * @return Enumeration|null
     */
    public function getDeclaringClass(): ?Enumeration
    {
        return $this->enumeration;
    }

}
