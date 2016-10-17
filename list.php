<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "iodparts";
include 'stylesheet.css';
try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->beginTransaction();
      
    $query1 = $conn->prepare("SELECT id,location_id,description,quantity,value,price FROM ice_imports LIMIT 100");
    $query1->execute();
    //$result = $query1->fetch(PDO::FETCH_ASSOC);
   echo "<table>";
   echo "<tr><th>ID</th><th>LOCATION ID</th><th>DESCRIPTION</th><th>QUANTITY</th><th>VALUE</th><th>PRICE</th><th></th><th></th><th></th></tr>";

   echo "".$_SESSION['status'];

foreach( $query1  as $row)
    {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['location_id']."</td>";
    echo "<td>".$row['description']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['value']."</td>";
    echo "<td>".$row['price']."</td>"; 
    echo"<td><a href='view.php?id=".$row['id']."'>View</a></td>";
    echo" <td><a href='edit1.php?id=".$row['id']."'>Edit</a></td>";
    echo"<td><a href='delete.php?id=".$row['id']."'>Delete</a></td>";
    echo "</tr>";
    }
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    } 
$conn = null;
?>

</table>
</body>
</html>
