<?php

/**
Establishes a connection to a MySQL database using the MySQLi extension in PHP
* @param string $host The host name or IP address of the MySQL server
* @param string $id The MySQL username
* @param string $pass The MySQL password
* @param string $db The name of the database to select
* @return object|false Returns the MySQLi connection object on success, or false on failure
*/
function my_connect($host, $id, $pass, $db) {
	$connect = mysqli_connect($host, $id, $pass);
	mysqli_select_db($connect, $db);
	return $connect;
}

/**
Sets the value of an array variable to itself, or returns null if it is not set
* @param array &$ary The array variable to set
* @return mixed|null Returns the value of the array variable if it is set, or null if it is not set
*/
function set_var(&$ary) {
	if (isset($ary) == true) {
		return $ary;
	} else {
		return null;
	}

}

/**
Outputs an error message in HTML format and terminates the current script execution
* @param string $msg The error message to display
* @param bool $bool A flag indicating whether or not to display the error message (default: true)
* @return void
*/
function err_msg($msg, $bool = "1") {
	if ($bool) {
		echo "  <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
				<script>
				window.alert('$msg');
				history.go(-1);
				</script>
				";
		exit;
	}
}

?>