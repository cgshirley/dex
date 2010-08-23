# DEX

First developed for Yale's radio station, WYBC, DEX is a web app that makes it easier for radio stations to operate in the digital age.

## Features

* Song tracking
* Charts
* Member management
* Automatic recording

## License

DEX is licensed as free, open-source software under the GPL license. A copy of this license is included in the source code repository as license.txt.

## TODO

* Rename dj.php to something that reflects the fact that it is our main configuration file
* Use the configuration file instead of hardcoding stuff (un-hardcode stuff)
* Make models/songtracker detect the length of a show instead of pre-supposing length 1 hr
* Make models/songtracker use more intelligent filenames
* Fix the issues where DEX repeats requests more than once to the recorder backend
* Abstract show scheduling data to not depend on the WYBC website
* Rewrite website interface with an actual API (libraries/drupal)
* A lot of other stuff that will take forever

