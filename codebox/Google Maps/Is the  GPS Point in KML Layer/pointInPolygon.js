function pointInPolygon(points,lat,lon)
{
    var i;
    var j=points.length-1;
    var inPoly=false;

    for (i=0; i<points.length; i++)
    {
        if (points[i].Longitude<lon && points[j].Longitude>=lon
            || points[j].Longitude<lon && points[i].Longitude>=lon)
        {
            if (points[i].Latitude+(lon-points[i].Longitude)/
                (points[j].Longitude-points[i].Longitude)*(points[j].Latitude
                    -points[i].Latitude)<lat)
            {
                inPoly=!inPoly;
            }
        }
        j=i;
    }
    return inPoly;
}