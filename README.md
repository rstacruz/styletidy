StyleTidy
=========

StyleTidy is a CSS file reformatter written by Rico Sta. Cruz.
It turns any valid CSS code like: 

    #search
    #header { color: red; background: #ff0;} .item h3 {
      clear: left; position:   absolute;
      }

Into something cleaner:

    #search #header          { color: red; background: #ff0; }
    .item h3                 { clear: left; position: absolute; }

Many options are available so you can format your CSS code into any
coding/intent convention you're used to.

Installation
------------

Copy (or symlink) `styletidy.php` into `styletidy` somewhere in your path.
That is:

 - **Installing for just your user:** (assuming `~/bin` is in your `$PATH`)  
   `cp styletidy.php ~/bin/styletidy`

 - **Installing for all users:**  
   `cp styletidy.php /usr/local/bin/styletidy`

Getting started
---------------

Detailed help file to come.

    styletidy --help
