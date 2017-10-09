<?php

namespace MF\CSVExporter\Tests;

use MF\CSVExporter\CsvStreamRenderer;
use MF\CSVExporter\DataStreamGenerator;
use Mockery as m;

class DataStreamGeneratorTest extends AbstractTestCase
{
    /** @var DataStreamGenerator */
    private $dataStreamGenerator;

    /** @var CsvStreamRenderer|m\MockInterface */
    private $csvStreamRenderer;

    public function setUp()
    {
        $this->csvStreamRenderer = m::spy(CsvStreamRenderer::class);
        $this->dataStreamGenerator = new DataStreamGenerator($this->csvStreamRenderer);
    }

    public function testShouldGenerateCsvResponse()
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
            return isset($bulks[$offset]) ? $bulks[$offset] : [];
        };
        $formatRowData = function (array $row) {
            return $row;
        };

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
