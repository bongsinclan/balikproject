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

mysql_select_db($database_balikCon, $balikCon);
$query_Recordset1 = "SELECT * FROM balikislam_tbl";
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
<br/>
<br/>
<table width="582" border="1" align="center">
  <tr>
    <td width="539" align="center" class="SA">ALBURHAN BALIK ISLAM DATA</td>
  </tr>
</table>
<br/>
<br/>

<table width="1186" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10">USERID</td>
    <td width="150">NAME</td>
    <td width="150">MUSLIM NAME</td>
    <td width="5">AGES</td>
    <td width="150">ADDRESS</td>
    <td width="98">PREVIOUS RELIGION</td>
    <td width="30">UPDATE</td>
    <td width="30">DELETE</td>
    <td width="30">SEARCH</td>
    <td width="3">ADD</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['USERID']; ?></td>
      <td><?php echo $row_Recordset1['NAME']; ?></td>
      <td><?php echo $row_Recordset1['MUSLIM NAME']; ?></td>
      <td><?php echo $row_Recordset1['AGES']; ?></td>
      <td><?php echo $row_Recordset1['ADDRESS']; ?></td>
      <td><?php echo $row_Recordset1['PREVIOUS RELIGION']; ?></td>
      <td><a href="update.php?USERID=<?php echo $row_Recordset1['USERID']; ?>">UPDATE</a></td>
      <td><a href="delete.php?USERID=<?php echo $row_Recordset1['USERID']; ?>">DELETE</a></td>
      <td><a href="search.php?USERID=<?php echo $row_Recordset1['USERID']; ?>">SEARCH</a></td>
      <td><a href="insert.php?USERID=<?php echo $row_Recordset1['USERID']; ?>">ADD</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
