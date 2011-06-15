<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Linkedin OAuth Abstract Resource
 *
 * @package    Kohana/OAuth
 * @category   Provider
 * @author     Kohana Team
 * @copyright  (c) 2010 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.0.7
 */
abstract class Linkedin extends OAuth_Provider_Linkedin {

	/**
	 * @var int|string  API version
	 */
	protected $version = '1';

	/**
	 * @var string  API response format
	 */
	protected $format = 'json';

	/**
	 * @var ???
	 */
	protected $base_url;

	/**
	 * @var array  Parser for mime types
	 */
	protected $parser = array(
		'json' => 'json_decode',
		'xml'  => 'simplexml_load_string',
	);

	/**
	 * Linkedin Resource Factory
	 *
	 * @static
	 * @param  string      $name     Resource name
	 * @param  array|null  $options  Individual resource options
	 * @return mixed
	 */
	public static function factory($name, array $options = NULL)
	{
		$class = 'Linkedin_'.$name;

		return new $class($options);
	}

	/**
	 * Set defaults
	 *
	 * @param array|null $options
	 */
	public function __construct(array $options = NULL)
	{
		parent::__construct($options);

		if (isset($options['version']))
		{
			// Set the Linkedin API version
			$this->version = (int) $options['version'];
		}

		if (isset($options['format']))
		{
			$this->format = trim($options['format'], '.');
		}
	}

	/**
	 * Parser
	 *
	 * @param  $format
	 * @param  $value
	 * @return Linkedin
	 */
	public function parser($format, $value)
	{
		$this->parser[$format] = $value;

		return $this;
	}

	/**
	 * Format URL according to resource/action
	 *
	 * @param  string  $action       Action
	 * @return string
	 */
	public function url($action)
	{
		// Clean up the action
		$action = trim($action, '/');
		
		return "http://api.linkedin.com/v{$this->version}/{$action}";
	}

	/**
	 * Parse response with matching parser
	 *
	 * @param  mixed  $response  API response
	 * @return mixed
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

} // End Linkedin