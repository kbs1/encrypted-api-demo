<?php

namespace App\Client;

use Illuminate\Http\Request;
use Kbs1\EncryptedApiServerLaravel\Client\ClientConfigurationProviderInterface;

class ClientConfigurationProvider implements ClientConfigurationProviderInterface
{
	protected $request;

	// calling clients. This can be for example read from a database.
	protected $clients = [
		'549096e6-cfb6-434f-afb2-b92c5de990ff' => [
			'secret1' => [65, 92, 29, 159, 90, 137, 76, 94, 22, 13, 177, 145, 71, 200, 129, 232, 230, 67, 32, 9, 74, 81, 26, 8, 229, 66, 7, 51, 2, 223, 46, 236, 109, 37],
			'secret2' => [64, 145, 211, 199, 66, 130, 62, 87, 139, 40, 235, 93, 60, 25, 76, 73, 53, 211, 229, 14, 152, 169, 65, 121, 46, 223, 72, 69, 91, 149, 128, 134, 26, 137, 81, 64, 184, 18, 248, 192, 80, 255, 46, 69, 71, 75, 123, 31],
			'ipv4_whitelist' => null,
		],
		'6e59d2f9-3bab-4577-a90b-629755e9cf05' => [
			'secret1' => [144, 225, 200, 168, 0, 142, 178, 183, 138, 12, 149, 219, 11, 124, 200, 227, 127, 211, 4, 153, 245, 179, 211, 69, 253, 71, 178, 65, 129, 236, 216, 104, 218, 225, 175, 181, 177, 136, 118],
			'secret2' => [12, 81, 144, 250, 38, 104, 61, 78, 51, 156, 168, 237, 13, 155, 251, 82, 47, 245, 102, 246, 216, 204, 43, 235, 167, 48, 9, 182, 21, 248, 101, 173, 182, 66, 141, 228, 60, 232, 156, 40, 33, 65, 248, 175, 153, 137, 58, 13, 44, 9, 67, 217, 149, 19, 59, 237, 32, 219, 61, 115],
			'ipv4_whitelist' => ['12.34.56.78'],
		]
	];

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function getSharedSecrets()
	{
		// load calling client's shared secrets
		if ($client = $this->loadClient())
			return ['secret1' => $client['secret1'], 'secret2' => $client['secret2']];

		// if we don't recognise this calling client, use our default shared secrets. Real world implementations would
		// throw an exception in this case.
		return ['secret1' => config('encrypted_api.secret1'), 'secret2' => config('encrypted_api.secret2')];
	}

	public function getIpv4Whitelist()
	{
		// load calling client's ipv4 whitelist
		if ($client = $this->loadClient())
			return $client['ipv4_whitelist'];

		// if we don't recognise this calling client, use our default ipv4 whitelist. Real world implementations would
		// throw an exception in this case.
		return config('encrypted_api.ipv4_whitelist');
	}

	protected function loadClient()
	{
		return $this->clients[$this->request->query('client_uuid')] ?? null;
	}
}
