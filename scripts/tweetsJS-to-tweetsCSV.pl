#!/usr/bin/perl
use strict;
use warnings;
#######################################################################
#
# tweetsJS-to-tweetsCSV.pl
#
# INVOCATION:
# -----------
#    perl tweetsJS-to-tweetsCSV.pl FILENAME.js
#    e.g. perl tweetsJS-to-tweetsCSV.pl tweets.js
#
# INPUT:
# ------
#
# - JSON of tweets from downloaded Twitter archive.
#
# OUTPUT:
# -------
#
# - CSV of tweets from downloaded Twitter archive ready to import to
#   WordPress via a CSV import plugin. Attempts to preserve as much
#   data as possible for plugins that allow you to define tags,
#   import media, etc. from CSV headers.
#
# - Log to assist troubleshooting whether tweet content was correctly
#   parsed and counted. Bonus: Log is a linear human-readable database
#   of your tweets and their properties.
#
# CURRENTLY UNSUPPORTED:
# ----------------------
# - geotagging
# - polls
# - ads
# - image alt text (doesn't appear to be in JSON)
#
# S. Qiouyi Lu | @sqiouyilu | November 12, 2022
#
#######################################################################

# Mark script execution start.
my $start_run = time();

#######################################################################
# VERIFY COMMAND
#######################################################################

# Check for correct number of command line arguments.
my $cl_arguments = $#ARGV + 1;
die "Only one command line argument supported.\nInvoke with perl tweetsJS-to-tweetsCSV.pl FILENAME.js\n" if $cl_arguments != 1;

# Get file name.
(my $filename = $ARGV[0]) =~ s/(.*)\.js/$1/;

# Check that $filename.js exists.
if (! open TWEETS, "<$filename.js") {

    # Quit if file is missing.
    die "Missing JSON for $filename.\n";

} else {

#######################################################################
# BEGIN LOGGING
#######################################################################

    # Open log.
    open LOG, ">tweetsJS-to-tweetsCSV.log";
    print LOG "========================================================================\nTWEET.JS TO TWEET.CSV LOG\n========================================================================\n";

    # Create tweet counter.
    my $total_tweets = 0;

#######################################################################
# INITIALIZE SCRIPT
#######################################################################

    # Open tweets.
    open TWEETS, "<$filename.js";

    # Log initialization.
    print "Working...\n";
    print LOG "Opened $filename.js. Extracting tweets to CSV...\n";

#######################################################################
# CREATE CSV
#######################################################################

    open CSV, ">$filename.csv";

    # Print CSV headers.
    print CSV 
    
        "\"tweet_id\",".
        "\"source\",".
        "\"mentions\",".
        "\"urls\",".
        "\"symbols\",".
        "\"hashtags\",".
        "\"timestamp\",".
        "\"full_text\",".
        "\"language\",".
        "\"in_reply_to_user_id\",".
        "\"in_reply_to_status_id\",".
        "\"in_reply_to_screen_name\",".
        "\"multimedia_attachments\"\n";
    
    print LOG "CSV header printed. Parsing tweets...\n------------------------------------------------------------------------\n";

#######################################################################
# MAKE REFERENCES
#######################################################################

    # Create a lookup table of month abbreviations and corresponding month numbers.
    my %mon2num = qw(
        Jan 01  Feb 02  Mar 03  Apr 04  May 05  Jun 06
        Jul 07  Aug 08  Sep 09  Oct 10 Nov 11 Dec 12
    );

    # Define variables to be filled per tweet.

    # Tweet identifiers
    my $tweet;               # Marks beginning of tweet
    my $tweet_id;            # Saves tweet ID
    
    # Entities and extended entities
    my $entities;            # Marks beginning of entities block
    my $extended_entities;   # Marks beginning of extended entities block

    # Hashtags (#)
    my $hashtags_block;      # Marks beginning of hashtags block
    my $has_hashtags;        # Flags if tweet contains hashtags
    my $hashtag;             # Marks beginning of hashtag
    my @hashtags;            # Collects hashtags

    # Symbols ($)
    my $symbols_block;       # Marks beginning of symbols block
    my $has_symbols;         # Flags if tweet contains symbols
    my $symbol;              # Marks beginning of symbol
    my @symbols;             # Collects symbols

    # Mentions (@)
    my $mentions_block;      # Marks beginning of mentions block
    my $has_mentions;        # Flags if tweet contains mentions
    my $mention;             # Marks beginning of user info
    my $mention_handle;      # Saves username (can be changed by user)
    my $mention_id;          # Saves unique user ID (cannot be changed)
    my %mentions;            # Collects mentions
    my $total_mentions;      # Counts mentions

    # Links
    my $links_block;         # Marks beginning of links block
    my $has_links;           # Flags if tweet contains links
    my $link;                # Marks beginning of link
    my @links;               # Collects links

    # Multimedia
    my $media_block;         # Marks beginning of multimedia block
    my $has_media;           # Flags if tweet contains multimedia
    my $attachment;          # Marks beginning of attachment
    my $attachment_url;      # Saves attachment URL
    my $attachment_type;     # Saves attachment type (photo, video, gif)
    my %media;               # Collects attachments
    my $total_attachments;   # Counts attachments

    # Conversational context
    my $in_reply_to_status_id;   # Saves preceding tweet
    my $in_reply_to_user_id;     # Saves user ID of preceding tweet author
    my $in_reply_to_screen_name; # Saves username of preceding tweet author
    my $is_reply;                # Flags if tweet is a reply
    my $is_thread;               # Flags if tweet is part of a thread

#######################################################################
# PARSE TWEETS
#######################################################################

    while (<TWEETS>) {

#######################################################################
# FIND START OF TWEET
#######################################################################

        # Mark beginning of tweet.
        $tweet = 1 if (/\"tweet\" \: \{/);

#######################################################################
# FIND TWEET ID
#######################################################################

        # Get tweet ID.
        $tweet_id = $1 if (/^\s{12}\"(\d+)\"$/);

        # Print ID to log and CSV.
        if ($tweet && $tweet_id) {
        
            print LOG $tweet_id ? "Begin tweet $tweet_id.\n\nProperties:\n\n" : "";
            print CSV "\"$tweet_id\",";
            $tweet = 0;
            
        }

#######################################################################
# FIND SOURCE
#######################################################################

        # Check for origin of tweet.
        my $source = $1 if (/^\s*\"source\" \: \"(.*)\",/);

        # Print source to log and CSV.
        if ($source) {
        
            my $origin;
            ($origin = $source) =~ s/.*\"\>(.+)\<\/a\>.*/$1/;
            
            # Prints simplified origin to log and full link to CSV.
            print LOG "- Origin: $origin\n";
            print CSV "\"$source\",";
            
            $source = undef;
            
        }

#######################################################################
# CHECK FOR ENTITIES
#######################################################################

        # Mark beginning of entity block.
        $entities = 1 if (/\"entities\" \: \{/);
        
        # Proceed if entity block has been found.
        if ($entities) {
        
#######################################################################
# LOOK FOR MENTIONS
#######################################################################

            # Check if tweet has mentions.
            $mentions_block = 1 if (/^\s*\"user_mentions\" \: \[$/);
            
            # Collect mentions.
            if ($mentions_block) {

                    $mention = 1 if (/\s*\{/);
                    $mention = 0 if (/\s*\},$/);

                    if ($mention) {

                        $mention_handle = $1 if (/^\s*\"screen_name\" \: \"(.+)\",$/);
                        $mention_id = $1 if ($mention_handle && /^\s*\"id\" \: \"(.+)\"$/);

                        if ($mention_handle && $mention_id) {

                            $mentions{$mention_handle} = $mention_id;
                            $mention_handle = undef;
                            $mention_id = undef;
                            $mention = 0;

                        }
                    }

                    $mentions_block = 0 if (/\s*\"urls\"/);
                    $has_mentions = 1 if ! $mentions_block;

                }

#######################################################################
# LOOK FOR LINKS
#######################################################################

            # Check if tweet has links.
            $links_block = 1 if (/^\s*\"urls\" \: \[$/);

            # Collect links.
            if ($links_block) {

                $link = $1 if (/^\s*\"expanded_url\" \: \"(.+)\",$/);
                
                if ($link) {
                
                    push(@links, $link);
                    $link = undef;

                }

            $links_block = 0 if (/\s*\],$/);
            $has_links = 1 if ! $links_block;

            }

#######################################################################
# LOOK FOR SYMBOLS
#######################################################################

            # Check if tweet has symbols.
            $symbols_block = 1 if (/^\s*\"symbols\" \: \[$/);

            # Collect symbols.
            if ($symbols_block) {

                $symbol = $1 if (/^\s*\"text\" \: \"(.+)\",$/);
                
                if ($symbol) {
                    push(@symbols, $symbol);
                    $symbol = undef;
                    
                }

            $symbols_block = 0 if (/\s*\],$/);
            $has_symbols = 1 if ! $symbols_block;

            }
            
#######################################################################
# LOOK FOR HASHTAGS
#######################################################################

            # Check if tweet has hashtags.
            $hashtags_block = 1 if (/^\s*\"hashtags\" \: \[$/);

            # Collect hashtags.
            if ($hashtags_block) {

                $hashtag = $1 if (/^\s*\"text\" \: \"(.+)\",$/);
                
                if ($hashtag) {
                
                    push(@hashtags, $hashtag);
                    $hashtag = undef;

                }
                
            $hashtags_block = 0 if (/^\s*\],$/);
            $has_hashtags = 1 if ! $hashtags_block;

            }
                
#######################################################################
# PROCESS ENTITIES AT END OF BLOCK
#######################################################################

            # Mark end of entity block.
            my $end_entities = 1 if (/\"favorite_count\"/);
            $entities = 0 if $end_entities;
            
            # Compile entities.
            if ($end_entities) {

                # Print mentions.
                #
                # File    Separator     Separator rationale
                # ---------------------------------------------
                # LOG     line break    legibility
                # CSV     comma         can be imported as tags

                if (! $has_mentions) {
                
                    print CSV "\,";
                    %mentions = ();
                
                } elsif ($has_mentions) {

                    $total_mentions = keys %mentions;
                    print LOG %mentions ? "- Mentions ($total_mentions total):\n" : "";
                    print CSV "\"";

                    foreach my $key (keys %mentions)
                        {
                            $total_mentions = keys %mentions;
                            print LOG "    - $key (userID: $mentions{$key})\n";
                            print CSV $total_mentions == 1 ? "$key" : "$key\,";
                            delete ($mentions{$key});
                        }

                    print CSV "\",";
                    %mentions = ();
                    $has_mentions = 0;
                }
                
                # Print links.
                #
                # File    Separator     Separator rationale
                # ----------------------------------------------------
                # LOG     line break    legibility
                # CSV     line break    better UX for edits and embeds
                
                if (! $has_links) {
                
                    print CSV "\,";
                    @links = ();
                
                } elsif ($has_links) {
            
                    print LOG "- Links (".scalar @links." total):\n    - ".join('\n    - ', @links)."\n";
                    print CSV "\"".join('\n', @links)."\",";
                    @links = ();
                    $has_links = 0;

                }
                
                # Print symbols.
                #
                # File    Separator        Separator rationale
                # ------------------------------------------------
                # LOG     comma & space    legibility
                # CSV     comma            can be imported as tags
                            
                if (! $has_symbols) {
                
                    print CSV "\,";
                    @symbols = ();
                
                } elsif ($has_symbols) {
            
                    print LOG "- Symbols: ".join(', ', @symbols)." (".scalar @symbols." total)\n";
                    print CSV "\"".join(',', @symbols)."\",";
                    @symbols = ();
                    $has_symbols = 0;
            
                }
                
                # Print hashtags.
                #
                # File    Separator        Separator rationale
                # ------------------------------------------------
                # LOG     comma & space    legibility
                # CSV     comma            can be imported as tags
                
                if (! $has_hashtags) {
                
                    print CSV "\,";
                    @hashtags = ();
                
                } elsif ($has_hashtags) {
                                
                    print LOG "- Hashtags: ".join(', ', @hashtags)." (".scalar @hashtags." total)\n";
                    print CSV "\"".join(',', @hashtags)."\",";
                    @hashtags = ();
                    $has_hashtags = 0;
                
                }
            
                # Finish reformatting entities.
                $end_entities = 0;
            }

        }

#######################################################################
# GET CONVERSATIONAL CONTEXT
#######################################################################

        # Check for conversational context.
        $in_reply_to_user_id = $1 if (/^\s*\"in_reply_to_user_id\" \: \"(.*)\"\,/);
        $in_reply_to_status_id = $1 if (/^\s*\"in_reply_to_status_id\" \: \"(\d+)\"\,/);
        $in_reply_to_screen_name = $1 if (/^\s*\"in_reply_to_screen_name\" \: \"(.*)\"\,/);

        $is_reply = 1 if ($in_reply_to_user_id && $in_reply_to_screen_name);
        $is_thread = 1 if ($in_reply_to_screen_name && $in_reply_to_status_id);

#######################################################################
# FIND TIMESTAMP
#######################################################################

        # Get timestamp.
        my $year = $1 if (/^\s*\"created_at\" \: \".*(\d{4})\",$/);
        my $month = $1 if (/^\s*\"created_at\" \: \".* \b(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\b.*\",/);
        my $day = $1 if (/^\s*\"created_at\" \: \".* (\d{2}) .*\",/);
        my $time = $1 if (/^\s*\"created_at\" \: \".*(\d{2}\:\d{2}\:\d{2}).*\",/);
        my $zone = $1 if (/^\s*\"created_at\" \: \".*(\+\d{4}).*\",/);

        # Print timestamp to log and CSV.
        if ($year && $month && $day && $time && $zone) {

               # Reformat timestamp to yyyy-mm-dd hh:mm:ss +oooo.
                my $timestamp = $year."-".$mon2num{$month}."-".$day." ".$time." ".$zone;
                
                print LOG "- Posted on $timestamp\n";
                print CSV $timestamp ? "\"$timestamp\"," : "\,";
                
                $timestamp = undef;
                $year = undef;
                $month = undef;
                $day = undef;
                $time = undef;
                $zone = undef;
                
        }

#######################################################################
# GET FULL TEXT OF TWEET
#######################################################################

        # Get full text of tweet.
        my $full_text = $1 if (/^\s*\"full\_text\" \: \"(.*)\",$/);

        # Print tweet text to log and CSV.
        if ($full_text) {
            print LOG "- Full text of tweet:\n\n".$full_text."\n";
            print CSV "\"$full_text\"\,"
        }

#######################################################################
# IDENTIFY TWEET LANGUAGE
#######################################################################

        # Identify tweet language as auto-assigned by Twitter.
        my $lang = $1 if (/\s*\"lang\" \: \"(.*)\"/);

        # Print language identifier to log and CSV.
        if ($lang) {
            print LOG "\n- Language: $lang\n";
            print CSV "\"$lang\"\,";
        }

#######################################################################
# LOOK FOR MULTIMEDIA
#######################################################################

        # Check if tweet has multimedia attachments.
        $media_block = 1 if (/^\s*\"media\" \: \[$/);
        
        # Collect attachments.

        if ($media_block) {

            $attachment = 1 if (/expanded_url/);

            if ($attachment) {

                $attachment_url = $1 if (/^\s*\"media_url_https\" \: \"(.+)\",$/);
                $attachment_type = $1 if (/^\s*\"type\" \: \"(.+)\",$/);

                if ($attachment_url && $attachment_type) {

                    $media{$attachment_url} = $attachment_type;
                    $attachment_url = undef;
                    $attachment_type = undef;
                    $attachment = 0;

                }
            }

            $media_block = 0 if (/^\s{8}\]$/);
            $has_media = 1 if ! $media_block;
            
        }
            
#######################################################################
# FINISH READING TWEET
#######################################################################

        # Check for end of tweet.
        my $end_of_tweet = 1 if (/^\s{2}\},\n/);

        # Compile multimedia and context.
        if ($end_of_tweet) {

            # Print conversational context.
            print CSV $in_reply_to_user_id ? "\"$in_reply_to_user_id\"\," : "\,";
            print CSV $in_reply_to_status_id ? "\"$in_reply_to_status_id\"\," : "\,";
            print CSV $in_reply_to_screen_name ? "\"$in_reply_to_screen_name\"\," : "\,";

            if ($is_reply) {
                print LOG "\- In conversation with \@$in_reply_to_screen_name (user ID\: $in_reply_to_user_id)\n";
                $is_reply = 0;
            }

            if ($is_thread) {
                print LOG "- Replying to https\:\/\/twitter\.com\/$in_reply_to_screen_name\/status\/$in_reply_to_status_id\n";
                $is_thread = 0;
            }
            
            $in_reply_to_user_id = undef;
            $in_reply_to_status_id = undef;
            $in_reply_to_screen_name = undef;
            
            # Print multimedia attachments.
            #
            # File   Format                   Separator    Separator rationale
            # ----------------------------------------------------------------
            # LOG    URL (type: media type)   line break   legibility
            # CSV    URL / media type         line break   legibility

            if (! $has_media) {
            
                print CSV "\n";
            
            } elsif ($has_media) {
            
                    $total_attachments = keys %media;
                    print LOG %media ? "- Media ($total_attachments attached):\n" : "";
                    print CSV "\"";

                    foreach my $key (keys %media)
                        {
                            $total_attachments = keys %media;
                            print LOG "    - $key (type: $media{$key})\n";
                            print CSV $total_attachments == 1 ? "$key \/ $media{$key}" : "$key \/ $media{$key}\\n";
                            delete ($media{$key});
                        }

                    print CSV "\"\n";
                    %media = ();
                    $has_media = 0;
            }

			# End tweet and print marker.
            print LOG "\nEnd tweet $tweet_id.\n------------------------------------------------------------------------\n";
            $tweet_id = undef;

        }

        # Keep count of number of tweets parsed.
        $total_tweets += 1 if $end_of_tweet;
    }

#######################################################################
# FINISH PROCESSING TWEETS
#######################################################################

    # Close files.
    close TWEETS;
    close CSV;

#######################################################################
# MARK TASK AS COMPLETE
#######################################################################

    # Log completion.
    print LOG "========================================================================\n$filename.csv created. $total_tweets tweets reformatted in ";
    print "Done.\n$filename.csv and $filename.log created.\n$total_tweets tweets reformatted in ";
    
    }

#######################################################################
# END SCRIPT
#######################################################################

# Mark script as complete and calculate execution duration.
my $end_run = time();
my $run_time = $end_run - $start_run;

# Print execution time to log and terminal.
print LOG "$run_time second(s).\n========================================================================";
print "$run_time second(s).\n";

# Close log.
close LOG;
