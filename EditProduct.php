<?php  
	if($_SERVER['REQUEST_METHOD'] === "GET") 
	{
		$id = $_GET["id"]; 
	}


	if($_SERVER['REQUEST_METHOD'] === "POST") 
	{
		$id = $_POST['productid'];
		$productfirstName = $_POST['productfirstname'];
		$productlastName = $_POST['productlastname'];


		// read file
		$data = file_get_contents('data.txt');

		// decode json to array
		$json_arr = json_decode($data, true);

		foreach ($json_arr as $key => $value) {
		    if ($value['product_id'] == $id) {
		        $json_arr[$key]['first_name'] = $productfirstName;
		        $json_arr[$key]['last_name'] = $productlastName;
		    }
		}

		// encode array to json and save to file
		file_put_contents('data.txt', json_encode($json_arr));
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product Edit Info</title>
</head>
<body>
 
	<h1>Product Edit Info</h1>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<fieldset>
			<legend>Edit</legend>

			<label for="productid">Product ID<span style="color: red">*</span>: </label>
			<input type="text" name="productid" id="productid" value="<?= $id ?>">
			<br><br>

			<label for="productfirstname">Product First Name<span style="color: red">*</span>: </label>
			<input type="text" name="productfirstname" id="productfirstname">
			<br><br>

			<label for="productlastname">Product Last Name<span style="color: red">*</span>: </label>
			<input type="text" name="productlastname" id="productlastname">
			<br><br>

			<input type="submit" name="submit" value="Update">
        
		</fieldset>
	</form>


</body>
</html>