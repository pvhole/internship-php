<html lang="en">
<head>
  <title>First Assignment...</title>
  <?php
require 'script1.php';
 ?> 
</head> 
<body>
<div class="container">
<p> 1. Select all transactions where quantity > 100 and price > 500</p>
  <center><h2>RECORD</h2></center>
           
  <table class="table table-striped">
  <thead>
      <tr>
        <th>ID</th>
        <th>LOCATION ID</th>
        <th>QUANTITY</th>
        <th>VALUE</th>
        <th>PRICE</th>
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

require 'database.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->beginTransaction();
      
    $stmt = $conn->prepare("SELECT id,location_id,quantity,value,price FROM ice_imports where quantity>100 and price>500 ");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
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
