# This repository contain two PHP scripts for two questions:
## CSV File to MySQL Database
This PHP script will be executed from the command line, which accepts a CSV file as input (see user.csv) and processes it. The parsed file data is to be inserted into a MySQL database. 

The user must be able to provide the CSV file as an argument when executing the file.

The PHP script will need to correctly handle the following criteria:
• CSV file will contain user data and have three columns: name, surname, email.
• CSV file will have an arbitrary list of users.
• Script will iterate through the CSV rows and insert each record into a dedicated MySQL database into the table “users”.
• The users database table will need to be created/rebuilt as part of the PHP script. This will be defined as a Command Line directive.
• Name and surname field should be set to be capitalised e.g. from “john” to “John” before being inserted into DB.
• Emails need to be set to be lower case before being inserted into DB.
• The script should validate the email address before inserting, to make sure that it is valid (valid means that it is a legal email format, e.g. “xxxx@asdf@asdf” is not a legal format). In case that an email is invalid, no insert should be made to database and an error message should be reported to STDOUT.

## Foo, Bar, Foobar
A PHP code for replacing specific numbers with foo, bar or foobar.
It scans number from 1 to 100 
• If the number is divisible by three (3) output the word “foo”
• If the number is divisible by five (5) output the word “bar”
• If the number is divisible by three (3) and five (5) output the word “foobar”. We could short the code and replace three (3) and five (5) with fifteen (15) as 3 x 5 = 15. 
