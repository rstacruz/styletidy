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

First, download StyleTidy. You can get it from the StyleTidy
(GitHub page)[http://github.com/rstacruz/styletidy/tree/master], or
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

Detailed help file to come.

    styletidy --help
