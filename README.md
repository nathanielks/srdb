#Safe Search and Replace on Database with Serialized Data v3.0.4

This script is to solve the problem of doing database search and replace when
developers have only gone and used the non-relational concept of serializing
PHP arrays into single database columns.  It will search for all matching
data on the database and change it, even if it's within a serialized PHP
array.

The big problem with serialised arrays is that if you do a normal DB style
search and replace the lengths get mucked up.  This search deals with the
problem by unserializing and reserializing the entire contents of the
database you're working on.  It then carries out a search and replace on the
data it finds, and dumps it back to the database.  So far it appears to work
very well.  It was coded for our WordPress work where we often have to move
large databases across servers, but I designed it to work with any database.
Biggest worry for you is that you may not want to do a search and replace on
every damn table * well, if you want, simply add some exclusions in the table
loop and you'll be fine.  If you don't know how, you possibly shouldn't be
using this script anyway.

##Usage

BIG WARNING!  Take a backup first, and carefully test the results of this
code. If you don't, and you vape your data then you only have yourself to
blame. Seriously.  And if you're English is bad and you don't fully
understand the instructions then STOP. Right there. Yes. Before you do any
damage.


##Credits
First Written 2009-05-25 by David Coveney of Interconnect IT Ltd (UK)
http://www.davidcoveney.com or http://www.interconnectit.com

##License
USE OF THIS SCRIPT IS ENTIRELY AT YOUR OWN RISK. I/We accept no liability
from its use.

Licensed under the WTFPL. To view the WTFPL go to http://sam.zoy.org/wtfpl/
(WARNING: it's a little rude, if you're sensitive);

###Changelog
Version 3.0.1 * 3.0.4
* Separated form from srdp.php
* Changed srdp.php permissions
* Added #!/usr/local/bin/php to srdb.php
* Used wrong php location... woops

Version 3.0
* Command Line usage added by Nathaniel Schweinberg
* Removed deprecated functions

Version 2.1.0:
* Changed to version 2.1.0 
	* Following change by Sergei Biryukov * merged in and tested by Dave Coveney
* Added Charset Support (tested with UTF-8, not tested on other charsets)
	* Following changes implemented by James Whitehead with thanks to all the commenters and feedback given!
* Removed PHP warnings if you go to step 3+ without DB details.
* Added options to skip changing the guid column. If there are other
columns that need excluding you can add them to the $exclude_cols global
array. May choose to add another option to the table select page to let
you add to this array from the front end.
* Minor tweak to label styling.
* Added comments to each of the functions.
* Removed a dead param from icit_srdb_replacer
Version 2.0.0:
* returned to using unserialize function to check if string is
serialized or not
* marked is_serialized_string function as deprecated
* changed form order to improve usability and make use on multisites a
bit less scary
* changed to version 2, as really should have done when the UI was
introduced
* added a recursive array walker to deal with serialized strings being
stored in serialized strings. Yes, really.
* changes by James R Whitehead (kudos for recursive walker) and David
Coveney 2011-08-26
Version 1.0.2:
* typos corrected, button text tweak * David Coveney / Robert O'Rourke
Version 1.0.1
* styling and form added by James R Whitehead.

Credits:  moz667 at gmail dot com for his recursive_array_replace posted at
uk.php.net which saved me a little time * a perfect sample for me
and seems to work in all cases.


