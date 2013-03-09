<?php
/**
 * @author Weavora Team <hello@weavora.com>
 * @link http://weavora.com
 * @copyright Copyright (c) 2011 Weavora LLC
 */

namespace WUnit\Http;

use WUnit\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
 
class YiiKernel implements HttpKernelInterface
{
	
	public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
	{
		$request->overrideGlobals();
		$app = \Yii::app();
		$app->setComponent('request',new YiiRequest());
		$app->request->inject($request->files->all());

		$hasError = false;

		ob_start();
		try {
			$app->processRequest();
		} catch (YiiExitException $e) {

		} catch (Exception $e) {
			$hasError = true;
		}

		$content = ob_get_contents();
		ob_end_clean();

		$headers = $this->getHeaders();
		
		$sessionId = session_id();
		if(empty($sessionId)){
			session_regenerate_id();
			$app->session->open();
			
		}

		
		return new Response($content, $this->getStatusCode($headers, $hasError), $headers);
	}

	protected function getHeaders()
	{
		$rawHeaders = xdebug_get_headers();
		$headers = array();
		foreach($rawHeaders as $rawHeader) {
			list($name, $value) = explode(":", $rawHeader, 2);
			$name = strtolower(trim($name));
			$value = trim($value);
			if (!isset($headers[$name]))
				$headers[$name] = array();

			$headers[$name][] = $value;
		}
		return $headers;
	}

	protected function getStatusCode($headers, $error = false)
	{
		if ($error)
			return 503;

		if (array_key_exists('location', $headers))
			return 302;

		return 200;
	}
}
