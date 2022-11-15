# twitter-nest
Tools for creating a decentralized Twitter clone on WordPress. 

- Tweet without using the Twitter interface.
- Automatically back up new tweets to WordPress. (requires <a href="https://developer.twitter.com/">developer account</a>)
- Import your tweet archive.

So long as the Twitter API is still working, you can tweet regardless of how the official website and app are functioning. Even if the API goes down, you can maintain an archive of your tweets and use the WordPress interface to add to it locally.

The Twitter archiver plugin can only access your 3,200 most recent tweets for an initial import. You will need to <a href="https://help.twitter.com/en/managing-your-account/how-to-download-your-twitter-archive" target="_new">download your archive from Twitter</a> if you want to restore older tweets.

Live demo: https://s.qiouyi.lu/tweets

Feature development map: https://github.com/sqiouyilu/twitter-nest/wiki/Feature-development-roadmap

----

## Available tools

### tweetsJS-to-tweetsCSV.pl

Perl command line script to convert tweets.js from a downloaded Twitter archive to a CSV that can be imported to WordPress with a CSV import plugin.

### <a href="https://github.com/ozh/ozh-tweet-archiver">ozh/ozh-tweet-archiver</a>

Plugin to automatically archive tweets to WordPress. Requires developer account.

### <a href="https://github.com/ozh/ozh-tweet-archiver-theme">ozh/ozh-tweet-archiver-theme</a>

Theme to display tweets.

### <a href="https://wordpress.org/plugins/wordpress-dashboard-twitter/">wordpress-dashboard-twitter</a>

Backend interface for tweeting from WordPress. Uses OAuth login.

----

## Additional tools needed

### CSV importer for WordPress

Needed to import a downloaded archive. Several are available. <a href="https://wordpress.org/plugins/tags/csv/">Select one that meets your needs from the WordPress plugins repository.</a>

----

## Tools in development

### glitch.me interface for tweet archive converter

So you don't have to use the command line to convert your archive.

----

## About the author

Finally, the skills I learned to process linguistic corpora come in handy for processing Twitter data, which is, ultimately, speech data. :)

Site: <a href="https://s.qiouyi.lu/" target="_new">s.qiouyi.lu</a><br />
Email: <a href="mailto:s@qiouyi.lu">s@qiouyi.lu</a><br />
Twitter: <a href="https://twitter.com/sqiouyilu" target="_new">@sqiouyilu</a>

*Tip Jars*

Direct: https://s.qiouyi.lu/shop/tip-jar/<br />
PayPal: https://paypal.me/sqiouyilu<br />
Venmo: @sqiouyilu<br />
Cashapp: $sqiouyilu
