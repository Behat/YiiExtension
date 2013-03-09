<?php
/**
 * @author Weavora Team <hello@weavora.com>
 * @link http://weavora.com
 * @copyright Copyright (c) 2011 Weavora LLC
 */

namespace WUnit\Http;

class YiiApplication extends \CWebApplication {


	public function end($status=0, $exit=true) {
		parent::end(0, false);
		throw new YiiExitException();
	}
}