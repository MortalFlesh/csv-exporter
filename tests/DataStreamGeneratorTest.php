<?php declare(strict_types=1);

namespace MF\CSVExporter;

use Mockery as m;

class DataStreamGeneratorTest extends AbstractTestCase
{
    private DataStreamGenerator $dataStreamGenerator;

    /** @var CsvStreamRenderer|m\MockInterface */
    private CsvStreamRenderer $csvStreamRenderer;

    protected function setUp(): void
    {
        $this->csvStreamRenderer = m::spy(CsvStreamRenderer::class);
        $this->dataStreamGenerator = new DataStreamGenerator($this->csvStreamRenderer);
    }

    public function testShouldGenerateCsvResponse(): void
    {
        $heading = ['winter', 'is', 'coming'];
        $firstBulk = [
            [123, 'first bulk', 'first row'],
            [234, 'first bulk', 'second row'],
        ];
        $secondBulk = [
            [456, 'second bulk', 'first row'],
            [567, 'second bulk', 'second row'],
        ];
        $bulks = [$firstBulk, $secondBulk];
        $findBulk = function ($offset, $bulkSize) use ($bulks) {
            return $bulks[$offset] ?? [];
        };
        $formatRowData = fn (array $row) => $row;

        $this->dataStreamGenerator->generateCsv($heading, $findBulk, $formatRowData, 1);

        $this->csvStreamRenderer->shouldHaveReceived('render')
            ->with([$heading])
            ->once()
            ->with($firstBulk)
            ->once()
            ->with($secondBulk)
            ->once();

        $this->assertTrue(true);
    }
}
