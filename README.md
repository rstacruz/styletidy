StyleTidy
=========

StyleTidy is a CSS file reformatter written by Rico Sta. Cruz,
released under the MIT license.
It takes any valid CSS code such as the one below: 

    #search
    #header { color: red; background: #ff0;} .item h3 {
      clear: left; position:   absolute;
      }

And turns it into something cleaner (the `clean` preset shown below):

    #search #header          { color: red; background: #ff0; }
    .item h3                 { clear: left; position: absolute; }

Or even perhaps (the `verbose` preset shown below):

    #search #header {
       color:       red;
       background:  #ff0;
    }

    .item h3 {
       clear:       left;
       position:    absolute;
    }

Many options are available so you can format your CSS code into any
common coding and indentation style.

Installation
------------

First, download StyleTidy. You can get it from the StyleTidy
[GitHub page](http://github.com/rstacruz/styletidy/tree/master), or
cloning the repository via git:

    git clone git://github.com/rstacruz/styletidy.git

Next, copy (or symlink) `styletidy.php` into `styletidy` somewhere in your path.
That is:

 - **Installing for just the active user:** (assuming `~/bin` is in your `$PATH`)  
   `cp styletidy.php ~/bin/styletidy`

 - **Installing for all users:**  
   `cp styletidy.php /usr/local/bin/styletidy`

Doing a symlink is recommended if you did the `git clone` line above -- that way,
you can simply do `git pull` to upgrade StyleTidy). You can do this by replacing
`cp` from the lines above with `ln -s`.

Getting started
---------------

You can get basic usage info through:

    styletidy --help

The StyleTidy manual (very crude at the moment!) can be accessed in:
http://ricostacruz.com/styletidy/manual/

