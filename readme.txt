TOPPilot v2.0

phpVMS module to extract monthly flight statistics for individual pilots from your phpVMS based virtual airline.

Released under the following license:
Creative Commons Attribution-Noncommercial-Share Alike 3.0 Unported License

The module was originally developed by:
simpilot - David Clark
www.simpilotgroup.com
www.david-clark.net

The TOPPilot v2.0 has been developed by:
PHP-Mods
www.php-mods.eu

Change Log from beta v1.0
- The module has been updated the auto update the statistics of the current month only. v1.0 was recalculating the statistics.
- The main page of the module now shows a list with the available months in a select area instead of the simple text list that it had. The pilot should be able
to view each month's statistics as soon as he/she clicks into the the month he/she wants to review.
- The module is now calculating the awards received, landings and tours completed per month by each pilot. For the tours, the module supports the simpilotgroup
tour system and the crazycreatives tour center. To activate it, you will have to open the core/modules/TopPilot/TopPilot.php and set number 1 or 2 on the
variable which is on line #20. 
If you do not have any tour module installation, this line should look like this:
	public $tour_center = 0;
If you are using the SimpilotGroup Tour System, this line should look like this:
	public $tour_center = 1;
If you are using the crazycreatives Tour Center, this line should look like this:
	public $tour_center = 2;

Included files:
readme.txt
top_flight.sql
TopPilot.php
TpPilotData.class.php
tp_index.tpl
tp_previous.tpl

Install:

-Download the attached package.
-unzip the package and place the files as structured in your root phpVMS install.

-your structure should be:
root
  core
    common
      TopPilotData.class.php
    modules
      TopPilot
        TopPilot.php
    templates
      tp_index.tpl
      tp_previous.tpl

-use the top_flights_install.sql file to create the table needed in your sql database using phpmyadmin or similar.
-use the top_flights_update.sql file to update the table need in your sql database using phpmyadmin or similar only if you are using the beta v1.0 of the module.
-after the initial install point your browser to yoursite/index.php/TopPilot/refresh_pilot_stats one time. This will populate the database table with any data available.
-to view the main TopPilot index create a link yoursite/index.php/TopPilot
-everytime a pirep is filed the module will recalculate the pilot stats and update the database
______________________________________________________

There are three main display functions within the TopPilotData class that you can configure to use in various parts of your site.

Flights flown - TopPilotData::top_pilot_flights($month, $year, 5)
Hours flown -  TopPilotData::top_pilot_hours($month, $year, 5)
Miles flown - TopPilotData::top_pilot_miles($month, $year, 5)
Awards Received - TopPilotData::top_pilot_awards($month, $year, 5)
Landing Rates - TopPilotData::top_pilot_landings($month, $year, 5)
Tours Completed - TopPilotData::top_pilot_tours($month, $year, 5)

$month should be the two digit month id of the month you want data from � ie 06 = June
$year is the four digit year you are pulling - ie 2010
5 can be changed to how many records you want returned.
______________________________________________________

TopPilot.php line 60 & 103.

Uncomment the trailing section and the module will not include unapproved PIREPS. Doing this will cause the module not to display any newly accepted PIREPS in the TopPilot data listings until after another PIREP is filed  although you can refresh the stats at anytime using � yoursite/index.php/TopPilot/refresh_pilot_stats

Although this script carries no limits of use a link back to www.simpilotgroup.com would be greatly appreciated!

Have fun!
