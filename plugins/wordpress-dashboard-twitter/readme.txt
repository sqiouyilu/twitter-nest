=== WordPress Dashboard Tweeter ===
Contributors: Alphawolf, ratterobert
Donate link: https://www.schloebe.de/donate/
Tags: twitter, tweet, wordpress, dashboard, widget, wpgd, oauth, retweet, timeline
Requires at least: 6.0
Tested up to: 6.1
Requires PHP: 8.0
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPress Dashboard Tweeter represents a Dashboard Widget for WordPress, that turns your Dashboard into a Twitter Client.

== Description ==

Twitter is everywhere. So why not in your WordPress Dashboard? WordPress Dashboard Tweeter is a **Dashboard Widget** that displays Twitter @replies, sent direct messages, Retweets, Friends Timeline and favorites the convenient way within your WordPress Dashboard. WordPress Dashboard Tweeter turns your Dashboard into a **Twitter client**.

The Dashboard widget lets you update your status, follow your mentions and retweets, your friends timeline and your favorites in a simple tab interface. All in a single widget. No seperate admin page needed. All the Twitter stuff you need right *where* you need it.

[Developer on Twitter](https://twitter.com/wpseek "Developer on Twitter")

**Looking for more WordPress plugins? Visit [www.schloebe.de/portfolio/](https://www.schloebe.de/portfolio/)**

[vimeo https://vimeo.com/5734274]

**Note:** The plugin requires at least WordPress 6.0 and PHP 8 in order to run. The openSSL module is mandatory, too.

**At a glance:**

* Twitter OAuth authentication
* Adds a Twitter Client to your WordPress Dashboard only
* Display Mentions, Retweets, Timeline and Favorites in a tabbed interface
* Reply to a Twitter status from within the Dashboard Widget
* No dedicated page in your WordPress admin panel
* All customization can be done through the widget’s configuration
* No impact on your blog’s frontend or other backend pages
* Whenever you check your incoming links or WordPress News in the Dashboard, you can check your Twitter status as well

**Included languages:**

* English
* German (de_DE) (Thanks to Robert Pfotenhauer ;-))
* Italian (it_IT) (Thanks for contributing italian language goes to [Gianni Diurno](https://gidibao.net))
* Danish (da_DK) (Thanks for contributing danish language goes to [Georg S. Adamsen](https://wordpress.blogos.dk/))
* French (fr_FR) (Thanks for contributing french language goes to [Didier](https://www.wptrads.fr))
* Dutch (nl_NL) (Thanks for contributing dutch language goes to [Rene](https://wpwebshop.com/premium-wordpress-plugins/))
* Turkish (tr_TR) (Thanks for contributing turkish language goes to [Ömer Faruk Karabulut](https://stamboulbazaar.com/))
* Swedish (sk_SK) (Thanks for contributing swedish language goes to [Branco Radenovich](https://webhostinggeeks.com/user-reviews/))
* Spanish (es_ES) (Thanks for contributing spanish translation goes to [Ibidem Group](https://www.ibidem-translations.com))

== Frequently Asked Questions ==

= Why isn't this or that implemented to improve the plugin interface? =

If you have suggestions please let us know by dropping us a line via e-mail or the wp.org forums.

== Installation ==

1. Download the plugin and unzip it.
2. Upload the folder wp-dashboard-twitter/ to your /wp-content/plugins/ folder.
3. Activate the plugin from your WordPress admin panel.
4. Installation finished.

== Changelog ==

= 1.3.2 =
* FIXED: WordPress 6.0 compatibility
* FIXED: PHP 8.x compatibility
* FIXED: Updated dependencies

= 1.3.1 =
* FIXED: WordPress 5.3 compatibility

= 1.3.0 =
* FIXED: New Twitter OAuth login flow (Twitter login was broken due to Twitter API changes)
* FIXED: Various bugfixes and improvements

= 1.2.1 =
* FIXED: Various bugfixes and improvements

= 1.2.0 =
* FIXED: Refined UI
* FIXED: Improved info and links
* FIXED: Improved auto-linking of hashtags, lists, usernames and external links
* FIXED: Minor bugfixes

= 1.1.21 =
* FIXED: WordPress 4.7 compatibility
* FIXED: PHP 7 compatibility

= 1.1.20 =
* FIXED: Issue with not serving Twitter profile images on SSL sites

= 1.1.13 =
* FIXED: Issue caused by code minification

= 1.1.11 =
* FIXED: 'Redefining already defined constructor' bug that occured on several configurations
* FIXED: WP 3.8 compatibility

= 1.1.10 =
* FIXED: jQuery UI deprecation changes

= 1.1.9 =
* FIXED: Migrated to Twitter API 1.1 as 1.0 retired

= 1.1.8 =
* FIXED: Changed some button labels to be more clear

= 1.1.7 =
* NEW: Compatibility Mode added for users who can't sign in with Twitter

= 1.1.6 =
* NEW: Swedish localization added

= 1.1.5 =
* FIXED: Oauth bug that prevented new users to authenticate with Twitter
* FIXED: WordPress 3.5 UI enhancements

= 1.1.4 =
* FIXED: Removed unused files
* FIXED: Readme.txt updated to be more compliant with the readme.txt standard
* FIXED: Moved screenshots off the package to the assets/ folder

= 1.1.3 =
* FIXED: Fixed a bug that caused some status messages to be blank (due to wrong character encoding)

= 1.1.2 =
* FIXED: Fixed a bug that caused some tabs to be blank

= 1.1.1 =
* FIXED: Maintenance update

= 1.1.0.3 =
* FIXED: Maintenance update

= 1.1.0.2 =
* NEW: Turkish localization added

= 1.1.0.1 =
* FIXED: Some images were missing

= 1.1 =
* FIXED: Fixed a bug that prevented the tabs to show properly
* FIXED: UI changes

= 1.0.7 =
* FIXED: Maintenance Release

= 1.0.6 =
* FIXED: Security update, please apply immediately!

= 1.0.5 =
* FIXED: Retweets will now show up in your Home Timeline
* FIXED: Retweet button now working
* FIXED: Code Cleanups

= 1.0.2 =
* NEW: Dutch localization added

= 1.0.1 =
* FIXED: Danish localization updated
* FIXED: Redeclaration error in OAuthException class

= 1.0 =
* ADDED: Switched from Basic Auth to Twitter OAuth authentication (doesn't require to save your credentials in your WP install)
* ADDED: Retweets Tab, Timeline Tab
* ADDED: French localization
* FIXED: New Twitter+OAuth lib + Code rewrite
* FIXED: Dashboard Widget can now be accessible by everyone (via settings)

= 0.8.8 =
* FIXED: Fixed a minor issue that made it so that you only had 139 characters to post (Thanks Marius for letting us know!)

= 0.8.7 =
* FIXED: Twitter avatars larger than 48x48 forced back to the regular format so they don't break the layout (Thanks smaakmakend for reporting!)

= 0.8.6 =
* FIXED: JS and CSS files won't be included in index.php pages other than dashboard only anymore
* FIXED: Removed references to images that don't exist (anymore) in tabs.style.css
* FIXED: Added a check if Twitter is available
* FIXED: Added request and response timeouts to all CURL operations

= 0.8.5 =
* FIXED: Damn you guys at tr.im! - re-integrated tr.im URL shortener

= 0.8.4 =
* FIXED: tr.im discontinued service thus it has been removed
* NEW: Added bit.ly URL shortener

= 0.8.3 =
* FIXED: passwords are now stored encrypted
* FIXED: incorrect link in the sent panel

= 0.8.2 =
* NEW: Verifying credentials on options panel
* FIXED: issue with localization on AJAX loading (thanks for testing, [Gianni Diurno](https://gidibao.net)!)
* FIXED: CSS, JS, PHP code & security improvements

= 0.8 =
* initial version

== Other Notes ==

= Video Demo =

[vimeo https://vimeo.com/5734274]

= Licence =

This plugins is released under the GPL, you can use it free of charge on your personal or commercial blog.

= Acknowledgements =

* Thanks to [Abraham Williams](https://twitteroauth.com/ "Abraham Williams") for the great Twitter library
* Thanks to all the beta testers ;-)

== Screenshots ==

1. OAuth authentication
1. The tabbed interface
1. The status update form
1. The status update form, changed submit button label when sending a DM
1. The options panel