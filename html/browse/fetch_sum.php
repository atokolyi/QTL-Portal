<?php
ini_set('display_errors', 1);
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
$phen=preg_replace("/[^A-Za-z0-9]/", '', $_GET['phenotype_id']);
 
// DB table to use
$table = $_GET['id'].'_sumstats';
 
// Table's primary key
$primaryKey = 'phenotype_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'variant_rsid', 'dt' => 0 ),
    array( 'db' => 'variant_posid', 'dt' => 1 ),
    array( 'db' => 'af', 'dt' => 2 ),
    array( 'db' => 'slope', 'dt' => 3 ),
    array( 'db' => 'pval_nominal',  'dt' => 4 ),
    array( 'db' => 'z_score_abs',  'dt' => 5 )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'test',
    'db'   => 'interval',
    'host' => 'mysql-server'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );

$ssp = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereResult=Null, $whereAll="phenotype_id='".$phen."'" );

foreach ($ssp['data'] as &$item) { 
	$item[4]=sprintf("%.2e",$item[4]);
}
 
echo json_encode($ssp);
