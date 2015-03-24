# onlineRssEdit
This set of PHP files enables editing an RSS feed online.


### Licence

None. Feel free to use it as you wish.


### Context

We are currently using an RSS feed to update information on a TV screen at our university. Using a local feed would not be  convenient, as we would not have been able to edit the feed remotely, so we needed a simple way to be able to edit this feed remotely


### Code structure

To do that, I developed a basic PHP script to add/remove entries in a given RSS feed via a webpage.
The code contains 4 files:
- feed.xml, the RSS feed itself;
- index.php is the webpage where the user can select which entry to remove and what to add;
- rss_add.php, is called by index.php, and adds a new entry in the feed;
- rss_del.php, is called by index.php, and removes an entry from the feed.


### Limitations

This basic script has several limitations:
- Access to the webpage should be protected via a login/password, for example using a [.htaccess](http://www.htaccesstools.com/articles/password-protection/) file.
- Only entry titles can currently be inserted via the interface (I did not need the rest, but this may be added rather easily).
- The feed URL is hardcoded and cannot be changed without manually editing the source code.

Note that the code is probably not very well secured. 


### Contact

Robin Roche - robinroche.com
