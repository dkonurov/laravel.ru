<?php namespace LaravelRU\Github;

class GithubRepo {

	/**
	 * @var \Github\Client
	 */
	private $githubClient;
	/**
	 * @var \Guzzle\Http\Client
	 */
	private $http;
	private $github_user;
	private $github_repository;

	public function __construct($github_user, $github_repository)
	{
		$this->githubClient = new \Github\Client;
		$this->githubClient->authenticate(\Config::get("laravel.github_authenticate_token"), null, \Github\Client::AUTH_URL_TOKEN );

		$this->guzzle = new \Guzzle\Http\Client;
		$this->github_user = $github_user;
		$this->github_repository = $github_repository;
	}

	public function getLastCommitId($branch, $filename)
	{
		$response = $this->githubClient->api('repo')->commits()->all($this->github_user, $this->github_repository, array('sha' => $branch, 'path' => $filename));
		if(count($response)!=0){
			return $response[0]['sha'];
		}else{
			return null;
		}
	}

	public function getLastCommit($branch, $filename)
	{
		$response = $this->githubClient->api('repo')->commits()->all($this->github_user, $this->github_repository, array('sha' => $branch, 'path' => $filename));
		if(count($response)!=0){
			return $response[0];
		}else{
			return null;
		}
	}

	public function getCommit($commit_id)
	{
		$response = $this->githubClient->api('repo')->commits()->show($this->github_user, $this->github_repository, $commit_id);
		if(count($response)!=0){
			return $response;
		}else{
			return null;
		}
	}

	public function getCommits($branch, $filename, $since)
	{
		$since = date("c", strtotime($since));
		$response = $this->githubClient->api('repo')->commits()->all($this->github_user, $this->github_repository, array('sha' => $branch, 'path' => $filename, 'since'=>$since));
		return $response;
	}

	public function getFile($branch, $filename, $commit_id="")
	{
		if( ! $commit_id){
			$commit_id = $this->getLastCommitId($branch, $filename);
			if( ! $commit_id) return null;
		}
		$request = $this->guzzle->get("https://raw.githubusercontent.com/".
				$this->github_user."/".
				$this->github_repository."/$commit_id/$filename");
		$response = $request->send();
		return $response->getBody(true);
	}

} 