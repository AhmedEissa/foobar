# This repository contains two PHP scripts for two questions:
----
## 1. CSV File to MySQL Database
This PHP script will be executed from the command line, which accepts a CSV file as input (see user.csv) and processes it. The parsed file data is to be inserted into a MySQL database. 

The user must be able to provide the CSV file as an argument when executing the file.

The PHP script will need to handle the following criteria correctly:
* CSV file will contain user data and have name, surname, and email columns.
* CSV file will have an arbitrary list of users.
* Script will iterate through the CSV rows and insert each record into a dedicated MySQL database into the table “users”.
* The user's database table must be created/rebuilt as part of the PHP script. This will be defined as a Command Line directive.
* Name and surname field should be set to be capitalised e.g. from “john” to “John” before being inserted into DB.
* Emails need to be set to be lowercase before being inserted into DB.
* The script should validate the email address before inserting, it to ensure that it is valid (valid means that it is a legal email format, e.g. “xxxx@asdf@asdf” is not legal). In case an email is invalid, no insert should be made to the database and an error message should be reported to STDOUT.

## 1.1. Examples running from the command line:
* php Question1.php –help
* php Question1.php –create_table -u user -p password -h localhost --dry_run

----

## 2. Foo, Bar, Foobar
A PHP code for replacing specific numbers with foo, bar or foobar.
* It scans all numbers from 1 to 100 
* If the number is divisible by three (3) output the word “foo”
* If the number is divisible by five (5) output the word “bar”
* If the number is divisible by three (3) and five (5) output the word “foobar”. We could shorten the code and replace three (3) and five (5) with fifteen (15) as 3 x 5 = 15. 

## 2.2. Examples running from the command line:
* php Question2.php

