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

class TopPilot extends CodonModule {
    public static $tour_center = 0; // 0:if no tour system -or- 1:for SimpilotGroup Tour Center -or- 2:for CrazyCreatives Tour Module
    public $title = 'Top Pilots';

    public function __construct() {
        CodonEvent::addListener('TopPilot', array('pirep_filed'));
    }
    public function EventListener($eventinfo) {
        if($eventinfo[0] == 'pirep_filed') {
            self::refresh_month_stats();
        }
    }

    public function index() {
        $start = StatsData::GetStartDate();
        $this->set('startmonth', date('m', strtotime($start->submitdate)));
        $this->set('startyear', date('Y', strtotime($start->submitdate)));
        $this->set('today', getdate());
        $this->set('tour_center', self::$tour_center);
        $this->render('toppilot/tp_index');
    }

    //added by PHP-Mods Addition
    public function refresh_month_stats() {
        $today = getdate();
        $pilots = PilotData::getAllPilots();

        foreach ($pilots as $pilot) {
            $month_stats = TopPilotData::get_monthly_stats_by_pilot($today[mon], $today[year], $pilot->pilotid);
            $totaltime=0;
            $totalflights=0;
            $totalmiles=0;
            $totalawards = TopPilotData::get_monthly_stats_by_pilot_awards($today[mon], $today[year], $pilot->pilotid)->total;
            $toplanding=TopPilotData::get_monthly_stats_by_pilot_landing($today[mon], $today[year], $pilot->pilotid)->landing;
            if(self::$tour_center == 1) {
                $totaltours=TopPilotData::get_pilot_tours_month_simpilot($today[mon], $today[year], $pilot->pilotid);
            } else {
                $totaltours=TopPilotData::get_pilot_tours_month_crazycreatives($today[mon], $today[year], $pilot->pilotid);
            }
            if(isset($month_stats)) {
                foreach ($month_stats as $pirep) {
                    if ($pilot->pilotid == $pirep->pilotid /* && $pirep->accepted == 1 */ ) {
                        $totaltime = $totaltime + $pirep->flighttime;
                        $totalflights++;
                        $totalmiles = $totalmiles + $pirep->distance;
                    }
                }
            }
            if($totalflights > 0) {
                TopPilotData::record_stats($pilot->pilotid, $totalflights, $totaltime, $totalmiles, $totalawards, $toplanding, $totaltours, $today[mon], $today[year]);
            }
        }
    }
    //end of PHP-Mods Addition

    public function refresh_pilot_stats() {

        TopPilotData::clear_table();

        $start = StatsData::GetStartDate();
        $startmonth = date('m', strtotime($start->submitdate));
        $startyear = date('Y', strtotime($start->submitdate));
        $today = getdate();

        while ($startyear <= $today[year] ) {

            $pilots = PilotData::getAllPilots();
            $month_stats = TopPilotData::get_monthly_stats($startmonth, $startyear);

            foreach ($pilots as $pilot) {
                $totaltime=0;
                $totalflights=0;
                $totalmiles=0;
                $totalawards = TopPilotData::get_monthly_stats_by_pilot_awards($startmonth, $startyear, $pilot->pilotid)->total;
                $toplanding=TopPilotData::get_monthly_stats_by_pilot_landing($startmonth, $startyear, $pilot->pilotid)->landing;
                if(self::$tour_center == 1) {
                    $totaltours=TopPilotData::get_pilot_tours_month_simpilot($startmonth, $startyear, $pilot->pilotid);
                    echo 'hello';
                } else {
                    $totaltours=TopPilotData::get_pilot_tours_month_crazycreatives($startmonth, $startyear, $pilot->pilotid);
                    echo 'hello1';
                }
                if(isset($month_stats)) {
                    foreach ($month_stats as $pirep) {
                        if ($pilot->pilotid == $pirep->pilotid /* && $pirep->accepted == 1 */ ) {
                            $totaltime = $totaltime + $pirep->flighttime;
                            $totalflights++;
                            $totalmiles = $totalmiles + $pirep->distance;
                        }
                    }
                }
                if($totalflights > 0) {
                    TopPilotData::record_stats($pilot->pilotid, $totalflights, $totaltime, $totalmiles, $totalawards, $toplanding, $totaltours, $startmonth, $startyear);
                }
            }
            if ($startmonth == 12) {$startyear++; $startmonth = 1;}
            else {$startmonth++;}
        }
    }

    public function get_old_stats() {
        $date = explode('-', $this->post->date);
        $month = $date[1];
        $year = $date[0];

        $this->set('month', $month);
        $this->set('year', $year);
        $this->set('topflights', TopPilotData::top_pilot_flights($month, $year, 5));
        $this->set('tophours',  TopPilotData::top_pilot_hours($month, $year, 5));
        $this->set('topmiles',  TopPilotData::top_pilot_miles($month, $year, 5));
        $this->set('topawards', TopPilotData::top_pilot_awards($month, $year, 5));
        $this->set('toplanding',  TopPilotData::top_pilot_landings($month, $year, 5));
        $this->set('toptours',  TopPilotData::top_pilot_tours($month, $year, 5));
        $this->set('tour_center', self::$tour_center);
        $this->render('toppilot/tp_previous');
    }
}