<?php defined('SYSPATH') or die('No direct script access.');

class Tumblr_User extends Tumblr {

	/**
	 * Sets the base base URL.
	 *
	 * @param   array  $options
	 * @return  void
	 */
	public function __construct(array $options = NULL)
	{
		// Set base URL
		$this->base_url .= '/user';

		parent::__construct($options);
	}

	/**
	 * Retrieve a user's dashboard.
	 *
	 *		Tumblr::factory('blog')->dashboard($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param	array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#user-methods
	 */
	public function dashboard(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('/user/dashboard'), array(
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
	 * Retrieve a user's likes.
	 *
	 *		Tumblr::factory('blog')->likes($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param	array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#user-methods
	 */
	public function likes(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('/user/likes'), array(
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
	 * Retrieve the blogs a user is following.
	 *
	 *		Tumblr::factory('blog')->following($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param	array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#user-methods
	 */
	public function following(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('/user/following'), array(
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
	 * Follow a blog.
	 *
	 *		Tumblr::factory('blog')->follow($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param	array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#user-methods
	 */
	public function follow(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['url']))
		{
			// Throw exception
			throw new Kohana_OAuth_Exception('Required parameter not passed: url must be provided');
		}

		// Create a new POST request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('/user/follow'), array(
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
	 * Unfollow a blog.
	 *
	 *		Tumblr::factory('blog')->unfollow($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param	array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#user-methods
	 */
	public function unfollow(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['url']))
		{
			// Throw exception
			throw new Kohana_OAuth_Exception('Required parameter not passed: url must be provided');
		}

		// Create a new POST request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('/user/unfollow'), array(
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

} // End Tumblr_User