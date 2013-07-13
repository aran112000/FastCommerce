FastCommerce: a fast PHP eCommerce platform
===========================================

FastCommerce is in the very early stages of development and as such major structural changes can be made without prior notice, we strongly advice against using in a production environment at this time.

FastCommerce is a fast eCommerce framework written in PHP and designed from the ground up for rapid development/deployment

If you would like to get involved in the development of FastCommerce then please feel free to get in contact with Aran via email: cdtreeks@gmail.com who is heading up the development.

Please feel free to submit pull requests for any bug bugs you find and fix.

Track our development progress
==============================
We are using YouTrack for monitoring development progress so to see exactly what we're working on at the moment please visit out YouTrack here:
http://fastcommerce.myjetbrains.com/youtrack/rest/agile/FC/sprint/Unscheduled

What platforms have been tested?
================================
After starting out with no unit testing in place (and now regretting this), we are currently working on implementing PHPUnit with a view of eventual 100% code coverage. We will shortly be starting CI using Travis (travis-ci.org).

We are currently developing and testing as we go in both Linux & Windows environments, below is the key versions we're using:
 - OS          : CentOS 6.3 (Final) & Window 7 (using Winginx)
 - Web Server  : Nginx, Apache (reports from other users within Apache environments confirm it works correctly although not officially tested yet)
 - PHP         : 5.4.11, 5.4.16 & PHP-FPM 5.4.15
 - DB          : MySQL 5.5.31 & 5.1.62
 - Caching     : Memcached Version(s) 1.4.4 & 1.4.15 & Memcache