<?php

namespace Hector\Migration;

interface RevisionInterface
{
	public function up();
	public function down();
	public function getDescription() : String;
}