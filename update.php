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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE balikislam_tbl SET NAME=%s, `MUSLIM NAME`=%s, AGES=%s, ADDRESS=%s, `PREVIOUS RELIGION`=%s WHERE USERID=%s",
                       GetSQLValueString($_POST['NAME'], "text"),
                       GetSQLValueString($_POST['MUSLIM_NAME'], "text"),
                       GetSQLValueString($_POST['AGES'], "text"),
                       GetSQLValueString($_POST['ADDRESS'], "text"),
                       GetSQLValueString($_POST['PREVIOUS_RELIGION'], "text"),
                       GetSQLValueString($_POST['USERID'], "int"));

  mysql_select_db($database_balikCon, $balikCon);
  $Result1 = mysql_query($updateSQL, $balikCon) or die(mysql_error());

  $updateGoTo = "display.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['USERID'])) {
  $colname_Recordset1 = $_GET['USERID'];
}
mysql_select_db($database_balikCon, $balikCon);
$query_Recordset1 = sprintf("SELECT * FROM balikislam_tbl WHERE USERID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $balikCon) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
.SA {
	font-size: 36px;
}
</style>
</head>

<body>
<br/>
<br/>
<table width="547" border="1" align="center">
  <tr>
    <td width="816" align="center" class="SA"><a href="display.php">ALBURHAN BALIK ISLAM DATA</a></td>
  </tr>
</table>
<br/>
<br/>
<br/>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">USERID:</td>
      <td><?php echo $row_Recordset1['USERID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">NAME:</td>
      <td><input type="text" name="NAME" value="<?php echo htmlentities($row_Recordset1['NAME'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MUSLIM NAME:</td>
      <td><input type="text" name="MUSLIM_NAME" value="<?php echo htmlentities($row_Recordset1['MUSLIM NAME'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AGES:</td>
      <td><input type="text" name="AGES" value="<?php echo htmlentities($row_Recordset1['AGES'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ADDRESS:</td>
      <td><input type="text" name="ADDRESS" value="<?php echo htmlentities($row_Recordset1['ADDRESS'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">PREVIOUS RELIGION:</td>
      <td><input type="text" name="PREVIOUS_RELIGION" value="<?php echo htmlentities($row_Recordset1['PREVIOUS RELIGION'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="USERID" value="<?php echo $row_Recordset1['USERID']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
