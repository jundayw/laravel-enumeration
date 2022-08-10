<?php

namespace DummyNamespace;

use Jundayw\LaravelEnumeration\Annotation\Attributes;
use Jundayw\LaravelEnumeration\Concerns\HasEnumeration;
use Jundayw\LaravelEnumeration\Contracts\Enumeration;

enum DummyClass: string implements Enumeration
{
    use HasEnumeration;

    #[Attributes(attribute: 'Attribute')]
    case NAME = 'VALUE';

}
