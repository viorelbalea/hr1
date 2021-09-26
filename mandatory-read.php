<html>
<head>
	<title>HR Executive</title>
    <link href="images/style2.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
	<!--
	function confirmation() {
		var answer = confirm("Continuarea folosirii aplicatiei implica luarea la cunostinta a informatiilor urmatoare. \nSunteti de acord sa cititi documentele?")
		if (!answer){
			window.location = "./?doLogout=1";
		}
		else{
			window.location = "./mandatory-read.php?showDocs=1";
		}
	}
	//-->
	</script>
</head>
<body <?php if(!isset($_GET['showDocs'])) echo 'onload="confirmation()"'; ?> >

<?php 


include('libs/Config.php'); 
include('libs/ConfigData.php');
include('libs/DB.class.php'); 
include('libs/Library.php');
include('libs/PersonLibrary.php');
include('libs/Utils.php');

session_start();

// Unset $_SESSION['USER_ID'] to force logout
//$_SESSION['TMP_USER_ID'] = $_SESSION['USER_ID'];
//unset($_SESSION['USER_ID']);

@$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$docs = array();
$docs_function = Library::getUnreadDocs($_SESSION['PERS']);
$docs_pers = PersonLibrary::getUnreadDocs($_SESSION['PERS']);
$docs[] = $docs_function;
$docs[] = $docs_pers;
//Utils::pa($docs);

if(!empty($_SESSION['PERS']) && $_GET['showDocs']==1 && !empty($docs_function))
	foreach($docs_function as $doc){
		$_SESSION['MANDATORY_DOCS'][$doc['MandatoryID']]=$doc;
	}

if(!empty($_SESSION['PERS']) && $_GET['showDocs']==1 && !empty($docs_pers))
	foreach($docs_pers as $doc){
		$_SESSION['MANDATORY_DOCS_PERS'][$doc['DocID']]=$doc;
	}
	
//$_SESSION['MANDATORY_DOCS']=array();
//Utils::pa($_SESSION);

// Mark docs that have been read
if(!empty($_SESSION['PERS']) && !empty($_GET['MandatoryID'])){
	$doc_url = $_SESSION['MANDATORY_DOCS'][$_GET['MandatoryID']]['FileName'];
	// Mark as read
	Library::markRead($_SESSION['PERS'], $_GET['MandatoryID']);
	// Delete from $_SESSION
	$_SESSION['MANDATORY_DOCS'][$_GET['MandatoryID']]='';
	header("Location: ".$doc_url);
}

if(!empty($_SESSION['PERS']) && !empty($_GET['DocID'])){
	$doc_url = $_SESSION['MANDATORY_DOCS_PERS'][$_GET['DocID']]['curr_filename'];
	// Mark as read
	PersonLibrary::markRead($_SESSION['PERS'], $_GET['DocID']);
	// Delete from $_SESSION
	$_SESSION['MANDATORY_DOCS_PERS'][$_GET['DocID']]='';
	header("Location: ".$doc_url);
}

// Reconditionate $_SESSION['USER_ID'] and delete temporary data
if(empty($docs_function)){
	//$_SESSION['USER_ID'] = $_SESSION['TMP_USER_ID'];
	//unset($_SESSION['TMP_USER_ID']);
	unset($_SESSION['MANDATORY_DOCS']);
}
if(empty($docs_function)){
	unset($_SESSION['MANDATORY_DOCS_PERS']);
}

?>

<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="images/logo.png" align="bottom"></td>
	</tr>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu" colspan="2"><span class="TitleBox">Lista documente</span></td>
    </tr>
    <?php 
    	if(!empty($docs_function))
    	foreach($docs_function as $doc){
			$doc_url = $_SESSION['MANDATORY_DOCS'][$doc['MandatoryID']]['FileName'];
			if($doc_url!='')
				$doc_url = "docs/72e6f6e0f08ca88f02b1480464afd55b/".str_replace(' ','-',$doc_url);
	
			?>
	    <tr height="30">
	        <td class="celulaMenuST"><?php echo $doc['DocName']?></td>
	        <td class="celulaMenuSTDR">
			<a href="<?php 
			echo $doc_url
			//echo './mandatory-read.php?showDocs=1&MandatoryID='.$doc['MandatoryID']
			?>" title="" class="blue" target="_blank" onclick="window.location.href='mandatory-read.php?showDocs=1&MandatoryID=<?=$doc['MandatoryID']?>';">Deschide</a></td>
	    </tr>
    <?php }
    	else{ ?>
    	<tr height="30"><td class="celulaMenuSTDR">Nu exista documente </td></tr>
    	<?php }?>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu" colspan="2"><span class="TitleBox">Lista documente personale</span></td>
    </tr>
    <?php 
    	if(!empty($docs_pers))
    	foreach($docs_pers as $doc){?>
	    <tr height="30">
	        <td class="celulaMenuST"><?php echo $doc['DocName']?></td>
	        <td class="celulaMenuSTDR"><a href="<?php echo './mandatory-read.php?showDocs=1&DocID='.$doc['DocID']?>" title="" class="blue">Deschide</a></td>
	    </tr>
    <?php }
    	else{ ?>
    	<tr height="30"><td class="celulaMenuSTDR">Nu exista documente </td></tr>
    	<?php }?>
</table>
<br>
<?php 
if(empty($docs_function) && empty($docs_pers)){
?>
<input type="button" value="Am terminat de citit" onclick="window.location='./';" class="formstyle">
<?php }?>

<input type="button" value="Actualizeaza lista" onclick="window.location='./mandatory-read.php?showDocs=1';" class="formstyle">



</body>
</html>