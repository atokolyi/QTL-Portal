<?php

//ini_set('display_errors', 1);

//echo $_GET['filter'];
$g=preg_replace("/[^A-Za-z0-9 :\+\-\_]/", '', $_GET['filter']);
$get = explode(' ',$g);

#$get=preg_replace("/[^A-Za-z0-9 ]/", '', explode(' ',$_GET['filter']));
# Also need to know the phenotype from table, where filter for this? Here? Report as study ID to LZ?
$id=explode('=',$_SERVER['HTTP_REFERER'])[1];

if (count($get)==16) {
	$chrom=$get[7];
	$sstart=$get[11];
	$send=$get[15];
	$phen=$get[2];
	//print "Chromosome: $chrom <br> Start: $sstart <br> End: $send";

	$servername = "mysql-server";
	$username = "root";
	$password = "test";
	$dbname = "interval";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Error: SQL connection failed: " . $conn->connect_error);
	}
	//$phen = "10:89010600:89011999:clu_91129_+";
	//$phen = "10:114601961:114821273:clu_178663_-";
	//$phen = "10:100979011:100983755:clu_178141_-";
	// Could get the lead SNP from here to make the summstat lead SNP below just a tiny bit more signif to make LD variant
	$sql = 'SELECT * FROM '.$id.'_phenstats WHERE phenotype_id="'.$phen.'"';	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$lead_snp = $row['variant_rsid'];
		}
	}


	$sql = 'SELECT abs(slope/slope_se) as "zscore",slope,variant_chr,pval_nominal,variant_pos,variant_posid,variant_rsid,variant_ref,variant_alt FROM '.$id.'_sumstats WHERE phenotype_id="'.$phen.'" AND variant_pos>='.$sstart.' AND variant_pos<='.$send.' AND variant_chr="'.$chrom.'"';
	//echo $sql;

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
		$analysis = array();
	  	$beta = array();
		$chromosome = array();
		$log_pvalue = array(); // -log10	
		$position = array();
		$variant = array();
		$variant_id = array();
		$ref_allele = array();
		$alt_allele = array();
		while($row = $result->fetch_assoc()) {
			//var_dump($row);
			//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			//Collect each col member in to seperate arrays
			$analysis[] = 45;
			$beta[] = floatval($row['slope']);
			$chromosome[] = $row['variant_chr'];
			//echo $row['pval_nominal'];
			$log_pvalue[] = floatval($row['zscore']);
			if (TRUE) {
				if ($row['pval_nominal']==0) {
					#if ($row['variant_rsid']==$lead_snp) {
					#	$log_pvalue[] = 311;
					#} else {
					#	$log_pvalue[] = 310;
					#}
					$log_pvalue_real[] = 310;
				} else {
					$log_pvalue_real[] = -log10($row['pval_nominal']);
				}
			}

			$position[] = intval($row['variant_pos']);
			//$variant[] = $row['chrom'].":".$row['pos']."_".$row['ref_allele']."/".$row['alt_allele'];//$row['variant_id'];
			$variant_posid[] = $row['variant_posid'];
			$variant_rsid[] = $row['variant_rsid'];
			$ref_allele[] = $row['variant_ref'];
			$alt_allele[] = $row['variant_alt'];
		  }
	} else {
	  // Later just return correctly formatted blank json
	  //echo "Error: 0 results";
	}
	// Then format the arrays as json
	//var_dump($log_pvalue);
	//print "<br><br>";
	print(json_encode(array('data'=>array(
		'analysis'=>$analysis,
		'beta'=>$beta,
		'chromosome'=>$chromosome,
		'log_pvalue'=>$log_pvalue,
		'log_pvalue_real'=>$log_pvalue_real,
		'position'=>$position,
		'variant'=>$variant_posid,
		'variant_id'=>$variant_rsid,
		'ref_allele'=>$ref_allele,
		'alt_allele'=>$alt_allele
		))));

} else {
	var_dump($get);
	print "Error: Invalid input token count.";
}

?>

