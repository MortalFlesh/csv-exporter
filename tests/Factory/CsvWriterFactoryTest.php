<?php declare(strict_types=1);

namespace MF\CSVExporter\Factory;

use League\Csv;
use MF\CSVExporter\AbstractTestCase;

class CsvWriterFactoryTest extends AbstractTestCase
{
    public function testShouldGetCsvWriter(): void
    {
        $csvWriterFactory = new CsvWriterFactory();

        $csvWriter = $csvWriterFactory->create();

        $this->assertInstanceOf(Csv\Writer::class, $csvWriter);
        $this->assertSame('UTF-8', $csvWriter->getEncoding());
    }
}
