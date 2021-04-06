<?php declare(strict_types=1);

namespace MF\CSVExporter;

use MF\CSVExporter\Factory\CsvWriterFactory;

class CsvStreamRenderer
{
    public function __construct(private CsvWriterFactory $csvWriterFactory)
    {
    }

    public function render(array $data): void
    {
        $writer = $this->csvWriterFactory->create();
        $writer->insertAll($data);
        $writer->output();
    }
}
