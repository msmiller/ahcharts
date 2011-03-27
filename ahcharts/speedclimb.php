<?PHP

$showplanesindex = array(findindex($rawdata, $showplanes[0]),
findindex($rawdata, $showplanes[1]),
findindex($rawdata, $showplanes[2]),
findindex($rawdata, $showplanes[3])
);

$chart [ 'chart_type' ] = "line";

$chart [ 'axis_value' ] = array (
	'color' => '666666',
	'bold' => false,
	'size'    =>  11,
	'steps' => 5,
	'max' =>  $cmax,
	'min' => $cmin
);

$chart [ 'chart_pref' ] = array (
	//line chart preferences
	'line_thickness'  =>  3,
	'point_shape'     =>  "none",
	'fill_shape'      =>  false,
);

$chart [ 'chart_data' ][0][0] = "Altitude (1000's)";
for ($i = 0; $i < 31; $i++) {
	$chart [ 'chart_data' ][0][$i+1] = $i;
}

for ($p = 0; $p < $numplanes; $p++) {
	if ($showplanes[$p]) {
		$chart [ 'chart_data' ][$p+1] = $rawdata[$showplanesindex[$p]];
		$chart [ 'chart_data' ][$p+1][0] = $planes[$showplanes[$p]][0];
	}
}

$chart[ 'draw' ] = array (
	array ( 'type'=>"text", 'color'=>"000000", 'alpha'=>10,
		'font'=>"arial", 'rotation'=>-90, 'bold'=>true,
		'size'=>24, 'x'=>0, 'y'=>240, 'width'=>300, 'height'=>200,
		'text'=>$metric, 'h_align'=>"left", 'v_align'=>"top" ),

	array ( 'type'=>"text", 'color'=>"000000", 'alpha'=>10,
		'font'=>"arial", 'rotation'=>0, 'bold'=>true,
	'size'=>24, 'x'=>110, 'y'=>265, 'width'=>300, 'height'=>200,
	'text'=>"Altitude (ft)", 'h_align'=>"left", 'v_align'=>"top" )
);

$chart [ 'axis_category' ] = array (   	'color' => '666666',
	'bold' => false,
	'size' => 11,
	'skip' => 4 );

?>