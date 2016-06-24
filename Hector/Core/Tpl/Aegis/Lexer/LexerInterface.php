<?php

namespace Hector\Core\Tpl\Aegis\Lexer;

interface LexerInterface
{
	public function tokenize( $string );
}