<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Google Contacts Resource
 * http://code.google.com/apis/contacts/
 *
 * @package    Kohana/OAuth
 * @category   Provider
 * @author     Kohana Team
 * @copyright  (c) 2010 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.0.7
 */
class Google_Contacts extends Google {

	/**
	 * Returns full contact list of authenticated user
	 *
	 * @param  OAuth_Consumer  $consumer       Consumer object
	 * @param  OAuth_Token     $token          Token object
	 * @param  array|null      $params         Call parameters
	 * @param  string          $contact_email  Leave as default for authenticated user, specify Email otherwise
	 * @return mixed
	 */
	public function full(OAuth_Consumer $consumer, OAuth_Token $token, array $params = NULL, $contact_email = 'default')
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::factory('resource', 'GET', $this->url("contacts/{$contact_email}/full"), array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token'        => $token->token,
		));

		// Set format, can be xml or json
		if ($this->format == 'json')
		{
			$params['alt'] = 'json';
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

} // End Google_Contacts