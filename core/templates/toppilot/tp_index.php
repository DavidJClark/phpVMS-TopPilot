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

//all time stats
?>
<h4>All Time Greats</h4>
<table width="100%" cellpadding="10px">
    <tr>
        <td width="50%" valign="top">
            <center>
                <b>Top Pilots All Time </b>(Flights Flown)
                <table class="profiletop">
                    <tr>
                        <th>Pilot</th>
                        <th>Flights Flown</th>
                    </tr>
                    <?php $all_flights = TopPilotData::alltime_flights(5);
                    foreach($all_flights as $all) {
                        $pilot = PilotData::GetPilotData($all->pilotid); ?>
                        <tr>
                            <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                            <td><?php echo $all->totalflights; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </center>
        </td>
        <td width="50%" valign="top">
            <center>
                <b>Top Pilots All Time </b>(Hours Flown)
                <table class="profiletop">
                    <tr>
                        <th>Pilot</th>
                        <th>Hours Flown</th>
                    </tr>
                    <?php $all_hours= TopPilotData::alltime_hours(5);
                    foreach($all_hours as $all) {
                        $pilot = PilotData::GetPilotData($all->pilotid); ?>
                        <tr>
                            <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                            <td><?php echo $all->totalhours; ?></td>
                        </tr>
                    <?php } ?>
                </table>
        </td>
    </tr>
</table>
<hr />
<?php //current month stats ?>
<h4>Current Month Stats</h4>
<table width="100%" cellpadding="10px">
    <?php $topflights = TopPilotData::top_pilot_flights($today[mon], $today[year], 5);
    if(!$topflights) {$month = date( 'F', mktime(0, 0, 0, $today[mon])); echo '<tr><td align="center" colspan="3">No Pireps Filed For '.$month.' '.$today[year].'</td></tr>'; }
    else {
        $month_name = date( 'F', mktime(0, 0, 0, $topflights[0]->month) );?>
        <tr>
            <td width="33%" valign="top">
                <center>
                    <b>Top Pilot for <?php echo $month_name.' '.$topflights[0]->year; ?> </b>(Flights Flown)
                    <table class="profiletop">
                        <tr>
                            <th>Pilot</th>
                            <th>Flights Flown</th>
                        </tr>
                        <?php foreach ($topflights as $top) {
                            $pilot = PilotData::GetPilotData($top->pilot_id); ?>
                            <tr>
                                <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                <td><?php echo $top->flights; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </center>
            </td>
            <td width="33%" valign="top">
                <center>
                    <?php $tophours = TopPilotData::top_pilot_hours($today[mon], $today[year], 5); ?>
                    <b>Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> </b>(Hours Flown)
                    <table class="profiletop">
                        <tr>
                            <th>Pilot</th>
                            <th>Hours Flown</th>
                        </tr>
                        <?php foreach ($tophours as $top) {
                            $pilot = PilotData::GetPilotData($top->pilot_id); ?>
                            <tr>
                                <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                <td><?php echo $top->hours; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </center>
            </td>
            <td width="33%" valign="top">
                <center>
                    <?php $topmiles = TopPilotData::top_pilot_miles($today[mon], $today[year], 5); ?>
                    <b>Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> </b>(Miles Flown)
                    <table class="profiletop">
                        <tr>
                            <th>Pilot</th>
                            <th>Miles Flown</th>
                        </tr>
                        <?php foreach ($topmiles as $top) {
                            $pilot = PilotData::GetPilotData($top->pilot_id); ?>
                            <tr>
                                <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                <td><?php echo $top->miles; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </center>
            </td>
        </tr>
        <tr>
            <td width="33%" valign="top">
                <center>
                    <?php $topawards = TopPilotData::top_pilot_awards($today[mon], $today[year], 5); ?>
                    <b>Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> </b>(Awards Received)
                    <table class="profiletop">
                        <tr>
                            <th>Pilot</th>
                            <th>Awards Received</th>
                        </tr>
                        <?php foreach ($topawards as $top) {
                            $pilot = PilotData::GetPilotData($top->pilot_id); ?>
                            <tr>
                                <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                <td><?php echo $top->awards; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </center>
            </td>
            <td width="33%" valign="top">
                <center>
                    <?php $toplanding = TopPilotData::top_pilot_landings($today[mon], $today[year], 5); ?>
                    <b>Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> </b>(Landing Rates)
                    <table class="profiletop">
                        <tr>
                            <th>Pilot</th>
                            <th>Landing</th>
                        </tr>
                        <?php foreach ($toplanding as $top) {
                            $pilot = PilotData::GetPilotData($top->pilot_id); ?>
                            <tr>
                                <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                <td><?php echo $top->landing; ?> <i>ft/min</i></td>
                            </tr>
                        <?php } ?>
                    </table>
                </center>
            </td>
            <td width="33%" valign="top">
                <?php if($tour_center) { ?>
                    <center>
                        <?php $toptours = TopPilotData::top_pilot_tours($today[mon], $today[year], 5); ?>
                        <b>Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> </b>(Tours Completed)
                        <table class="profiletop">
                            <tr>
                                <th>Pilot</th>
                                <th>Tours Completed</th>
                            </tr>
                            <?php foreach ($toptours as $top) {
                                $pilot = PilotData::GetPilotData($top->pilot_id); ?>
                                <tr>
                                    <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                    <td><?php echo $top->tours; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </center>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
<hr>
<h4>Historical Stats</h4>
<form action="<?php echo url('TopPilot/get_old_stats'); ?>" method="post">
    <center>
        <table class="profiletop">
            <tr>
                <td valign="top" align="center"><b>Select Month:</b></td>
                <td><select name="date" onchange="this.form.submit()">
                        <?php
                        $month = $today[mon];
                        $year = $today[year];
                        while($year >= $startyear): {
                            $month_name = date( 'F', mktime(0, 0, 0, $month) );
                            ?>
                            <option value="<?php echo $year.'-'.$month; ?>"><?php echo $month_name.' - '.$year; ?></option>
                            <?php
                            //advance dates
                            if ($month == $startmonth && $startyear == $year) {break;}
                            if ($month == 1) {$year--; $month = 12;}
                            else {$month--;}
                        }
                        endwhile;
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </center>
</form>