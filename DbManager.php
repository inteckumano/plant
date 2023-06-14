<?php
function openconnect() : PDO {
  $dsn = 'sqlsrv:server = tcp:p1ejssjw01kbtcom.database.windows.net,1433; Database = p1ejssjw01-sd01';
  $user = 'kbtdb';
  $passwd = 'k5EaV~DY';

 try {
    $conn = new PDO($dsn,$user,$passwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
 }

return $conn;

}
