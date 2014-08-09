<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

class TopPilotData extends CodonData
{
    public static function get_monthly_stats($month, $year) {
        $query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year'";

        return DB::get_results($query);
    }

    public static function record_stats($pilot_id, $totalflights, $totaltime, $totalmiles, $startmonth, $startyear) {
        $query = "INSERT INTO ".TABLE_PREFIX."top_flights (pilot_id, flights, hours, miles, month, year)
                VALUES('$pilot_id', '$totalflights', '$totaltime', '$totalmiles', '$startmonth', '$startyear')";

        DB::query($query);
    }

    public static function clear_table()   {
        $query = "TRUNCATE TABLE ".TABLE_PREFIX."top_flights";

        DB::query($query);
    }

    public static function top_pilot_flights($month, $year, $howmany)    {
        $query = "SELECT * FROM ".TABLE_PREFIX."top_flights WHERE month='$month' AND year='$year' ORDER BY flights DESC LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function top_pilot_hours($month, $year, $howmany)    {
        $query = "SELECT * FROM ".TABLE_PREFIX."top_flights WHERE month='$month' AND year='$year' ORDER BY hours DESC LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function top_pilot_miles($month, $year, $howmany)    {
        $query = "SELECT * FROM ".TABLE_PREFIX."top_flights WHERE month='$month' AND year='$year' ORDER BY miles DESC LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function alltime_flights ($howmany)  {
        $query = "SELECT pilotid, totalflights FROM ".TABLE_PREFIX."pilots ORDER BY totalflights DESC LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function alltime_hours ($howmany)  {
        $query = "SELECT pilotid, totalhours FROM ".TABLE_PREFIX."pilots ORDER BY totalhours DESC LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function get_monthly_landingrate($month, $year, $howmany) {
        $query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year' ORDER BY landingrate DESC LIMIT '$howmany'";

        return DB::get_results($query);
    }
}