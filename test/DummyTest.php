<?php

require_once 'PHPUnit/Framework.php';
//require_once '../../htdocs/simlandia/core/system/session/Session.class.php';

class DummyTest extends PHPUnit_Framework_TestCase
{
	public function testFail()
	{
		$this->fail('Your test successfully failed!');
	}
	
	public function testSessionIsCreatedWithSuccess()
	{
		Session::initialize();
		$session = Session::getInstance();
		$this->assertNotNull($session);
	}
}

?>