@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Home</div>
		<div class="panel-body">
			<h3>Welcome</h3>
			<p>Encrypted Api demo showcases various features of Encrypted Api packages.</p>
			<p>Demonstrated packages:</p>
			<ul>
				<li><a href="https://github.com/kbs1/encrypted-api-server-laravel" target="_blank">Laravel server</a></li>
				<li><a href="https://github.com/kbs1/encrypted-api-client-php" target="_blank">PHP client</a></li>
				<li><a href="https://github.com/kbs1/encrypted-api-client-nodejs" target="_blank">NodeJS client</a></li>
			</ul>
			<p>Proceed to the demos section on the left to see encrypted api features in action.</p>
			<h3>Encrypted Api takeaway</h3>
			<blockquote class="blockquote">
				<p>I don't have to modify my server code, Encrypted Api is fully transparent.</p>
				<footer class="blockquote-footer">Laravel API endpoint programmer</footer>
			</blockquote>
			<blockquote class="blockquote">
				<p>I call Encrypted Api endpoints as I normally would using a Guzzle client.</p>
				<footer class="blockquote-footer">API consumer</footer>
			</blockquote>
		</div>
	</div>
@endsection
