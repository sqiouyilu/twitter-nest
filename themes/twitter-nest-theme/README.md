# Twitter Nest Theme

WordPress theme designed to work with [Twitter Nest](https://github.com/sqiouyilu/twitter-nest).

![nest-theme_screenshot](https://github.com/sqiouyilu/twitter-nest/blob/8dda403724732f62ec9e97388dae2fbe04d501ac/themes/twitter-nest-theme/screenshot.png)
Screenshot of theme

----

## Demos

### **Default theme demo:** https://s.qiouyi.lu/tweets/staging

### **Live personalized demo:** https://s.qiouyi.lu/tweets/

----

## Features

* Designed to be responsive and maintain legibility across mobile, tablet, desktop, and TV viewports.
* Customizable from the native WordPress customizer interface without having to edit code. Options you can personalize:
  * Avatar
  * Banner
  * Color palette, labeled to encourage end users to consider contrast for legibility when choosing a palette
  * User information
     * Twitter handle
     * Twitter user ID
     * Location
     * Pronouns
     * User bio
     * Prominent accessibility needs callout, color-coded in [OSHA safety blue](https://hextoral.com/hex-color/2B79A2/federal-std-595c/)
     * Include a default message for DMs originating from nest
     * Links menu
        * Set Font Awesome icons using a custom field 
* User information includes buttons to DM and follow user on Twitter.
* Individual Tweets have Reply, Retweet, and Like buttons that take you to the Twitter interface to interact with the Tweet.

----

## Under the hood

* Theme tags written to use semantic tags as much as possible over `<div>`.
* CSS written to use variables for more programmatic styling and forward compatibility.
* Font Awesome support for links added through custom menu field.

----

### Screenshots

![nest-theme_user-info_1](https://user-images.githubusercontent.com/27913821/202977825-26991efb-b025-4f32-91da-b1ecf4b87d4a.png) ![nest-theme_user-info_2](https://user-images.githubusercontent.com/27913821/202977829-79ddc62f-c265-4896-92f6-0252dae58dfd.png)
User information customization options

![nest-theme_colors](https://user-images.githubusercontent.com/27913821/202977831-567c32b7-035b-4fcf-a326-b879c699cda5.png)
Color palette customization option

![nest-theme_menu](https://user-images.githubusercontent.com/27913821/202977832-84a2dc06-b9a5-4d9c-8fca-4358e0b68f99.png) ![nest-theme_menu_font-awesome](https://user-images.githubusercontent.com/27913821/202977834-75dc75dd-f8a1-4339-8548-0b941e73ead1.png)
Menu links customization interfaces

----

## Known issues

* Font Awesome custom menu field doesn't show up in customizer interface, only on Menu page.
* Customizer sometimes doesn't recognize a property if you keep it the same as the default. If things aren't showing up properly, edit the field in Customizer, hit Publish, and hard refresh the page.

## Credits

Based on the [Ozh' Tweet Archiver Theme by ozh](https://github.com/ozh/ozh-tweet-archive-theme).
