# Psalm Playground Plugins

These Psalm plugins aim to provide a playground that makes it easy to learn more about the various event handlers provided by the Psalm API.  By default they print each location analyzed by Psalm, and can be modified to quickly test the result of any desired action in any of Psalm's API interfaces.

To see these plugins in action:
1. Clone this repo
1. Run `composer install`
1. Run `psalm --no-cache` to see a trace of `example.php` including lines & positions from which each of Psalm's API events are fired
1. Modify these plugins to learn whatever you like!  Suggestions include but are not limited to...
    - Include your own code in `example.php` to learn more about how Psalm steps through it
    - Modify these plugins to perform any action you like to aid in learning how to write your own plugins
    - Include these plugins in your own projects to see how Psalm steps through them
    - Modify these plugins in your own projects to only show traces and/or perform actions relevant to your own goals
    - Use the `static::dump()` method to get details about any Psalm class.