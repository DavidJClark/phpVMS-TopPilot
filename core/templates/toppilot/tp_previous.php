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

//old month stats
$month_name = date( 'F', mktime(0, 0, 0, $month) );
?>
<h4><?php echo $month_name.' '.$year; ?> Stats</h4>
<?php if(!$topflights) {echo 'No flights filed'; }
else
{ ?>
    <table width="100%" cellpadding="10px">
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
    </table>
<?php } ?>
<hr>
<form method="link" action="<?php echo url('TopPilot'); ?>">
    <p align="center"><input type="submit" value="Current Month"></p>
</form>