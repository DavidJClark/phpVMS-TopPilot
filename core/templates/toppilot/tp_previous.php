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

//old month stats
$month_name = date( 'F', mktime(0, 0, 0, $month) );
echo '<h4>'.$month_name.' '.$year.' Stats</h4>';
if(!$topflights)
{echo 'No flights filed'; }
else
{
echo '<table width="100%" cellpadding="10px"><tr><td width="33%" valign="top">';
echo '<center>';

//$topflights = TopPilotData::top_pilot_flights($today[mon], $today[year], 5);

    $month_name = date( 'F', mktime(0, 0, 0, $topflights[0]->month) );

    echo '<b>Top Pilot for '.$month_name.' '.$topflights[0]->year.' </b>(Flights Flown)';

    echo '<table class="profiletop">';

    echo '<tr>';
    echo '<td>Pilot</td>';
    echo '<td>Flights Flown</td>';
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

   // $tophours = TopPilotData::top_pilot_hours($today[mon], $today[year], 5);

    echo '<b>Top Pilot for '.$month_name.' '.$tophours[0]->year.' </b>(Hours Flown)';
    echo '<table class="profiletop">';
    echo '<tr>';
    echo '<td>Pilot</td>';
    echo '<td>Hours Flown</td>';
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

    //$topmiles = TopPilotData::top_pilot_miles($today[mon], $today[year], 5);

    echo '<b>Top Pilot for '.$month_name.' '.$tophours[0]->year.' </b>(Miles Flown)';
    echo '<table class="profiletop">';
    echo '<tr>';
    echo '<td>Pilot</td>';
    echo '<td>Miles Flown</td>';
    echo '</tr>';
    foreach ($topmiles as $top) {
        $pilot = PilotData::GetPilotData($top->pilot_id);
        echo '<tr>';
        echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid).'</td>';
        echo '<td>'.$top->miles.'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</center>';
    echo '</td></tr></table>';
}
    echo '<hr>';
    echo '<form method="link" action="'.url('TopPilot').'">
        <input class="mail" type="submit" value="Current Month"></form>';
?>