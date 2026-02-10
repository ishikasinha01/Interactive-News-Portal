<?php
include("inc/db.php");

$result = mysqli_query($conn, "SHOW COLUMNS FROM news");

echo "<h2>NEWS Table Columns</h2>";

while($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . "<br>";
}
?>
