<html>
<head>
<?php
require 'script1.php';
 ?> 
</head>
<body>
<div class="container">
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
<form class="form-horizontal"method="post"action="">
<center><h1>EDIT DATA</h1></center>
<div class="form-group">
      <label for="usr">ID:</label>
      <input type="text" class="form-control"name="id" id="disabledInput"value="<?php echo $row['id']; ?>"disabled>
 </div>
<div class="form-group">
      <label for="usr">LOCATION ID:</label>
      <input type="text" class="form-control"name="location_id" id="disabledInput"value="<?php echo $row['location_id']; ?>" readonly>
 </div>
<div class="form-group">
      <label for="usr">DESCRIPTION::</label>
      <input type="text" class="form-control"name="description" id="focusedInput" value="<?php echo $row['description']; ?>">
 </div>
<div class="form-group">
      <label for="usr">QUANTITY:</label>
      <input type="text" class="form-control"name="quantity" value="<?php echo $row['quantity']; ?>">
 </div>
<div class="form-group">
      <label for="usr">VALUE:</label>
      <input type="text" class="form-control"name="value" value="<?php echo $row['value']; ?>">
 </div>
<div class="form-group">
      <label for="usr">PRICE:</label>
      <input type="text" class="form-control" name="price"value="<?php echo $row['price']; ?>">
 </div>
<center><input type="submit" name="submit" class="btn btn-primary btn-lg"value="update" /></center>
</div>
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




