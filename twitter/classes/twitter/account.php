<?php defined('SYSPATH') or die('No direct script access.');

class Twitter_Account extends Twitter {

	/**
	 * @link  http://dev.twitter.com/doc/get/account/verify_credentials
	 */
	public function verify_credentials(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('account/verify_credentials'), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		if ($params)
		{
			// Load user parameters
			$request->params($params);
		}

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * @link  http://dev.twitter.com/doc/get/account/rate_limit_status
	 */
	public function rate_limit_status(OAuth_Consumer $consumer, OAuth_Token $token = NULL, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('account/rate_limit_status'), array(
			'oauth_consumer_key' => $consumer->key,
		));

		// Authorization is not required
		$request->required('oauth_token', FALSE);

		if ($token)
		{
			// Include the token
			$params['oauth_token'] = $token->token;
		}

		if ($params)
		{
			// Load user parameters
			$request->params($params);
		}

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * @link  http://dev.twitter.com/doc/get/account/end_session
	 */
	public function end_session(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('account/end_session'), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		if ($params)
		{
			// Load user parameters
			$request->params($params);
		}

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

} // End Twitter_Account
