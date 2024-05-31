<?php
set_error_handler(
    function ($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);

//get all the commands from the arguments
$inlineCommand1 = $argv[1];
$inlineCommand2 = $argv[2];
$inlineCommand3 = $argv[3];
$inlineCommand4 = $argv[4];
$inlineCommand5 = $argv[5];
$inlineCommand6 = $argv[6];
$inlineCommand7 = $argv[7];

if (str_contains($inlineCommand,"file [")){
    echo "File option is selected: " . $inlineCommand;
} elseif (str_contains($inlineCommand,"create_table")){
    
}

/*
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
}*/
?>
