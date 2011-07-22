<?php defined('SYSPATH') or die('No direct script access.');

abstract class Tumblr extends OAuth_Provider_Tumblr {

	/**
	 * @var  string  the base URL for the Tumblr OAuth API
	 */
	protected $base_url = 'api.tumblr.com/v2';

	/**
	 * @var  string  format of returned response
	 */
	protected $format = 'json';

	/**
	 * @var  array  parsers for different formats
	 */
	protected $parser = array(
		'json' => 'json_decode',
	);

	/**
	 * Returns a new Tumblr object.
	 *
	 * @param   string  $name
	 * @param   array   $options
	 * @return  Tumblr
	 */
	public static function factory($name, array $options = NULL)
	{
		$class = 'Tumblr_'.$name;

		return new $class($options);
	}

	/**
	 * Sets the format.
	 *
	 * @param   array  $options
	 * @return  void
	 */
	public function __construct(array $options = NULL)
	{
		parent::__construct($options);

		if (isset($options['format']))
		{
			// Set the response format
			$this->format = trim($options['format']);
		}
	}

	/**
	 * Sets a parser for a specific format.
	 *
	 * @param   string  $format
	 * @param   string  $value
	 * @return  Tumblr
	 */
	public function parser($format, $value)
	{
		$this->parser[$format] = $value;

		return $this;
	}

	/**
	 * Creates the URL for executing actions.
	 *
	 * @param   string  $action
	 * @param   string  $modifier
	 * @return  string
	 */
	public function url($action, $modifier = NULL)
	{
		// Set URL
		$url = "http://{$this->base_url}/{$action}";

		if ($modifier !== NULL)
		{
			// Add modifier to URL
			$url .= '/'.$modifier;
		}

		return $url;
	}

	/**
	 * Parses the response based on set format.
	 *
	 * @param   mixed  $response
	 * @return  mixed
	 */
	public function parse($response)
	{
		if ( ! isset($this->parser[$this->format]))
		{
			// No parser for the requested format
			return $response;
		}

		// Get the parser for this format
		$parser = $this->parser[$this->format];

		// Parse the response
		return $parser($response);
	}

} // End Tumblr