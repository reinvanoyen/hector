<?php

namespace Hector\Migration;

interface VersionStoreInterface
{
	public function retreive() : int;
	public function store( int $version );
}