# chperms
A script to reset SuiteCRM/SugarCRM permissions via browser

chperms.php is a simple script that resets SuiteCRM/SugarCRM permissions via a browser.

Pre-requisites:
A linux/unix installation of SuiteCRM/SugarCRM

Installation:
copy the file chperms.php in the root folder of your SuiteCRM/SugarCRM instance.

Usage:
Open a browser tab or window.
Type the url to your SuiteCRM/SugarCRM root folder followed by /chperms.php then hit enter as in the following example:

http://www.yoursite.com/yourcrm/chperms.php

By default the script runs in silent mode so no output is displayed. When execution is finished permissions will have been reset to the correct values.

Once the script has finished running it is recommended that you run, from within SuiteCRM/SugarCRM, Quick Repair and Rebuild. It may be necessary that both the chperms script and Quick Repair and Rebuild have to be run a few times.

Options:
Verbose/Silent mode:
There are two ways to switch from verbose to silent mode:

. Edit the script
it is possible to edit the script comment or uncomment one of the two following lines:

// define('chmod_debug_mode', TRUE);

or:

define('chmod_debug_mode', FALSE);

The default is Silent.

. Add the verbose variable in the url of the script in the following way:
http://www.yoursite.com/yourcrm/chperms.php?verbose=true
or
http://www.yoursite.com/yourcrm/chperms.php?verbose=false

If you pass the verbose variable when invoking the script, this will prevail and override the chmod_debug_mode constant.
