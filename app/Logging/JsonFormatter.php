<?php

namespace App\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\LogRecord;

class JsonFormatter implements FormatterInterface
{
    public function format(LogRecord $record): mixed
    {
        $logData = [
            'timestamp' => $record->datetime->format('Y-m-d\TH:i:s\Z'),
            'level'     => $record->level->getName(),
            'message'   => $record->message,
        ];

        return json_encode($logData) . "\n";
    }

    public function formatBatch(array $records): mixed
    {
        $message = '';
        foreach ($records as $record) {
            $message .= $this->format($record);
        }
        return $message;
    }
}
