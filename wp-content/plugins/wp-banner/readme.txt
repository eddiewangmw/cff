=== Wordpress-Banner ===
Stable tag: 2.2.0
Requires at least: 3.9
Contributors: alfredocubitos
Tested up to: 3.9.1
Tags: banner, ads, adverts, advertising, ad
Donate link: http://bibuweb.de

== Description ==

WP Banner Admin allows you to manage various banner ads from different affiliate programs.
With the banner plugin you can manage:

* different banners programs from one affiliate provider
* various banners from different affiliate programs
* make banner campaigns limited by date or views
* show ads from different capaigns at the same time
* make ads context sensitive
* visual editor integration

Needless to say that this plugin supports banner rotation. Every banner is randomly selected after each
page reloaded.
Because of using the Ajax-Technology, the banner clicks will stored asynchronously to the database.
This may be important for sites with high page impressions, because banner actions (loading and clicking) will not
affect page loading time.

The bannersize support is usefull for Flash banner, because of Flash is a
vector format, so the original Flash-banner could be much bigger than the size you want to use in your ad.

Pay attention if you are using the bannersize option with images. 
If your are not sure what size your banner image may have, leave the selection empty.

== Installation ==

* copy the wp-banner.zip file into the wp-content/plugins/ directory
* extract the wp-banner.zip file 
* activate the plugin in the wp-admin menu
* add your first banner (Plugins / Banner Admin)

If you have the banners on your file system, even so you have to add the full URL (http://...) to the banner image.
The plugin only works in browsers with activated Javascript

== Update ==

* deactivate the plugin first
* unzip the new version into the plugin directory
* activate the plugin
* When upgrading from versions below  1.0.0:
   Administrate your existing banner at the admin frontend again!
* thats it

== Changelog ==

= 2.2.0 =

* TinyMCE-Plugin fix for WP 3.9
* This version will work correctly only with WP 3.9!

= 2.1.1 =

* *New:* Spanish language
* bugfix for textual ads
* bugfix for stiky ads

= 2.1.0 =

* *New:* Add banner from WP Media Library
* *New:* Sticky Ads for the first three posts

= 2.0.4 =

* css bugfix

= 2.0.3 =

* code cleanup
* bugfix: banner positioning in expert mode
* bugfix: help view
* *New:* Banner Admin menu added to toolbar

= 2.0.2 =

some bugfixes

= 2.0.0 =

* *New:* visual editor integration
* *New:* quick tag support
* *New:* Contract data: price per view, clicks or month
* *New:* basic statistic view

= 1.1.0 =
* some bugfixes
* language support for German and Czech (many thanks to Jan Fuček!)
* Banner rotation in widgets contributed by Jan Fuček

= 1.0.1 =
Security Update

= 1.0.0 = 

* almost complete rewritten
* new UI with latest jQuery support
* place your banner where ever you want
* no programming skills needed for placing the banner
* easy banner adjustment on admin UI
* multi widget support
* multi banner support

= 0.6.1 =
* bugfix

= 0.6.0 =
* bugfix

= 0.5.3 =
* security update

= 0.5 =

* Now you can add banner ads as widget and/or free positioned in a DIV.

= 0.4 =

* better support for banner positioning

= 0.3 =

* Now supports Flash banner
* Automatic filetype detection (Image- or Flash-Format)
* The style sheet for the banner DIV now is seperated from the code
* Banner size support

== Frequently Asked Questions ==

* Please visit [BiBuweb](http://bibuweb.de)

== Screenshots ==

* Please visit [BiBuweb](http://bibuweb.de)
