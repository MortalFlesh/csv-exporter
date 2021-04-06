<?php declare(strict_types=1);

namespace MF\CSVExporter;

use MF\CSVExporter\Factory\CsvWriterFactory;

class CsvStreamRenderer
{
    private CsvWriterFactory $csvWriterFactory;

    public function __construct(CsvWriterFactory $csvWriterFactory)
    {
        $this->csvWriterFactory = $csvWriterFactory;
    }

    public function render(array $data): void
    {
        $writer = $this->csvWriterFactory->create();
        $writer->insertAll($data);
        $writer->output();
    }
}
