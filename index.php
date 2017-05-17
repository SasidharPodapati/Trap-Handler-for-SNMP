<?php

$path = dirname(__FILE__);

$path1 = explode("/",$path,-1);
$path1[count($path1)+1]='db.conf';
$finalpath = implode("/",$path1);

$file = file("$finalpath");

for($i=0;$i<=4;$i++)
{
		$details=explode('"',$file[$i]);
		$array[$i]="$details[1]";
}
$host = $array[0];
$port = $array[1];
$database = $array[2];
$username = $array[3];
$password = $array[4];
 
 
$link = new mysqli($host, $username, $password, $database,$port);

?>

<html>

<head>
<!--<link rel="stylesheet" href="style.css" type="text/css"> </link>-->
</head>
        
<body>
          <body style="background-image:url('http://www.sasfit.co.uk/wp-content/uploads/2015/01/green-1.jpg')">

<center>
<div style="font-weight: bold;font-size: 30px;color:red;">ENTER THE CREDENTIALS OF MANAGER</div>

<br>
	
		<form method = "post">

    <table border="3">
		<tr> <td> IP:
		<input type="text" name="ip" required>
		</td></tr>

    <tr><td>
		Port:
		<input type="text" name="port" required>
		</td></tr>

    <tr><td>
		Community:
		<input type="text" name="community" required>
    </td></tr>

    <td>
		<input type="hidden" name="set" value="1">
		</td>
    
  <tr>  <td> 
		<input type="submit" value="Submit"> 
    </td></tr>

		</table>

		</form> 
  
		<form method="post">
    <br>
		 <input type="hidden" name="reset" value="1">
		 <!--<input type="submit" value="Delete existing credentials">--> 
		</form>

<?php

$ip = htmlspecialchars($_POST['ip']);
$port = htmlspecialchars($_POST['port']);
$com = htmlspecialchars($_POST['community']);
$set = htmlspecialchars($_POST['set']);
$reset = htmlspecialchars($_POST['reset']);
	
		$sql = "CREATE TABLE IF NOT EXISTS `sasidhartrapdevice`(`id` int(11) NOT NULL,`ip` VARCHAR(100) NOT NULL,`port` VARCHAR(40) NOT NULL,`community` VARCHAR(100) NOT NULL,PRIMARY KEY( `id` ))";
		
		$link->query($sql);

if($set==1)		
{		
		$link->query($sql);

		$sql1 = "INSERT INTO `sasidhartrapdevice` (`ip`,`port`,`community`) VALUES('$ip','$port','$com')";
		$link->query($sql1);
		$set=0;
}		

if($reset==1){

	$sql2 = "TRUNCATE `sasidhartrapdevice`";
		
	$link->query($sql2);

	$set=0;
}

?>       

<h2>DEVICE STATUS</h2>
<?php

$sql4="SELECT * FROM sasidhartraps";

$result2=$link->query($sql4);

echo '<table border="3" style="width:50%">
<tr>
<th>ID</th>
<th>Status</th>
<th>IP Address</th>
<th>Time</th>
<th>Previous status</th>
<th>Previous time</th>
</tr>';

while($row = mysqli_fetch_array($result2))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['STATUS'] . "</td>";
echo "<td>" . $row['IP'] . "</td>";
echo "<td>" . $row['TIME'] . "</td>";
echo "<td>" . $row['PREVIOUS_STATUS'] . "</td>";
echo "<td>" . $row['PREVIOUS_TIME'] . "</td>";
echo "</tr>";
}
echo "</table>";

?>

</body>
</html>
