<?php declare(strict_types=1);

namespace DoclerLabs\ApiClientGenerator\Command;

use DoclerLabs\ApiClientGenerator\CodeGeneratorFacade;
use DoclerLabs\ApiClientGenerator\Input\Configuration;
use DoclerLabs\ApiClientGenerator\Input\Parser;
use DoclerLabs\ApiClientGenerator\MetaTemplateFacade;
use DoclerLabs\ApiClientGenerator\Output\Meta\MetaFileCollection;
use DoclerLabs\ApiClientGenerator\Output\Meta\MetaFilePrinter;
use DoclerLabs\ApiClientGenerator\Output\Php\PhpFileCollection;
use DoclerLabs\ApiClientGenerator\Output\Php\PhpPrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    private Configuration       $configuration;
    private CodeGeneratorFacade $codeGenerator;
    private Parser              $parser;
    private PhpPrinter          $phpPrinter;
    private MetaTemplateFacade  $metaTemplate;
    private MetaFilePrinter     $templatePrinter;

    public function __construct(
        Configuration $configuration,
        Parser $parser,
        CodeGeneratorFacade $codeGenerator,
        PhpPrinter $phpPrinter,
        MetaTemplateFacade $metaTemplate,
        MetaFilePrinter $templatePrinter
    ) {
        parent::__construct();

        $this->configuration   = $configuration;
        $this->parser          = $parser;
        $this->codeGenerator   = $codeGenerator;
        $this->phpPrinter      = $phpPrinter;
        $this->metaTemplate    = $metaTemplate;
        $this->templatePrinter = $templatePrinter;
    }

    public function configure()
    {
        $this->setName('generate');
        $this->setDescription('Generate an api client based on a given OpenApi specification');
        $this->addUsage(
            'OPENAPI={path}/swagger.yaml NAMESPACE=Group\SomeApiClient PACKAGE=dh-group/some-api-client OUTPUT_DIR={path}/generated CODE_STYLE={path}/.php_cs.php ./bin/api-client-generator generate'
        );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $specification = $this->parser->parse($this->configuration->getFilePath());

        $phpFiles = new PhpFileCollection($this->configuration->getDirectory(), $this->configuration->getNamespace());
        $this->codeGenerator->generate($specification, $phpFiles);
        $this->phpPrinter->createFiles($phpFiles);

        $metaFiles = new MetaFileCollection($this->configuration->getDirectory());
        $this->metaTemplate->render($specification, $metaFiles);
        $this->templatePrinter->createFiles($metaFiles);

        return 0;
    }
}