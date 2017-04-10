<?php
/* *************************
 * Post Slack WebHock Tool
 * Ver 1.1
 ************************* */

try{
	// Custom Settings
	$url      = 'https://hooks.slack.com/services/AAAA/BBBB'; // Set Your WebHock URL
	$emoji    = ':space_invader:'; // set display icon
	$username = 'PHP SlackBot'; // set display name
	// $color    = "#36a64f";  // if you want to set color on message. Set this parameter

	if ($argc !== 3) {
		echo PHP_EOL;
		echo '##### Illegal Command #####'.PHP_EOL;
		echo '<<Usage>>'.PHP_EOL;
		echo '    php SlackWebHock.php {target channnel or user} {message text}'.PHP_EOL;
		echo '<<Example>>'.PHP_EOL;
		echo '    php SlackWebHock.php #general TestMessage'.PHP_EOL;
		echo '    php SlackWebHock.php @david "you are fired"'.PHP_EOL;
		echo PHP_EOL;
		exit;
	}

	$to      = $argv[1];
	$subject = $argv[2];
	$ua      = 'php slack bot';

	$postData = new stdClass();
	$postData->channel = $to;
	$postData->username = $username;
	$postData->icon_emoji = $emoji;
	if (isset($color)) {
		$attachment = new stdClass();
		$attachment->color = $color;
		$attachment->text = $subject;
		$postData->attachments = [$attachment];
	} else {
		$postData->text = $subject;
	}

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'payload='.json_encode($postData));

	curl_exec($ch);
	curl_close($ch);
} catch (Exception $e) {
	echo $e->getMessage();
}