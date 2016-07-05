<?php $this->setBlock( 'body', function() { ?>

			<?php $this->setBlock( 'header', function() { ?>
				<header>
					<ul>
						<?php foreach($this->pages as $this->p): ?>
							<li><a href="#" title="<?php echo htmlspecialchars( $this->p ); ?>"><?php echo htmlspecialchars( $this->p ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</header>
			<?php } ); ?><?php $this->getBlock( 'header'); ?>

			<?php $this->setBlock( 'content', function() { ?>

				<div>
					<?php $this->setBlock( 'home', function() { ?>
						<h1>Home</h1>
					<?php } ); ?><?php $this->getBlock( 'home'); ?>
				</div>

				<div>
					<?php $this->setBlock( 'contact', function() { ?>
						<h1>Contact</h1>
					<?php } ); ?><?php $this->getBlock( 'contact'); ?>
				</div>

			<?php } ); ?><?php $this->getBlock( 'content'); ?>

		<?php } ); ?>