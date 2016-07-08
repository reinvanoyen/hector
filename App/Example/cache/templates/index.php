<?=$this->renderHead( 'base')?><?php $this->setBlock( 'title', function() { ?>Example<?php } ); ?><?php $this->setBlock( 'main', function() { ?>

		<a href="users/login/">Login</a>

	<?php } ); ?><?=$this->renderBody( 'base')?>