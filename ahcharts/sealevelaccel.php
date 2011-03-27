<?PHP

$rawdata = importcsv($datadir."sealevelaccel.csv");
$showplanesindex = array(findindex($rawdata, $showplanes[0]),
	findindex($rawdata, $showplanes[1]),
	findindex($rawdata, $showplanes[2]),
	findindex($rawdata, $showplanes[3])
);

$chart [ 'axis_value' ] = array (
	'color' => '666666',
	'bold' => false,
	'size'    =>  11,
	'min'              =>  10,
	'max'              =>  50
);

$chart [ 'chart_value' ] = array(
'position'=>"outside", 'size'=>11, 'color'=>"666666", 'alpha'=>75,
'decimals' => 2, 'bold' => false);

$chart [ 'chart_data' ][0] = array (' ', $rawdata[0][1]);
for ($p = 0; $p < $numplanes; $p++) {
	if ($showplanes[$p]) {
		$chart [ 'chart_data' ][$p+1] = $rawdata[$showplanesindex[$p]];
		$chart [ 'chart_data' ][$p+1][0] = $planes[$showplanes[$p]][0];
	}
}

?>