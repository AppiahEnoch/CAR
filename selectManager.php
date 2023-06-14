<?php
include "config.php";

// Select all unique manager from the "washed" table and usernames from the "sysadmin" table
$sql = "(SELECT DISTINCT UPPER(TRIM(fullname)) as name FROM user1)
        UNION
        (SELECT DISTINCT username as name FROM sysadmin)";
$result = $conn->query($sql);

// Store the result in an array
$names = array();
while ($row = $result->fetch_assoc()) {
    $names[] = strtoupper($row["name"]);
}

// Convert the array to a JSON object and return it
echo json_encode($names);
?>
