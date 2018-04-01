<?php

return [
	// both secrets must be at least 32 bytes in length and must not be equal to each other
	// secrets are either a string or an array with byte values, for example [33, 216, 0, ...]
	'secret1' => base64_decode('D4iVtCARig8BMH9wTKRscfxqYL15Addya7WetCt/CkuL'),
	'secret2' => base64_decode('ATBLBlYonJBiVC1AHLGxOhUfQYrang4Stc8uQrKq2hJt'),

	// if you want to whitelist only certain IP addresses, provide an array here. Null or empty array turns off whitelisting.
	'ipv4_whitelist' => null,

	// specify included and excluded routes as patterns, encrypted api won't run on routes that don't match these rules
	'routes' => [
		'include' => [
			'/api/*',
			'/webapi/*',
		],
		'exclude' => [
		],
	],
];
