<?php

function getcsvxls($buffer)
{
   $buffer = str_replace('""', '"', $buffer);
   $n = strlen($buffer);
   $i = $line = 0;
   $del = false;
   while($i < $n)
   {
       $part = substr($buffer, $i);

       if(
           (substr($part, 0, 1) == ';' && !$del) ||
           (substr($part, 0, 2) == '";' && $del)
       )
       {
           $i ++;
           if($del)
           {
               $str = substr($str, 1, strlen($str) - 1);
               $i ++;
           }
           $data[$line][] = $str;
           $del = false;
           $str = '';
       } else if(substr($part, 0, 2) == "\r\n")
       {
           $data[$line][] = $str;
           $str = '';
           $del = false;
           $line ++;
           $i += 2;
       } else
       {
           if($part[0] == '"')
               $del = true;
           $str .= $part[0];
           $i ++;
       }
   }
   return $data;
}

/* $handle = fopen("sealevelaccel.csv", "r");
$buffer = fread($handle, 100000);
$d = getcsvxls($buffer);
echo $d[0][0];
fclose($handle);*/

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

$b = importcsv("sealevelaccel.csv");
echo $b[0][1];
echo $b[1][0];

/*
$row = 1;
$handle = fopen("sealevelaccel.csv", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   $num = count($data);
   echo "<p> $num fields in line $row: <br /></p>\n";
   $row++;
   for ($c=0; $c < $num; $c++) {
       echo $data[$c] . "<br />\n";
   }
}
fclose($handle); */
?> 