<?php

namespace Hector;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class init extends \Exception
{
    public static function handleError($no, $message, $file, $line)
    {
        throw new self($message);
    }
}

function exceptionHandler(/*\Exception*/ $exception)
{
    try {
        ob_end_clean();
    } catch (\Exception $e) {
    }

    echo '<pre>';
    echo $exception->getMessage();
    echo '<br />';
    echo $exception->getFile();
    echo '<br />';
    echo $exception->getLine();
    $trace = $exception->getTraceAsString();
    echo htmlspecialchars($trace);
    echo '</pre>';

    exit;
}

set_exception_handler('Hector\\exceptionHandler');
