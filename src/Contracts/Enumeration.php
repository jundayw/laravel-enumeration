<?php

namespace Jundayw\LaravelEnumeration\Contracts;

use Jundayw\LaravelEnumeration\Annotation\Attributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property-read  string name
 * @property-read  string value
 */
interface Enumeration extends Arrayable, Jsonable
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @return mixed
     */
    public function getAttribute(): mixed;

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string", 'value' => "string", 'attribute' => "null|string"])]
    public function toArray(): array;

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string;

    /**
     * @return Attributes[]
     */
    public static function values(): array;

    /**
     * @param string $value
     * @param Enumeration|null $default
     * @return Attributes
     */
    public static function valueOf(string $value, Enumeration $default = null): Attributes;

}
