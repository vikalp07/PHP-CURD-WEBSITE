<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user8357";

$conn = mysqli_connect($servername,$username,$password,$database); 
if (!$conn){
    die ("connection was not successfully because of this error".mysqli_connect_error());
}
// else{
//     echo "Connection successfully <br>";
// }
/*
// $sql = "CREATE DATABASE user8357";
// $sql = "CREATE TABLE `user8357`.`data` (`S No.` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(11) NOT NULL , `password` VARCHAR(50) NOT NULL , `Date` DATETIME NOT NULL , PRIMARY KEY (`S No.`))";
$sql = "INSERT INTO `data` (`S No.`, `username`, `password`, `Date`) VALUES ('1', 'vikalp', 'jafhkjhfakj', '2022-09-21 08:34:14.000000')";
$result = mysqli_query($conn,$sql);

if ($result){
    echo "Database table created successfully";
}
else{
    echo "Database table is not created successfully because" .mysqli_error($conn);
}
*/
?>