<?php declare(strict_types=1);

namespace FroshTinker\Components\Casters;

use Shopware\Components\Model\ModelEntity;
use Shopware\Components\Model\ModelManager;
use Symfony\Component\VarDumper\Cloner\Stub;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

class ModelEntityCaster implements CasterInterface
{
    /**
     * @var ModelManager
     */
    private $modelManager;

    public function __construct(ModelManager $modelManager)
    {
        $this->modelManager = $modelManager;
    }

    public static function getSupportedType(): string
    {
        return ModelEntity::class;
    }

    public function cast($object, $array, Stub $stub, $isNested, $filter): array
    {
        if (!$object instanceof ModelEntity) {
            return $array;
        }

        try {
            return $this->modelManager->toArray($object);
        } catch (ThrowingCasterException $exception) {
            return $array;
        }
    }
}
