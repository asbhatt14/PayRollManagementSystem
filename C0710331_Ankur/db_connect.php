<?php
//Creating Database
//comment this code after first use..
/*	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "payRollManagement";

	$conn = mysql_connect($servername, $username, $password);
   
	if(! $conn ) {
		//die('Could not connect: ' . mysql_error());
	}
   
  /// 	echo 'Connected successfully';
   
	$sql = 'CREATE Database payRollManagement';
	$retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
     // die('Could not create database: ' . mysql_error());
   }
   
 //  echo "Database test_db created successfully\n";
   mysql_close($conn);
   //comment this code after first use..
   */
?>
<?php
//comment this code after first use..
/*$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "payRollManagement";
	$conn = mysqli_connect($servername,$username,$password,$dbname);
   
   if(! $conn ) { 
      //die('Could not connect: ' . mysql_error());
   }
   
   //echo 'Connected successfully';
   //mysql_select_db( $dbname );

   $sql = "CREATE TABLE LogIn (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30) NOT NULL,
	password VARCHAR(30) NOT NULL
	)";
  
   $retval = mysqli_query($conn,$sql);
	if(! $retval ) {
		//die('Could not create table: ' . mysql_error());
	}
	
	//echo "Table LogIn created successfully\n";

	$sql = "INSERT INTO LogIn (username, password)
	VALUES ('admin', 'admin'),('admin','admin@123')";
	
	if ($conn->query($sql) === TRUE) {
	//	echo "New record created successfully";
	} else {
	//	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	mysqli_close($conn);	
//comment this code after first use..   
*/
?>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "payRollManagement";
	
	$conn = mysqli_connect($servername,$username,$password,$dbname);
?>
