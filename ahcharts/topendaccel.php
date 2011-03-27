<?PHP

$chart [ 'chart_type' ] = "stacked column";
$rawdata = importcsv($datadir."topendaccel.csv");
$showplanesindex = array(
	findindex($rawdata, $showplanes[0]),
	findindex($rawdata, $showplanes[1]),
	findindex($rawdata, $showplanes[2]),
	findindex($rawdata, $showplanes[3])
);

$chart [ 'axis_value' ] = array (
	'color' => '666666',
	'bold' => false,
	'size'    =>  11
);

$chart[ 'chart_value' ] = array ( 'hide_zero'=>true, 'bold'=>false, 'color'=>"eeeeee", 'alpha'=>80, 'size'=>9, 'position'=>"middle", 'prefix'=>"", 'suffix'=>"s", 'decimals'=>1, 'separator'=>"", 'as_percentage'=>false );
// Flip data for stacked column

$chart [ 'chart_data' ][0] = array (' ');
for ($p = 0; $p < 4; $p++) {
	if ($showplanes[$p]) {
		$chart [ 'chart_data' ][0][$p+1] = $planes[$showplanes[$p]][0];
	}
}
	
$chart [ 'chart_data' ][1][0] = $rawdata[0][1];
$chart [ 'chart_data' ][2][0] = $rawdata[0][2];


for ($c = 1; $c <= 2; $c++) {
	for ($p = 0; $p < 4; $p++) {
		if ($showplanes[$p])
			$chart [ 'chart_data' ][$c][$p+1] = $rawdata[$showplanesindex[$p]][$c];
	}
}

$chart [ 'chart_data' ][1][0] = $rawdata[0][1];
$chart [ 'chart_data' ][2][0] = $rawdata[0][2];

?>