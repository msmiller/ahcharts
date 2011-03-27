<?PHP

//include charts.php to access the SendChartData function
include "charts.php";

require_once("config.php");

$debug = 0;
if ($debug) {
	$_REQUEST['dataset'] = "speed";
	$_REQUEST['p1'] = "temp";
	$_REQUEST['p2'] = "p51b";
	$_REQUEST['p3'] = "la7";
	$_REQUEST['p4'] = "a6m5";
}

// Set up vars
//$dreq = $_REQUEST['dfile'];
//$dfile = "data/".$dreq.".csv";
//$rawdata = importcsv($dfile);
$dataset = $_REQUEST['dataset'];
$showplanes[0] = $_REQUEST['p1'];
$showplanes[1] = $_REQUEST['p2'];
$showplanes[2] = $_REQUEST['p3'];
$showplanes[3] = $_REQUEST['p4'];

// Comma encoding so it can be passed into a "draw"
if (strpos($dataset, ",")) {
	$ta = explode(",", $dataset);
	$dataset = $ta[0];
$showplanes[0] = substr($ta[1], 3);
$showplanes[1] = substr($ta[2], 3);
$showplanes[2] = substr($ta[3], 3);
$showplanes[3] = substr($ta[4], 3);
	
}

// Find index for plane tags within raw data - can't assume sorting
function findindex($a, $t) {
	$i = 0;
	foreach ($a as $d) {
		if ($d[0] == $t) {
			return $i;
		} else {
			$i++;
		}
	}
	return(0);
}

// Base setup for a chart
$chart [ 'chart_rect' ] = array (
	'width' => 260,
	'positive_color' => "ffffff",
		'negative_color' => "ffffff",
	'positive_alpha' => 0
);
$chart [ 'legend_rect' ] = array (
	'width' => 260,
	'fill_color'      =>  "f8f8f8",
     'fill_alpha'      =>  100
);
$chart [ 'axis_category' ] = array (
	'color' => '666666',
	'bold' => false,
	'size'    =>  11
);
$chart [ 'axis_value' ] = array (
	'color' => '666666',
	'bold' => false,
	'size'    =>  11
);
$chart [ 'legend_label' ] = array (   
	'size'    =>  11
                                  );
$chart [ 'chart_border' ] = array (
	  'top_thickness'     =>  0,
     'bottom_thickness'  =>  1,
     'left_thickness'    =>  1,
     'right_thickness'   =>  0,
     'color'             =>  "333333"
);

// Select and format the data
switch ($dataset) {
	case "sealevelaccel":
		include("sealevelaccel.php");
		break;

	case "lethality":
		include("lethality.php");	
		break;
		
	case "speed":
		$rawdata = importcsv($datadir."speed_mil.csv");
		$metric = "Speed (mph)";
		$cmax = 500; $cmin = 250;
		include("speedclimb.php");
		break;
		
	case "climb":
		$rawdata = importcsv($datadir."climb_mil.csv");
		$metric = "Climb (fpm)";
		$cmax = 5000;
		$cmin = 0;
		include("speedclimb.php");
		break;
	
	case "speedwep":
		$rawdata = importcsv($datadir."speed_wep.csv");
		$metric = "Speed (mph)";
		$cmax = 500; $cmin = 250;
		include("speedclimb.php");
		break;
		
	case "climbwep":
		$rawdata = importcsv($datadir."climb_wep.csv");
		$metric = "Climb (fpm)";
		$cmax = 5000;
		$cmin = 0;
		include("speedclimb.php");
		break;

	case "accel3":
		include "accel3.php";
		break;
		
	case "turnradius":
		include "turnradius.php";
		break;
		
	case "firetime":
		include "firetime.php";
		break;
		
	case "topend":
		include "topend.php";
		break;

	case "topendaccel":
		include "topendaccel.php";
		break;
		
	default:
		break;
}

SendChartData ($chart);

?>