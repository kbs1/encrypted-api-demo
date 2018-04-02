<?php

namespace App\Demos;

use Kbs1\EncryptedApiClientPhp\Client as EncryptedApiClient;

class Demo017 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'different calling client';
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
		argument to modify the config file in-place with generated secrets.';
	}

	public function getRequestQueryString()
	{
		return 'client_uuid=549096e6-cfb6-434f-afb2-b92c5de990ff';
	}

	public function createClient()
	{
		$this->client = EncryptedApiClient::create(
			[65, 92, 29, 159, 90, 137, 76, 94, 22, 13, 177, 145, 71, 200, 129, 232, 230, 67, 32, 9, 74, 81, 26, 8, 229, 66, 7, 51, 2, 223, 46, 236, 109, 37],
			[64, 145, 211, 199, 66, 130, 62, 87, 139, 40, 235, 93, 60, 25, 76, 73, 53, 211, 229, 14, 152, 169, 65, 121, 46, 223, 72, 69, 91, 149, 128, 134, 26, 137, 81, 64, 184, 18, 248, 192, 80, 255, 46, 69, 71, 75, 123, 31]
		);
	}
}
