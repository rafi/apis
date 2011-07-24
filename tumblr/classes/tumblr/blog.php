<?php defined('SYSPATH') or die('No direct script access.');

class Tumblr_Blog extends Tumblr {

	/**
	 * Sets the base URL.
	 *
	 * Base hostname format is defined here: http://www.tumblr.com/docs/en/api/v2#overview
	 *
	 * @param   array  $options
	 * @return  mixed
	 */
	public function __construct(array $options = NULL)
	{
		if ( ! isset($options['base_hostname']))
		{
			throw new Kohana_OAuth_Exception('Required option not passed: base_hostname must be provided');
		}

		// Set base URL
		$this->base_url .= "/blog/{$options['base_hostname']}";

		parent::__construct($options);
	}

	/**
	 * Retrieve blog info.
	 *
	 *		Tumblr::factory('blog')->info($consumer);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-info
	 */
	public function info(OAuth_Consumer $consumer)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('info'), array(
			'api_key' => $consumer->key,
		));

		// Authorization is not required
		$request->required('oauth_consumer_key', FALSE);
		$request->required('oauth_token', FALSE);

		// Signature is not required
		$request->required('oauth_signature_method', FALSE);
		$request->required('oauth_signature', FALSE);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * Retrieve a blog avatar.
	 *
	 *		Tumblr::factory('blog')->avatar();
	 *
	 * @param	array  $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-avatar
	 */
	public function avatar(array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('avatar', Arr::get($params, 'size')));

		// Authorization is not required
		$request->required('oauth_consumer_key', FALSE);
		$request->required('oauth_token', FALSE);

		// Signature is not required
		$request->required('oauth_signature_method', FALSE);
		$request->required('oauth_signature', FALSE);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * Retrieve a blog's followers.
	 *
	 *		Tumblr::factory('blog')->followers($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param	array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-followers
	 */
	public function followers(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('followers'), array(
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
	 * Retrieve published posts.
	 *
	 *		Tumblr::factory('blog')->posts($consumer);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param   array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-followers
	 */
	public function posts(OAuth_Consumer $consumer, array $params = NULL)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('posts', Arr::get($params, 'type')), array(
			'api_key' => $consumer->key,
		));

		// Authorization is not required
		$request->required('oauth_consumer_key', FALSE);
		$request->required('oauth_token', FALSE);

		// Signature is not required
		$request->required('oauth_signature_method', FALSE);
		$request->required('oauth_signature', FALSE);

		if ($params)
		{
			// Remove type from params
			unset($params['type']);

			// Load user parameters
			$request->params($params);
		}

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * Retrieve queued posts.
	 *
	 *		Tumblr::factory('blog')->queued_posts($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-queue
	 */
	public function queued_posts(OAuth_Consumer $consumer, OAuth_Token $token)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('posts/queue'), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * Retrieve draft posts.
	 *
	 *		Tumblr::factory('blog')->draft_posts($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-drafts
	 */
	public function draft_posts(OAuth_Consumer $consumer, OAuth_Token $token)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('posts/draft'), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * Retrieve submission posts.
	 *
	 *		Tumblr::factory('blog')->submission_posts($consumer, $token);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#blog-submissions
	 */
	public function submission_posts(OAuth_Consumer $consumer, OAuth_Token $token)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url('posts/submission'), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		// Create a response from the request
		$response = $request->execute();

		return $this->parse($response);
	}

	/**
	 * Create a new blog post.
	 *
	 *		Tumblr::factory('blog')->post($consumer, $token, $params);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param   array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#posting
	 */
	public function post(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['type']))
		{
			// Throw exception
			throw new Kohana_OAuth_Exception('Required parameter not passed: type must be provided');
		}

		// Create a new POST request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('post'), array(
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
	 * Edit a blog post.
	 *
	 *		Tumblr::factory('blog')->edit_post($consumer, $token, $params);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param   array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#editing
	 */
	public function edit_post(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['id']))
		{
			// Throw exception
			throw new Kohana_OAuth_Exception('Required parameter not passed: id must be provided');
		}

		// Create a new POST request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('post/edit'), array(
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
	 * Reblog a blog post.
	 *
	 *		Tumblr::factory('blog')->reblog_post($consumer, $token, $params);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param   array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#reblogging
	 */
	public function reblog_post(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['reblog_key']))
		{
			// Throw exception
			throw new Kohana_OAuth_Exception('Required parameter not passed: reblog_key must be provided');
		}

		// Create a new POST request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('post/reblog'), array(
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
	 * Delete a blog post.
	 *
	 *		Tumblr::factory('blog')->delete_post($consumer, $token, $params);
	 *
	 * @param	OAuth_Consumer  $consumer
	 * @param	OAuth_Token     $token
	 * @param   array           $params
	 * @return	mixed
	 * @link    http://www.tumblr.com/docs/en/api/v2#deleting-posts
	 */
	public function delete_post(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL)
	{
		if ( ! isset($params['id']))
		{
			// Throw exception
			throw new Kohana_OAuth_Exception('Required parameter not passed: id must be provided');
		}

		// Create a new POST request with the required parameters
		$request = OAuth_Request::factory('resource', 'POST', $this->url('post/delete'), array(
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

} // End Tumblr_Blog