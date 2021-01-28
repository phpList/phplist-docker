<?php
/*
* ==============================================================================================================
*
*
* The minimum requirements to get phpList working are in this file.
* If you are interested in tweaking more options, check out the config_extended.php file
* or visit http://resources.phplist.com/system/config
*
* ** NOTE: To use options from config_extended.php, you need to copy them to this file **
*
==============================================================================================================
*/
// what is your Mysql database server hostname
$database_host = '##PHPLIST_DB_HOST##';
// what is the name of the database we are using
$database_name = '##PHPLIST_DB_NAME##';
// what user has access to this database
$database_user = '##PHPLIST_DB_USER##';
// and what is the password to login to control the database
$database_password = '##PHPLIST_DB_PASSWORD##';
// if you have an SMTP server, set it here. Otherwise it will use the normal php mail() function
//# if your SMTP server is called "smtp.mydomain.com" you enter this below like this:
//#
//#     define("PHPMAILERHOST",'smtp.mydomain.com');
define('PHPMAILERHOST', '##PHPLIST_PHPMAILERHOST##');
define('PHPMAILERPORT', '##PHPLIST_PHPMAILERPORT##');
define('PHPMAILER_SECURE', '##PHPLIST_PHPMAILER_SECURE##');

$phpmailer_smtpuser='##PHPLIST_PHPMAILER_SMTPUSER##';
$phpmailer_smtppassword='##PHPLIST_PHPMAILER_SMTPPASSWORD##';
// if TEST is set to 1 (not 0) it will not actually send ANY messages, but display what it would have sent
// this is here, to make sure you edited the config file and mails are not sent "accidentally"
// on unmanaged systems
define('TEST', 0);
/*
==============================================================================================================
*
* Settings for handling bounces
*
* This section is OPTIONAL, and not necessary to send out mailings, but it is highly recommended to correctly
* set up bounce processing. Without processing of bounces your system will end up sending large amounts of
* unnecessary messages, which overloads your own server, the receiving servers and internet traffic as a whole
*
==============================================================================================================
*/
// Message envelope.
// This is the address that most bounces will be delivered to
// Your should make this an address that no PERSON reads
// but a mailbox that phpList can empty every so often, to process the bounces
$message_envelope = '##PHPLIST_MESSAGE_ENVELOPE##';
// Handling bounces. Check README.bounces for more info
// This can be 'pop' or 'mbox'
$bounce_protocol = 'pop';
// set this to 0, if you set up a cron to download bounces regularly by using the
// commandline option. If this is 0, users cannot run the page from the web
// frontend. Read README.commandline to find out how to set it up on the
// commandline
define('MANUALLY_PROCESS_BOUNCES', 1);
// when the protocol is pop, specify these three
$bounce_mailbox_host = '##PHPLIST_BOUNCE_MAILBOX_HOST##';
$bounce_mailbox_user = $phpmailer_smtpuser;
$bounce_mailbox_password = $phpmailer_smtppassword;
// the "port" is the remote port of the connection to retrieve the emails
// the default should be fine but if it doesn't work, you can try the second
// one. To do that, add a # before the first line and take off the one before the
// second line
$bounce_mailbox_port = '##PHPLIST_BOUNCE_MAILBOX_PORT##';
//$bounce_mailbox_port = "110/pop3";
// it's getting more common to have secure connections, in which case you probably want to use
//$bounce_mailbox_port = "995/pop3/ssl/novalidate-cert";
// when the protocol is mbox specify this one
// it needs to be a local file in mbox format, accessible to your webserver user
$bounce_mailbox = '/var/mail/listbounces';
// set this to 0 if you want to keep your messages in the mailbox. this is potentially
// a problem, because bounces will be counted multiple times, so only do this if you are
// testing things.
$bounce_mailbox_purge = 1;
// set this to 0 if you want to keep unprocessed messages in the mailbox. Unprocessed
// messages are messages that could not be matched with a user in the system
// messages are still downloaded into phpList, so it is safe to delete them from
// the mailbox and view them in phpList
$bounce_mailbox_purge_unprocessed = 1;
// how many bounces in a row need to have occurred for a user to be marked unconfirmed
$bounce_unsubscribe_threshold = 5;
// choose the hash method for password
// check the extended config for more info
// in most cases, it is fine to leave this as it is
define('HASH_ALGO', 'sha256');

// added follwing the installer suggestion
$default_system_language = "fr";

// if you change the path to the phpList system, make the change here as well
// path should be relative to the root directory of your webserver (document root)
$pageroot = '';

// select the language module to use
// Look for <country>.inc files in the texts directory
// to find your language
// this is the language for the frontend pages. In the admin pages you can
// choose your language by using the dropdown in the pages.
$language_module = "french.inc";

// ensure admin part requires a login
$require_login = 1;

// if a user should immediately be unsubscribed, when using their personal URL, instead of
// the default way, which will ask them for a reason, set this to 1
define("UNSUBSCRIBE_JUMPOFF",0);

// define the amount of emails you want to send per period. If 0, batch processing
// is disabled and messages are sent out as fast as possible
define("MAILQUEUE_BATCH_SIZE",0);

// define the length of one batch processing period, in seconds (3600 is an hour)
define("MAILQUEUE_BATCH_PERIOD",60);

// to avoid overloading the server that sends your email, you can add a little delay
// between messages that will spread the load of sending
// you will need to find a good value for your own server
// value is in seconds (or you can play with the autothrottle below)
define('MAILQUEUE_THROTTLE',1);

// Domain Throttling
// You can activate domain throttling, by setting USE_DOMAIN_THROTTLE to 1
// define the maximum amount of emails you want to allow sending to any domain and the number
// of seconds for that amount. This will make sure you don't send too many emails to one domain
// which may cause blacklisting. Particularly the big ones are tricky about this.
// it may cause a dramatic increase in the amount of time to send a message, depending on how
// many users you have that have the same domain (eg hotmail.com)
// if too many failures for throttling occur, the send process will automatically add an extra
// delay to try to improve that. The example sends 1 message every 2 minutes.
define('USE_DOMAIN_THROTTLE',0);
define('DOMAIN_BATCH_SIZE',1);
define('DOMAIN_BATCH_PERIOD',10);

define("PLUGIN_ROOTDIR","plugins");

// attachments is a new feature and is currently still experimental
// set this to 1 if you want to try it
// caution, message may become very large. it is generally more
// acceptable to send a URL for download to users
// if you try it, it will be appreciated to give feedback to the
// users mailinglist, so we can learn whether it is working ok
// using attachments requires PHP 4.1.0 and up
define("ALLOW_ATTACHMENTS",1);

// if you use the above, how many would you want to add per message (max)
// You can leave this 1, even if you want to attach more files, because
// you will be able to add them sequentially
define("NUMATTACHMENTS",1);

// when using attachments you can upload them to the server
// if you want to use attachments from the local filesystem (server) set this to 1
// filesystem attachments are attached at real send time of the message, not at
// the time of creating the message
define("FILESYSTEM_ATTACHMENTS",0);

// if you add filesystem attachments, you will need to tell PHPlist where your
// mime.types file is.
define("MIMETYPES_FILE","/etc/mime.types");

// if a mimetype cannot be determined for a file, specify the default mimetype here:
define("DEFAULT_MIMETYPE","application/octet-stream");

$attachment_repository = '/tmp';

// forward to friend, multiple emails
// This setting defines howmany email addresses you can enter in the forward page.
// Default is 1 to not change behaviour from previous version.
define('FORWARD_EMAIL_COUNT', 5);

// ensure that icons stored on the server are embedded in the mail
define('EMBEDUPLOADIMAGES', 1);

// To disable the automatic updater change the value to false. By default the value is true.
define('ALLOW_UPDATER', false);


// EMBEDEXTERNALIMAGES
// this flag will fetch images in your content that are remotely hosted and put them
// inside the message that is sent.
// remark: allow to embed smileys in mail
define('EMBEDEXTERNALIMAGES',true);

