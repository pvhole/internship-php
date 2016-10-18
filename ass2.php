<html lang="en">
<head>
  <title>Second Assignment...</title>
  <?php
require 'script1.php';
 ?> 
</head> 
<body>
<div class="container"style="margin-top:50px">
<p> 2. Prepare a report of transactions by Location ID</p>
  <center><h2>RECORD</h2></center>
           
  <table class="table table-striped">
  <thead>
      <tr>
        <th><center>LOCATION ID</center></th>
        <th><center>NO OF TRANSACTION</center></th>
      </tr>
    </thead>
<?php


class TableRows extends RecursiveIteratorIterator 
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() 
    {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren()
    {
        echo "<tr>";
    }

    function endChildren() 
    {
        echo "</tr>" . "\n";
    } 

}
/*
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "iodparts";*/
require 'database.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT location_id,COUNT(*) FROM ice_imports  GROUP BY location_id");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
    {
        echo $v;
    }
    
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?> 
</table>
</div>
</body>
</html>
