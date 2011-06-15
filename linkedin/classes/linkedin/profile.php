<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Linkedin Profile Resource
 * http://developer.linkedin.com/docs/DOC-1002  Profile API
 * http://developer.linkedin.com/docs/DOC-1061  Profile fields
 *
 * @package    Kohana/OAuth
 * @category   Provider
 * @author     Kohana Team
 * @copyright  (c) 2010 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.0.7
 */
class Linkedin_Profile extends Linkedin {

	/**
	 * Return profile of current user
	 *
	 * @param  OAuth_Consumer  $consumer        Consumer object
	 * @param  OAuth_Token     $token           Token object
	 * @param  array|null      $params          Call parameters
	 * @param  bool            $public_profile  Set TRUE to request the public profile
	 * @return mixed
	 */
	public function current_user(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL, $public_profile = FALSE)
	{
		$fields = '';
		if (isset($params['fields']))
		{
			$fields = ':('.implode(',', $params['fields']).')';
		}
		// Fields must not be in query parameters
		unset($params['fields']);

		// Set key for public profile if requested
		$public = $public_profile ? ':public' : '';

		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url("people/~$public$fields"), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		// Set format, can be xml or json
		$params['format'] = $this->format;

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

} // End Linkedin_Profile