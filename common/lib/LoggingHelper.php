<?php


namespace common\lib;


class LoggingHelper
{
    public static function logToFile(string $error, array $stacktrace, string $filePath = null)
    {
        if (empty($filePath)) {
            $filePath = LOGGING_ERROR_FILE;
        }

        $time = date('d.m.Y H:i');
        $error = "\n\n$time $error";
        $fh = fopen($filePath, 'a');
        fwrite($fh, $error);
        fwrite($fh, "\nStack trace:\n" . print_r($stacktrace, true));
        fclose($fh);
    }

}