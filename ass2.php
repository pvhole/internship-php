<html lang="en">
<head>
  <title>Second Assignment...</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head> 
<body>
<div class="container">
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
