@extends('layouts.app')

@section('content')
	<div class="panel panel-default demo-view">
		<div class="panel-heading">{{ $demo->getType() }} {{ $demo->getNumber() }} - {{ $demo->getTitle() }}</div>
		<div class="panel-body">
			 <ul class="nav nav-tabs demo-tabs" role="tablist">
				<li role="presentation"{!! (!$demo->isExecuted() && !isset($exception)) ? ' class="active"' : '' !!}><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
				@if (isset($exception))
					<li role="presentation" class="active"><a href="#exception" aria-controls="exception" role="tab" data-toggle="tab">Exception</a></li>
				@endif
				@if ($demo->isExecuted())
					<li role="presentation"><a href="#request" aria-controls="request" role="tab" data-toggle="tab">Request</a></li>
					<li role="presentation"><a href="#raw-response" aria-controls="raw-response" role="tab" data-toggle="tab">Raw response</a></li>
					<li role="presentation"{!! $demo->isExecuted() ? ' class="active"' : '' !!}><a href="#response" aria-controls="response" role="tab" data-toggle="tab">Response</a></li>
				@endif
			</ul>

			<div class="tab-content demo-tabs-content">
				<div role="tabpanel" class="tab-pane{{ (!$demo->isExecuted() && !isset($exception)) ? ' active' : '' }}" id="details">
					<h3>Description</h3>
					<p>{!! $demo->getDescription() !!}</p>

					<h3>Endpoint</h3>
					<code>{{ strtoupper($demo->getRequestMethod()) }} {{ $demo->getRequestUrl() }}</code>

					<h3>Guzzle request options</h3>
					@php(dump($demo->getRequestOptions()))

					<a href="{{ route('demo', [$demo->getNumber(), 'execute']) }}" class="btn btn-primary btn-lg">Execute</a>
				</div>

				@if (isset($exception))
					<div role="tabpanel" class="tab-pane active" id="exception">
						@if ($demo->getExceptionDescription() !== null)
							<p class="offset-lg">{!! $demo->getExceptionDescription() !!}</p>
						@endif
						<hr>
						<h3>{{ get_class($exception) }}</h3>
						<p>{{ ($exception->getMessage() && $exception->getMessage() !== '0') ? $exception->getMessage() : '(no message)' }}</p>

						<a href="{{ route('demo', [$demo->getNumber(), 'execute']) }}?disable_exception_handling=1" class="btn btn-primary">Re-execute without exception handling</a>
					</div>
				@endif

				@if ($demo->isExecuted())
					<div role="tabpanel" class="tab-pane" id="request">
						@if ($demo->getrequestDescription() !== null)
							<p class="offset-sm">{!! $demo->getRequestDescription() !!}</p>
						@endif
<pre class="wrap">{{ $request->getMethod() }} {{ $request->getRequestTarget() }} HTTP/{{ $request->getProtocolVersion() }}
{{ $demo->headersToString($request->getHeaders()) }}

{{ (string) $request->getBody() }}
</pre>
					</div>
					<div role="tabpanel" class="tab-pane" id="raw-response">
						@if ($demo->getRawResponseDescription() !== null)
							<p class="offset-sm">{!! $demo->getRawResponseDescription() !!}</p>
						@endif
<pre class="wrap">{{ $demo->headersToString($raw_response->getHeaders()) }}

{{ (string) $raw_response->getBody() }}
</pre>
					</div>
					<div role="tabpanel" class="tab-pane active" id="response">
						@if ($demo->getResponseDescription() !== null)
							<p class="offset-lg">{!! $demo->getResponseDescription() !!}</p>
						@endif
						<hr>
						<h3>Response headers</h3>
						@php(dump($response->getHeaders()))
						@if ($cookies)
							<h3>CookieJar contents</h3>
							@php(dump($cookies->toArray()))
						@endif
						<hr>
						<p>Below is a response generated by the server endpoint. It represents the request from the server's point of view.</p>
						<hr>
						@if ($demo->viewResponseEscaped())
							{{ $response->getBody() }}
						@else
							{!! (string) $response->getBody() !!}
						@endif
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		new demoView();
	</script>
@endsection
