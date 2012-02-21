=== Members Only ===

Contributors: hami
Tags: members, user, admin, restrict, posts, access
Donate link: http://code.andrewhamilton.net/donate/
Requires at least: 2.1
Tested up to: 2.6.2
Stable tag: 0.6.7

A WordPress plugin that allows you to make your WordPress blog only viewable to visitors that are logged in.

== Description ==

*Members Only* is a WordPress plugin that allows you to make your blog only viewable to visitors that are logged in. If a visitor is not logged in, they will be redirected either to the WordPress login page or a page of your choice. Once logged in they can be redirected back to the page that they originally requested. You can also protect your feeds whilst allowing registered user access to them by using *Feed Keys*.


== Installation ==

This section describes how to install the plugin and get it working.

1. Download the archive and expand it.
2. Upload the *members-only* folder into your *wp-content/plugins/* directory
3. In your *WordPress Administration Area*, go to the *Plugins* page and click *Activate* for *Members Only*

Once you have *Members Only* installed and activated you can change it's settings in *Settings > Members Only*.

== Changes ==
*0.6.7*

1. Fixed a problem when there is no Feed Key with a call to an undefined function `add_usermeta`. Changed it to the correct `update_usermeta`.

*0.6.6*

1. **New Feature:** Added redirection option for users who login directly to `wp-login.php`. You can now choose to redirect them to the Front Page or to the Dashboard as normal.
2. **New Feature:** Added the ability to grant a one-time view to your blog from an Administrator's IP address allowing XML RPC applications, such as [WordPress for iPhone](http://iphone.wordpress.org/) to be able to login. 
3. **New Feature:** Added the ability for Administrators to remove a User's Feed Key as well as reset it.
4. Fixed a problem with Feed Keys not working in all situations due to a typo.

*0.6.5*

1. **New Feature:** Added the option of requiring *Feed Keys* even if the user is logged in.
2. Changed the way *Feed Key* errors are display to the user. They no longer are displayed as a WordPress Error, *Members Only* now creates an RSS feed with the error in it.
3. Fixed a bug where redirection to `wp-login.php` caused a redirect loop when WordPress was installed in different folder to the site URL.
4. Fixed some admin page style issues with versions previous to 2.5

*0.6*

1. **New Feature:** Added Feed Keys to give users unique URLs for your blog's feed.
2. Added the display of a user's Feed Key in their profile, and you can choose whether they can reset it or not.
3. Rewritten how feeds are protected by *Members Only* in order to use *Feed Keys*.
4. Improved setup function for future development and features.
5. Improved where how function behaves when *Members Only* is turned off rather than the plugin is deactivated.

*0.5.1*

1. Fixed a bug where redirecting to a specific page was causing an endless redirection loop.
2. Simplified redirection logic and made it simpler. Using `template_redirect` no longer requires the plugin to exclude `wp-login.php`, `wp-register.php`, `xmlrpc.php` or anywhere in `wp-admin` from being inaccessible, or to check if page is a 404.
3. Added `wp-feed.php` to the list of files in the function that restricts access to feeds.
4. Removed `sprintf` from the variable that gets the current URL.

*0.5*

1. Added functionality making RSS feeds inaccessible. Calling the plugin at `wp_head` in previous versions made the feeds accessible without being logged in.
2. Added the ability to toggle whether RSS feeds are accessible to the settings page.
3. Changed where the plugin is call from `wp_head` to `template_redirect` which fixes an error where in some situations WordPress would give an error saying `Warning: Cannot modify header information - headers already sent...`
4. Rewrote some functions in the plugin to make them tidier. 

*0.4.2*

1. Improved security on checking URLs. Replace all `preg_match` and replaced with `strpos` except checking for wp-admin URLs.
2. Added checking for 404 pages. They now redirect to the login page too.
3. Change where the plugin is called from `init` back to `wp_head` otherwise 404 pages can't be redirected. If this causes problems, like the 'Cannot modify header information' error you can change this back to `init` but a 404 page will be able to be seen as normal.

*0.4.1*

1. *Actually* fixed the *critical flaw* in the `preg_match` used to check the url highlighted by [mrgreen](http://wordpress.org/support/topic/164011). The fix in 0.4 didn't work full as you could still add the full url of wp-login.php as a variable and bypass the check. The `preg-match` now uses `parse_url` to only check only the path of the url and nothing else. All users using *Members Only* should upgrade to version 0.4.1 as soon as possible to avoid this flaw being taken advantage of.

*0.4*

1. Fixed a *critical flaw* in the `preg_match` used to check the url highlighted by [mrgreen](http://wordpress.org/support/topic/164011). All users using *Members Only* should upgrade to version 0.4 as soon as possible to avoid this simple flaw being taken advantage of.
2. Excluded `xmlrpc.php` from being protected by *Members Only*.
3. Tweaked Settings Page to suit WordPress 2.5

*0.3*

1. Fixed an error where in some situations WordPress would give an error saying `Warning: Cannot modify header information - headers already sent...`
2. Excluded `wp-register.php` and `wp-admin/*` from being protected by *Members Only*.
3. Exposed the page the visitor original requested so it can be used as a global variable (`$members_only_reqpage`).

*0.2*

1. Added the ability to specify the page to redirect to, and the ability to turn off the redirection to the requested page.

*0.1*

1. Initial release.

== Settings ==

The settings for *Members Only* are extremely simple. You have a check box that will toggle whether your blog can be access by visitors with or without logging in. The default setting allows visitors to visit your blog as normal.

If you choose to make your blog only accessible to visitors that are logged in, a visitor that isn't logged in will be redirected to either the WordPress login page or a specific page of you choice. This choice can be selected via a drop down menu. You can enter the specific page to redirect to at the bottom of the options page, but if this field is left blank, visitors will be redirected to the login page instead

If you chose to redirect to the WordPress login page, you can also decide whether once the visitor has logged if they will be redirected back to the page that they originally requested. This can be toggled with a check box.

You can also choose how you protect your feeds on you blog. You can choose either requiring Feed Keys, require users to be logged in or have your feeds open to all. Feed Keys allow your users to access your feeds using feed readers or other things that don't login to WordPress.

== Feed Keys ==

*Members Only* can also protect you feeds in two ways. You can either require user's to be logged in to the site to be able to access your feeds, require users to use Feed Keys to be able to access your feeds or have no protect on your feeds allowing anyone to access your feeds.

*What are Feed Keys?*

Feed Keys, are unique 32bit keys that are added to your blog's URL in order to give every registered user a custom feed URL. 
A Feed Key looks something like this: *`206914af21373cc4792a057b067d2448`*

This is then appended to the feed url for your user in their User Profile, like the examples below, either without permalinks...

*`http://example.com/?feed=rss2&feedkey=206914af21373cc4792a057b067d2448`*

...or with permalinks

*`http://example.com/feed/?feedkey=206914af21373cc4792a057b067d2448`*

When a user visits a feed on your site, Members Only checks to see if there is a Feed Key in the query section of the feed URL and checks whether it is stored in the @wp_usermeta@ table of your WordPress database. If it finds the Feed Key in the database it allows access to the feed, otherwise it presents the user and error. An error will also be give if no Feed Key is found in the feed URL.

*How and When are Feed Keys Generated?*

A Feed Key is generated by creating a 32bit random alpha-numeric-case-insensitive string that is then hashed against the user's username, insuring that no two users can ever have the same.

Feed Keys are generated when the user logs in to your blog. If they don't have a Feed Key, one generated for them and stored in the `wp_usermeta` table in your database, otherwise they will use the one that is already stored in the database. An admin can also manually generate a Feed Key for a user by visiting there user profile and choosing the option.

If you allow it, users can also reset their Feed Keys from their user profiles or you can leave this to Admins.

== One-Time View ==

*Members Only* now allows an Administrator to grant a one-time view from there own IP address. The IP is hashed with md5 and stored in the *Members Only* settings. Once the next visit from that IP address is recorded, the IP address is removed from the settings and your WordPress blog is protected as before.

This allows `XML RPC` applications, such as WordPress for iPhone and other third-party blog editors to login to the site for the first time. Subsequent visit from these editors don't require this visit as they know where the `xmlrpc.php` file is, and this isn't restricted by *Members Only*.


== Screenshots ==

1. Options for *Members Only*
2. Displaying *Feed Keys* in a user's profile
3. Admin options for resetting a user's *Feed Key*

== Known Issues ==

No known issues at this time. 

If you find any bugs or want to request some additional features for future releases, please log them the [projects tracker page](http://tracker.andrewhamilton.net/projects/show/members-only)
