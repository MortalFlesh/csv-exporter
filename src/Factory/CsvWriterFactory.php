<?php declare(strict_types=1);

namespace MF\CSVExporter\Factory;

use League\Csv;

class CsvWriterFactory
{
    public function create(): Csv\Writer
    {
        $csvWriter = new Csv\Writer(new \SplTempFileObject());
        $csvWriter->setEncoding('utf-8');

        return $csvWriter;
    }
}
