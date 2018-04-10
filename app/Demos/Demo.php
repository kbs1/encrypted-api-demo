<?php

namespace App\Demos;

use GuzzleHttp\Client as GuzzleClient;
use Kbs1\EncryptedApiClientPhp\Client as EncryptedApiClient;

use Illuminate\Http\Request;

abstract class Demo
{
	protected $client, $middleware, $options, $executed = false;

	public function getNumber()
	{
		return substr(get_class($this), -3);
	}

	public function isExecuted()
	{
		return $this->executed;
	}

	public function executeServer(Request $request)
	{
		return view('demo.response.dump-server', [
			'method_and_fullurl' => $request->getRealMethod() . ' => ' . $request->getMethod() . ' ' . $request->fullUrl(),
			'headers_bag' => $request->headers->all(),
			'query_bag' => $request->query->all(),
			'request_bag' => $request->request->all(),
			'input_bag' => $request->all(),
			'cookies_bag' => $request->cookies->all(),
			'files_bag' => $request->files->all(),
			'json' => $request->json()->all(),
			'content' => $request->getContent(),
			'php_server' => $_SERVER,
			'php_get' => $_GET,
			'php_post' => $_POST,
			'php_request' => $_REQUEST,
			'php_cookie' => $_COOKIE,
			'php_files' => $_FILES,
			'php_input' => file_get_contents('php://input'),
		]);
	}

	public function getRequestMethod()
	{
		return 'get';
	}

	public function getRequestUrl()
	{
		$query = $this->getRequestQueryString();
		return route('api.demo', $this->getNumber()) . ($query !== null ? '?' . $query : '');
	}

	public function getRequestQueryString()
	{
		return null;
	}

	public function getRequestOptions()
	{
		return null;
	}

	public function executeClient()
	{
		$this->createClient();

		$method = $this->getRequestMethod();
		$response = $this->client->$method($this->getRequestUrl(), EncryptedApiClient::prepareOptions($this->options = $this->getRequestOptions()));
		$this->executed = true;
		return $response;
	}

	public function getClient()
	{
		return $this->client;
	}

	public function getMiddleware()
	{
		return $this->middleware;
	}

	public function getLastRequestOption($name = null)
	{
		if ($name)
			return $this->options[$name] ?? null;

		return $this->options;
	}

	public function createClient()
	{
		$this->client = EncryptedApiClient::createDefaultGuzzleClient(config('encrypted_api.secret1'), config('encrypted_api.secret2'), $middleware);
		$this->middleware = $middleware;
	}

	public function viewResponseEscaped()
	{
		return false;
	}

	public function headersToString($headers)
	{
		$result = [];

		foreach ($headers as $header => $values)
			foreach ($values as $value)
				$result[] = "$header: $value";

		return implode("\n", $result);
	}

	public function getRequestDescription()
	{
		return "This tab shows encrypted request sent to the API endpoint. Notice that headers which weren't explicitly marked as transmitted unencrypted (except <code>User-Agent</code>, <code>Host</code>, <code>Content-Type</code>, <code>Content-Length</code>, <code>Transfer-Encoding</code>, <code>Expect</code>, which are transmitted unencrypted by default) are not present as standard request headers. The server still sees them after the encrypted api middleware executes. This includes cookies, which are always transmitted encrypted by default.";
	}

	public function getExceptionDescription()
	{
		return "A client exception occured while processing this request. Exception details are provided below.";
	}

	public function getRawResponseDescription()
	{
		return "This tab shows raw response received from the server, witout any further processing. Notice that any other than default unencrypted response headers (<code>Server</code>, <code>Content-Type</code>, <code>Content-Length</code>, <code>Connection</code>, <code>Cache-Control</code> and <code>Date</code>) or explicitly forced plain response headers are transmitted encrypted in the response, and are not presnet as plain response headers. This includes cookies. <code>Content-Type</code> of raw response is always <code>application/json</code>.";
	}

	public function getResponseDescription()
	{
		return "This tab shows verified and decrypted response from the server. Full response headers after the guzzle middleware finishes execution are shown. Response content contains request data from server's point of view, after the encrypted api middleware executed.";
	}

	abstract public function getType();
	abstract public function getTitle();
	abstract public function getDescription();
}
