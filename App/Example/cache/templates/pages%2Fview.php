<?php $this->renderHead( 'base'); ?><?php $this->appendBlock( $this->slug, function() { ?>

		<div>

			<p>We are viewing a page with slug <?php echo htmlspecialchars( $this->slug ); ?> now</p>

		</div>

	<?php } ); ?><?php $this->renderBody( 'base'); ?>