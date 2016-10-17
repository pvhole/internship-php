<html>
<body>
<?php
require 'database.php';

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_GET['id']))
       {
      $id=$_GET['id'];
      $result = $conn->prepare("DELETE FROM ice_imports WHERE id= $id");
      $result->execute();
      //session('status', 'Record Deleted');
      if($result)
       {
      header('location:list.php');
    
       }
       }
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    } 
 ?>
</body>
</html>
