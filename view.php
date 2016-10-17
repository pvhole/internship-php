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


if(isset($_GET['id']))
{
  $id=$_GET['id'];
  if(isset($_POST['submit']))
  {
   $location_id=$_POST['location_id'];
   $mode_id=$_POST['mode_id'];
   $import_date=$_POST['import_date'];
   $description=$_POST['description'];
   $mpn_entry_id=$_POST['mpn_entry_id'];
   $country_id=$_POST['country_id'];
   $hs_code=$_POST['hs_code'];
   $quantity=$_POST['quantity'];
   $unit_id=$_POST['unit_id'];
   $value=$_POST['value'];
   $price=$_POST['price'];
   $currency_id=$_POST['currency_id'];
   $importer_id=$_POST['importer_id'];
   $exporter_id=$_POST['exporter_id'];
   $importer_type=$_POST['importer_type'];
   $description_id=$_POST['description_id'];
   $source_id=$_POST['source_id'];
   $file_id=$_POST['file_id'];
   $created=$_POST['created'];
   if($query1)
   {
   header('location:list.php');
   }
  }

    $query1=$conn->prepare("SELECT * FROM ice_imports where id='$id'");
    $query1->execute();
  foreach( $query1  as $row)
   {
   ?>
<form method="post" action="">
<table>
<tr><td>ID:<input type="text" name="name" value="<?php echo $row['id']; ?>" /><br /></td></tr>

<tr><td>DESCRIPTION:<input type="text" name="description" value="<?php echo $row['description']; ?>" /><br /><br /></td></tr>
<tr><td>QUANTITY:<input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" /><br /><br /></td></tr>
<tr><td>VALUE:<input type="text" name="value" value="<?php echo $row['value']; ?>" /><br /><br /></td></tr>
<tr><td>PRICE:<input type="text" name="price" value="<?php echo $row['price']; ?>" /><br /><br /></td></tr>
<br />
>
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





