<?php
/*
| FOR FUTURE RELEASE
| Please enter installer password below, can be anything
|
*/
//$installer_password = '';
/* ---------------------- */


//if installer password not set, do not proceed.
//if(empty($installer_password)) die('please enter installer password at install/index.php. It can be anything.');
//-------------------


function connect($database_host='localhost', $database_name='codefight', $database_user='root', $database_password='abc') {
	if(mysql_connect($database_host, $database_user, $database_password)) {
		$data['connect'] = 'yes';
	} else {
		$data['connect'] = mysql_error();
	}
	
	if(mysql_select_db($database_name)) {
		$data['database'] = 'yes';
	} else {
		$data['database'] = mysql_error();
	}
	
	return $data;
} 
?>

<h3>Codefight Installer</h3>
<p>NOTE:: If you already have existing install, Please backup Database Before Continuing. Currently this installer doesn't support database upgrade to current installed version.</p>
<form action="index.php" method="post" name="installer" id="installer">
<?php
//***** step 1 *****
if(!isset($_POST) || empty($_POST['url'])) { 
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = preg_replace('/install(\/)?(index\.php)?/i','',$url);
?>
<h6>URL setting</h6>
<input name="step" type="hidden" id="step" value="1" />
Please enter url:  <input name="url" type="text" id="url" value="<?php echo $url; ?>" size="35" maxlength="255" />
<?php } ?>

<?php 
//***** step 2 *****
$step2=false;
if(isset($_POST['database_password']) && $_POST['step']=='1') {
	$data = connect($_POST['database_host'],$_POST['database_name'],$_POST['database_user'],$_POST['database_password']);
	if($data['connect']=='yes') {
		if($data['database']=='yes') {
			$step2=true;
			$_POST['step'] = '2';
		} else {
			echo '<div class="error"><p>Please make sure the database \'<strong>'.$_POST['database_name'].'</strong>\' exists. <br />The database returned below error:<br />'.$data['database'].'</p></div>';
		}
	} else {
		echo '<div class="error"><p>Please make sure the username and password are correct. <br />The database returned below error:<br />'.$data['connect'].'</p></div>';
	}
}

if(isset($_POST) && !empty($_POST['url']) && $step2==false) { ?>
<h6>Database setting</h6>
<input name="url" type="hidden" id="url" value="<?php echo $_POST['url']; ?>" />
<input name="step" type="hidden" id="step" value="1" />
<strong>Database Host:</strong><br />
<input name="database_host" type="text" id="database_host" value="localhost" size="35" maxlength="255" />
<br />
<strong>Database Name:</strong><br />
<input name="database_name" type="text" id="database_name" value="codefight" size="35" maxlength="255" />
<br />
<strong>Database User:</strong><br />
<input name="database_user" type="text" id="database_user" value="root" size="35" maxlength="255" />
<br />
<strong>Database Password:</strong><br />
<input name="database_password" type="password" id="database_password" value="" size="35" maxlength="255" />
<br />
<?php } ?>

<?php
//***** step 3 *****
$step3 = false;
if(isset($_POST['step']) && $_POST['step'] > 2) $step3 = true;
if($step2==true && $step3==false) {
	//$data = split('#%%#',file_get_contents('files/cmsdemo.sql.php'));
	$data = file_get_contents('files/codefight_latest.sql');
	$data = str_replace("\r", '', $data);
	$data = explode("\n\n", $data);

	$num = 0;
	foreach($data as $v) {
		$sql_part = trim($v, "\r\n; ");

		if (preg_match('/^\#/', $sql_part)) continue;

		$num = $num + 1;
		if ($sql_part) mysql_query($sql_part);
		if(mysql_error()) {
			echo mysql_error();
		}
	}

	$base_url = $_POST['url'];
	$database_host = $_POST['database_host'];
	$database_name = $_POST['database_name'];
	$database_user = $_POST['database_user'];
	$database_password = $_POST['database_password'];
	
	//config content
	$file_config_front = str_replace('%base_url%', $base_url, file_get_contents('files/config.php'));
	$file_config_front = str_replace('%index_page%', '', $file_config_front);
	
	//$file_config_admin = str_replace('%base_url%', $base_url, file_get_contents('files/config.php'));
	//$file_config_admin = str_replace('%index_page%', 'admin.php', $file_config_admin);
	
	//database content
	$file_database = str_replace('%database_host%', $database_host, file_get_contents('files/database.php'));
	$file_database = str_replace('%database_name%', $database_name, $file_database);
	$file_database = str_replace('%database_user%', $database_user, $file_database);
	$file_database = str_replace('%database_password%', $database_password, $file_database);
	
	$config1 = "../app/config/config.php";
	//$config2 = "../app/frontend/config/config.php";
	$database1 = "../app/config/database.php";
	//$database2 = "../app/frontend/config/database.php";
	
	//***** config file 1 *****
	$fh = fopen($config1, 'w+') or die("FILE: ../app/config/config.php must be writeable");
	fwrite($fh, $file_config_front);
	fclose($fh);
	
	//***** database file 1 *****
	$fh = fopen($database1, 'w+') or die("FILE: ../app/config/database.php must be writeable");
	fwrite($fh, $file_database);
	fclose($fh);
	
	//***** config file 2 *****
	/*
	$fh = fopen($config2, 'w+') or die("FILE: ../app/frontend/config.php must be writeable");
	fwrite($fh, $file_config_front);
	fclose($fh);
	*/
	
	//***** database file 2 *****
	/*
	$fh = fopen($database2, 'w+') or die("FILE: ../app/frontend/database.php must be writeable");
	fwrite($fh, $file_database);
	fclose($fh);
	*/
	
	//$step_count = 3;
	?>
<h6>Applying setting</h6>
<input name="url" type="hidden" id="url" value="<?php echo $base_url; ?>" />
<input name="database_host" type="hidden" id="database_host" value="<?php echo $database_host; ?>" />
<input name="database_name" type="hidden" id="database_name" value="<?php echo $database_name; ?>" />
<input name="database_user" type="hidden" id="database_user" value="<?php echo $database_user; ?>" />
<input name="database_password" type="hidden" id="database_password" value="<?php echo $database_password; ?>" />
<input name="step" type="hidden" id="step" value="3" />
<p><strong>ALL DONE!!!</strong></p>
<p>Please <strong>DELETE</strong> install folder or rename it.</p>
<p><a target="_blank" href="<?php echo $base_url; ?>">Click here to visit your new site.</a></p>
<p><a target="_blank" href="<?php echo $base_url; ?>admin">Click here to Login to admin.</a>[U: test@test.com, P: test]</p>
<?php } ?>


<?php
//***** step 4 *****
//$step4 = false;
//if(isset($_POST['step']) && $_POST['step'] > 3) $step4 = true;
//if($step2==true && $step3==false) {}
?>

<input name="submit" type="submit" id="submit" value="submit" />

</form>
