<?php
	include php.ini;
	$detailhost    = $_GET["detailhost"];
	$detailport    = $_GET["detailport"];
	$detaildbname    = $_GET["detaildbname"];
	$detailuser    = $_GET["detailuser"];
	$detailpwd    = $_GET["detailpwd"];
	$detailservicename = $_GET["servicename"];
	
	// Connects to the MYDB database described in tnsnames.ora file,
	// One example tnsnames.ora entry for MYDB could be:
	//   MYDB =
	//     (DESCRIPTION =
	//       (ADDRESS = (PROTOCOL = TCP)(HOST = mymachine.oracle.com)(PORT = 1521))
	//       (CONNECT_DATA =
	//         (SERVER = DEDICATED)
	//         (SERVICE_NAME = XE)
	//       )
	//     )
	$detailurl = '//'.$detailhost.':'.$detailport.'/'.$detailservicename;
	$conn = oci_connect($detailuser, $detailpwd, $detailurl);
	if (!$conn) { //fail
	    $e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    $response = array("success" => 0);

	} else { 
		$response = array("success" => 1);
	    echo json_encode($response);
	   	print "Connected to Oracle!";
	}

	// Close the Oracle connection
	oci_close($conn);
?>