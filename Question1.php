<?php
set_error_handler(
    function ($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);

//get passed in arguments
$csvFilePath = $argv[1];

//return the file contents if it exists
try
{
    echo file_get_contents($csvFilePath).PHP_EOL;
}
catch (Exception $ex)
{
    echo "File not found: ".trim($ex->getMessage()).PHP_EOL;
}
?>
