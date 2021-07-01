<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP IO</title>
</head>
<body>
<h1>PHP IO</h1>

 

<?php
define("filepath", "data.txt");



$productfirstName = $productlastName = $productId = "";
$productfirstNameErr = $productlastNameErr = $productIdErr = "";
$flag = false;
$successfulMessage = $errorMessage = "";



if($_SERVER['REQUEST_METHOD'] === "POST") 
{
	$productId = $_POST['productid'];
	$productfirstName = $_POST['productfirstname'];
	$productlastName = $_POST['productlastname']; 


	if(empty($productId)) 
	{
	$productlastIdErr = "Field can not be empty";
	$flag = true;
	}

	if(empty($productfirstName))
	 {
	$productfirstNameErr = "Field can not be empty";
	$flag = true;
	}

	if(empty($productlastName)) 
	{
	$productlastNameErr = "Field can not be empty";
	$flag = true;
	}


	if(!$flag) 
	{
		/*$data[] = array("productfirstname" => $productfirstName, "productlastname" => $productlastName);

		$data_encode = json_encode($data);
		$res = write($data_encode);

		if($res) {
		$successfulMessage = "Sucessfully saved.";
		}
		else {
		$errorMessage = "Error while saving.";
		} */


		// read json file
		$data = file_get_contents("data.txt");

		// decode json
		$json_arr = json_decode($data, true);

		// add data
		$json_arr[] = array('product_id'=>$productId, 'first_name'=>$productfirstName, 'last_name'=>$productlastName);

		// encode json and save to file
		file_put_contents('data.txt', json_encode($json_arr));




		 
		if (isset($_POST['update'])) {
			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$_SESSION['message'] = " name updated!"; 
		}

		 if (isset($_GET['del'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$_SESSION['message'] = "name deleted!";
		}
	}
}



function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
$data =updatename($data);
$data= deletename($data);
return $data;
}



function write($content) 
{
$file = fopen(filepath, "a");
$fw = fwrite($file, $content . "\n");
fclose($file);
return $fw;
}
?>



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	<fieldset>
	 	<legend>Product Details:</legend>

	 		<label for="productid">Product ID<span style="color: red">*</span>: </label>
			<input type="text" name="productid" id="productid">
			<span style="color: red"><?php echo $productIdErr; ?></span>
			<br><br>

			<label for="productfirstname">ProductFirst Name<span style="color: red">*</span>: </label>
			<input type="text" name="productfirstname" id="productfirstname">
			<span style="color: red"><?php echo $productfirstNameErr; ?></span>
			<br><br>

			<label for="productlastname">ProductLast Name<span style="color: red">*</span>: </label>
			<input type="text" name="productlastname" id="productlastname">
			<span style="color: red"><?php echo $productlastNameErr; ?></span>
			<br><br>

			<input type="submit" name="submit" value="Submit">
	</fieldset>
</form>



<br>



<span style="color: green"><?php echo $successfulMessage; ?></span>
<span style="color: red"><?php echo $errorMessage; ?></span>



<?php



function read() {
$file = fopen(filepath, "r");
$fz = filesize(filepath);
$fr = "";
if($fz > 0) {
$fr = fread($file, $fz);
}
fclose($file);
return $fr;
}
?>
</body>
</html>
