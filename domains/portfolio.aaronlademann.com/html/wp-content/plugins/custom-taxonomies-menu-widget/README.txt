=== Custom Taxonomies Menu Widget ===

Version: 1.2.2
Author: Ade Walker
Author page: http://www.studiograsshopper.ch
Plugin page: http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/
Tags: custom taxonomies,taxonomy, menu, widget
Requires at least: 3.2
Tested up to: 3.3
Stable tag: 1.2.2

Creates a simple menu of your custom taxonomies and their associated terms, ideal for sidebars. Highly customisable via widget control panel.


== Description==

Creates a simple menu of your custom taxonomies and their associated terms, ideal for sidebars. Highly customisable via checkboxes to select which custom taxonomies and terms are displayed in the menu.

**Key Features**
----------------

* Select which custom taxonomies to display
* Select which terms to display within the selected custom taxonomies
* Choose the order in which terms are displayed within the custom taxonomies (ID, name, count, etc)
* Choose whether to display the taxonomy name as a title
* Choose whether to display the list of terms as a hierarchy
* Choose whether to hide terms with no posts
* NEW - New terms are now automatically added to the menu


**Further information**
-----------------------
Comprehensive information on installing, configuring and using the plugin can be found [here](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/)

* [Configuration Guide](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/)
* [FAQ](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/faq/)


All support is handled at the [Studiograsshopper Forum](http://www.studiograsshopper.ch/forum/). I do not have time to monitor the wordpress.org forums, therefore please post any questions on my site's forum.


== Installation ==


**New Installation**
--------------------------------------------
Either use the automatic installer via the Dashboard>Plugins page or manually install as follows:
1. Download the latest version of the plugin to your computer.
2. Extract and upload the folder *custom-taxonomies-menu-widget* to your */wp-content/plugins/* directory. Please ensure that you do not rename any folder or filenames in the process.
3. Activate the plugin in your Dashboard via the "Plugins" menu item.
4. Go to the plugin's Settings page, and configure your settings.

Note for WordPress Multisite users:

* Install the plugin in your */plugins/* directory (do not install in the */mu-plugins/* directory).
* In order for this plugin to be visible to Site Admins, the plugin has to be activated for each blog by the Network Admin. Each Site Admin can then configure the plugin's Settings page in their Admin Settings.

**Upgrading from a previous version**
-------------------------------------
Either use the automatic upgrader via the Dashboard>Plugins page or manually upgrade as follows:
1. Download the latest version of the plugin to your computer.
2. Extract and upload the folder *custom-taxonomies-menu-widget* to your */wp-content/plugins/* directory, overwriting the existing *custom-taxonomies-menu-widget* folder and its contents. Please ensure that you do not rename any folder or filenames in the process.
3. Go to the plugin's Settings page, and configure any new settings introduced with the upgrade.


**Instructions for use**
------------------------

**Using the plugin** 

Go to your Dashboard > Appearance > Widgets page and drag the Custom Taxonomies Menu widget to your sidebar. Open the widget and configure the options.



== Configuration and set-up ==

Comprehensive information on installing, configuring and using the plugin can be found [here](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/)

* [Configuration Guide](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/)
* [FAQ](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/faq/)



== Frequently Asked Questions ==

None at present.


**Download**
------------

Latest stable version is available from http://wordpress.org/extend/plugins/custom-taxonomies-menu-widget/ 


**Support**
-----------

This plugin is provided free of charge without warranty.  In the event you experience problems you should visit these resources:

* [Custom Taxonomies Menu Widget home page](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/)
* [Configuration Guide](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/)
* [FAQ](http://www.studiograsshopper.ch/custom-taxonomies-menu-widget/faq/)

If, having referred to the above resources, you still need assistance, visit the support page at http://www.studiograsshopper.ch/forum/.  Support is provided in my free time but every effort will be made to respond to support queries as quickly as possible. I do not have time to monitor the wordpress.org forums, therefore please post any questions on my site's forum.

Thanks for downloading the plugin.  Enjoy!

If you have found the plugin useful, please consider a Donation to help me continue to invest the time and effort in maintaining and improving this plugin. Thank you!


**Troubleshooting**
-------------------

In the event of problems with the plugin, refer to the Resources listed above.



== Screenshots ==
1. Custom Taxonomies Menu Widget



== Changelog ==

= 1.2.2 =
* Released 1 January 2012
* Bug fix: Fixed PHP data type error

= 1.2.1 =
* Released 29 December 2011
* Bug fix: Fixed PHP error on upgrade with $known_terms returning NULL

= 1.2 =
* Released 28 December 2011
* Bug fix: Now ignores taxonomies with no terms
* Bug fix: Fixed missing internationalisation for strings in the widget form
* Bug fix: Enqueues admin CSS properly now
* Enhance: Upped minimum WP version requirement to 3.2 - upgrade!
* Enhance: Widget sub-class now uses PHP5 constructor
* Enhance: Widget control form made wider, less scrolling required for long taxonomy checklist
* Enhance: Added activation hook function for WP version check, deprecated SGR_CTMW_WP_VERSION_REQ constant
* Enhance: sgr_ctmw_wp_version_check() deprecated
* Enhance: sgr_ctmw_admin_notices() deprecated
* Enhance: Added SGR_CTMW_HOME for plugin's homepage url on studiograsshopper
* Enhance: Plugin files reorganised, sgr-ctmw-admin-core.php no longer used
* Feature: 'hide_empty' options added, to allow display of empty terms in the menu
* Feature: New terms are now automatically added to menu, and 'checked' in the widget form

= 1.1.1 =
* Released 1 March 2011
* Bug fix: Removed debug code form sgr_ctmw_wp_version_check() function

= 1.1 =
* Released 4 November 2010
* Feature: Added option to hide Taxonomy title
* Feature: Added option to select whether or not to display terms as a hierarchy

= 1.0 =
* Public release 9 October 2010