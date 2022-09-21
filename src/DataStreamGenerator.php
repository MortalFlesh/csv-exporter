<?php declare(strict_types=1);

namespace MF\CSVExporter;

class DataStreamGenerator
{
    public const DEFAULT_BULK_SIZE = 1000;

    /** @var callable */
    private $formatRowData;
    /** @var callable */
    private $findData;

    public function __construct(private readonly CsvStreamRenderer $csvStreamRenderer)
    {
    }

    public function generateCsv(
        array $heading,
        callable $findData,
        callable $formatRowData,
        int $bulkSize = self::DEFAULT_BULK_SIZE,
    ): void {
        $this->formatRowData = $formatRowData;
        $this->findData = $findData;

        $this->csvStreamRenderer->render([$heading]);

        $offset = 0;
        while ($data = $this->getBulk($offset, $bulkSize)) {
            $offset += $bulkSize;
            $this->csvStreamRenderer->render($this->formatData($data));
        }
    }

    private function getBulk(int $offset, int $bulkSize): array
    {
        return call_user_func($this->findData, $offset, $bulkSize);
    }

    private function formatData(array $data): array
    {
        return array_map($this->formatRowData, $data);
    }
}
