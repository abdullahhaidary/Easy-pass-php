<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Replace 'ochrdb' with your actual database name
$databaseName = 'ochrdb';

// Get the current date and time
$dateTime = date('Y-m-d_H-i-s');

// Set the backup filename using the format: databaseName_dateAndTime.sql
$backupFilename = $databaseName . '_' . $dateTime . '.sql';

// MySQL database credentials
$host = 'localhost';
$username = 'root';
$password = 'Rania@%123123';

// Create the command to perform the database backup
$command = "mysqldump --host={$host} --user={$username} --password={$password} {$databaseName} > {$backupFilename}";

// Execute the backup command
exec($command);

// Redirect back to dashboardVersionOld.php after the backup is complete
header("Location: dashboardVersionOld.php");
exit;
?>
