<?php
$name_err = "";
$message = "";
$servername = "pythondb.cw9xyd9ybmy0.us-east-1.rds.amazonaws.com";
$username = "root";
$password = "khalids226";
$dbname = "pythondb";
//mysql -h pythondb.cw9xyd9ybmy0.us-east-1.rds.amazonaws.com -port 3306 -u root -p

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
else{
  //echo "Connected";exit;
}
if($_POST){
	
	$name = trim($_POST['name']);
	
	if($name == ""){
		$name_err = "Name is empty!! Please insert a name!!";
	}
	else{
			//echo "<pre>";print_r($_POST);
		$sql = "SELECT name FROM khalid_table WHERE name = '$name'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$name_err = $name." already exist!!Try another name";
		
		}
		else {
			$fav_color = trim($_POST['fav_color']);
			$cats_dogs = trim($_POST['cats_dogs']);
			$sql = "INSERT INTO khalid_table (name, fav_color, cats_dogs)
			VALUES ('$name', '$fav_color', '$cats_dogs')";

			if (mysqli_query($conn, $sql)) {
				$message = "New record created successfully";
			} else {
				$message =  "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		
		
	}

}
?>

<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px; 
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<h2 align = "center">Form</h2>
<h2 align = "center"><?php echo $message;?></h2>


<div class="container">
  <form action="" method = "post">
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Name..">
	  <span class = "name" ><?php echo $name_err;?></span>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="fav_color">Favorite Color</label>
    </div>
    <div class="col-75">
      <input type="text" id="fav_color" name="fav_color" placeholder="Favorite Color..">
	  <span class = "fav_color" ></span>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="cats_dogs">Cat or Dog</label>
    </div>
    <div class="col-75">
      <select id="cats_dogs" name="cats_dogs">
        <option value="Cat">Cat</option>
        <option value="Dog">Dog</option>
      </select>
	  <span class = "fav_color" ></span>
    </div>
  </div>
  
    
  <div class="row">
	<input type="submit" value="Submit">
  </div>
  </form>
</div>

<div style="overflow-x:auto;">

	<?php 
		$sql = "SELECT
		khalid_table.`name`,
		khalid_table.fav_color,
		khalid_table.cats_dogs
		FROM
		khalid_table";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) { 
		$sl = 1;?>
  <table>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Favorite Color</th>
      <th>Cat or Dog</th>
    </tr>
	<?php 
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {?>
			    <tr>
				  <td><?php echo $sl;?></td>
				  <td><?php echo $row['name']?></td>
				  <td><?php echo $row['fav_color']?></td>
				  <td><?php echo $row['cats_dogs']?></td>
				</tr>
				
	<?php $sl++; } 
	} else { mysqli_close($conn);echo "No Data Found!!!";} ?>
  </table>
</div>

</body>
</html>
