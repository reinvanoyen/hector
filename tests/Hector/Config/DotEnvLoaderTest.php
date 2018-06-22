<?php

class DotEnvLoaderTest extends PHPUnit_Framework_TestCase
{
    public function testParsing()
    {
        $testEnv = '
			TST_VAR = whatever
			TST_NUMBER=4
			TST_STRING =inconsistent as f**
		';
    }
}
