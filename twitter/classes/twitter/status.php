<?php defined('SYSPATH') or die('No direct script access.');

class Twitter_Status extends Twitter {

	public function update(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['status']))
		{
			throw new Kohana_OAuth_Exception('Required parameter not passed: :param', array(
				':param' => 'status',
			));
		}

		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('statuses/update'), array(
				'oauth_consumer_key' => $consumer->key,
				'oauth_token'        => $token->token,
			));

		if ($params)
		{
			// Load user parameters
			$request->params($params);
		}

		$request->send_header = FALSE;

		// Sign the request using only the consumer, no token is available yet
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

} // End Twitter_Status