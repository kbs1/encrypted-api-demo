<h3>Real method => method and fullUrl()</h3>
@php(dump($method_and_fullurl))

<h3>Headers bag</h3>
@php(dump($headers_bag))

<h3>Query bag</h3>
@php(dump($query_bag))

<h3>Request bag</h3>
@php(dump($request_bag))

<h3>Input bag</h3>
@php(dump($input_bag))

<h3>Cookies bag</h3>
@php(dump($cookies_bag))

<h3>Files bag</h3>
@php(dump($files_bag))

<hr>

<h3>Request as json</h3>
@php(dump($json))

<h3>Request content</h3>
@php(dump($content))

<hr>

<h3>PHP $_SERVER</h3>
@php(dump($php_server))

<h3>PHP $_GET</h3>
@php(dump($php_get))

<h3>PHP $_POST</h3>
@php(dump($php_post))

<h3>PHP $_REQUEST</h3>
@php(dump($php_request))

<h3>PHP $_COOKIE</h3>
@php(dump($php_cookie))

<h3>PHP $_FILES</h3>
@php(dump($php_files))

<h3>php://input <small>(can not be replaced - always contains original request body, except for multipart requests)</small></h3>
@php(dump($php_input))
