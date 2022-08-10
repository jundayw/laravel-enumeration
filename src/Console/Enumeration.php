<?php

namespace Jundayw\LaravelEnumeration\Console;

use Illuminate\Console\GeneratorCommand;

class Enumeration extends GeneratorCommand
{
    protected $name = 'make:enumeration';

    protected $description = 'Create a new custom enum class';

    protected $type = 'Enumeration';

    protected function getStub(): string
    {
        return view('enumeration::enumeration')->getPath();
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Enums';
    }
}
