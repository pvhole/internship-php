<html>
<head>
   <?php
require 'script1.php';
 ?> 
</head>
<body>
<?php
require 'database.php';
include 'stylesheet.css';
try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->beginTransaction();
      session_start();
    $query1 = $conn->prepare("SELECT id,location_id,description,quantity,value,price FROM ice_imports LIMIT 100");
    $query1->execute();
    //$result = $query1->fetch(PDO::FETCH_ASSOC);
   ?>
  <div class="container"style="margin-top:50px">
 <center> <h1>RECORD</h1></center>
           
  <table class="table table-striped">
  <thead>
      <tr>
        <th>ID</th>
        <th>LOCATION ID</th>
        <th>DESCRIPTION</th>
        <th>QUANTITY</th>
        <th>VALUE</th>
        <th>PRICE</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php



  // echo "<table>";
  // echo "<tr><th>ID</th><th>LOCATION ID</th><th>DESCRIPTION</th><th>QUANTITY</th><th>VALUE</th><th>PRICE</th><th></th><th></th><th></th></tr>";
   $SESSION['status']='record deteted...';
   //echo "".$_SESSION['status'];

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
     echo" <td><a href='delete.php?id=".$row['id']."'>Delete</a></td>";
    
    //echo"<div class = "alert alert-success">Success! Well done its submitted.</div>"
    echo "</tr>";
    }
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    } 
$conn = null;
?>
</tbody>
</table>
 </body>
</html>
    
