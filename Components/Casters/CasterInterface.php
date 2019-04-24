<?php declare(strict_types=1);

namespace FroshTinker\Components\Casters;

use Symfony\Component\VarDumper\Cloner\Stub;

interface CasterInterface
{
    public static function getSupportedType(): string;

    public function cast($object, $array, Stub $stub, $isNested, $filter): array;
}
