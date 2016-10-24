<?php $this->setBlock( 'title', function() { ?><?php } ); ?><?php $this->setBlock( 'title', function() { ?><?php } ); ?><?php $this->setBlock( 'main', function() { ?><?php } ); ?><?php $this->setBlock( 'body', function() { ?>

			<div id="wrapper">

				<header>
					<h1><?php $this->getBlock( 'title'); ?></h1>
				</header>

				<div id="main">
					<?php $this->getBlock( 'main'); ?>
				</div>

				<footer>
					&copy; Copyright
				</footer>

			</div>

		<?php } ); ?>