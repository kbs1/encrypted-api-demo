<?php

namespace App\Demos;

use Kbs1\EncryptedApiClientPhp\Client as EncryptedApiClient;

class Demo018 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'different calling client with failed IPv4 validation';
	}

	public function getDescription()
	{
		return 'Sends basic GET request to a server endpoint, identifying the calling client. Encrypted Api supports many calling clients,
		each with it\'s own set of shared secrets and IPv4 whitelist. This means each calling client is authenticated, since no other
		client can perform requests on behalf of any other client, also no client can read server\'s response meant for other
		clients.
		</p><p>
		Calling client must be identified <i>before</i> request processing, in order to load it\'s shared secrets and IPv4 whitelist.
		Calling client identifier should be hard to guess (for example an UUID) and can be passed either as a query string,
		visible or unmanaged header or as a part of URL username / password so that the server can identify the client before attemping
		to process the request any further.
		</p><p>
		<code>ClientConfigurationProvider</code> is implemented in <code>App\Client\ClientConfigurationProvider</code>. If use case requires
		only one calling client, shared secrets and IPv4 whitelist can be specified in <code>config/encrypted_api.php</code> config file
		after publishing using <code>php artisan vendor:publish --tag=encrypted-api</code>.
		</p><p>
		Suitable shared secrets may be generated using <code>php artisan encrypted-api:secrets:generate</code>. Pass the <code>--save</code>
		argument to modify the config file in-place with generated secrets.
		</p><p>IPv4 validation fails for this client and all it\'s requests will be discarded.
		<a href="/api/demo/018?client_uuid=6e59d2f9-3bab-4577-a90b-629755e9cf05" target="_blank">Visit</a> the server endpoint
		to see raised server exception, any further request processing is dropped. The client recives invalid data from the server
		and fails to decrypt the response.';
	}

	public function getRequestQueryString()
	{
		return 'client_uuid=6e59d2f9-3bab-4577-a90b-629755e9cf05';
	}

	public function createClient()
	{
		$this->client = EncryptedApiClient::create(
			[144, 225, 200, 168, 0, 142, 178, 183, 138, 12, 149, 219, 11, 124, 200, 227, 127, 211, 4, 153, 245, 179, 211, 69, 253, 71, 178, 65, 129, 236, 216, 104, 218, 225, 175, 181, 177, 136, 118],
			[12, 81, 144, 250, 38, 104, 61, 78, 51, 156, 168, 237, 13, 155, 251, 82, 47, 245, 102, 246, 216, 204, 43, 235, 167, 48, 9, 182, 21, 248, 101, 173, 182, 66, 141, 228, 60, 232, 156, 40, 33, 65, 248, 175, 153, 137, 58, 13, 44, 9, 67, 217, 149, 19, 59, 237, 32, 219, 61, 115]
		);
	}
}
