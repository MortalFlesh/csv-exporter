<?php

namespace MF\CSVExporter\Factory;

use MF\CSVExporter\DataStreamGenerator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamedResponseFactory
{
    /** @var DataStreamGenerator */
    private $dataStreamGenerator;

    public function __construct(DataStreamGenerator $dataStreamGenerator)
    {
        $this->dataStreamGenerator = $dataStreamGenerator;
    }

    public function createCsv(
        string $filename,
        array $heading,
        callable $findBulk,
        callable $formatRowData
    ): StreamedResponse {
        $response = new StreamedResponse(function () use ($heading, $findBulk, $formatRowData) {
            $this->dataStreamGenerator->generateCsv($heading, $findBulk, $formatRowData);
        });

        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}