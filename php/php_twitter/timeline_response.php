<?php

// You MUST modify app_tokens.php to use your own Oauth tokens
require 'app_tokens.php';

header('Access-Control-Allow-Origin: http://localhost:8383');

// Create an OAuth connection
require 'tmhOAuth.php';
$connection = new tmhOAuth(array(
  'consumer_key'    => $consumer_key,
  'consumer_secret' => $consumer_secret,
  'user_token'      => $user_token,
  'user_secret'     => $user_secret
));

// Get the timeline with the Twitter API
// This can easily be changed to get home_timeline for example, see https://dev.twitter.com/rest/public
$http_code = $connection->request('GET',$connection->url('1.1/statuses/user_timeline'), array('screen_name' => 'WeAreTUDublin','count' => 10));

// Request was successful
if ($http_code == 200) {

	// Extract the tweets from the API response
	$tweet_data = json_decode($connection->response['response'],true);

	// Add tweet data to php object called tweets
	$tweetObject["tweets"] = $tweet_data;

	// Send the tweets back to the Ajax request
	print json_encode($tweetObject);

// Handle errors from API request
} else {
	if ($http_code == 429) {
		print 'Error: Twitter API rate limit reached';
	} else {
		print 'Error: Twitter was not able to process that request';
	}
}
?>