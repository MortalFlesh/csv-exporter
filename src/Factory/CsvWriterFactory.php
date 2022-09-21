<?php declare(strict_types=1);

namespace MF\CSVExporter\Factory;

use League\Csv;
use League\Csv\CharsetConverter;
use League\Csv\Writer;

class CsvWriterFactory
{
    public function create(): Csv\Writer
    {
        $csvWriter = Writer::createFromFileObject(new \SplTempFileObject());

        $converter = (new CharsetConverter())->outputEncoding('utf-8');
        $csvWriter->addFormatter($converter);

        return $csvWriter;
    }
}
