<?php
/**
 * @param string $pointLatLong  xLongitude,yLatitude
 * @param array $outerBoundary $outerBoundary[] = xLongitude,yLatitude
 * @return bool
 */
function pointInPolygon(string $pointLatLong, array $outerBoundary) : bool
{
    //yLatitude In ZA is -
    //xLongitude In ZA is +
    //Format: xLongitude,yLatitude

    $i = 0;
    $j = count($outerBoundary)-1;
    $inPolygon = false;
    $polyYLatitude = [];
    $polyXLongitude = [];

    $pointLatLong = explode(',', $pointLatLong);
    $xLongitude = $pointLatLong[0];
    $yLatitude = $pointLatLong[1];

    foreach($outerBoundary AS $xy){
        $temp = explode(',', $xy);
        if(!empty($temp[0]) && !empty($temp[1])){
            $polyXLongitude[] = $temp[0];
            $polyYLatitude[] = $temp[1];
        }
    }
    unset($temp);

    for ($i; $i < count($outerBoundary); $i++)
    {
        if (($polyYLatitude[$i] < $yLatitude && $polyYLatitude[$j] >= $yLatitude || $polyYLatitude[$j]< $yLatitude && $polyYLatitude[$i] >= $yLatitude)
            && ($polyXLongitude[$i] <= $xLongitude || $polyXLongitude[$j] <= $xLongitude))
        {
            if ($polyXLongitude[$i] + ($yLatitude - $polyYLatitude[$i]) / ($polyYLatitude[$j] - $polyYLatitude[$i]) * ($polyXLongitude[$j] - $polyXLongitude[$i]) < $xLongitude)
            {
                $inPolygon = !$inPolygon;
            }
        }
        $j = $i;
    }

    return $inPolygon;
}