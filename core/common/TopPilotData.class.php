<?php

/**
 * PHP-Mods Addon Module for phpVMS virtual airline syste,
 * The module was originally developed by simpilotgroup
 *
 * The module is licenced under the following license:
 * Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 * To view full license text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @Initial Developer David Clark (simpilot)
 * @copyright Copyright (c) 2009-2017, David Clark
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link https://github.com/DavidJClark/phpVMS-TopPilot
 *
 * The module has been updated by PHP-Mods on 31st of October 2017
 * @link https://github.com/phpmods/phpVMS-TopPilot
 */

class TopPilotData extends CodonData
{

    public static function get_monthly_stats($month, $year)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "pireps WHERE MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year'");
    }
    public static function get_monthly_stats_by_pilot($month, $year, $pilotid)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "pireps WHERE pilotid='$pilotid' AND MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year'");
    }
    public static function get_monthly_stats_by_pilot_awards($month, $year, $pilotid)
    {
        return DB::get_row("SELECT COUNT(id) as total FROM " . TABLE_PREFIX . "awardsgranted WHERE pilotid='$pilotid' AND MONTH(dateissued) = '$month' AND YEAR(dateissued) = '$year'");
    }
    public static function get_monthly_stats_by_pilot_landing($month, $year, $pilotid)
    {
        return DB::get_row("SELECT MAX(landingrate) as landing FROM " . TABLE_PREFIX . "pireps WHERE pilotid='$pilotid' AND MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year' AND landingrate<0 ORDER BY landingrate DESC");
    }
    public static function get_pilot_tours_month_crazycreatives($month, $year, $pilotid) {
        $sql = "SELECT COUNT(id) AS total from tourcenter_signups WHERE pilotid='$pilotid' AND MONTH(enddate) = '$month' AND YEAR(enddate) = '$year'";
        $total = DB::get_row($sql);
        if(!$total) return 0;
        return $total->total;
    }

    public static function get_pilot_tours_month_simpilot($month, $year, $pilotid) {
        $total_tours = 0;
        $sql = "SELECT * FROM ".TABLE_PREFIX."tours_pilotdata WHERE pilotid='$pilotid'";
        $tours = DB::get_results($sql);
        if($tours) {
            foreach($tours as $tour) {
                $legs = unserialize($tour->data);
                $last = end($legs);
                if($last != 0) {
                    $sql = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE pirepid='$last' AND MONTH(submitdate)='$month' AND YEAR(submitdate)='$year'";
                    $result = DB::get_row($sql);
                    if($result)
                        $total_tours++;
                }
            }
        }
        return $total_tours;
    }

    public static function record_stats($pilot_id, $totalflights, $totaltime, $totalmiles, $totalawards, $toplanding, $totaltours, $startmonth, $startyear)
    {
        $sql = "SELECT * FROM ".TABLE_PREFIX."top_flights WHERE pilot_id='$pilot_id' AND month='$startmonth' AND year='$startyear'";
        $check = DB::get_row($sql);
        if($check) {
            DB::query("UPDATE " . TABLE_PREFIX . "top_flights SET flights='$totalflights', hours='$totaltime', miles='$totalmiles', awards='$totalawards', landing='$toplanding', tours='$totaltours' WHERE pilot_id='$pilot_id' AND month='$startmonth' AND year='$startyear'");
        } else {
            DB::query("INSERT INTO " . TABLE_PREFIX . "top_flights (pilot_id, flights, hours, miles, awards, landing, tours, month, year) VALUES('$pilot_id', '$totalflights', '$totaltime', '$totalmiles', '$totalawards', '$toplanding', '$totaltours', '$startmonth', '$startyear')");
        }
    }

    public static function clear_table()
    {
        DB::query("TRUNCATE TABLE " . TABLE_PREFIX . "top_flights");
    }
    public static function clear_month_table()
    {
        //DB::query("TRUNCATE TABLE " . TABLE_PREFIX . "top_flights");
    }
    public static function top_pilot_flights($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY flights DESC LIMIT $howmany");
    }

    public static function top_pilot_hours($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY hours DESC LIMIT $howmany");
    }

    public static function top_pilot_miles($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY miles DESC LIMIT $howmany");
    }

    public static function top_pilot_awards($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY awards DESC LIMIT $howmany");
    }

    public static function top_pilot_landings($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' AND landing<0 ORDER BY landing DESC LIMIT $howmany");
    }

    public static function top_pilot_tours($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY tours DESC LIMIT $howmany");
    }

    public static function alltime_flights($howmany)
    {
        return DB::get_results("SELECT pilotid, totalflights FROM " . TABLE_PREFIX . "pilots ORDER BY totalflights DESC LIMIT $howmany");
    }

    public static function alltime_hours($howmany)
    {
        return DB::get_results("SELECT pilotid, totalhours FROM " . TABLE_PREFIX . "pilots ORDER BY totalhours DESC LIMIT $howmany");
    }


}
