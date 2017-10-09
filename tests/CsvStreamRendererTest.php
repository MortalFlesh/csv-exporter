<?php

namespace MF\CSVExporter\Tests;

use MF\CSVExporter\CsvStreamRenderer;
use MF\CSVExporter\Factory\CsvWriterFactory;

class CsvStreamRendererTest extends AbstractTestCase
{
    /** @var CsvStreamRenderer */
    private $csvStreamRenderer;

    /** @var CsvWriterFactory */
    private $csvWriterFactory;

    public function setUp()
    {
        $this->csvWriterFactory = new CsvWriterFactory();
        $this->csvStreamRenderer = new CsvStreamRenderer($this->csvWriterFactory);
    }

    public function testShouldPrintCsvData()
    {
        $data = [
            [666, 'Jon Snow', 'jon.snow@gmail.com'],
            [23, 'Jon Rain', 'jon.rain@gmail.com'],
            [39483094, 'John Smith', ''],
        ];
        $csv = '666,"Jon Snow",jon.snow@gmail.com' . PHP_EOL
            . '23,"Jon Rain",jon.rain@gmail.com' . PHP_EOL
            . '39483094,"John Smith",' . PHP_EOL
            . '';

        ob_start();
        $this->csvStreamRenderer->render($data);
        $output = ob_get_clean();

        $this->assertSame($csv, $output);
    }
}
