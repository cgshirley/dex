# DEX

First developed for Yale's radio station, WYBC, DEX is a web app that makes it easier for radio stations to operate in the digital age.

## Features

* Song tracking
* Charts
* Member management
* Automatic recording

## License

DEX is free software, licensed under the terms of the GNU GPLv2. This means that you are free
to use, modify, and redistribute the software under the terms of the same license, with no
warranties, expressed or implied. Please view the full text of the license in the
GPL.txt file which is included in the distribution.

The DEX program is derived from CodeIgniter. A copy of the CodeIgniter License Agreement
is included under the file named CodeIgniterAgreement.txt in the distribution.

## TODO

* Use the configuration file instead of hardcoding stuff (un-hardcode stuff)
* Make models/songtracker detect the length of a show instead of pre-supposing length 1 hr
* Fix the issues where DEX repeats requests more than once to the recorder backend
* Abstract show scheduling data to not depend on the WYBC website
* Rewrite website interface with an actual API (libraries/drupal)
* A lot of other stuff that will take forever

