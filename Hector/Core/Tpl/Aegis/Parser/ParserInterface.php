<?php

namespace Hector\Core\Tpl\Aegis\Parser;

use Hector\Core\Tpl\Aegis\Lexer\TokenStream;

interface ParserInterface
{
	public function parse( TokenStream $tokens );
}