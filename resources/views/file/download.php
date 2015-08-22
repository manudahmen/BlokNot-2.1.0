<?php

if(/* My authorization here */) {
$path = "/uploads/";
$name = $row[0];           //This is a MySQL reference with the filename
$fullname = $path . $name; //Create filename
$fd = fopen($fullname, "rb");
if ($fd) {
$fsize = filesize($fullname);
$path_parts = pathinfo($fullname);
$ext = strtolower($path_parts["extension"]);
switch ($ext) {
case "pdf":
header("Content-type: application/pdf");
break;
case "zip":
header("Content-type: application/zip");
break;
default:
header("Content-type: application/octet-stream");
break;
}
header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
header("Content-length: $fsize");
header("Cache-control: private"); //use this to open files directly
while(!feof($fd)) {
$buffer = fread($fd, 1*(1024*1024));
echo $buffer;
ob_flush();
flush();    //These two flush commands seem to have helped with performance
}
}
else {
echo "Error opening file";
}
fclose($fd);