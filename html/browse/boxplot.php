<?php

//ini_set('display_errors', 1);

//echo $_GET['filter'];
$g=preg_replace("/[^A-Za-z0-9]/", '', $_GET['phen']);
$get = explode(' ',$g);

#$get=preg_replace("/[^A-Za-z0-9 ]/", '', explode(' ',$_GET['filter']));
# Also need to know the phenotype from table, where filter for this? Here? Report as study ID to LZ?

if (count($get)==1) {
	$phen=$get[0];

	$servername = "localhost";
	$username = get_cfg_var("dj93jd.user");
	$password = get_cfg_var("dj93jd.pass");
	$dbname = "interval";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Error: SQL connection failed: " . $conn->connect_error);
	}
	//$phen = "10:89010600:89011999:clu_91129_+";
	//$phen = "10:114601961:114821273:clu_178663_-";
	//$phen = "10:100979011:100983755:clu_178141_-";
	$sql = 'SELECT * FROM eqtl_boxplot WHERE phenotype_id="'.$phen.'"';

	// Could get the lead SNP from here to make the summstat lead SNP below just a tiny bit more signif to make LD variant
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
		$analysis = array();
		while($row = $result->fetch_assoc()) {
			//var_dump($row);
			//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			//Collect each col member in to seperate arrays
			print(json_encode(array('data'=>array(
			'phenotype_id'=>$row['phenotype_id'],
			'name1'=>$row['name1'],
			'list1'=>$row['list1'],
			'name2'=>$row['name2'],
			'list2'=>$row['list2'],
			'name3'=>$row['name3'],
			'list3'=>$row['list3']
			))));
		  }
	} else {
	  // Later just return correctly formatted blank json
	  #echo "Error: 0 results";
	}
	// Then format the arrays as json
	//var_dump($log_pvalue);
	//print "<br><br>";

} else {
	var_dump($get);
	print "Error: Invalid input token count.";
}

?>

