<?PHP

// From ZEND.com

//This code should help conceal the email addresses you list on your site from spammers. It's especially useful for email addresses drawn from a database (like in a phonebook application)

//obfuscate takes a string and replaces most characters with the hexidecimal ordinal equivalent. Note: return string is almost certainly much longer than the original email address
function obfuscate($email) {
    $i=0;
    $obfuscated="";
    while ($i<strlen($email)) {
       if (rand(0,2)) {
          $obfuscated.='%'.dechex(ord($email{$i}));
       } else {
          $obfuscated.=$email{$i};
       }
       $i++;
   }
return $obfuscated;
}

//obfuscate_numeric takes a string and replaces the characters with html entity eqivalents. You have to do this if you want to obfuscate the label and have it display normally, or if you just want to obfuscate the "mailto" tag. Note: return string is almost certainly much longer than the plaintext string
function obfuscate_numeric($plaintext) {
    $i=0;
    $obfuscated="";
    while ($i<strlen($plaintext)) {
       if (rand(0,2)) {
          $obfuscated.='&#'.ord($plaintext{$i});
       } else {
          $obfuscated.=$plaintext{$i};
       }
       $i++;
   }
return $obfuscated;
}

//this function drives the two above and generates a mailto link. if label isn't set, it just re-obfuscates the email address and uses that as the label
function generate_obfuscated_mailto ($email,$label) {
if (isset($label)) {
           return sprintf("<a href='%s:%s'>%s</a>",
           obfuscate_numeric('mailto'),
           obfuscate($email),
           obfuscate_numeric($label));
} else {
           return sprintf("<a href='%s:%s'>%s</a>",
           obfuscate_numeric('mailto'),
           obfuscate($email),
           obfuscate_numeric($email));
    }
}

// ====
	
print("<table class='inner' border='0' width='100%' cellpadding='0' cellspacing='4'>");
print("<tr><td>");
?>
<h2>The Aces High&trade; Fighter Performance Comparison Site</h2>
<p style="text-align:justify">One of the toughest things for a new player to get a handle of in Aces High is just what plane to use, and how that plane stacks up against the others. Some of the data is on the HiTech Creations site, some is floating around the BBS, some is on various player's sites. But it's not really compiled in a way that makes side-by-side-by-side comparisons easy, or easy to read. This site is an attempt to solve that problem.</p>
<p style="text-align:justify">This site is built using a custom PHP script which reads in the CSV (Excel) data that the contributing players have compiled of the various flight performance data. It then feeds the data for the four (4) planes that the visitor wants to examine to a Flash-based charting package. The result is a console-like display of all the important data; allowing the viewer to see how planes stack up against each other in many areas.</p>

<p id="welcomehead"><b>Instructions:</b></p>
<ul><li>Select four planes from the left-hand column, hit "Submit" ... that's it.
<li>If you pick more than four planes, it'll only show the first four (for some definition of "first").</ul>

<p id="welcomehead""><b>Notes:</b></p>
<ul>
<li>Planes were tested in their "typical" Main Arena load-outs (i.e. La-7's had 3 cannon, P47's had 8 machine guns, etc.)</li>

</ul>

<p id="welcomehead"><b>Direct Access:</b></p>
<ul>
<p style="text-align:justify">It is possible to specify a set of planes to be compared from the URL definition. The syntax is
<br><ul><code>http://www.gonzoville.com/ahcharts/index.php?p1=PLANE1&p2=PLANE2&p3=PLANE3&p4=PLANE4</code></ul><br>
The names for the planes are the tags used internally by the system to normalize the namespace. These tags
must be used. They are as follows:<br>
<br><ul>
<table style="border:1px solid #cccccc;" cellpadding="4" cellspacing="4" border="0" width="80%"><tr>
<td valign="top" width="25%"><code>p51d
p51b
f6f5
f4u1
f4u1d
f4u4
f4u1c
fm2
f4f4
p47d11
p47d25
p47d40
p47n
p40b
p40e
p38g
p38j
p38l
</code></td>
<td valign="top" width="25%"><code>109e4
109f4
109g14
109g2
109g6
109k4
110c4b
110g2
190a5
190a8
190d9
190f8
ta152h
</code></td>
<td valign="top" width="25%"><code>spit1
spit5
spit16
spit9
spit8
spit14
mosq
temp
seaf2
typh
hurri1
hurri2d
hurri2c
</code></td>
<td valign="top" width="25%"><code>yak9u
yak9t
la5fn
la7
c202
c205
a6m2
a6m5
ki61
ki84
n1k2j
</code></td>
</tr></table>
</ul><br>
Note that there isn't much error checking done for this feature, so be real
careful about how you form the URL when you pass it in. Here's a few examples:<br>
<br><ul>
<li><a href="http://www.gonzoville.com<?php echo $basedir;?>/index.php?p1=p51d&p2=la7&p3=spit16&p4=n1k2j">Main Arena Dominators</a></li>
<li><a href="http://www.gonzoville.com<?php echo $basedir;?>/index.php?p1=fm2&p2=a6m5&p3=hurri2c&p4=109f4">Furballers</a></li>
<li><a href="http://www.gonzoville.com<?php echo $basedir;?>/index.php?p1=spit1&p2=hurri1&p3=109e4&p4=110c4b">Battle of Britain</a></li>
<li><a href="http://www.gonzoville.com<?php echo $basedir;?>/index.php?p1=p40e&p2=p40b&p3=a6m2&p4=a6m5">Flying Tigers</a></li>
<li><a href="http://www.gonzoville.com<?php echo $basedir;?>/index.php?p1=p47d11&p2=p38g&p3=190a5&p4=109g2">Torch</a></li>
<li><a href="http://www.gonzoville.com<?php echo $basedir;?>/index.php?p1=f4u4&p2=spit14&p3=temp&p4=ta152h">Perked</a></li>
</ul>
</p>
</ul>

<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td valign="top" width="48%">
<p id="welcomehead"><b>Contributors:</b></p>
<ul>
<li>DoKtor GonZo <i>(Programming and Concept)</i></li>
<li>WideWing <i>(Data Measurement and Collection)</i></li>
<li>Hammer <i>(Data Measurement and Collection)</i></li>
<li>MOSQ <i>(Data Measurement and Collection)</i></li>
<li>Tony Williams <i>(WW2 Weapon Data)</i></li>
<br>
<li>If you'd like to contribute data, start the ball rolling <a href="http://www.gonzoville.com/contact/" target="_blank">here</a>.</li>
</ul>

</td><td>&nbsp;&nbsp;</td><td valign="top" width="48%">

<p id="welcomehead"><b>Support This Project:</b></p>
<ul>I'd like to buy a license for the charts package to unlock some features and also get rid of the default link-back. A donation would help me do that.
<br><br><form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_xclick"><input type="hidden" name="business" value="admin@siliconchisel.com"><input type="hidden" name="item_name" value="Support DoK's Fighter Pages"><input type="hidden" name="item_number" value="IH8U2"><input type="hidden" name="no_note" value="1"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="tax" value="0"><input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but21.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</ul></form>

</td></tr></table>
<?php
print("</td></tr>");
print("</table>");

?>