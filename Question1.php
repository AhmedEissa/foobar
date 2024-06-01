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

// Function to create the 'users' table
function createTable($conn) {
    $query = "CREATE TABLE IF NOT EXISTS tblUsers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        surname VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE
    )";
    if ($conn->query($query) === TRUE) {
        echo "Table 'users' created successfully." . PHP_EOL;
    } else {
        echo "Error creating table: " . $conn->error . PHP_EOL;
    }
    $conn->close();
    exit;
}
// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to capitalise name and surname
function capitalise($string) {
    return ucfirst(strtolower($string));
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

// Read and process the CSV file
$csv_file = $options['file'];
if (!file_exists($csv_file)) {
    die("File not found: $csv_file" . PHP_EOL);
}

//process the csv file contents if it exists
try
{
    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) != 3) {
                echo "Invalid CSV format. Each row must have 3 columns: name, surname, email" . PHP_EOL;
                continue;
            }

            list($name, $surname, $email) = $data;

            // Capitalize name and surname
            $name = capitalise($name);
            $surname = capitalise($surname);
            
            //Trim extra spaces
            $name = trim($name);
            $surname = trim($surname);

            // Removes special chars.
            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
            $surname = preg_replace('/[^A-Za-z0-9\-]/', '', $surname);
            
            // Convert email to lowercase
            $email = strtolower($email);

            // Validate email
            $emailIsValid = true;
            if (!validateEmail($email)) {
                echo "Invalid email format: $email" . PHP_EOL;
                $emailIsValid = false;
                continue;
            }

            // If dry_run option is set, do not insert into database
            if (isset($options['dry_run'])) {
                echo "Dry run: [$name, $surname, $email]" . PHP_EOL;
            } else {
                // Insert into database if email is valid.
                if ($emailIsValid){
                    $stmt = $conn->prepare("INSERT INTO tblUsers (name, surname, email) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $name, $surname, $email);
                    if ($stmt->execute()) {
                        echo "Inserted: [$name, $surname, $email]" . PHP_EOL;
                    } else {
                        echo "Error inserting [$name, $surname, $email]: " . $stmt->error . PHP_EOL;
                    }
                    $stmt->close();    
                }
                else{
                    echo "No record is added to the database, as the email $email is invalid.". PHP_EOL;
                }
            }
        }
    }
} catch (Exception $ex) {
    echo "Error opening file: $csv_file, or file not found: ".trim($ex->getMessage()).PHP_EOL;
} finally {
    fclose($handle);
    $conn->close();
}
?>
