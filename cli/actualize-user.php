#!/usr/bin/php
<?php
require('_cli.php');

$options = getopt('', array(
		'user:',
	));

if (empty($options['user'])) {
	fail('Usage: ' . basename(__FILE__) . " --user username");
}

$username = cliInitUser($options['user']);

fwrite(STDERR, 'FreshRSS actualizing user “' . $username . "”…\n");

list($nbUpdatedFeeds, $feed) = FreshRSS_feed_Controller::actualizeFeed(0, '', true);

echo "FreshRSS actualized $nbUpdatedFeeds feeds for $username\n";

invalidateHttpCache($username);

done($nbUpdatedFeeds > 0);
