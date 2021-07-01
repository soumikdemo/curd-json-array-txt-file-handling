
<!DOCTYPE html>
<html>
<head>
<meta cherset = "utf-8">
<title>Product List</title>

</head>
<body>


<?php
// load file
$data = file_get_contents("data.txt");

// decode json to associative array
$json_arr = json_decode($data, true);
//echo gettype($json_arr);

?>
  	


 <h1>Product List </h1>
<br>
<table style="border: 1px solid black">

  <tr>
    <th>Product ID</th>
    <th>Product Firstname</th>
    <th>Product Lastname</th>
    <th>Action</th>
  </tr>
<?php 
	for($i = 0 ; $i < count($json_arr) ; $i++) {

   //echo  $json_arr[$i]['Code'] . " - " .  $json_arr[$i]['Name'] . "<br/>";
	//echo $json_arr[0]['Code'];
?>
  <tr>
    <td><?= $json_arr[$i]['product_id'] ?></td>
    <td><?= $json_arr[$i]['first_name'] ?></td>
    <td><?= $json_arr[$i]['last_name'] ?></td>
    <td>
    	<button type="button" onclick="EditPage(this)" value="<?= $json_arr[$i]['product_id'] ?>">Edit</button>
    	<button type="button" onclick="DeletePage(this)" value="<?= $json_arr[$i]['product_id'] ?>">Delete</button>
    </td>
  </tr>

<?php } ?>
  </table>
	




	<script>
	function EditPage(elem){
	    location.href = "EditProduct.php" + "?id=" + elem.value;
	};

	function DeletePage(elem){
	    location.href = "DeleteProduct.php" + "?id=" + elem.value;
	};
	</script>

</body>
</html>