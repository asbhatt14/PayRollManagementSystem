<?php

/**
* 
*/
class Employee
{
	
	var  $id;
	var  $name;
	var  $gender;
	var  $dob;
	var  $address;
	var  $city;
	var  $province;
	var  $zipcode;
	var  $email;
	var  $url;
	var  $joinDate;
	var  $basicPay;

	var $servername = "localhost";
	var $username = "root";
	var $password = "";
	var $dbname = "payRollManagement";
	var $conn1 = "";


	function setId($id)
	{
		$this->id = $id;
	}
	function setName($name)
	{
		$this->name = $name;
	}
	function setGender($gender)
	{
		$this->gender = $gender;
	}
	function setDob($dob)
	{
		$this->dob = $dob;
	}
	function setAddress($address)
	{
		$this->address = $address;
	}
		function setCity($city)
	{
		$this->city = $city;
	}
	function setProvince($province)
	{
		$this->province = $province;
	}
	function setZipcode($zipcode)
	{
		$this->zipcode = $zipcode;
	}
	function setEmail($email)
	{
		$this->email = $email;
	}
	function setUrl($url)
	{
		$this->url = $url;
	}
	function setJoiningDate($joinDate)
	{
		$this->joinDate = $joinDate;
	}
	function setBasicpay($basicPay)
	{
		$this->basicPay = $basicPay;
	}



	function getId()
	{
		echo $this->id ."<br/>";
	}
		function getName()
	{
		echo $this->name ."<br/>";
	}
		function getGender()
	{
		echo $this->gender ."<br/>";
	}
		function getDob()
	{
		echo $this->dob ."<br/>";
	}
		function getAddress()
	{
		echo $this->address ."<br/>";
	}
		function getCity()
	{
		echo $this->city ."<br/>";
	}
		function getProvince()
	{
		echo $this->province ."<br/>";
	}
		function getZipcode()
	{
		echo $this->zipcode ."<br/>";
	}
		function getEmail()
	{
		echo $this->email ."<br/>";
	}
		function getUrl()
	{
		echo $this->url ."<br/>";
	}
		function getJoinDate()
	{
		echo $this->joinDate ."<br/>";
	}
		function getBasicPay()
	{
		echo $this->basicPay ."<br/>";
	}

		function createConection()
		{
			
				// Create connection
				$conn = mysqli_connect($this->servername, $this->username, $this->password);

				// Check connection
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}
				mysqli_close($conn);
		}

		function createDataBase()
		{

			// Create database
				$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

				$sql = "CREATE DATABASE payRollManagement";
				if ($conn->query($sql) === TRUE) {
				    echo "Database created successfully";
				} else {
				    echo "Error creating database: " . $conn->error;
				}

		mysqli_close($conn);
	}

		function createTable()
		{

				// sql to create table
			    $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

			    mysql_select_db($this->dbname);

				$sql = "CREATE TABLE Employee (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				name VARCHAR(30) NOT NULL,
				gender VARCHAR(30) NOT NULL,
				email VARCHAR(50),
				url VARCHAR(200),
				dob TIMESTAMP,
				address VARCHAR(50),
				city VARCHAR(50),
				province VARCHAR(30),
				zipcode VARCHAR(30),
				joinDate TIMESTAMP,
				basicPay INT(10)

				)";

				if (mysqli_query($conn, $sql)) {
				    echo "Table Employee created successfully";
				} else {
				    echo "Error creating table: " . mysqli_error($conn);
				}



			mysqli_close($conn);

	}

	function insertEmployee()
	{
			$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

			mysql_select_db($this->dbname);

			//Comment Code After Inserting Record On Load
			$sql = "INSERT INTO Employee (name, gender, email, url, dob, address, city, province, zipcode, joinDate, basicPay)
			VALUES ('Ankur', 'Male','asbhatt14@gmail.com','www.gmail.com','1991-05-11','225 Van Horne','Toronto','ON','M2J2T9','2015-06-20','100000'),
			('Harsh', 'Male','harsh@gmail.com','www.yahoo.com','1991-05-11','225 Van Horne','Toronto','ON','M2J2T9','2015-08-20','200000'),
			('Zalak', 'Female','zalak@gmail.com','www.facebook.com','1982-04-10','225 Van Horne','Toronto','ON','M2J2T9','2015-09-21','300000'),
			('Palak', 'Female','palak@gmail.com','www.linkedin.com','1984-11-16','225 Van Horne','Toronto','ON','M2J2T9','2015-11-25','400000')";
			//Comment Code After Inserting Record On Load

//uncomment code after inserting record on load..
	//		$sql = "INSERT INTO Employee (name, gender, email, url, dob, address, city, province, zipcode, joinDate, basicPay)
	//		VALUES ('$this->name', '$this->gender','$this->email','$this->url','$this->dob','$this->address','$this->city','$this->province','$this->zipcode','$this->joinDate','$this->basicPay')";
//uncomment code after inserting record on load..

				if ($conn->query($sql) === TRUE) {
					//echo "New record created successfully";
				} else {
					//echo "Error: " . $sql . "<br>" . $conn->error;
				}

		$conn->close();
	}

	function updateEmployee($id){
		
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
		mysql_select_db($this->dbname);
		
		$sql = "UPDATE Employee SET 
		name = '$this->name',gender = '$this->gender',email = '$this->email',url ='$this->url',dob = '$this->dob',address = '$this->address',
		city ='$this->city',province = '$this->province',zipcode ='$this->zipcode',joinDate = '$this->joinDate',basicPay ='$this->basicPay'
		WHERE id= $id";

		if ($conn->query($sql) === TRUE) {
			//echo "Record Updated successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}


	function deleteRecords($id)
	{

		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
		mysql_select_db($this->dbname);

		// sql to delete a record
			$sql = "DELETE FROM Employee WHERE id=$id";

			if ($conn->query($sql) === TRUE) {
				echo "Record deleted successfully";
			} else {
				echo "Error deleting record: " . $conn->error;
			}

		$conn->close();
	}
	function tempConnection(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "payRollManagement";
		
		$this->conn1 = mysqli_connect($servername,$username,$password,$dbname);
	}

	function calculateMonthlyPay($annualPay){

	//	return $finalAmount;
	}
}

?>