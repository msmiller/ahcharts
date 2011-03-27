<HTML>
<head>
	<style type="text/css" media="screen">
		@import url( ./style.css );
	</style>
	<meta name="keywords" content="aces high, fighter performance, charts, gonzoville.com" />
		<meta name="description" content="Aces High fighter performance charts on gonzoville.com" />
<link rel="SHORTCUT ICON" href=favicon.ico>
<?PHP
require("config.php");

if ((sizeof($_POST) < 2) && (sizeof($_GET) == 0)) {
	$title = "Aces High Fighter Comparison";
} else {
	$i = 0;
	$title = "Aces High Fighter Comparison : ";
	if (sizeof($_GET) > 0) {
		foreach ($_GET as $key => $val) {		if ($i < 5) {
			$title .= $planes[$val][0]."&nbsp;&nbsp;";
			$i++;
		}

		}
	} else {
		foreach ($_POST as $key => $val) {
			if ($val != "Submit") { // Skip "Submit"
				if ($i < 5) {
					$title .= $planes[$key][0]."&nbsp;&nbsp;";
					$i++;
				}
			}
		}
	}
}
?>
<title><?php echo $title; ?></title>
<script src="http://www.siliconchisel.com/mint-gv2/?js" type="text/javascript"></script>
</head>
<BODY>

<?php



//include charts.php to access the InsertChart function
include "charts.php";

print("<table width='100%' cellspacing='0' cellpadding='2' class='wrapper'><tr>\n");
print("<td colspan='2' align='center' valign='top' bgcolor='#555555'>\n");

print('<b><h1 class="title" style="font-size: 24px; color: #eeeeee; font-family:helvetica,arial,sans-serif;"><a href="index.php">ACES HIGH&trade; FIGHTER PERFORMANCE COMPARISON</a></h1>');
print("</td>\n");

print("</tr><tr>\n");

print("<td valign='top' width='150' bgcolor='#555555'>\n");
print('<form id="form1" name="form1" method="post" action="index.php">');
//print('<form id="form1" name="form1" method="get" action="index.php">');

print('<table bgcolor="#777777" class="inner" width="100%" cellpadding="0" cellspacing="0">');

print('<tr><td bgcolor="#555555" align="center">&nbsp;</td></tr>');
print('<tr><td bgcolor="#555555" align="center"><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;<input type="reset" name="Submit2" value="Reset" /></td></tr>');
print('<tr><td bgcolor="#555555" align="center">&nbsp;</td></tr>');
print('<tr><td style="color: #cccccc;" align="center">Select 4 planes for<br>data comparison.</td></tr>');
foreach ($countries as $key => $val) {
	print("<tr><td bgcolor='#555555'><h2 style='color: #cccccc;'>&nbsp;$val</h2></td></tr>\n");
	foreach ($planes as $pkey => $pval) {
		if ($pval[1] == $key) {
			print('<tr><td valign="center"><input name="'.$pkey.'" type="checkbox" id="'.$pkey.'" value="on" /><label>'.$pval[0].'</label></td></tr>');
			print("\n");
		}
	}

}

print('<tr><td bgcolor="#555555" align="center">&nbsp;</td></tr>');
print('<tr><td bgcolor="#555555" align="center"><input type="submit" name="Submit" value="Submit" />&nbsp;&nbsp;<input type="reset" name="Submit2" value="Reset" /></td></tr>');
print("</table>");

print('</form>');

if ((sizeof($_POST) < 2) && (sizeof($_GET) == 0)) {
	print("</td><td bgcolor='#eeeeee' valign='top' style='padding:8px;' >\n");
	include "welcome.php";
} else {
	print("</td><td bgcolor='#dddddd' valign='top'>\n");
include "thecharts.php";
}
print("</td>\n");

print("</tr><tr>");
print("<td align='center' colspan='2' id='linkbar'>\n");
include_once("linkbar.php");
print("</td>\n");
print("</tr><tr>");
print("<td align='center' colspan='2' id='footer'>Copyright &copy; 2006 ".
	"<a href='http://www.gonzoville.com'>GonZoville.com</a> &amp; ".
	"<a href='http://www.siliconchisel.com'>SiliconChisel.com</a>".
	" | <a target='_blank' href='http://forum.gonzoville.com/smf/index.php?board=6.0'>Support Forum</a> | $versionstr</td>");
//					 print("<tr ><td  id='linkbar' colspan='2'>");
//					 include ('./M8Bcounter/M8Bcounter.php');
//						   print("</td>");
print("</tr></table>\n");

?>
</BODY>
</HTML>