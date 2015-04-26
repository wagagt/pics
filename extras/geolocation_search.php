<?php

$tzip= \Models\ZipcodeModel::where('zip','=',$searchQuery['zipSearch'])->get();
if (empty($tzip[0])) {
    $tzip= \Models\ZipcodeModel::where('zip','=','90210')->get(); // ***
}
$tzip= $tzip[0];
$R = EARTH_MEAN_RADIUS;  // earth's mean radius, km;

$lat_radians= deg2rad($tzip->latitude);
$lon_radians= deg2rad($tzip->longitude);
$lat= ($tzip->latitude);
$lon= ($tzip->longitude);

// first-cut bounding box (in degrees)
$maxLat = $lat + rad2deg($radius/$R);
$minLat = $lat - rad2deg($radius/$R);
// compensate for degrees longitude getting smaller with increasing latitude
$maxLon = $lon + rad2deg($radius/$R/cos(deg2rad($lat)));
$minLon = $lon - rad2deg($radius/$R/cos(deg2rad($lat)));

$sqlzips= "
select * from zip_codes
where
    latitude >= '{$minLat}' AND latitude <= '{$maxLat}'
    AND longitude >= '{$minLon}' AND longitude <= '{$maxLon}'
";
$zipresults= \DB::query( $sqlzips, array() );