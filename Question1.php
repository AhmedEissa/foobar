<?php
set_error_handler(
    function ($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);
// Function to print the help message
function displayHelp() {
    echo "Usage: php user_upload.php [options]" . PHP_EOL;
    echo "Options:" . PHP_EOL;
    echo "--file [csv file name]     Name of the CSV file to be processed" . PHP_EOL;
    echo "--create_table             Create the MySQL users table and exit" . PHP_EOL;
    echo "--dry_run                  Run the script without inserting into the database" . PHP_EOL;
    echo "-u                         MySQL username" . PHP_EOL;
    echo "-p                         MySQL password" . PHP_EOL;
    echo "-h                         MySQL host" . PHP_EOL;
    echo "--help                     Display this help message" . PHP_EOL;
    exit;
}

//get all the commands from the arguments
$options = getopt("", ["file:", "create_table", "dry_run", "help"], $optind);
$shortopts = "u:p:h:";
$options = array_merge($options, getopt($shortopts));

// If help option is set, display help and exit
if (isset($options['help'])) {
    displayHelp();
}

// Check required options for database connection
if (!isset($options['u']) || !isset($options['p']) || !isset($options['h'])) {
    echo "Missing database connection parameters." . PHP_EOL;
    displayHelp();
}

// Database connection details
$db_user = $options['u'];
$db_pass = $options['p'];
$db_host = $options['h'];
$db_name = 'users';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . PHP_EOL);
}

// If create_table option is set, create the table and exit
if (isset($options['create_table'])) {
    createTable($conn);
}

// If file option is not set, display help and exit
if (!isset($options['file'])) {
    echo "CSV file name is required." . PHP_EOL;
    displayHelp();
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
