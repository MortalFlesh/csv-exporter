<?php

namespace MF\CSVExporter\Tests\Factory;

use MF\CSVExporter\DataStreamGenerator;
use MF\CSVExporter\Factory\StreamedResponseFactory;
use MF\CSVExporter\Tests\AbstractTestCase;
use Mockery as m;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamedResponseFactoryTest extends AbstractTestCase
{
    /** @var StreamedResponseFactory */
    private $streamedResponseFactory;

    /** @var DataStreamGenerator|m\Mock */
    private $dataStreamGenerator;

    public function setUp()
    {
        $this->dataStreamGenerator = m::spy(DataStreamGenerator::class);
        $this->streamedResponseFactory = new StreamedResponseFactory($this->dataStreamGenerator);
    }

    public function testShouldGetStreamedResponse()
    {
        $filename = 'jon.snow';
        $heading = ['winter', 'is', 'coming'];
        $findBulk = function () {
        };
        $formatRowData = function () {
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
