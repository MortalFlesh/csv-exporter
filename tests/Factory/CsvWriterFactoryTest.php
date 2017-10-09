<?php

namespace MF\CSVExporter\Tests\Factory;

use League\Csv;
use MF\CSVExporter\Factory\CsvWriterFactory;
use MF\CSVExporter\Tests\AbstractTestCase;

class CsvWriterFactoryTest extends AbstractTestCase
{
    public function testShouldGetCsvWriter()
    {
        $csvWriterFactory = new CsvWriterFactory();

        $csvWriter = $csvWriterFactory->create();

        $this->assertInstanceOf(Csv\Writer::class, $csvWriter);
        $this->assertSame('UTF-8', $csvWriter->getEncoding());
    }
}
