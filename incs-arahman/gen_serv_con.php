<?php
	//move to outside of the root folder
	//variables
	define("Host","us-cdbr-east-06.cleardb.net"); // localhost
	define("User","b3ba2e68377492"); // root
	define("Password","b5b1af39"); //
	define("Db_Name","heroku_d312c7c5a7544bc"); // arahman_portal
	define("Conn_error","could not connect to server at this time"); // all of the rest below may be defined later
	define("db_conn_error","<div id='oops'>
							<h1 id='oops_h1'>Oops!!!</h1>
							<h1>We are sorry</h1>
							<h3>Data could not be fetched at this time</h3>
							</div>
							");
	
	//connecting to server
	$connect=mysqli_connect(Host,User,Password,Db_Name);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$data_select=mysqli_select_db($connect,Db_Name) or die(db_conn_error);		//maximum execution time exceeded on this line
	
	
	

	    
    $querysubject = mysqli_query($connect, "SELECT * FROM primary_school_classes") or die(mysqli_error($connect));
if(mysqli_num_rows($querysubject) == 0){
    mysqli_query($connect, "INSERT INTO `primary_school_classes` (`primary_class_id`, `primary_class`, `primary_class_fees`) VALUES 
    (1, 'Basic one', '1000'), (2, 'Basic two', '2000'), (3, 'Basic three', '3000'), (4, 'Basic four', '4000'), (5, 'Basic five', '5000'),
    (6, 'Basic six', '6000')");

}
	
$querysubjectsec = mysqli_query($connect, "SELECT * FROM secondary_school_classes") or die(mysqli_error($connect));
if(mysqli_num_rows($querysubjectsec) == 0){
    mysqli_query($connect, "INSERT INTO `secondary_school_classes` (`secondary_class_id`, `secondary_class`, `secondary_class_fees`) VALUES (1, 'JSS 1', '1000'), (2, 'JSS 2', '2000'), (3, 'JSS 3', '3000'), (4, 'SSS 1', '4000'), (5, 'SSS 2', '5000'), (6, 'SSS 3', '6000')");

}
	



	

	
	
	
?>