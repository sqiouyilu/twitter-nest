# twitter-nest

**Tools for creating a decentralized Twitter clone on WordPress.**

- Tweet without using the Twitter interface.
- Automatically back up new tweets to WordPress. (requires [developer account](https://developer.twitter.com/))
- Import your tweet archive.

So long as the Twitter API is still working, you can tweet regardless of how the official website and app are functioning. 

Even if the API goes down, you can maintain an archive of your tweets and use the WordPress interface to add to it locally.

The Twitter archiver plugin can only access your 3,200 most recent tweets for an initial import. You will need to [download your archive](https://help.twitter.com/en/managing-your-account/how-to-download-your-twitter-archive) if you want to archive older tweets.

----

**Live demo:** https://s.qiouyi.lu/tweets

----

**Feature development roadmap:** https://github.com/sqiouyilu/twitter-nest/wiki/Feature-development-roadmap

----

## Prerequisites

### Website hosting and domain name

- Space to store your tweets and an address for your space. 
- **Beginner's guide:** [Launchpad Themes # Why have a website?](https://s.qiouyi.lu/resources/launchpad-themes/)

### Self-hosted WordPress

- Content management system for tweets. [Download at WordPress.org.](https://wordpress.org/download/)
- Free WordPress.com accounts do not allow you to use plugins.
- If you have an existing WordPress site, install a fresh WordPress in a subdomain or subdirectory to make managing your posts easier.

### CSV importer for WordPress

- Import downloaded archive. 
- Several plugins available. [Select one that meets your needs from WordPress repository.](https://wordpress.org/plugins/tags/csv/)

----

## Twitter nest toolkit

### [ozh/ozh-tweet-archiver](https://github.com/ozh/ozh-tweet-archiver)

- Automatically archive new tweets to WordPress. Requires [developer account](https://developer.twitter.com/).

### [ozh/ozh-tweet-archiver-theme](https://github.com/ozh/ozh-tweet-archiver-theme)

- Theme to display tweets.

### [wordpress-dashboard-twitter](https://wordpress.org/plugins/wordpress-dashboard-twitter/)

- Backend interface for tweeting from WordPress. Uses OAuth login.

### Settings page

- Local copy of Twitter settings menu. 
- Links take you back to Twitter.com to manage your account.

### tweetsJS-to-tweetsCSV.pl

- Perl command line script to convert downloaded Twitter archive tweets from JSON to CSV. 
- Also creates a human-readable, plain text, flat database of your tweets as a log.

----

## Additional tools and resources

### [jessefogarty/tweet-archive-converter.py](https://gist.github.com/jessefogarty/b0f2d4ea6bdd770e5e9e94d54154c751)

- Python command line script to convert downloaded Twitter archive tweets from JSON to CSV.
- Will capture all data in JSON, but may require further cleanup if you want to import hashtags and mentions as tags.
- Does not produce human-readable log.

----

## Tools in development

### Twitter contact manager

- Import Twitter follows as WordPress users so you can annotate entries, attach contact information, and maintain your connections.

### glitch.me interface for tweet archive converter

- So you don't have to use the command line to convert your archive to CSV.

----

## About the author

Finally, the skills I learned to process linguistic corpora come in handy for processing Twitter data, which is, ultimately, speech data. :)

### Contact information

- **Site:** [s.qiouyi.lu](https://s.qiouyi.lu/)
- **Email:** [s@qiouyi.lu](mailto:s@qiouyi.lu)
- **Twitter:** [@sqiouyilu](https://twitter.com/sqiouyilu)

### Tip jars

- **Direct:** https://s.qiouyi.lu/shop/tip-jar/
- **PayPal:** https://paypal.me/sqiouyilu
- **Venmo:** @sqiouyilu
- **Cashapp:** $sqiouyilu
