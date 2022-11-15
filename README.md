# twitter-nest
Tools for creating a decentralized Twitter clone on WordPress. 

- Tweet without using the Twitter interface.
- Automatically back up new tweets to WordPress. (requires [developer account](https://developer.twitter.com/))
- Import your tweet archive.

So long as the Twitter API is still working, you can tweet regardless of how the official website and app are functioning. 

Even if the API goes down, you can maintain an archive of your tweets and use the WordPress interface to add to it locally.

The Twitter archiver plugin can only access your 3,200 most recent tweets for an initial import. You will need to [download your archive from Twitter](https://help.twitter.com/en/managing-your-account/how-to-download-your-twitter-archive) if you want to restore older tweets.

----

**Live demo:** https://s.qiouyi.lu/tweets

----

**Feature development roadmap:** https://github.com/sqiouyilu/twitter-nest/wiki/Feature-development-roadmap

----

## Available tools

### [ozh/ozh-tweet-archiver](https://github.com/ozh/ozh-tweet-archiver)

Automatically archive new tweets to WordPress. Requires [developer account](https://developer.twitter.com/).

### [ozh/ozh-tweet-archiver-theme](https://github.com/ozh/ozh-tweet-archiver-theme)

Theme to display tweets.

### [wordpress-dashboard-twitter](https://wordpress.org/plugins/wordpress-dashboard-twitter/)

Backend interface for tweeting from WordPress. Uses OAuth login.

### Settings page

Local copy of Twitter settings menu. Links take you back to Twitter website to manage your account.

### tweetsJS-to-tweetsCSV.pl

Perl command line script to convert downloaded Twitter archive tweets from JSON to CSV.

----

## Additional tools needed

### Website hosting and domain name

Space to store your tweets and an address for your space. Beginner's guide here: [Launchpad Themes # Why have a website?](https://s.qiouyi.lu/resources/launchpad-themes/)

### Self-hosted WordPress

Content management system for tweets. [Download at WordPress.org.](https://wordpress.org/download/)

Free WordPress.com accounts do not allow you to use plugins.

If you have an existing WordPress site, install a fresh WordPress in a subdomain or subdirectory to make managing your posts easier.

### CSV importer for WordPress

Import downloaded archive. 

Several plugins are available. [Select one that meets your needs from the WordPress plugins repository.](https://wordpress.org/plugins/tags/csv/)

----

## Tools in development

### Twitter contact manager

Import Twitter follows as WordPress users so you can annotate entries, attach contact information, and maintain your connections.

### glitch.me interface for tweet archive converter

So you don't have to use the command line to convert your archive.

----

## About the author

Finally, the skills I learned to process linguistic corpora come in handy for processing Twitter data, which is, ultimately, speech data. :)

Site: [s.qiouyi.lu](https://s.qiouyi.lu/)<br />
Email: [s@qiouyi.lu](mailto:s@qiouyi.lu)<br />
Twitter: [@sqiouyilu](https://twitter.com/sqiouyilu)

**Tip Jars**

Direct: https://s.qiouyi.lu/shop/tip-jar/<br />
PayPal: https://paypal.me/sqiouyilu<br />
Venmo: @sqiouyilu<br />
Cashapp: $sqiouyilu
