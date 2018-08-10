<?php
$con = mysqli_connect("localhost", "root", "gF8axs", "social");

if (mysqli_connect_errno()) {
   echo "failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES ('2', 'Optimis')");

?>

<!DOCTYPE html>
<html>
<head>
   <title>Welcome to Swirlfeed</title>
</head>
<body>
   Hello Reece!!!!!
</body>
</html>