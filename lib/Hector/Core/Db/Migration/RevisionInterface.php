<?php

namespace Hector\Core\Db\Migration;

interface RevisionInterface
{
	public function up();
	public function down();
	public function getDescription() : String;
}