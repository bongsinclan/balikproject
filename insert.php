<?php require_once('Connections/balikCon.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO balikislam_tbl (USERID, NAME, `MUSLIM NAME`, AGES, ADDRESS, `PREVIOUS RELIGION`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['USERID'], "int"),
                       GetSQLValueString($_POST['NAME'], "text"),
                       GetSQLValueString($_POST['MUSLIM_NAME'], "text"),
                       GetSQLValueString($_POST['AGES'], "text"),
                       GetSQLValueString($_POST['ADDRESS'], "text"),
                       GetSQLValueString($_POST['PREVIOUS_RELIGION'], "text"));

  mysql_select_db($database_balikCon, $balikCon);
  $Result1 = mysql_query($insertSQL, $balikCon) or die(mysql_error());

  $insertGoTo = "display.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
.SA {
	font-size: 24px;
}
</style>
</head>

<body>
  <br/>
    <br/>
<table width="500
" border="1" align="center">
  <tr>
    <td width="816" align="center" class="SA"><a href="display.php">ALBURHAN BALIK ISLAM DATA</a></td>
  </tr>
</table>
<br/>

</tr>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">USERID:</td>
      <td><input type="text" name="USERID" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">NAME:</td>
      <td><input type="text" name="NAME" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MUSLIM NAME:</td>
      <td><input type="text" name="MUSLIM_NAME" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AGES:</td>
      <td><input type="text" name="AGES" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ADDRESS:</td>
      <td><input type="text" name="ADDRESS" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">PREVIOUS RELIGION:</td>
      <td><input type="text" name="PREVIOUS_RELIGION" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert Data"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>