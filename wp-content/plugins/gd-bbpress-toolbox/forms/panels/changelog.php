<div class="d4p-group d4p-group-changelog">
    <h3><?php _e("Version", "gd-bbpress-toolbox"); ?> 4</h3>
    <div class="d4p-group-inner">
        <h4>Version: 4.7.2 / June 9 2017</h4>
        <ul>
            <li><strong>fix</strong> wrong filter name used for the edit reply notification</li>
            <li><strong>fix</strong> problem with saving of the Statistics widget settings</li>
        </ul>

        <h4>Version: 4.7.1 / June 7 2017</h4>
        <ul>
            <li><strong>new</strong> core object for the proper RSS Feed detection</li>
            <li><strong>new</strong> notifications: reply edit now includes topic title tag</li>
            <li><strong>edit</strong> signatures: don't show in the feed</li>
            <li><strong>edit</strong> quote: don't show in the feed</li>
            <li><strong>edit</strong> attachments: don't show in the feed</li>
            <li><strong>edit</strong> d4pLib 2.0.2</li>
            <li><strong>fix</strong> notifications: reply edit invalid default subject</li>
            <li><strong>fix</strong> notifications: topic edit invalid default subject</li>
            <li><strong>fix</strong> notifications: new topic invalid default subject</li>
            <li><strong>fix</strong> notifications: small typo in the default reply edit template</li>
            <li><strong>fix</strong> minor thumbnail function issue with the filter arguments</li>
            <li><strong>fix</strong> problems with some topics and reply specific settings</li>
        </ul>

        <h4>Version: 4.7 / May 27 2017</h4>
        <ul>
            <li><strong>new</strong> tinymce editor: option to control Quicktags Text editor tab</li>
            <li><strong>new</strong> say thanks: filters to change thanks related strings</li>
            <li><strong>new</strong> syntaxhighlighter: few more additional languages</li>
            <li><strong>new</strong> syntaxhighlighter: additional theme style</li>
            <li><strong>new</strong> send notification to keymasters and moderators on new topic</li>
            <li><strong>new</strong> send notification to author and subscribers on reply edit</li>
            <li><strong>new</strong> options to customize email for the reply edit notification</li>
            <li><strong>new</strong> prevent closing of settings page if there are unsaved changes</li>
            <li><strong>new</strong> widgets tabbed interface using ARIA markup</li>
            <li><strong>new</strong> administration interface accessibility improvements</li>
            <li><strong>new</strong> first step in the plugin reorganization with new core objects</li>
            <li><strong>new</strong> disable plugin if system requirements are not met</li>
            <li><strong>edit</strong> syntaxhighlighter: improved validation of BBCode settings</li>
            <li><strong>edit</strong> syntaxhighlighter: check if the specified language is valid</li>
            <li><strong>edit</strong> widgets: improved forum statistics rendering</li>
            <li><strong>edit</strong> widgets: improved forum statistics handling and saving</li>
            <li><strong>edit</strong> widgets: improved topics views handling and saving</li>
            <li><strong>edit</strong> widgets: interface using proper HTML input types</li>
            <li><strong>edit</strong> widgets: improved sanitation for all widget value on save</li>
            <li><strong>edit</strong> widgets: all widgets classes updated and improved</li>
            <li><strong>edit</strong> plugin now requires WordPress 4.3 or newer</li>
            <li><strong>edit</strong> few tweaks in the SEO module excerpt generating function</li>
            <li><strong>edit</strong> several always active modules converted to core objects</li>
            <li><strong>edit</strong> changed organization for some folders and files</li>
            <li><strong>edit</strong> various improvements in shared library loading</li>
            <li><strong>edit</strong> SyntaxHighlighter 4.0.1</li>
            <li><strong>edit</strong> d4pLib 2.0</li>
            <li><strong>fix</strong> rare issue with the options handling in forum statistics widget</li>
            <li><strong>fix</strong> few problems with function listing active BBCodes</li>
            <li><strong>fix</strong> some notification overrides not working for all types</li>
            <li><strong>fix</strong> topic edit notification overrides not applied to the emails</li>
            <li><strong>fix</strong> few translation strings missing from the POT file</li>
        </ul>

        <h4>Version: 4.6.6 / May 11 2017</h4>
        <ul>
            <li><strong>edit</strong> various improvements in the new posts (replies only) query</li>
            <li><strong>edit</strong> check for attachments shortcode in the content on attachments upload</li>
            <li><strong>edit</strong> minor accessibility improvements with attachments editing</li>
            <li><strong>edit</strong> few more database related functions moved to main database object</li>
            <li><strong>edit</strong> d4pLib 1.9.6</li>
            <li><strong>fix</strong> activity date for new posts (replies only) widget is wrong</li>
            <li><strong>fix</strong> fatal error in PHP 7.1 for to the array/string conversion</li>
        </ul>

        <h4>Version: 4.6.5 / May 2 2017</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.9.3</li>
            <li><strong>del</strong> removed several unused functions and files</li>
            <li><strong>fix</strong> noindex meta for non private topics and replies</li>
        </ul>

        <h4>Version: 4.6.4 / April 17 2017</h4>
        <ul>
            <li><strong>new</strong> report: report form now includes the cancel button</li>
            <li><strong>edit</strong> fitvids library updated to version 1.2</li>
            <li><strong>fix</strong> buddypress: wrong order for the field integration</li>
            <li><strong>fix</strong> few translation strings missing from the POT file</li>
        </ul>

        <h4>Version: 4.6.3 / April 9 2017</h4>
        <ul>
            <li><strong>edit</strong> buddypress: notices displayed if signatures are disabled</li>
            <li><strong>fix</strong> templates: fieldset wrappers with unused label tags</li>
            <li><strong>fix</strong> attachments: several more accessibility issues</li>
            <li><strong>fix</strong> attachments: javascript adding incomplete markup</li>
            <li><strong>fix</strong> buddypress: integration when signatures are disabled</li>
            <li><strong>fix</strong> report: report form not automatically focusing on input field</li>
        </ul>

        <h4>Version: 4.6.2 / March 29 2017</h4>
        <ul>
            <li><strong>new</strong> quote: scroll to editor puts focus on textarea</li>
            <li><strong>new</strong> quote: quote link now has 'role' set to 'button'</li>
            <li><strong>new</strong> report: report link now has 'role' set to 'button'</li>
            <li><strong>new</strong> say thanks: thanks link now has 'role' set to 'button'</li>
            <li><strong>new</strong> attachments: new file link now has 'role' set to 'button'</li>
            <li><strong>new</strong> canned replies: toggle links now have 'role' set to 'button'</li>
            <li><strong>new</strong> bbcode toolbar: handle keyboard activation of buttons</li>
            <li><strong>edit</strong> bbcode toolbar: buttons are part of normal tabindex</li>
            <li><strong>edit</strong> allowed kses tags override filter has higher priority</li>
            <li><strong>edit</strong> minor update to the database install script</li>
            <li><strong>edit</strong> d4pLib 1.9.2</li>
            <li><strong>fix</strong> problem with the notify on edit validation</li>
        </ul>

        <h4>Version: 4.6.1 / March 23 2017</h4>
        <ul>
            <li><strong>edit</strong> notify on edit: optional checkbox for topic author</li>
            <li><strong>edit</strong> notify on edit: filter list of subscribers to remove duplicates</li>
            <li><strong>fix</strong> bbcodes toolbar: content textarea not matched properly</li>
            <li><strong>fix</strong> bbpress user profile: styling issues with the signature editor</li>
            <li><strong>fix</strong> signature editor length limiter might be dispayed twice</li>
        </ul>

        <h4>Version: 4.6 / March 21 2017</h4>
        <ul>
            <li><strong>new</strong> forum: welcome back block with activity since last visit</li>
            <li><strong>new</strong> forum: settings for individual elements of the statistics block</li>
            <li><strong>new</strong> forum: color coded list of users with additional options</li>
            <li><strong>new</strong> forums: display badge when forum has a new post (topic/reply)</li>
            <li><strong>new</strong> forums: display badge when forum was not read by the user</li>
            <li><strong>new</strong> module: dedicated module for BuddyPress specific features</li>
            <li><strong>new</strong> buddypress: special field type for signature editing</li>
            <li><strong>new</strong> buddypress: extended profile field for forum signature</li>
            <li><strong>new</strong> new posts widget: option to specific forums to include</li>
            <li><strong>new</strong> attachments: additional information for max file size</li>
            <li><strong>new</strong> latest posts queries: completely rewritten functions</li>
            <li><strong>new</strong> topic attachments count: store counts in postmeta</li>
            <li><strong>new</strong> signatures: option to limit signature to plain text only</li>
            <li><strong>new</strong> unread replies: option to mark unread replies in the topic thread</li>
            <li><strong>new</strong> unread badges: include titles attributes for each badge</li>
            <li><strong>new</strong> unread badges: filter to change the new replies badge</li>
            <li><strong>new</strong> notification on topic edit: include editor name in template</li>
            <li><strong>new</strong> say thanks: fire actions when thanks is saved or removed</li>
            <li><strong>new</strong> option to hide private replies using CSS and jQuery</li>
            <li><strong>new</strong> support for the threaded replies in various areas</li>
            <li><strong>new</strong> user tracking meta support for multisite WordPress</li>
            <li><strong>new</strong> user tracking cookies support for multisite WordPress</li>
            <li><strong>new</strong> option to choose from where to load FontAwesome font</li>
            <li><strong>new</strong> script and style code for BBCodes Toolbar moved to new files</li>
            <li><strong>new</strong> filter for the topic thumbnail size</li>
            <li><strong>edit</strong> attachments: force size limit for the file size option</li>
            <li><strong>edit</strong> user replied to topic: query supports threaded replies</li>
            <li><strong>edit</strong> topic replies id: query supports threaded replies</li>
            <li><strong>edit</strong> topic participants: query supports threaded replies</li>
            <li><strong>edit</strong> topic attachments count: query supports threaded replies</li>
            <li><strong>edit</strong> topics with user replies: query supports threaded replies</li>
            <li><strong>edit</strong> plugin settings: changes to notifications settings</li>
            <li><strong>edit</strong> latest posts queries: big performance improvement</li>
            <li><strong>edit</strong> latest posts queries: take into account threaded replies</li>
            <li><strong>edit</strong> all database query related functions moved into DB object</li>
            <li><strong>edit</strong> users panel grid shows GMT corrected last activity time</li>
            <li><strong>edit</strong> updated and improved information for various plugin settings</li>
            <li><strong>edit</strong> various small styling changes and improvements</li>
            <li><strong>edit</strong> various and numerous changes in code organization</li>
            <li><strong>edit</strong> renamed all JavaScript and CSS files according to loading</li>
            <li><strong>edit</strong> various optimization in code of main JavaScript file</li>
            <li><strong>edit</strong> removed obosolete and duplicated portions of JavaScript</li>
            <li><strong>edit</strong> prevent direct access to all form files</li>
            <li><strong>edit</strong> d4pLib 1.9.1</li>
            <li><strong>del</strong> removed option for controlling loading of jQuery</li>
            <li><strong>del</strong> removed outdated jQuery Browser library for old IE detection</li>
            <li><strong>fix</strong> topic read tracking: tracking info not saved for topics with no replies</li>
            <li><strong>fix</strong> attachments: ignoring no limit upload for file size</li>
            <li><strong>fix</strong> attachments: ignoring no limit upload for mime types</li>
            <li><strong>fix</strong> attachments: ignoring forum based mime types override</li>
            <li><strong>fix</strong> topic info widget: problem with the missing users</li>
            <li><strong>fix</strong> say thanks: problem with the missing users when showing users list</li>
            <li><strong>fix</strong> notification on topic edit: settings now used correctly</li>
            <li><strong>fix</strong> linking issues with the admin attachments panel grid</li>
            <li><strong>fix</strong> users panel grid uses invalid format for time display</li>
            <li><strong>fix</strong> one instance of missing semicolon in the main JavaScript file</li>
        </ul>

        <h4>Version: 4.5.1 / January 27 2017</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.8.9</li>
            <li><strong>fix</strong> multisite issue with the blog switching functions</li>
            <li><strong>fix</strong> multisite issue with deletion of the blog tables</li>
            <li><strong>fix</strong> first unread topic reply link always links to last reply</li>
            <li><strong>fix</strong> few small issues with generating unread marks for topics</li>
        </ul>

        <h4>Version: 4.5 / January 19 2017</h4>
        <ul>
            <li><strong>new</strong> topics: track last access time for each user</li>
            <li><strong>new</strong> topics: display badges for new and unread topics for loggedin user</li>
            <li><strong>new</strong> topics: links to unread replies for loggedin user</li>
            <li><strong>new</strong> module: disable and redirect selected RSS feeds</li>
            <li><strong>new</strong> report: select method for reporting topic or reply</li>
            <li><strong>new</strong> report: methods to send report without filling the form</li>
            <li><strong>new</strong> dashboard widget: display latest topics and replies activity</li>
            <li><strong>new</strong> redirect: blocked users</li>
            <li><strong>new</strong> redirect: no access to private forums</li>
            <li><strong>new</strong> redirect: no access to hidden forums</li>
            <li><strong>new</strong> view: my favorite topics</li>
            <li><strong>new</strong> view: my subscribed topics</li>
            <li><strong>new</strong> multisite: remove tables for deleted blogs</li>
            <li><strong>new</strong> user stats: filter for the registration date format</li>
            <li><strong>new</strong> show icon for the temporary locked topic</li>
            <li><strong>new</strong> all image icons moved into separate stylesheet file</li>
            <li><strong>new</strong> added few image icons for some new plugin features</li>
            <li><strong>new</strong> filter to replace default icons stylesheet file</li>
            <li><strong>new</strong> filter to control list of attachment file icons sets</li>
            <li><strong>new</strong> object for handling rendering of all icons/marks</li>
            <li><strong>new</strong> plugin now requires bbPress 2.5 or newer</li>
            <li><strong>new</strong> plugin now requires WordPress 4.2 or newer</li>
            <li><strong>edit</strong> enabled moderators access to some plugin admin panels</li>
            <li><strong>edit</strong> enabled moderators access to TinyMCE Media Buttons</li>
            <li><strong>edit</strong> attachment BBCode: show as image for selected image types</li>
            <li><strong>edit</strong> changed title of the Online Users dashboard widget</li>
            <li><strong>edit</strong> use different icon for marking private topics in the topics list</li>
            <li><strong>edit</strong> show selected image types as a links, not as the thumbnails</li>
            <li><strong>edit</strong> expanded list of filters in mu plugins custom code example file</li>
            <li><strong>edit</strong> improved main styling for better display of inline images</li>
            <li><strong>edit</strong> improved file enqueue to load icons when needed</li>
            <li><strong>edit</strong> improved organization of plugin form files</li>
            <li><strong>edit</strong> d4pLib 1.8.8</li>
            <li><strong>edit</strong> removed outdated and unsued images</li>
            <li><strong>fix</strong> several styling issues with the forum meta boxes</li>
            <li><strong>fix</strong> thumbnail for TIFF type displayed as the blank thumbnail</li>
        </ul>

        <h4>Version: 4.4.6 / January 11 2017</h4>
        <ul>
            <li><strong>edit</strong> improved method for handling thanks buttons</li>
            <li><strong>fix</strong> thanks buttons not working in some rare cases</li>
        </ul>

        <h4>Version: 4.4.5 / December 27 2016</h4>
        <ul>
            <li><strong>fix</strong> fatal error with some PHP versions</li>
        </ul>

        <h4>Version: 4.4.4 / December 27 2016</h4>
        <ul>
            <li><strong>new</strong> translation: fa_IR - Persian / Farsi</li>
            <li><strong>new</strong> bbcodes toolbar: show only active and available BBCodes buttons</li>
            <li><strong>edit</strong> bbcodes: webshot serves HTTP/HTTPS based URL</li>
            <li><strong>edit</strong> updated various URL's to reflect Dev4Press Network changes</li>
            <li><strong>edit</strong> disabled use of moderation based user roles for admin panels</li>
            <li><strong>edit</strong> d4pLib 1.8.7</li>
            <li><strong>fix</strong> bbcodes: restricted BBCodes disabling not working properly</li>
            <li><strong>fix</strong> bbcodes: restriction processing ignores uppercase codes</li>
            <li><strong>fix</strong> bbcodes: restriction processing not working on edit</li>
            <li><strong>fix</strong> bbcodes: restriction processing always shows message</li>
            <li><strong>fix</strong> problem with some settings after the plugin is updated</li>
        </ul>

        <h4>Version: 4.4.3 / November 1 2016</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.8.4</li>
            <li><strong>fix</strong> issue with the topic lock and access to locked topic</li>
            <li><strong>fix</strong> topic lock template misspelling of word Temporarily</li>
        </ul>

        <h4>Version: 4.4.2 / October 20 2016</h4>
        <ul>
            <li><strong>new</strong> option to allow visitors to use advanced BBCodes</li>
            <li><strong>edit</strong> few minor changes to some of the options descriptions</li>
            <li><strong>fix</strong> media upload control constant not defined warning</li>
        </ul>

        <h4>Version: 4.4.1 / October 16 2016</h4>
        <ul>
            <li><strong>new</strong> filter to control display of the user stats online status</li>
            <li><strong>new</strong> tools panel to recheck database and update plugin settings</li>
            <li><strong>edit</strong> new posts widget: notice about the access rights option</li>
            <li><strong>edit</strong> some small updates to the tools panel organization</li>
            <li><strong>edit</strong> expanded list of filters in the MU override script</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>edit</strong> d4pLib 1.8.3</li>
            <li><strong>fix</strong> online status widget: some settings ignored</li>
            <li><strong>fix</strong> few translation strings missing from the POT file</li>
        </ul>

        <h4>Version: 4.4 / September 27 2016</h4>
        <ul>
            <li><strong>new</strong> attachments: add download attribute to files links</li>
            <li><strong>new</strong> attachments: option to remove 'insert into content' button</li>
            <li><strong>new</strong> attachments: disable limits for selected user roles</li>
            <li><strong>new</strong> attachments: improved error validation messages</li>
            <li><strong>new</strong> attachments: extra panel with deletion settings</li>
            <li><strong>new</strong> attachments: delete attachments from topic/reply edit</li>
            <li><strong>new</strong> report: option to disable scroll to report form behavior</li>
            <li><strong>new</strong> report: show on the front if the topic or reply are reported</li>
            <li><strong>new</strong> additional capabilities for control over admin side panels</li>
            <li><strong>new</strong> options to allow moderator access to some admin side panels</li>
            <li><strong>new</strong> options to select roles that can see front forum statistics block</li>
            <li><strong>new</strong> option to allow only topic author to modify tags in reply</li>
            <li><strong>new</strong> plugin has new icon for WordPress admin side menu</li>
            <li><strong>edit</strong> attachments: some settings are moved to different panels</li>
            <li><strong>edit</strong> attachments: various improvements in the display of attachments</li>
            <li><strong>edit</strong> attachments: add another attachment styled as a button</li>
            <li><strong>edit</strong> quotes: display allowed HTML tags option on quotes settings panel</li>
            <li><strong>edit</strong> improvements to the styling of the BBCode toolbar buttons</li>
            <li><strong>edit</strong> changes in the way JavaScript files are compressed</li>
            <li><strong>edit</strong> additional information for many of the plugin settings</li>
            <li><strong>edit</strong> few more settings validation improvements and changes</li>
            <li><strong>edit</strong> d4pLib 1.8.2</li>
            <li><strong>del</strong> removed search topics widget</li>
            <li><strong>del</strong> removed search topics results view</li>
            <li><strong>fix</strong> attachments: button for adding files gone in some cases</li>
            <li><strong>fix</strong> attachments: delete attachment parameters not sanitized</li>
            <li><strong>fix</strong> translations in some rare cases can break JavaScript code</li>
        </ul>

        <h4>Version: 4.3.5 / September 15 2016</h4>
        <ul>
            <li><strong>edit</strong> optimizations in functions getting latest topics and replies</li>
            <li><strong>fix</strong> slow query from using post_date_gmt column in some queries</li>
        </ul>

        <h4>Version: 4.3.4 / September 8 2016</h4>
        <ul>
            <li><strong>new</strong> forum statistcs function results are now cached</li>
            <li><strong>edit</strong> replaced statistical function for counting users</li>
            <li><strong>fix</strong> slow query from WordPress count_users function</li>
        </ul>

        <h4>Version: 4.3.3 / September 5 2016</h4>
        <ul>
            <li><strong>edit</strong> improvements to the main frontend CSS stylesheet</li>
            <li><strong>edit</strong> d4pLib 1.8</li>
            <li><strong>fix</strong> styling problems when using bbPress shortcodes</li>
        </ul>

        <h4>Version: 4.3.2 / August 11 2016</h4>
        <ul>
            <li><strong>edit</strong> say thanks: shows message after saving thanks</li>
            <li><strong>edit</strong> d4pLib 1.7.8</li>
            <li><strong>fix</strong> say thanks: shows removal link after thanks</li>
            <li><strong>fix</strong> some styling missing from minified CSS file</li>
            <li><strong>fix</strong> missing base class for the list of attachments panel</li>
        </ul>

        <h4>Version: 4.3.1 / August 2 2016</h4>
        <ul>
            <li><strong>new</strong> report: scroll screen to the top of the form</li>
            <li><strong>new</strong> report: replace report button after submit report</li>
            <li><strong>new</strong> report: filter for list of emails where notification is sent</li>
            <li><strong>edit</strong> report: improved detection for waiting reports only</li>
            <li><strong>edit</strong> report: small improvements in the positioning of the form</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>edit</strong> d4pLib 1.7.7</li>
            <li><strong>fix</strong> report: detection of report position not working in some cases</li>
            <li><strong>fix</strong> report: display of topic/reply forum in the report grid</li>
        </ul>

        <h4>Version: 4.3 / July 19 2016</h4>
        <ul>
            <li><strong>new</strong> report topic or reply to keymaster or moderator</li>
            <li><strong>new</strong> modify the list of allowed HTML tags and attributes</li>
            <li><strong>new</strong> process shortcodes for email notifications</li>
            <li><strong>new</strong> using AJAX for Say Thanks module</li>
            <li><strong>new</strong> improved sanitation of plugins settings on save</li>
            <li><strong>edit</strong> improvements to all plugin admin side grids</li>
            <li><strong>edit</strong> small changes in the settings organization</li>
            <li><strong>edit</strong> small changes in the default settings values</li>
            <li><strong>edit</strong> updated all SQL queries to go through wrapper object</li>
            <li><strong>edit</strong> improvements to JS/CSS compression and minification</li>
            <li><strong>edit</strong> d4pLib 1.7.6</li>
            <li><strong>fix</strong> wrong date comparison in functions to get latest posts</li>
            <li><strong>fix</strong> few small issues with the main JavaScript file</li>
        </ul>

        <h4>Version: 4.2.1 / June 22 2016</h4>
        <ul>
            <li><strong>edit</strong> few minor improvements to plugin styling with BuddyPress</li>
            <li><strong>edit</strong> changes to some of the plugin default settings</li>
            <li><strong>edit</strong> d4pLib 1.7.5</li>
            <li><strong>fix</strong> problem with adding multiple attachments with new jQuery</li>
            <li><strong>fix</strong> attachment preview before upload for some file names</li>
        </ul>

        <h4>Version: 4.2.0.1 / May 17 2016</h4>
        <ul>
            <li><strong>edit</strong> internationalization of date display for online users</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>fix</strong> option for topic duplication was hidden</li>
        </ul>

        <h4>Version: 4.2 / May 16 2016</h4>
        <ul>
            <li><strong>new</strong> bbcode toolbar: accessibility support</li>
            <li><strong>new</strong> attachments: accessibility support</li>
            <li><strong>new</strong> admin interface: accessibility support</li>
            <li><strong>new</strong> forum index: basic forum statistics block</li>
            <li><strong>new</strong> view: most thanked topics</li>
            <li><strong>new</strong> view: my most thanked topics</li>
            <li><strong>new</strong> lock: conditional functions for locked topics and replies</li>
            <li><strong>new</strong> show topic thumbnail if available in the forum topics list</li>
            <li><strong>new</strong> online users: track maximum number of online users</li>
            <li><strong>new</strong> private reply: basic threaded replies support</li>
            <li><strong>new</strong> new posts widget: option to exclude forums by forum ID</li>
            <li><strong>edit</strong> online users widget: show maximum number of users ever</li>
            <li><strong>edit</strong> quote: attempt to close broken HTML before adding</li>
            <li><strong>edit</strong> bbcode toolbar: toolbar buttons now use BUTTON tag</li>
            <li><strong>edit</strong> small changes in the way plugin enqueues CSS/JS files</li>
            <li><strong>edit</strong> attachments: many changes to attachment rendering</li>
            <li><strong>edit</strong> several improvements to public functions organization</li>
            <li><strong>edit</strong> d4pLib 1.7.0</li>
            <li><strong>fix</strong> online users tracking: duplicated run of tracking code</li>
            <li><strong>fix</strong> online users widget: warning related to tracking cookie</li>
            <li><strong>fix</strong> few minor issues with several functions names</li>
        </ul>

        <h4>Version: 4.1.1 / April 21 2016</h4>
        <ul>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>edit</strong> d4pLib 1.6.6</li>
            <li><strong>fix</strong> users stats integration: thanks count displayed wrong</li>
            <li><strong>fix</strong> problem with source code BBCodes in some cases</li>
            <li><strong>fix</strong> few typos and missing translation strings</li>
        </ul>

        <h4>Version: 4.1.0.2 / March 31 2016</h4>
        <ul>
            <li><strong>fix</strong> invalid URL for the admin side attachments list page</li>
            <li><strong>fix</strong> missing items per page screen option for attachments list</li>
            <li><strong>fix</strong> using search field for the attachments list not working</li>
        </ul>

        <h4>Version: 4.1.0.1 / March 28 2016</h4>
        <ul>
            <li><strong>fix</strong> settings from BBCodes panel not saving</li>
            <li><strong>fix</strong> few small settings description issues</li>
        </ul>

        <h4>Version: 4.1 / March 28 2016</h4>
        <ul>
            <li><strong>new</strong> widget: enhanced forum statistics</li>
            <li><strong>new</strong> BBCode: highlight</li>
            <li><strong>new</strong> BBCode: heading</li>
            <li><strong>new</strong> BBCode hide can be set to check for thanks</li>
            <li><strong>new</strong> BBCode attachment attempts to replace file name with ID</li>
            <li><strong>new</strong> shows thanks counts inside user stats area</li>
            <li><strong>new</strong> redirect non-logged users to custom URL or home page</li>
            <li><strong>new</strong> fitvids library for auto sizing videos added using BBCodes</li>
            <li><strong>new</strong> admin panel for Views, Modules, Attachments and BBCodes</li>
            <li><strong>new</strong> reorganization of settings with new groups and panels</li>
            <li><strong>new</strong> individual BBCodes settings moved into own panels</li>
            <li><strong>new</strong> posts widget has option to show author avatar</li>
            <li><strong>new</strong> posts widget filters post by author access rights</li>
            <li><strong>new</strong> filters for the items in the user counts area</li>
            <li><strong>new</strong> actions fired when users says and removes thanks</li>
            <li><strong>new</strong> basic help tab for all plugin admin pages</li>
            <li><strong>new</strong> mu-plugins based filters override php starter file</li>
            <li><strong>new</strong> more knowledge base links for various plugin features</li>
            <li><strong>new</strong> plugin now requires WordPress 4.0 or newer</li>
            <li><strong>edit</strong> improved styling for the thanks list of users</li>
            <li><strong>edit</strong> improvements to the WordPress toolbar plugin menu</li>
            <li><strong>edit</strong> all grids now have full sanitation of input data</li>
            <li><strong>edit</strong> internal file structures improvements</li>
            <li><strong>edit</strong> updated method for loading translations</li>
            <li><strong>edit</strong> d4pLib 1.6.3</li>
            <li><strong>edit</strong> removed some duplicated functions</li>
            <li><strong>edit</strong> removed standalone export handler file</li>
            <li><strong>fix</strong> minor issue with attachment insert into content control</li>
            <li><strong>fix</strong> problem with canned replies menu position in some cases</li>
            <li><strong>fix</strong> few problems with BBCodes toolbar when used on admin side</li>
            <li><strong>fix</strong> some filter and action names were named wrong</li>
            <li><strong>fix</strong> private topics and replies admin colum always empty</li>
            <li><strong>fix</strong> private topics and replies undefined variable</li>
            <li><strong>fix</strong> profile widget misspelling of word Subscription</li>
            <li><strong>fix</strong> settings panel misspelling of word Enhancements</li>
        </ul>

        <h4>Version: 4.0.8 / February 4 2015</h4>
        <ul>
            <li><strong>edit</strong> quote loading workaround for BuddyPress integration</li>
            <li><strong>edit</strong> d4pLib 1.5.9</li>
            <li><strong>fix</strong> quote button not displayed in some cases</li>
            <li><strong>fix</strong> typo: replayed used instead of replied</li>
            <li><strong>fix</strong> typo: subsciptions used instead of subscriptions</li>
        </ul>

        <h4>Version: 4.0.7 / December 28 2015</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.5.5</li>
            <li><strong>fix</strong> missing tag in the notification settings description</li>
        </ul>

        <h4>Version: 4.0.6 / December 10 2015</h4>
        <ul>
            <li><strong>edit</strong> auto update signature for shorthand BBCodes</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>fix</strong> minor issue with the main JavaScript file</li>
        </ul>

        <h4>Version: 4.0.5 / December 9 2015</h4>
        <ul>
            <li><strong>new</strong> update tool added for WordPress 4.4 shortcodes changes</li>
            <li><strong>new</strong> global update confirmation notice after plugin is updated</li>
            <li><strong>edit</strong> list of BBCodes updated to remove shorthand notation</li>
            <li><strong>edit</strong> list of used BBCodes formats for toolbar updated</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>fix</strong> list of BBCodes in some cases are missing quotes</li>
            <li><strong>fix</strong> list of toolbar BBCodes in some cases are missing quotes</li>
            <li><strong>fix</strong> adding quote BBCode using shorthand notation</li>
        </ul>

        <h4>Version: 4.0.4 / December 8 2015</h4>
        <ul>
            <li><strong>new</strong> added Apple Swift support for Syntax Highlighting</li>
            <li><strong>new</strong> expand list of Syntax Highlighting brushes for auto load</li>
            <li><strong>new</strong> toolbar menu expanded with Knowledge Base and Support Forum links</li>
            <li><strong>edit</strong> d4pLib 1.5.3</li>
            <li><strong>fix</strong> issues with private topics and replies created by anonymous users</li>
            <li><strong>fix</strong> some outdated links in the WordPres toolbar menu</li>
            <li><strong>fix</strong> some outdated links on the About Dev4Press panel</li>
            <li><strong>fix</strong> minor problem with enqueuing files on the admin side</li>
            <li><strong>fix</strong> few typos and missing translation strings</li>
        </ul>

        <h4>Version: 4.0.3 / Novemeber 21 2015</h4>
        <ul>
            <li><strong>new</strong> added WordPress plugin flag Private</li>
            <li><strong>edit</strong> removed PHP close tags from end of all PHP files</li>
            <li><strong>edit</strong> fully tested with upcoming WordPress 4.4</li>
            <li><strong>edit</strong> some important loading changes and improvements</li>
            <li><strong>edit</strong> d4pLib 1.5.2</li>
            <li><strong>fix</strong> wrong link used for reply to topic for thanks feature</li>
            <li><strong>fix</strong> several missing strings from translation file</li>
        </ul>

        <h4>Version: 4.0.2 / October 30 2015</h4>
        <ul>
            <li><strong>fix</strong> topic lock options is always active regardless of settings</li>
            <li><strong>fix</strong> problem with escaping string function for SQL query in PHP 5.5 and newer</li>
        </ul>

        <h4>Version: 4.0.1 / October 22 2015</h4>
        <ul>
            <li><strong>new</strong> online users widget: option to show / hide user roles</li>
            <li><strong>new</strong> dedicated function to get list of online users</li>
            <li><strong>edit</strong> online users widgets are using new function to get users list</li>
            <li><strong>edit</strong> d4pLib 1.5</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>fix</strong> attachment BBCode name not sanitized before search for attachment</li>
            <li><strong>fix</strong> online users widget now showing only user display name</li>
            <li><strong>fix</strong> source code BBCode was parsing shortcodes inside of it</li>
        </ul>

        <h4>Version: 4.0 / October 5 2015</h4>
        <ul>
            <li><strong>new</strong> module: say thanks for topics and replies</li>
            <li><strong>new</strong> module: define and use canned replies</li>
            <li><strong>new</strong> module: track users and guests online status</li>
            <li><strong>new</strong> functions: set of functions to override by theme</li>
            <li><strong>new</strong> functions: display signature for any user anywhere</li>
            <li><strong>new</strong> bbcode: scode for displaying formated source code</li>
            <li><strong>new</strong> syntax highlighting for source code shortcode</li>
            <li><strong>new</strong> widget: display online users and guests</li>
            <li><strong>new</strong> widgets: template based rendering for all widgets</li>
            <li><strong>new</strong> dashboard widget: display online users and guests</li>
            <li><strong>new</strong> forums: expanded attachments settings override</li>
            <li><strong>new</strong> forums: lock topic / reply form override settings</li>
            <li><strong>new</strong> topics: option to temporarily lock any topic</li>
            <li><strong>new</strong> topics: option to duplicate any topic</li>
            <li><strong>new</strong> tweak: fix the user/view pages 404 status error</li>
            <li><strong>new</strong> tweak: enable media library upload for TinyMCE for Participant</li>
            <li><strong>new</strong> tweak: disable make_clickable filter for topics and replies</li>
            <li><strong>new</strong> tweak: disable mention filter for topics and replies</li>
            <li><strong>new</strong> tweak: position for some topics and replies actions</li>
            <li><strong>new</strong> attachments: alternative placement for attachments list</li>
            <li><strong>new</strong> functions for custom signatures integration</li>
            <li><strong>new</strong> secondary action area added at the topic/reply bottom</li>
            <li><strong>new</strong> child / parent inheritance of forum settings</li>
            <li><strong>new</strong> send notification to subscribers on topic edit</li>
            <li><strong>new</strong> replace content and subject for forum notification emails</li>
            <li><strong>new</strong> options to display user online status in topic and reply</li>
            <li><strong>new</strong> options to enforce min/max length for title and content</li>
            <li><strong>new</strong> additional bbPress related links for Nav Menus</li>
            <li><strong>new</strong> display links to Knowledge Base for some plugin settings</li>
            <li><strong>new</strong> database tables to store data about user actions</li>
            <li><strong>new</strong> convert individual forum settings to new format</li>
            <li><strong>php</strong> tested for compatibility with upcoming PHP7</li>
            <li><strong>edit</strong> updated some private topic/reply style colors</li>
            <li><strong>edit</strong> improved CSS for some of the BBCodes</li>
            <li><strong>edit</strong> renamed some CSS classes for naming consistency</li>
            <li><strong>edit</strong> attachment shortcode no longer limiting parent post</li>
            <li><strong>edit</strong> rewritten adding of Quote links for topics and replies</li>
            <li><strong>edit</strong> rewritten handling of the forum settings metabox</li>
            <li><strong>edit</strong> rewritten loading of privacy checkbox settings</li>
            <li><strong>edit</strong> rewritten loading of attachments module</li>
            <li><strong>edit</strong> improvements to plugin JavaScript core code</li>
            <li><strong>edit</strong> improvements to many plugin core functions</li>
            <li><strong>edit</strong> refactored main settings object and access function</li>
            <li><strong>edit</strong> various adminisitration improvements and tweaks</li>
            <li><strong>edit</strong> d4pLib 1.4.6</li>
            <li><strong>edit</strong> updated pt_BR translation file</li>
            <li><strong>fix</strong> minor styling issues with new posts widget</li>
            <li><strong>fix</strong> minor issues with BBCode toolbar button replacement</li>
            <li><strong>fix</strong> attachments display styling issues with inline images</li>
            <li><strong>fix</strong> few issues with BBCode toolbar replacement of BBCodes</li>
            <li><strong>fix</strong> user profile widget appears empty due to some settings</li>
            <li><strong>fix</strong> problem with file size check for attached files</li>
            <li><strong>fix</strong> private topic CSS class not applied in all cases</li>
        </ul>
    </div>
</div>

<div class="d4p-group d4p-group-changelog">
    <h3><?php _e("Version", "gd-bbpress-toolbox"); ?> 3</h3>
    <div class="d4p-group-inner">
        <h4>Version: 3.8.3 / September 9 2015</h4>
        <ul>
            <li><strong>edit</strong> add line breaks after the content added to editor</li>
            <li><strong>edit</strong> changed minification for main plugin JavaScript code</li>
            <li><strong>edit</strong> changed minification for jQuery Browser plugin</li>
            <li><strong>edit</strong> jQuery jqEasyCharCounter Extended</li>
            <li><strong>edit</strong> jQuery Textrange 1.3.3</li>
            <li><strong>edit</strong> updated sv_SE translation file</li>
            <li><strong>fix</strong> buttons broken with signature BBCode editor</li>
            <li><strong>fix</strong> missing semicolon in minified JavaScript file</li>
            <li><strong>fix</strong> BBCode Toolbar issue with some BBCodes replacement</li>
            <li><strong>fix</strong> cursor stuck inside HTML quote in TinyMCE</li>
        </ul>
        <h4>Version: 3.8.2 / September 4 2015</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.4.4</li>
            <li><strong>fix</strong> attachments list styling for responsive layouts</li>
        </ul>
        <h4>Version: 3.8.1 / August 17 2015</h4>
        <ul>
            <li><strong>new</strong> translation: de_DE - Deutsch / German</li>
            <li><strong>edit</strong> d4pLib 1.4.1</li>
            <li><strong>edit</strong> updated pt_BR translation file</li>
            <li><strong>fix</strong> broken remove of custom MIME types</li>
        </ul>
        <h4>Version: 3.8 / May 27 2015</h4>
        <ul>
            <li><strong>new</strong> new posts widget can show topic/reply author</li>
            <li><strong>new</strong> new posts widget now has template to override</li>
            <li><strong>new</strong> option to open attachments in blank page</li>
            <li><strong>new</strong> option to enable KSES support for IMG tag Class attribute</li>
            <li><strong>new</strong> add close topic checkbox to replies for some roles</li>
            <li><strong>new</strong> search topics view widget now has template to override</li>
            <li><strong>new</strong> remove topic action link: Merge</li>
            <li><strong>new</strong> remove reply action link: Split</li>
            <li><strong>new</strong> settings panel for topics and replies features</li>
            <li><strong>new</strong> check for reply form access when displaying quote link</li>
            <li><strong>new</strong> translation: sv_SE - Svenska / Swedish</li>
            <li><strong>edit</strong> few minor changes to the display of attachments</li>
            <li><strong>edit</strong> several improvements to TinyMCE specific styling</li>
            <li><strong>edit</strong> d4pLib 1.3.5.1</li>
            <li><strong>edit</strong> updated pt_BR translation file</li>
            <li><strong>edit</strong> removed outdated and incomplete translations</li>
            <li><strong>fix</strong> attachments display alignment issue without caption</li>
            <li><strong>fix</strong> several small styling issues on the admin side</li>
        </ul>
        <h4>Version: 3.7.1 / May 5 2015</h4>
        <ul>
            <li><strong>edit</strong> improved main admin side enqueue files process</li>
            <li><strong>edit</strong> d4pLib 1.3.5</li>
            <li><strong>fix</strong> forced JS/CSS loading fails for the BBCode Toolbar</li>
            <li><strong>fix</strong> forced JS/CSS loading fails for the BBCodes</li>
            <li><strong>fix</strong> display of last activity in the Users grid</li>
        </ul>
        <h4>Version: 3.7 / April 22 2015</h4>
        <ul>
            <li><strong>new</strong> set caption for attachments before upload</li>
            <li><strong>new</strong> enhanced attachments upload form is responsive</li>
            <li><strong>new</strong> new detect and load of the plugin JS and CSS files</li>
            <li><strong>new</strong> option to change attachments form position</li>
            <li><strong>new</strong> option to change privacy checkbox form position</li>
            <li><strong>edit</strong> escaping urls from add_query_args function</li>
            <li><strong>edit</strong> attachments display shows caption if available</li>
            <li><strong>edit</strong> improvements to TinyMCE styling for BuddyPress integration</li>
            <li><strong>edit</strong> changes to some settings default values</li>
            <li><strong>edit</strong> several small styling improvements</li>
            <li><strong>edit</strong> load always option moved to advanced settings</li>
            <li><strong>edit</strong> d4pLib 1.3.4.1</li>
            <li><strong>fix</strong> upgrade notice displayed while upgrading plugin</li>
            <li><strong>fix</strong> few minor problems with minified CSS files</li>
        </ul>
        <h4>Version: 3.6.4 / April 8 2015</h4>
        <ul>
            <li><strong>new</strong> filter to modify allowed user roles for moderation</li>
            <li><strong>edit</strong> d4pLib 1.3.4</li>
            <li><strong>fix</strong> attachments on upload preview not working for uppercase filenames</li>
            <li><strong>fix</strong> private reply not always visibile to topic author</li>
        </ul>
        <h4>Version: 3.6.3 / March 18 2015</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.3.3</li>
            <li><strong>fix</strong> detection of allowed features in some very rare cases</li>
            <li><strong>fix</strong> potential security vulnerability with attachments grid</li>
        </ul>
        <h4>Version: 3.6.2 / March 7 2015</h4>
        <ul>
            <li><strong>fix</strong> attachments shortcode missing embedded file HREF attribute</li>
            <li><strong>fix</strong> some styling issues with enhanced attachments</li>
        </ul>
        <h4>Version: 3.6.1 / March 5 2015</h4>
        <ul>
            <li><strong>edit</strong> forum meta box checks if modules are active</li>
            <li><strong>edit</strong> updated pt_BR translation file</li>
            <li><strong>fix</strong> forum edit page broken if attachments are disabled</li>
        </ul>
        <h4>Version: 3.6 / March 3 2015</h4>
        <ul>
            <li><strong>new</strong> protect display of topic/reply revisions</li>
            <li><strong>new</strong> seo tools module</li>
            <li><strong>new</strong> seo: meta description tags</li>
            <li><strong>new</strong> seo: override topic/reply default excerpts</li>
            <li><strong>new</strong> seo: override forum/topic/reply meta title</li>
            <li><strong>new</strong> seo: meta robot for private topics/replies</li>
            <li><strong>new</strong> seo: rich snippet breadcrumbs</li>
            <li><strong>new</strong> widget: current topic information</li>
            <li><strong>new</strong> tools: close old and inactive topics</li>
            <li><strong>new</strong> rewritten admin side forum metabox</li>
            <li><strong>new</strong> override privacy settings for each forum</li>
            <li><strong>new</strong> select roles that can create private topic/reply</li>
            <li><strong>new</strong> list current attachments in topic/reply mode</li>
            <li><strong>new</strong> signature filter for before the display</li>
            <li><strong>new</strong> options for topic/reply admin side panel columns</li>
            <li><strong>new</strong> topic/reply admin side panel privacy column</li>
            <li><strong>new</strong> attachment validation always prevents .js and .php files</li>
            <li><strong>new</strong> new posts widget rewrited functions to get data</li>
            <li><strong>new</strong> widgets have own CSS styles file</li>
            <li><strong>new</strong> options to disable more bbPress default widgets</li>
            <li><strong>edit</strong> new posts widget uses reply names and URL's</li>
            <li><strong>edit</strong> few improvements to the plugin adminbar menu</li>
            <li><strong>edit</strong> improvements to attachments module</li>
            <li><strong>edit</strong> improvements to signatures module</li>
            <li><strong>edit</strong> improvements css/js compression</li>
            <li><strong>edit</strong> many improvements to all plugin widgets</li>
            <li><strong>edit</strong> d4pLib 1.3.2</li>
            <li><strong>fix</strong> broken enhanced signatures and signatures editor</li>
            <li><strong>fix</strong> broken signature display in some cases for visitors</li>
            <li><strong>fix</strong> problem with loading signature module</li>
            <li><strong>fix</strong> private topic CSS class not always applied</li>
            <li><strong>fix</strong> new posts widget problems with getting data</li>
            <li><strong>fix</strong> basic wrappers missing for all widgets</li>
            <li><strong>fix</strong> several styling issues with user profile widget</li>
        </ul>
        <h4>Version: 3.5.5 / February 23 2015</h4>
        <ul>
            <li><strong>new</strong> signatures display additional processing</li>
            <li><strong>new</strong> more options to control signature display</li>
            <li><strong>edit</strong> d4pLib 1.3.1</li>
            <li><strong>fix</strong> broken filtering for signature content editing</li>
            <li><strong>fix</strong> broken buddypress signature edit is some cases</li>
        </ul>
        <h4>Version: 3.5.2 / February 18 2015</h4>
        <ul>
            <li><strong>new</strong> filter to control private topics/replies checkbox</li>
            <li><strong>fix</strong> buddypress links removal with broken base object</li>
        </ul>
        <h4>Version: 3.5.1 / February 6 2015</h4>
        <ul>
            <li><strong>edit</strong> few more improvements to JavaScript file</li>
            <li><strong>edit</strong> round attachment size to 2 decimals</li>
            <li><strong>edit</strong> d4pLib 1.3.0.1</li>
            <li><strong>fix</strong> broken insert attachment into content</li>
        </ul>
        <h4>Version: 3.5 / February 5 2015</h4>
        <ul>
            <li><strong>new</strong> options to control private topics</li>
            <li><strong>new</strong> options to control private replies</li>
            <li><strong>new</strong> use of BBCodes toolbar to edit signatures</li>
            <li><strong>new</strong> use of TinyMCE editor to edit signatures</li>
            <li><strong>new</strong> limit roles that can edit signatures</li>
            <li><strong>new</strong> panel listing all users active in forums</li>
            <li><strong>new</strong> option to enable titles for replies</li>
            <li><strong>new</strong> option to change length for the titles</li>
            <li><strong>new</strong> option to disable Toolbar information submenu</li>
            <li><strong>new</strong> topic icons: user replied to topic</li>
            <li><strong>new</strong> topic icons: topic is set as sticky</li>
            <li><strong>new</strong> auto flush rewrite rules on saving Views</li>
            <li><strong>edit</strong> various improvements to main style file</li>
            <li><strong>edit</strong> various improvements to rendering of icons</li>
            <li><strong>edit</strong> fully reorganized main JavaScript file</li>
            <li><strong>edit</strong> various improvements to the quote object</li>
            <li><strong>edit</strong> updated list of included icons PNG file</li>
            <li><strong>edit</strong> reorganization of some settings panels</li>
            <li><strong>edit</strong> d4pLib 1.3</li>
            <li><strong>edit</strong> FontAwesome 4.3.0</li>
            <li><strong>fix</strong> problems with quote envelop filters order</li>
            <li><strong>fix</strong> BBCodes examples missing double quotes</li>
            <li><strong>fix</strong> several minor styling problems</li>
        </ul>
        <h4>Version: 3.4.2 / January 17 2015</h4>
        <ul>
            <li><strong>new</strong> browser detection in JavaScript</li>
            <li><strong>new</strong> granular display of allowed attachment size</li>
            <li><strong>edit</strong> changes to the attachment form theme template</li>
            <li><strong>edit</strong> few minor updates to meta boxes forms</li>
            <li><strong>edit</strong> d4pLib 1.2.9.1</li>
            <li><strong>fix</strong> enhanced attachments displayed in outdated browsers</li>
        </ul>
        <h4>Version: 3.4.1 / January 9 2015</h4>
        <ul>
            <li><strong>edit</strong> capabilities check work even with no administrator role</li>
            <li><strong>edit</strong> quote BBCode now parses shortcodes inside the quote</li>
            <li><strong>edit</strong> list attachments in the order of the upload</li>
            <li><strong>edit</strong> d4pLib 1.2.9</li>
            <li><strong>fix</strong> issue with attachments validation submit button</li>
            <li><strong>fix</strong> some minor issues with saving plugin settings</li>
        </ul>
        <h4>Version: 3.4 / December 16 2014</h4>
        <ul>
            <li><strong>new</strong> views: integration of Views into Nav Menus</li>
            <li><strong>new</strong> attachments: enhanced file selection with image preview</li>
            <li><strong>new</strong> attachments: insert into content before upload</li>
            <li><strong>new</strong> bbcode: attachment for getting topic/reply attachments</li>
            <li><strong>new</strong> signature: saving checks if user can post unfiltered HTML</li>
            <li><strong>new</strong> widgets: topic views allows for reordering of views list</li>
            <li><strong>new</strong> widgets: all now have before and after HTML</li>
            <li><strong>new</strong> settings to disable bbPress adding 'nofollow' to links</li>
            <li><strong>new</strong> settings panel to add new MIME Types</li>
            <li><strong>new</strong> option to reverse replies order on the topic page</li>
            <li><strong>new</strong> show notice to disable our free bbPress plugins</li>
            <li><strong>edit</strong> renamed old functions to avoid collision with free plugins</li>
            <li><strong>edit</strong> widgets: all use new and improved tabbed layout</li>
            <li><strong>edit</strong> widgets: all are renamed to avoid confusion</li>
            <li><strong>edit</strong> few updates to the plugin admin side interface</li>
            <li><strong>edit</strong> FontAwesome 4.2.0</li>
            <li><strong>edit</strong> d4pLib 1.2.6</li>
            <li><strong>fix</strong> widgets: not applying custom css class to all widgets</li>
            <li><strong>fix</strong> attachments: some minor styling issues</li>
        </ul>
        <h4>Version: 3.3.1 / November 5 2014</h4>
        <ul>
            <li><strong>edit</strong> d4pLib 1.1</li>
            <li><strong>fix</strong> attachments log: delete and unattach not working</li>
            <li><strong>fix</strong> attachments log: bulk delete and unattach not working</li>
            <li><strong>fix</strong> errors log: delete not working</li>
            <li><strong>fix</strong> errors log: bulk delete not working</li>
        </ul>
        <h4>Version: 3.3 / August 22 2014</h4>
        <ul>
            <li><strong>new</strong> attachments: client side validation for size and type</li>
            <li><strong>new</strong> attachments: show file size and type before upload</li>
            <li><strong>new</strong> attachments: option to reset attachment input field</li>
            <li><strong>new</strong> attachments: confirmation when deleting or detaching</li>
            <li><strong>new</strong> view: my topics with no replies</li>
            <li><strong>new</strong> view: my topics with most replies</li>
            <li><strong>new</strong> option to lock all forums for new topics</li>
            <li><strong>new</strong> option to lock all topics for new replies</li>
            <li><strong>new</strong> option to enable adding of DIV into allowed tag</li>
            <li><strong>new</strong> option to show last user activity column in the users panel</li>
            <li><strong>edit</strong> attachments: file types with new FontAwesome file icons</li>
            <li><strong>edit</strong> expanded instructions for some of the settings</li>
            <li><strong>edit</strong> FontAwesome 4.1.0</li>
            <li><strong>edit</strong> d4pLib 1.0.6</li>
            <li><strong>fix</strong> attachments list styling with font based icons</li>
            <li><strong>fix</strong> problems with upload of audio and video attachments</li>
            <li><strong>fix</strong> quote problem caused by filtered DIV tags</li>
        </ul>
        <h4>Version: 3.2 / July 8 2014</h4>
        <ul>
            <li><strong>new</strong> view: topics with my replies</li>
            <li><strong>new</strong> view: all my topics (active and closed)</li>
            <li><strong>new</strong> option to disable views that require log in</li>
            <li><strong>edit</strong> encoded BBCodes toolbar buttons contents</li>
            <li><strong>edit</strong> expanded instructions for some of the settings</li>
            <li><strong>edit</strong> clear instructions for BBCodes toolbar activation</li>
            <li><strong>edit</strong> several styling improvements for quotes</li>
            <li><strong>edit</strong> d4pLib 1.0.3</li>
            <li><strong>fix</strong> BBCodes toobar problems with some theme templates</li>
            <li><strong>fix</strong> my active topics view was showing closed topics</li>
            <li><strong>fix</strong> views widget warnings for views no longer registered</li>
        </ul>
        <h4>Version: 3.1.4 / June 25 2014</h4>
        <ul>
            <li><strong>fix</strong> duplicated define entry for last activity constant</li>
        </ul>
        <h4>Version: 3.1.3 / June 21 2014</h4>
        <ul>
            <li><strong>fix</strong> email notifications override number of filter parameters</li>
        </ul>
        <h4>Version: 3.1.2 / June 15 2014</h4>
        <ul>
            <li><strong>edit</strong> changed loading of some core libraries</li>
            <li><strong>fix</strong> several missing strings from translation file</li>
            <li><strong>fix</strong> several broken settings on admin side</li>
        </ul>
        <h4>Version: 3.1.1 / June 12 2014</h4>
        <ul>
            <li><strong>new</strong> tracking cookie number of days for expiration</li>
            <li><strong>new</strong> extra cookie for the current session</li>
            <li><strong>edit</strong> improvement to the 'since last visit' view</li>
            <li><strong>edit</strong> d4pLib 1.0.2</li>
        </ul>
        <h4>Version: 3.1 / May 15 2014</h4>
        <ul>
            <li><strong>new</strong> auto set first attached image as post thumbnail</li>
            <li><strong>new</strong> selection of allowed mime types for attachments upload</li>
            <li><strong>new</strong> options to register extra features for forum post type</li>
            <li><strong>new</strong> options to register extra features for topic post type</li>
            <li><strong>new</strong> options to register extra features for reply post type</li>
            <li><strong>new</strong> view: topics by freshness</li>
            <li><strong>new</strong> theme can override attachments form template</li>
            <li><strong>new</strong> theme can override signature form edit templates for bbPress and BuddyPress</li>
            <li><strong>edit</strong> attachments form template notice display improvements</li>
            <li><strong>edit</strong> many admin side styling improvements</li>
            <li><strong>edit</strong> d4pLib 1.0.1</li>
            <li><strong>fix</strong> quote issue with rich editor in WordPress 3.9</li>
            <li><strong>fix</strong> quote issue with BR tags not properly stripped</li>
        </ul>
        <h4>Version: 3.0.1 / April 23 2014</h4>
        <ul>
            <li><strong>new</strong> signature: process smilies when displaying</li>
            <li><strong>fix</strong> posts deletion problem caused by attachments module</li>
        </ul>
        <h4>Version: 3.0 / April 16 2014</h4>
        <ul>
            <li><strong>new</strong> completely new administration interface</li>
            <li><strong>new</strong> administration interface is now responsive</li>
            <li><strong>new</strong> show user registration date in topics/replies</li>
            <li><strong>new</strong> show user posts counts in topics/replies</li>
            <li><strong>new</strong> bbcodes: toolbar for quick access to codes</li>
            <li><strong>new</strong> bbcodes: toolbar uses FontAwesome font icons</li>
            <li><strong>new</strong> signatures: enhanced signature settings</li>
            <li><strong>new</strong> signatures: user can mix HTML and BBCodes</li>
            <li><strong>new</strong> attachments: use font icons or images for icons</li>
            <li><strong>new</strong> bbPress: disable login widget</li>
            <li><strong>new</strong> bbPress: disable dashboard right now widget</li>
            <li><strong>new</strong> tools: export and import plugin settings</li>
            <li><strong>new</strong> tools: reset plugin settings</li>
            <li><strong>new</strong> widgets: expanded new posts time period index</li>
            <li><strong>new</strong> enhance: disable bbPress breadcrumbs</li>
            <li><strong>new</strong> now using WordPress List Table based grids</li>
            <li><strong>new</strong> now using d4pLib shared code library</li>
            <li><strong>new</strong> uses FontAwesome font icons for admin interface</li>
            <li><strong>new</strong> uses DashIcons font icons for admin interface</li>
            <li><strong>edit</strong> refactoring of filters/actions names</li>
            <li><strong>edit</strong> refactoring of most functions names</li>
            <li><strong>edit</strong> changed form elements for signature edit</li>
            <li><strong>del</strong> removed support for bbPress 2.0, 2.1 and 2.2</li>
            <li><strong>del</strong> removed shared gdr2 library</li>
            <li><strong>del</strong> removed dependency on jQueryUI</li>
            <li><strong>del</strong> removed many obsolete or duplicated functions</li>
            <li><strong>fix</strong> buddypress editing custom fields can remove signature</li>
            <li><strong>fix</strong> styling issues caused by the bbPress layout changes</li>
            <li><strong>fix</strong> widgets: broken new posts time period index</li>
            <li><strong>fix</strong> several small issues with attachments block layout</li>
            <li><strong>fix</strong> bbcode email broken: wrong protection encoding method</li>
            <li><strong>fix</strong> list of bbcodes for display purposes missing some codes</li>
            <li><strong>fix</strong> problem with periods selection for new posts widget</li>
        </ul>
    </div>
</div>

<div class="d4p-group d4p-group-changelog">
    <h3><?php _e("Version", "gd-bbpress-toolbox"); ?> 2</h3>
    <div class="d4p-group-inner">
        <h4>Version: 2.0.1 / September 11 2013</h4>
        <ul>
            <li><strong>fix</strong> latest posts widgets problems</li>
        </ul>
        <h4>Version: 2.0 / September 11 2013</h4>
        <ul>
            <li><strong>new</strong> widget: logged in user profile</li>
            <li><strong>new</strong> views: current user active (open) topics</li>
            <li><strong>new</strong> views: new topics/replies in the last 3 days</li>
            <li><strong>new</strong> bbcode: hide</li>
            <li><strong>new</strong> bbcode: spoiler</li>
            <li><strong>new</strong> bbcode: topic link</li>
            <li><strong>new</strong> bbcode: reply link</li>
            <li><strong>edit</strong> improved form integration for attachments</li>
            <li><strong>edit</strong> all widgets have option for extra CSS class</li>
            <li><strong>edit</strong> few improvements to signatures integration</li>
            <li><strong>edit</strong> updated to latest gdr2 2.8.2.2 shared library</li>
            <li><strong>edit</strong> updated jquery ui library to 1.10.3</li>
            <li><strong>fix</strong> hardcoded posts table for custom views</li>
            <li><strong>fix</strong> warnings with views module query modification</li>
        </ul>
    </div>
</div>

<div class="d4p-group d4p-group-changelog">
    <h3><?php _e("Version", "gd-bbpress-toolbox"); ?> 1</h3>
    <div class="d4p-group-inner">
        <h4>Version: 1.6.3 / september 3 2013</h4>
        <ul>
            <li><strong>edit</strong> updated to latest gdr2 2.8.2.1 shared library</li>
            <li><strong>fix</strong> signatures not working with bbPress 2.4</li>
            <li><strong>fix</strong> quotes not working with bbPress 2.4</li>
            <li><strong>fix</strong> saving plugin settings fails in some cases</li>
        </ul>
        <h4>Version: 1.6.2 / september 3 2013</h4>
        <ul>
            <li><strong>edit</strong> many improvements to handling of bbCodes</li>
            <li><strong>fix</strong> few attachments module initialization problems</li>
            <li><strong>fix</strong> issue with attachments DIV not closed properly</li>
            <li><strong>fix</strong> few typos and missing translation strings</li>
            <li><strong>fix</strong> bbCode youtube and vimeo don't work with SSL active</li>
            <li><strong>fix</strong> bbCode notice option was not used by the plugin</li>
        </ul>
        <h4>Version: 1.6.1 / june 25 2013</h4>
        <ul>
            <li><strong>new</strong> replace content and subject for subscribe notification emails</li>
            <li><strong>new</strong> replace sender email and name for subscribe notification emails</li>
            <li><strong>edit</strong> updated to latest gdr2 2.8.2 shared library</li>
            <li><strong>edit</strong> removed all unused debugger related code</li>
            <li><strong>fix</strong> bbCode use info on signature edit when bbCodes are disabled</li>
        </ul>
        <h4>Version: 1.6 / may 10 2013</h4>
        <ul>
            <li><strong>new</strong> module: control over the topic fancy editor</li>
            <li><strong>new</strong> module: control over the reply fancy editor</li>
            <li><strong>new</strong> option to disable BBCodes you don't need</li>
            <li><strong>edit</strong> optimized and improved custom views queries</li>
        </ul>
        <h4>Version: 1.5.1 / april 21 2013</h4>
        <ul>
            <li><strong>new</strong> select profile group in BuddyPress for signature editor</li>
            <li><strong>edit</strong> changed upload field location to end of the form</li>
            <li><strong>fix</strong> missing enhanced info when editing signatures</li>
            <li><strong>fix</strong> minor problem with quote removing filters</li>
            <li><strong>fix</strong> missing table cell ending for admin side signature editor</li>
        </ul>
        <h4>Version: 1.5.0.1 / april 19 2013</h4>
        <ul>
            <li><strong>fix</strong> quote not setting proper ID for lead topic display</li>
        </ul>
        <h4>Version: 1.5 / march 31 2013</h4>
        <ul>
            <li><strong>new</strong> confirmed plugin support for bbpress 2.3</li>
            <li><strong>new</strong> bbcodes: youtube code supports full url</li>
            <li><strong>new</strong> bbcodes: vimeo code supports full url</li>
            <li><strong>edit</strong> updated bbpress user profile signature editor form</li>
            <li><strong>edit</strong> changed method for enqueuing scripts and css files</li>
            <li><strong>edit</strong> changed loading of modules init and order</li>
            <li><strong>edit</strong> updated jquery ui library to 1.9.2</li>
            <li><strong>edit</strong> updated jquery qtip2 library to 2.0.1</li>
            <li><strong>fix</strong> various warnings due to missing variables check</li>
        </ul>
        <h4>Version: 1.4.0.1 / march 26 2013</h4>
        <ul>
            <li><strong>edit</strong> updated to latest gdr2 2.8.1.2 shared library</li>
            <li><strong>fix</strong> minor problem with the widgets initialization</li>
            <li><strong>fix</strong> attempts to load CSS file that is no longer in use</li>
        </ul>
        <h4>Version: 1.4 / december 13 2012</h4>
        <ul>
            <li><strong>new</strong> support for dynamic roles with bbpress 2.2</li>
            <li><strong>new</strong> toolbar: support for new bbpress 2.2 tools</li>
            <li><strong>edit</strong> updated readme file with faq and installation info</li>
            <li><strong>edit</strong> updated to latest gdr2 2.8 shared library</li>
            <li><strong>edit</strong> updated jquery ui library to 1.9.2</li>
            <li><strong>edit</strong> updated jquery ui multiselect to 1.14_dev</li>
            <li><strong>fix</strong> roles selection dropdowns not saving changes</li>
            <li><strong>fix</strong> duplicated signature form on profile edit page</li>
            <li><strong>fix</strong> broken url's to images in main CSS file</li>
        </ul>
        <h4>Version: 1.3.1 / november 21 2012</h4>
        <ul>
            <li><strong>edit</strong> confirmed compatibility with bbPress 2.2</li>
            <li><strong>edit</strong> some changes for Wordpress 3.5 compatibility</li>
            <li><strong>edit</strong> styling updates for TwentyTwelve theme</li>
            <li><strong>fix</strong> detecting script debug mode generates warning</li>
        </ul>
        <h4>Version: 1.3 / november 16 2012</h4>
        <ul>
            <li><strong>new</strong> enhancing: remove buddypress profile url overrides</li>
            <li><strong>new</strong> bbcode: filters to restrict and strip shortcodes</li>
            <li><strong>new</strong> bbcode: restricted codes section</li>
            <li><strong>new</strong> bbcode: embed using oEmbed for supported providers</li>
            <li><strong>new</strong> bbcode: nfo (monospaced info files)</li>
            <li><strong>new</strong> bbcode: email</li>
            <li><strong>new</strong> bbcode: anchor</li>
            <li><strong>new</strong> bbcode: webshot (screenshot for url)</li>
            <li><strong>new</strong> bbcode: iframe (restricted)</li>
            <li><strong>new</strong> bbcode: function to return list of bbcodes and information</li>
            <li><strong>edit</strong> bbcode: improved youtube and vimeo implementation</li>
            <li><strong>edit</strong> bbcode: improvements to main bbcodes class</li>
            <li><strong>edit</strong> bbcode: improvements to panel listing codes</li>
            <li><strong>edit</strong> updated some styling elements on admin side</li>
            <li><strong>edit</strong> updated to latest gdr2 2.7.9.5 shared library</li>
            <li><strong>edit</strong> updated qtip 2.0 library to latest nightly</li>
            <li><strong>edit</strong> updated jquery ui library to 1.9.1</li>
            <li><strong>fix</strong> bbcode: not applied when displaying lead topic</li>
            <li><strong>fix</strong> detecting script debug mode generates warning</li>
            <li><strong>fix</strong> several php warnings and notices</li>
        </ul>
        <h4>Version: 1.2.2 / november 2 2012</h4>
        <ul>
            <li><strong>new</strong> enhancing bbPress: always show lead topic</li>
            <li><strong>new</strong> translation: German</li>
            <li><strong>new</strong> translation: Serbian</li>
            <li><strong>edit</strong> signature: improvements to display filters</li>
            <li><strong>edit</strong> attachments: improvements to display filters</li>
            <li><strong>edit</strong> quote: improvements to display filters</li>
            <li><strong>edit</strong> updated to latest gdr2 2.7.9.3 shared library</li>
            <li><strong>fix</strong> signature: fails to find topic/reply author</li>
            <li><strong>fix</strong> signature: not displayed when using lead topic</li>
            <li><strong>fix</strong> attachments: using actions instead of filters for content</li>
            <li><strong>fix</strong> quote: not working when using lead topic</li>
            <li><strong>fix</strong> quote: in some cases quote link is missing</li>
            <li><strong>fix</strong> minor problem with saving plugin settings</li>
        </ul>
        <h4>Version: 1.2.1 / october 18 2012</h4>
        <ul>
            <li><strong>new</strong> bbcode: admin panel with list of all bbcodes</li>
            <li><strong>new</strong> widgets: new posts can display date with topics</li>
            <li><strong>new</strong> widgets: new posts allows selection of posts type</li>
            <li><strong>fix</strong> view: new posts since last visit broken</li>
            <li><strong>fix</strong> view: new posts broken when slug for it is changed</li>
        </ul>
        <h4>Version: 1.2 / october 15 2012</h4>
        <ul>
            <li><strong>new</strong> bbcode: line break tag - br</li>
            <li><strong>new</strong> views: new topics/replies in the last week</li>
            <li><strong>new</strong> views: new topics/replies in the last month</li>
            <li><strong>new</strong> views: set your own slugs and titles for views</li>
            <li><strong>new</strong> users: columns with user topics and replies counters</li>
            <li><strong>edit</strong> quote: few missing translation strings</li>
            <li><strong>edit</strong> toolbar: Change to generating some links in toolbar menu</li>
            <li><strong>edit</strong> updated to latest gdr2 2.7.9.1 shared library</li>
            <li><strong>fix</strong> widgets: missing option to disable new posts widget</li>
            <li><strong>fix</strong> quote: with fancy editor active not working with HTML editor</li>
            <li><strong>fix</strong> quote: scroll in javascript with ie7 and ie8</li>
            <li><strong>fix</strong> quote: javascript use of trim function with ie7 and ie8</li>
            <li><strong>fix</strong> quote: hook order breaks the oembed feature</li>
            <li><strong>fix</strong> quote: option displayed even when not allowed</li>
            <li><strong>fix</strong> views: empty view result can lead to 404 page</li>
        </ul>
        <h4>Version: 1.1 / october 7 2012</h4>
        <ul>
            <li><strong>new</strong> views: new topics/replies since last visit/activity</li>
            <li><strong>new</strong> views: new topics/replies in the last 24 hours</li>
            <li><strong>new</strong> views: filter allowing to change views slugs</li>
            <li><strong>new</strong> widget: new topics/replies for selected timeframe</li>
            <li><strong>new</strong> signature: buddypress profiles support to edit signature</li>
            <li><strong>new</strong> tools: options to track latest user activity time</li>
            <li><strong>new</strong> toolbar: show menu to normal visitors if toolbar is active</li>
            <li><strong>new</strong> languages: added german translation</li>
            <li><strong>edit</strong> updated to latest gdr2 2.7.9 shared library</li>
            <li><strong>edit</strong> updated jquery ui library to 1.8.24</li>
            <li><strong>edit</strong> updated jquery multiselect library to 1.13</li>
            <li><strong>fix</strong> duplicated registration for reply embed filter</li>
            <li><strong>fix</strong> toolbar menu broken when there are no forums or views</li>
            <li><strong>fix</strong> quote element was also including attachments</li>
            <li><strong>fix</strong> few small issues with the WordPress 3.5</li>
        </ul>
        <h4>Version: 1.0.1 / june 14 2012</h4>
        <ul>
            <li><strong>edit</strong> improved detection for bbpress</li>
            <li><strong>edit</strong> shared code library gdr2 updated to 2.7.6</li>
            <li><strong>fix</strong> toolbar integration causing post edit problems</li>
        </ul>
        <h4>Version: 1.0.0 / may 27 2012</h4>
        <ul>
            <li><strong>new</strong> first official version</li>
        </ul>
    </div>
</div>
