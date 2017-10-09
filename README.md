CSV Exporter
============

[![Build Status](https://travis-ci.org/MortalFlesh/csv-exporter.svg?branch=master)](https://travis-ci.org/MortalFlesh/csv-exporter)
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
- `PHP 7.1`
- [league/csv](https://github.com/thephpleague/csv)

## Usage

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
