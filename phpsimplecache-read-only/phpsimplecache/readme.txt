Table of Contents
-----------------
1. License Information
2. Disclaimer
3. Installation
4. Support
5. Credits


1. License Information
----------------------
PHP Simple Cache is release under the GNU GENERAL PUBLIC LICENSE Version 2, June 1991.  For a full copy of the license
please visit: http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt

PHP Simple Cache is Copyright (C) 2008 by Matt Walters.


2. Disclaimer
-------------
PHP Simple Cache is provided as-is and has not been widely tested at this time.  You may use it at your own risk.  The
developers are not responsible for any monetary of physical damages that result from the use of PHP Simple Cache.


2. Installation
---------------
Installation of PHP Simple Cache is fairly straight forward.

- Add simpleCache.php to your projects root directory.

- Create a directory called "Cache" off the projects root directory and make sure it is able to be written to by PHP

- Include "simpleCache.php" on each page you wish for a cached version to be served such as:
      <?php include_once('simpleCache.php'); ?>

- You can optionally include PHP Simple Cache from a common file and have it cache any pages that file is included on. If
you take this approach, then on any pages you wish to not have cached, on a line BEFORE simpleCache.php is included, add:
      <?php $Bypass_Cache = 'Yes'; ?>


3. Support
----------
If you have discovered a bug regarding this software, please visit the Google Code site established and submit a ticket
in the issues area located here: http://code.google.com/p/phpsimplecache/issues/list


4. Credits
----------
At this time, PHP Simple Cache is created and Maintained by Matt Walters - http://mattwalters.net/