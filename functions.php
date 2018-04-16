<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpusers";
$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if($_GET){
	if($_GET['function']=='getUsers') getUsers();
	if($_GET['function']=='addUser') addUser();
	if($_GET['function']=='delUser') delUser($_GET['id']);
	if($_GET['function']=='viewUser') viewUser($_GET['id']);
	if($_GET['function']=='updateUser') updateUser($_GET['id']);

};

function getUsers(){
$sql = "SELECT * FROM `phpuserslist`";
$result = $GLOBALS['conn']->query($sql);
if ($result->num_rows > 0) {
	$resp = '[';
    while($row = $result->fetch_assoc()) {
        $resp .= '{"id" : '.'"'.$row['id'].'",';
        $resp .= '"fname" : '.'"'.$row['fname'].'",';
        $resp .= '"lname" : '.'"'.$row['lname'].'"},';
    }
    $resp .= ']';
    $resp = str_replace(',]',']',$resp);
    echo $resp;
};
};

function addUser(){

	if(isset($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'])) {
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$number=$_POST['number'];
	};
		$sql = "INSERT INTO `phpuserslist` (`id`, `fname`, `lname`, `email`, `password`, `number`) VALUES (NULL, '".$fname."', '".$lname."', '".$email."', MD5('".$password."'), '".$number."');";
		$result = $GLOBALS['conn']->query($sql);
}

// function viewUser(){
// $sql = "SELECT * FROM `phpuserslist` WHERE `id` LIKE '".$_GET['id']."'";
// $result = $GLOBALS['conn']->query($sql);
// if ($result->num_rows > 0) {
// 	$resp = '[';
//     while($row = $result->fetch_assoc()) {
//         $resp .= '{"id" : '.'"'.$row['id'].'",';
//         $resp .= '"fname" : '.'"'.$row['fname'].'",';
//         $resp .= '"lname" : '.'"'.$row['lname'].'"},';
//     }
//     $resp .= ']';
//     $resp = str_replace(',]',']',$resp);
//     echo $resp;
// };
// };


function delUser($idParam){
	$sql = "DELETE FROM `phpuserslist` WHERE `id` = ".$idParam;
	$result = $GLOBALS['conn']->query($sql);
}

function viewUser($idParam){
	$sql = "SELECT * FROM `phpuserslist` WHERE `id` LIKE '".$idParam."'";
	$result = $GLOBALS['conn']->query($sql);
	if ($result->num_rows > 0) {
		// while($row = $result->fetch_assoc()) {
  		// 	echo "ID: ".$_GET['id']."<br>FIRST NAME: ".$row['fname']."<br>LAST NAME: ".$row['lname']."<br>EMAIL: ".$row['email']."<br>NUMBER: ".$row['number']."<br><br><a href='delete.php?id=".$row['id']."'>Delete Account</a>";
    	// }
		$resp = '[';
	    while($row = $result->fetch_assoc()) {
		    $resp .= '{"id" : '.'"'.$row['id'].'",';
	        $resp .= '"fname" : '.'"'.$row['fname'].'",';
	        $resp .= '"lname" : '.'"'.$row['lname'].'",';
	        $resp .= '"email" : '.'"'.$row['email'].'",';
	        $resp .= '"number" : '.'"'.$row['number'].'"},';
	    }	    
	    $resp .= ']';
	    $resp = str_replace(',]',']',$resp);
	    echo $resp;
}
}


function updateUser($idParam){

	if(isset($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'])) {
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$number=$_POST['number'];
	};
		$sql = "UPDATE `phpuserslist` SET `fname` = '".$fname."', `lname` = '".$lname."', `email` = '".$email."', `number` = '".$number."' WHERE `phpuserslist`.`id` = ".$_GET['id'];
		$result = $GLOBALS['conn']->query($sql);
}
?>