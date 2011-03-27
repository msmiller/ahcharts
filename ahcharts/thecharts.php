<?PHP

// Convenience function
function dochartinsert($ds) {
	global $basedir;
	global $showplanes;

	echo InsertChart( $basedir."/charts.swf", $basedir."/charts_library", $basedir."/ahdata.php?dataset=".$ds.
	"&p1=".$showplanes[0].
	"&p2=".$showplanes[1].
	"&p3=".$showplanes[2].
	"&p4=".$showplanes[3], 320, 300, "eeeeee" );
}

// Output a row of the console
function chartrow($lab1, $set1, $cred1,  $lab2, $set2, $cred2) {

	print("<tr>\n");

	print("<td width='50%' valign='top'>\n");

	if ($lab1) print "<b>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;$lab1</b>\n";

	print("</td><td width='50%' valign='top'>\n");

	if ($lab2) print "<b>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;$lab2</b>\n";

	print("</td></tr>\n");

	print("<tr>\n"); 
	print("<td width='50%' class='small' valign='top'>\n"); // Chart 1    

	print "$cred1\n";

	print("</td><td class='small' width='50%' valign='top'>\n"); // Chart 2 

	print "$cred2\n";

	print("</td></tr>\n");
	
	print("<tr>\n"); 
	print("<td width='50%' valign='top'>\n"); // Chart 1    

	if ($set1) dochartinsert($set1);

	print("</td><td width='50%' valign='top'>\n"); // Chart 2 

	if ($set2) dochartinsert($set2);

	print("</td></tr>\n");
	
}

// Same as above, but use an inner table for better spacing control

function chartrowt($lab1, $set1, $cred1,  $lab2, $set2, $cred2) {

	print("<tr>\n");
	print("<td width='50%' valign='top'>\n");
	
	print("<table style='background:#eeeeee;border:1px solid #cccccc;' width='100%' cellpadding='0' cellspacing='0'>\n");
	print("<tr><td class='tabname'>");
	if ($lab1) print "<b>$lab1</b>\n";
	print("<tr><td valign='top'>\n");
	if ($set1) dochartinsert($set1);
	print("<tr><td class='small' valign='top'>\n");
	print "$cred1\n";
	print("</td></tr>");
	print("</table>");

	print("</td><td width='50%' valign='top'>\n");

	if ($set2) {
	print("<table style='background:#eeeeee;border:1px solid #cccccc;' width='100%' cellpadding='0' cellspacing='0'>\n");
	print("<tr><td class='tabname'>");
	if ($lab2) print "<b>$lab2</b>\n";
	print("<tr><td valign='top'>\n");
	if ($set2) dochartinsert($set2);
	print("<tr><td class='small' valign='top'>\n");
	print "$cred2\n";
	print("</td></tr>");
	print("</table>");
	}
	print("</td></tr>\n");
	
}


print("<table class='inner' border='0' width='100%' cellpadding='0' cellspacing='16'>");

// Heading amd set up planes

print("<tr><td style='padding:2px;font-size:14px;font-weight:bold;border-bottom:2px solid #666666;color:#666666;' colspan='2'>");
print("Comparing: ");
$i = 0;
if (sizeof($_GET) > 0) {
	foreach ($_GET as $key => $val) {		if ($i < 5) {
		echo $planes[$val][0]."&nbsp;&nbsp;";
		$showplanes[$i] = $val;
		$i++;
	}

	}
} else {
	foreach ($_POST as $key => $val) {
		if ($val != "Submit") { // Skip "Submit"
			if ($i < 5) {
				echo $planes[$key][0]."&nbsp;&nbsp;";
				$showplanes[$i] = $key;
				$i++;
			}
		}
	}
}

print("</td></tr>");


chartrowt("Speed @ Mil", "speed", "Data compiled by Hammer.",
		"Speed @ WEP", "speedwep", "Data compiled by Hammer.");
		
chartrowt("Climb Rate @ Mil", "climb", "Data compiled by Hammer.",
		"Climb Rate @ WEP", "climbwep", "Data compiled by Hammer.");
		
chartrowt("Acceleration", "accel3", "Data compiled by MOSQ. (alt = 500ft)",
		"Turn Radius", "turnradius", "Data compiled by MOSQ.  (alt = 500ft)");
		
chartrowt("Maximum Speed (Low Alt)", "topend", "Data compiled by MOSQ. (alt = 500ft)",
		"Top-End Acceleration (Low Alt)", "topendaccel", "Data compiled by MOSQ.  (alt = 500ft)");
		
chartrowt("Lethality", "lethality", "Based on in-game data compiled by Hammer and the WW2 Weapon Lethality calculations of Tony Williams. 
Hammer's RtKH data is based on the rounds to kill a hangar in-game; Hammer's calculated figures are derived from a 1-second fired burst for TW data.<br><i>(Normalized to 1 M2 .50cal = 10)</i>",
		"Firing Time", "firetime", "Based on in-game data compiled by Hammer.<br>'Primary' is the 'main gun' - usually cannons; 'secondary' is usually machine guns or the smaller battery.");


print("</table>");
?>