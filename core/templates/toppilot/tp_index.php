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

//all time stats
echo '<h4>All Time Greats</h4>';
echo '<table width="100%" cellpadding="10px">';
echo '<tr><td width="50%" valign="top">';
echo '<center>';
echo '<b>Top Pilots All Time </b>(Flights Flown)';
echo '<table class="profiletop">';
echo '<tr>';
echo '<th>Pilot</th>';
echo '<th>Flights Flown</th>';
echo '</tr>';
$all_flights = TopPilotData::alltime_flights(5);
foreach($all_flights as $all) {
    $pilot = PilotData::GetPilotData($all->pilotid);
    echo '<tr>';
    echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid).'</td>';
    echo '<td>'.$all->totalflights.'</td>';
    echo '</tr>';
}
echo '</table>';
echo '</td><td width="50%" valign="top">';
echo '<center>';
echo '<b>Top Pilots All Time </b>(Hours Flown)';
echo '<table class="profiletop">';
echo '<tr>';
echo '<th>Pilot</th>';
echo '<th>Hours Flown</th>';
echo '</tr>';
$all_hours= TopPilotData::alltime_hours(5);
foreach($all_hours as $all) {
    $pilot = PilotData::GetPilotData($all->pilotid);
    echo '<tr>';
    echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid).'</td>';
    echo '<td>'.$all->totalhours.'</td>';
    echo '</tr>';
}
echo '</table>';
echo '</td></tr>';
echo '</table>';
echo '<hr />';
//current month stats
echo '<h4>Current Month Stats</h4>';
echo '<table width="100%" cellpadding="10px"><tr><td width="33%" valign="top">';
echo '<center>';
$topflights = TopPilotData::top_pilot_flights($today[mon], $today[year], 5);
if(!$topflights) {$month = date( 'F', mktime(0, 0, 0, $today[mon])); echo 'No Pireps Filed For '.$month.' '.$today[year]; }
else {
    $month_name = date( 'F', mktime(0, 0, 0, $topflights[0]->month) );

    echo '<b>Top Pilot for '.$month_name.' '.$topflights[0]->year.' </b>(Flights Flown)';

    echo '<table class="profiletop">';

    echo '<tr>';
    echo '<th>Pilot</th>';
    echo '<th>Flights Flown</th>';
    echo '</tr>';

    foreach ($topflights as $top) {
        $pilot = PilotData::GetPilotData($top->pilot_id);
        echo '<tr>';
        echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid).'</td>';
        echo '<td>'.$top->flights.'</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</center>';

    echo '</td><td width="33%" valign="top">';
    echo '<center>';

    //top hours flown

    $tophours = TopPilotData::top_pilot_hours($today[mon], $today[year], 5);

    echo '<b>Top Pilot for '.$month_name.' '.$tophours[0]->year.' </b>(Hours Flown)';
    echo '<table class="profiletop">';
    echo '<tr>';
    echo '<th>Pilot</th>';
    echo '<th>Hours Flown</th>';
    echo '</tr>';
    foreach ($tophours as $top) {
        $pilot = PilotData::GetPilotData($top->pilot_id);
        echo '<tr>';
        echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid).'</td>';
        echo '<td>'.$top->hours.'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</center>';
    echo '</td><td width="33%" valign="top">';
    echo '<center>';

    //top miles flown

    $topmiles = TopPilotData::top_pilot_miles($today[mon], $today[year], 5);

    echo '<b>Top Pilot for '.$month_name.' '.$tophours[0]->year.' </b>(Miles Flown)';
    echo '<table class="profiletop">';
    echo '<tr>';
    echo '<th>Pilot</th>';
    echo '<th>Miles Flown</th>';
    echo '</tr>';
    foreach ($topmiles as $top) {
        $pilot = PilotData::GetPilotData($top->pilot_id);
        echo '<tr>';
        echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid).'</td>';
        echo '<td>'.$top->miles.'</td>';
        echo '</tr>';
    }
    echo '</table>';

    echo '</td></tr>';

}
echo '</center></table>';
echo '<hr>';
echo '<h4>Historical Stats</h4>';
echo '<table class="profiletop"><tr><th valign="top" colspan="2">';
echo '<center><b>Monthly Stats</b></th></tr>';

while ($startyear <= $today[year]): {
        $month_name = date( 'F', mktime(0, 0, 0, $startmonth) );
        echo '<tr><td><center>'.$month_name.' - '.$startyear.'</td>';
        echo '<td><center>';
        echo '<a href="'.url('/TopPilot/get_old_stats?month='.$startmonth.'&year='.$startyear.'').'">View</a></td></tr>';

        //advance dates
        if ($startmonth == $today[mon] && $startyear == $today[year]) {break;}
        if ($startmonth == 12) {$startyear++; $startmonth = 01;}
        else {$startmonth++;}
    }
endwhile;
echo '</table><br /><br />';
?>