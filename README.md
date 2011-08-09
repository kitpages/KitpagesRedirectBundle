KitpagesRedirectBundle (work in progress)
=====================================

This is a redirect system for symfony2. (still no real documentation)

You register a list of sourceUrl and destinationUrl. if the URL requested
by a navigator is in sourceUrl, you are redirected (301 redirection) to the
destinationUrl.

There is a very basic interface to record list of urls. It is directly generated
by the symfony2 genrator.

author : Philippe Le Van (@plv)


Installation
-------------
hum... as usual...

put the code in vendors/Kitpages/RedirectBundle

add vendors/ in the app/autoload.php

add the new Bundle in app/appKernel.php

You need to create a table in the database :
./app/console doctrine:schema:update

Users Guide
-----------
TODO :

