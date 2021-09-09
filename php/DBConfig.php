<?php
$ini_array = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/../config.ini", true, INI_SCANNER_RAW);
// print_r($ini_array['mysqlDB']);

$con = mysqli_connect($ini_array['mysqlDB']['host'], $ini_array['mysqlDB']['user'], $ini_array['mysqlDB']['pass'], $ini_array['mysqlDB']['db'], $ini_array['mysqlDB']['port']);

if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
// echo "<br>";
// echo "Host information: " . mysqli_get_host_info($con) . PHP_EOL;

// mysqli_close($con);
?>