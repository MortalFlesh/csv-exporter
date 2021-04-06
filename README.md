CSV Exporter
============

[![Latest Stable Version](https://img.shields.io/packagist/v/mf/csv-exporter.svg)](https://packagist.org/packages/mf/csv-exporter)
[![Total Downloads](https://img.shields.io/packagist/dt/mf/csv-exporter.svg)](https://packagist.org/packages/mf/csv-exporter)
[![License](https://img.shields.io/packagist/l/mf/csv-exporter.svg)](https://packagist.org/packages/mf/csv-exporter)
[![Tests and linting](https://github.com/MortalFlesh/csv-exporter/actions/workflows/tests.yaml/badge.svg)](https://github.com/MortalFlesh/csv-exporter/actions/workflows/tests.yaml)
[![Coverage Status](https://coveralls.io/repos/github/MortalFlesh/csv-exporter/badge.svg?branch=master)](https://coveralls.io/github/MortalFlesh/csv-exporter?branch=master)

Csv exporter for [Symfony](https://github.com/symfony/symfony)

## Installation
```bash
$ composer require mf/csv-exporter
```
or
```json
{
    "mf/csv-exporter": "^1.0"
}
```

## Requirements
- `PHP 7.4`
- [league/csv](https://github.com/thephpleague/csv)

## Usage

> For detail explanation see [this issue](https://github.com/MortalFlesh/csv-exporter/issues/2#issuecomment-782130283)

### In Symfony Controller action
```php
return (new StreamedResponseFactory(/* ...dependencies */)) // from ->get('service')
    ->createCsv(
        'filename.csv',
        [
            'columns...',
        ],
        function ($offset, $bulk) use ($repository) {
            return $repository->findBulkForExport($offset, $bulk);
        },
        function (array $row) {
            return [
                $row['key'],
            ];
        }
    );
```
