 <?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Location_Id</th><th>Quantity</th><th>value</th><th>price</th></tr>";

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

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "iodparts";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->beginTransaction();
      
    $stmt = $conn->prepare("SELECT id,location_id,quantity,value,price FROM ice_imports WHERE quantity=0 OR value=0 OR price=0 ");

  
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
