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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_POST['IDUSER'])) {
  $colname_Recordset1 = $_POST['IDUSER'];
}
mysql_select_db($database_balikCon, $balikCon);
$query_Recordset1 = sprintf("SELECT * FROM balikislam_tbl WHERE NAME LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $balikCon) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
.sa {
	font-size: 24px;
}
.DA {
}
.sa {
	font-size: 14px;
}
.SA {
	font-size: 36px;
}
.sa .sa {
	font-size: 24px;
}
</style>
</head>

<body>
<br/>
<br/>
<br/>

<table width="599" border="1" align="center">
  <tr>
    <td width="519" align="center" class="SA"><a href="display.php">ALBURHAN BALIK ISLAM DATA</a></a></td>
  </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<form name="form1" method="post" action="">
  <label for="IDUSER"><span class="sa"><span class="sa">SEARCH</span>:</span></label>
  <input name="IDUSER" type="text" class="sa" id="IDUSER" size="30">
  <input type="submit" name="button" id="button" value="SUBMIT">
</form>
<br/>

<table border="1" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td>USERID</td>
    <td>NAME</td>
    <td>MUSLIM NAME</td>
    <td>AGES</td>
    <td>ADDRESS</td>
    <td>PREVIOUS RELIGION</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['USERID']; ?></td>
      <td><?php echo $row_Recordset1['NAME']; ?></td>
      <td><?php echo $row_Recordset1['MUSLIM NAME']; ?></td>
      <td><?php echo $row_Recordset1['AGES']; ?></td>
      <td><?php echo $row_Recordset1['ADDRESS']; ?></td>
      <td><?php echo $row_Recordset1['PREVIOUS RELIGION']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
