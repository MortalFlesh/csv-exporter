<?php declare(strict_types=1);

namespace MF\CSVExporter\Factory;

use MF\CSVExporter\AbstractTestCase;
use MF\CSVExporter\DataStreamGenerator;
use Mockery as m;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamedResponseFactoryTest extends AbstractTestCase
{
    /** @var StreamedResponseFactory */
    private $streamedResponseFactory;

    /** @var DataStreamGenerator|m\Mock */
    private $dataStreamGenerator;

    protected function setUp(): void
    {
        $this->dataStreamGenerator = m::spy(DataStreamGenerator::class);
        $this->streamedResponseFactory = new StreamedResponseFactory($this->dataStreamGenerator);
    }

    public function testShouldGetStreamedResponse(): void
    {
        $filename = 'jon.snow';
        $heading = ['winter', 'is', 'coming'];
        $findBulk = function (): void {
        };
        $formatRowData = function (): void {
        };

        $response = $this->streamedResponseFactory->createCsv($filename, $heading, $findBulk, $formatRowData);
        $response->sendContent();

        $this->assertInstanceOf(StreamedResponse::class, $response);
        $this->assertSame('application/force-download', $response->headers->get('Content-Type'));
        $this->assertSame('attachment; filename="' . $filename . '"', $response->headers->get('Content-Disposition'));
        $this->dataStreamGenerator->shouldHaveReceived('generateCsv')
            ->with($heading, $findBulk, $formatRowData);
    }
}
