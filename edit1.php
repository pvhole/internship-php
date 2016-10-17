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
  if(isset($_POST['submit']))
  {
   //$location_id=$_POST['location_id'];
   $description=$_POST['description'];
   $quantity=$_POST['quantity'];
   $value=$_POST['value'];
   $price=$_POST['price'];
 
   $query3=$conn->prepare("UPDATE ice_imports SET description='$description',quantity='$quantity',value='$value',price='$price' where id='$id'    ");
   $query3->execute();  
   if($query3)
   {
   header('location:list.php');
   }
  }

    $query1=$conn->prepare("SELECT id,location_id,description,quantity,value,price FROM ice_imports where id='$id'");
    $query1->execute();


   foreach( $query1  as $row)
   {
   ?>
<form method="post" action="">
ID:<input type="text" name="name" value="<?php echo $row['id']; ?>" /><br />

DESCRIPTION:<input type="text" name="description" value="<?php echo $row['description']; ?>" /><br /><br />
QUANTITY:<input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" /><br /><br />
VALUE:<input type="text" name="value" value="<?php echo $row['value']; ?>" /><br /><br />
PRICE:<input type="text" name="price" value="<?php echo $row['price']; ?>" /><br /><br />
<br />
<input type="submit" name="submit" value="update" />
</form>
<?php
}
}
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    } 
$conn = null;

?>
</body>
</html>





