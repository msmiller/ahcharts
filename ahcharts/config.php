<?PHP

//
// Load and sort plane label dictionary
//

$datadir = "data/";
$basedir = "/ahcharts";

$numplanes = 4;

$versionstr = "v1.0.0 21.may.05";

include "planes.php";
asort($planes);

$showplanes = array();

//
// Function from php.net to load arrary from CSV
//

function importcsv($file,$head=false,$delim=",",$len=1000) {
   $return = false;
   $handle = fopen($file, "r");
   if ($head) {
       $header = fgetcsv($handle, $len, $delim);
       echo $header[0];
   }
   while (($data = fgetcsv($handle, $len, $delim)) !== FALSE) {
       if ($head AND isset($header)) {
           foreach ($header as $key=>$heading) {
               $row[$heading]=(isset($data[$key])) ? $data[$key] : '';
           }
           $return[]=$row;
       } else {
           $return[]=$data;
       }
   }
   fclose($handle);
   return $return;
}

//
// Datafiles
//

//$dat_sealevaccel = importcsv("data/sealevelaccel.csv");

?>