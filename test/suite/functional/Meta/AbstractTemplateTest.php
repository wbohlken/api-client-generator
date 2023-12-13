<?php

declare(strict_types=1);

namespace DoclerLabs\ApiClientGenerator\Test\Functional\Meta;

use DoclerLabs\ApiClientGenerator\Input\Configuration;
use DoclerLabs\ApiClientGenerator\Input\FileReader;
use DoclerLabs\ApiClientGenerator\Input\Parser;
use DoclerLabs\ApiClientGenerator\Meta\TemplateInterface;
use DoclerLabs\ApiClientGenerator\Output\Meta\MetaFileCollection;
use DoclerLabs\ApiClientGenerator\Test\Functional\ConfigurationAwareTrait;
use DoclerLabs\ApiClientGenerator\Test\Functional\ConfigurationBuilder;
use PHPUnit\Framework\TestCase;

abstract class AbstractTemplateTest extends TestCase
{
    use ConfigurationAwareTrait;

    protected FileReader         $specificationReader;
    protected Parser             $specificationParser;
    protected MetaFileCollection $fileRegistry;

    protected function setUp(): void
    {
        $container = $this->getContainerWith(ConfigurationBuilder::fake()->build());

        $this->specificationReader = $container[FileReader::class];
        $this->specificationParser = $container[Parser::class];
        $this->fileRegistry        = new MetaFileCollection();
    }

    /**
     * @dataProvider exampleProvider
     */
    public function testGenerate(
        string $specificationFilePath,
        string $expectedResultFilePath,
        string $resultFileName,
        Configuration $configuration
    ): void {
        $sut = $this->sutTemplate($configuration);

        $absoluteSpecificationPath  = __DIR__ . $specificationFilePath;
        $absoluteExpectedResultPath = __DIR__ . $expectedResultFilePath;

        self::assertFileExists($absoluteSpecificationPath);
        self::assertFileExists($absoluteExpectedResultPath);

        $data          = $this->specificationReader->read($absoluteSpecificationPath);
        $specification = $this->specificationParser->parse($data, $absoluteSpecificationPath);

        $sut->render($specification, $this->fileRegistry);

        $result = $this->fileRegistry->get($resultFileName)->content;

        self::assertStringEqualsFile($absoluteExpectedResultPath, $result);
    }

    abstract public function exampleProvider(): array;

    abstract protected function sutTemplate(Configuration $configuration): TemplateInterface;
}
