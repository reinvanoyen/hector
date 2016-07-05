<?php $this->renderHead( 'header'); ?><?php $this->setBlock( 'title', function() { ?><?php echo htmlspecialchars( $this->title ); ?><?php } ); ?><?php $this->setBlock( 'content', function() { ?><?php } ); ?><?php $this->renderHead( 'footer'); ?><?php $this->setBlock( 'body', function() { ?>

			<div id="wrapper">

				<?php $this->renderBody( 'header'); ?>

				<?php $this->getBlock( 'content'); ?>

				<?php $this->renderBody( 'footer'); ?>

			</div>

		<?php } ); ?>