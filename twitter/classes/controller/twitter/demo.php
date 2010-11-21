<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Twitter_Demo extends Controller_Demo {

	public function demo_account_verify_credentials()
	{
		$api = Twitter::factory('account');

		$response = $api->verify_credentials($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_account_rate_limit_status()
	{
		$api = Twitter::factory('account');

		$response = $api->rate_limit_status($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_account_end_session()
	{
		$api = Twitter::factory('account');

		$response = $api->end_session($this->consumer, $this->token);

		// The access token is not valid after ending the session
		$this->session->delete($this->key('access'));

		$this->content = Kohana::debug($response);
	}

	public function demo_status_friends_timeline()
	{
		$api = Twitter::factory('status');

		$response = $api->friends_timeline($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_home_timeline()
	{
		$api = Twitter::factory('status');

		$response = $api->home_timeline($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_mentions()
	{
		$api = Twitter::factory('status');

		$response = $api->mentions($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_retweeted_by_me()
	{
		$api = Twitter::factory('status');

		$response = $api->retweeted_by_me($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_retweeted_to_me()
	{
		$api = Twitter::factory('status');

		$response = $api->retweeted_to_me($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_retweets_of_me()
	{
		$api = Twitter::factory('status');

		$response = $api->retweets_of_me($this->consumer, $this->token);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_public_timeline()
	{
		$api = Twitter::factory('status');

		$response = $api->public_timeline($this->consumer);

		$this->content = Kohana::debug($response);
	}

	public function demo_status_user_timeline()
	{
		if (Request::$method === 'POST')
		{
			// Get the screen name and account id from POST
			$params = Arr::extract($_POST, array('screen_name', 'account_id'));

			if ( ! $params)
			{
				// No parameters included
				$this->request->redirect($this->request->uri);
			}

			$api = Twitter::factory('status');

			$response = $api->user_timeline($this->consumer, $this->token, $params);

			$this->content = Kohana::debug($response);
		}
		else
		{
			$this->content = View::factory('api/form')
				->set('message', 'Enter an account ID or screen name.')
				->set('inputs', array(
					'Screen Name' => Form::input('screen_name'),
					'Account ID'  => Form::input('acount_id'),
				))
				;
		}
	}

	public function demo_user_show()
	{
		if (Request::$method === 'POST')
		{
			// Get the screen name and account id from POST
			$params = Arr::extract($_POST, array('screen_name', 'account_id'));

			if ( ! $params)
			{
				// No parameters included
				$this->request->redirect($this->request->uri);
			}

			$api = Twitter::factory('user');

			$response = $api->show($this->consumer, $this->token, $params);

			$this->content = Kohana::debug($response);
		}
		else
		{
			$this->content = View::factory('api/form')
				->set('message', 'Enter an account ID or screen name.')
				->set('inputs', array(
					'Screen Name' => Form::input('screen_name'),
					'Account ID'  => Form::input('acount_id'),
				))
				;
		}
	}

} // End Twitter_Demo