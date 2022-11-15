# twitter-nest
Tools for creating a decentralized Twitter clone on WordPress. 

- Tweet without using the Twitter interface.
- Automatically back up new tweets to WordPress. (requires <a href="https://developer.twitter.com/">developer account</a>)
- Import your tweet archive.

So long as the Twitter API is still working, you can tweet regardless of how the official website and app are functioning. 

Even if the API goes down, you can maintain an archive of your tweets and use the WordPress interface to add to it locally.

The Twitter archiver plugin can only access your 3,200 most recent tweets for an initial import. You will need to <a href="https://help.twitter.com/en/managing-your-account/how-to-download-your-twitter-archive" target="_new">download your archive from Twitter</a> if you want to restore older tweets.

----

**Live demo:** https://s.qiouyi.lu/tweets

----

**Feature development roadmap:** https://github.com/sqiouyilu/twitter-nest/wiki/Feature-development-roadmap

----

## Available tools

### <a href="https://github.com/ozh/ozh-tweet-archiver">ozh/ozh-tweet-archiver</a>

Automatically archive new tweets to WordPress. Requires <a href="https://developer.twitter.com/">developer account</a>.

### <a href="https://github.com/ozh/ozh-tweet-archiver-theme">ozh/ozh-tweet-archiver-theme</a>

Theme to display tweets.

### <a href="https://wordpress.org/plugins/wordpress-dashboard-twitter/">wordpress-dashboard-twitter</a>

Backend interface for tweeting from WordPress. Uses OAuth login.

### Settings page

Local copy of Twitter settings menu. Links take you back to Twitter website to manage your account.

### tweetsJS-to-tweetsCSV.pl

Perl command line script to convert downloaded Twitter archive tweets from JSON to CSV.

----

## Additional tools needed

### CSV importer for WordPress

Import downloaded archive. 

Several plugins are available. <a href="https://wordpress.org/plugins/tags/csv/">Select one that meets your needs from the WordPress plugins repository.</a>

----

## Tools in development

### Twitter contact manager

Import Twitter follows as WordPress users so you can annotate entries, attach contact information, and maintain your connections.

### glitch.me interface for tweet archive converter

So you don't have to use the command line to convert your archive.

----

## About the author

Finally, the skills I learned to process linguistic corpora come in handy for processing Twitter data, which is, ultimately, speech data. :)

Site: <a href="https://s.qiouyi.lu/" target="_new">s.qiouyi.lu</a><br />
Email: <a href="mailto:s@qiouyi.lu">s@qiouyi.lu</a><br />
Twitter: <a href="https://twitter.com/sqiouyilu" target="_new">@sqiouyilu</a>

**Tip Jars**

Direct: https://s.qiouyi.lu/shop/tip-jar/<br />
PayPal: https://paypal.me/sqiouyilu<br />
Venmo: @sqiouyilu<br />
Cashapp: $sqiouyilu
