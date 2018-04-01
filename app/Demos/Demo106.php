<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo106 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST files exercising PHP\'s name mangling';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files. File form names exercise PHP\'s name mangling.
		</p><p>There are differences from standard GET / POST parameter name mangling, such that form entries with invalid array syntax
		(like <code>fi.le[</code>, <code>fi.le[]extra[]</code> <code>array [[][]</code> or <code>array]</code>) are completely ignored by PHP.</p><p>
		Encrypted Api always checks that each uploaded file was not changed or swapped with other files from the request or completely
		new file during transmit, also that file data was not passed as main request, and also that no new valid files were uploaded, or re-uploaded
		later (replay attacks protection is also supported for file uploads).
		Attacker can not delete any files from the request, as Encrypted Api checks each file upload and if one is missing, request validation
		will fail.</p><p>
		Encrypted Api client currently requires that each sent file can fit into calling application\'s memory at a time.</p><p>
		File names and form field names for files are not passed encrypted. Attacker can not modify passed file names, as those are checked by the server.
		Attacker also can not fully modify form field names for files,
		only to an extent that causes PHP to parse the file form field name exactly the same as original, for example form field name
		<code>fi_les[]</code> can be replaced to <code>   fi les[0]</code> by the attacker, but this does not cause any harm to the application.';
	}

	public function getResponseDescription()
	{
		return parent::getResponseDescription() . '<br><br>Notice that the "main" request is sent differently as PHP would natively process it
		and is seen by the server as a standard <code>application/x-www-form-urlencoded</code> request.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'multipart' => [
				[
					'name' => 'parameter1',
					'contents' => 'value1',
				],
				[
					'name' => 'parameter2[]ignored[3]',
					'contents' => 'value2',
				],
				[
					'name' => 'parameter3  & & //,',
					'contents' => 'value3',
				],
				[
					'name' => 'file1',
					'contents' => 'file 1 contents',
					'filename' => 'file1.txt',
				],
				[
					'name' => '  fi.les  [a_b.c d]',
					'contents' => 'file array 1 contents',
					'filename' => 'filearr1.txt',
				],
				[
					'name' => '  fi_les__[]',
					'contents' => 'file array 2 contents',
					'filename' => 'filearr2.txt',
				],
				[
					'name' => ' fi les_ [][a b c]',
					'contents' => 'file array 3 contents',
					'filename' => 'filearr3.txt',
				],
				[
					'name' => 'file2',
					'contents' => 'file 2 contents',
					'filename' => 'file2.txt',
				],
				[
					'name' => 'file3+/&/',
					'contents' => 'file 3 contents',
					'filename' => 'file3.txt',
				],
				[
					'name' => '        fi les_ [7][6][][e]',
					'contents' => 'file array 4 contents',
					'filename' => 'filearr4.txt',
				],
				[
					'name' => '        fi les_ [7][6][][f]',
					'contents' => 'bug in guzzlehttp doesn\'t allow sending filename as "0" with PHP in-memory temp streams',
					'filename' => '0',
				],
				[
					'name' => 'arraytest1[6]',
					'contents' => 'file arraytest1-1 contents',
					'filename' => 'filearraytest1-1.txt',
				],
				[
					'name' => 'arraytest1[]',
					'contents' => 'file arraytest1-2 contents',
					'filename' => 'filearraytest1-2.txt',
				],
				[
					'name' => 'arraytest1[8]',
					'contents' => 'file arraytest1-3 contents',
					'filename' => 'filearraytest1-3.txt',
				],
				[
					'name' => 'arraytest2[7]',
					'contents' => 'file arraytest2-1 contents',
					'filename' => 'filearraytest2-1.txt',
				],
				[
					'name' => 'arraytest2[]',
					'contents' => 'file arraytest2-2 contents (will be replaced by 2-4)',
					'filename' => 'filearraytest2-2.txt',
				],
				[
					'name' => 'arraytest2[]',
					'contents' => 'file arraytest2-3 contents (array key will be 9)',
					'filename' => 'filearraytest2-3.txt',
				],
				[
					'name' => 'arraytest2[8]',
					'contents' => 'file arraytest2-4 contents',
					'filename' => 'filearraytest2-4.txt',
				],
				[
					'name' => 'arraytest3[]',
					'contents' => 'file arraytest3-1 contents (will be replaced by non-array file 3-3)',
					'filename' => 'filearraytest3-1.txt',
				],
				[
					'name' => 'arraytest3[]',
					'contents' => 'file arraytest3-2 contents (will be replaced by non-array file 3-3)',
					'filename' => 'filearraytest3-2.txt',
				],
				[
					'name' => 'arraytest3',
					'contents' => 'file arraytest3-3 contents)',
					'filename' => 'filearraytest3-3.txt',
				],
				[
					'name' => 'files[7][6][]ignored[e]',
					'contents' => 'file 1 that won\'t be received by PHP because of invalid form key name',
					'filename' => 'invalidformkey1.txt',
				],
				[
					'name' => 'files[',
					'contents' => 'file 2 that won\'t be received by PHP because of invalid form key name',
					'filename' => 'invalidformkey2.txt',
				],
			],
		];
	}
}
