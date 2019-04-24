<?php declare(strict_types=1);

namespace FroshTinker\Commands;

use FroshTinker\Components\Casters\CasterInterface;
use Psy\Configuration;
use Psy\Shell;
use Shopware\Commands\ShopwareCommand;
use Shopware\Components\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TinkerCommand extends ShopwareCommand
{
    /**
     * @var CasterInterface[]
     */
    private $casters;

    public function __construct(string $name, iterable $casters)
    {
        parent::__construct($name);

        $this->casters = $casters;
    }

    protected function configure()
    {
        $this->addArgument('include', InputArgument::IS_ARRAY, 'Include file(s) before starting tinker');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getApplication()->setCatchExceptions(false);

        $config = new Configuration([
            'updateCheck' => 'never',
        ]);

        $config->getPresenter()->addCasters(
            $this->getCasters()
        );

        $shell = new Shell($config);
        $shell->addCommands($this->getCommands());
        $shell->setIncludes($input->getArgument('include'));

        return $shell->run();
    }

    protected function getCommands(): array
    {
        $commands = $this->getApplication()->all();

        foreach ($commands as $command) {
            if ($command instanceof ContainerAwareInterface) {
                $command->setContainer($this->container);
            }
        }

        return $commands;
    }

    protected function getCasters(): array
    {
        $casters = [];

        foreach ($this->casters as $caster) {
            if (!$caster instanceof CasterInterface) {
                continue;
            }

            $casters[$caster::getSupportedType()] = [$caster, 'cast'];
        }

        return $casters;
    }
}
