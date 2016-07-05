<header>

	<h1><?php $this->getBlock( 'title'); ?></h1>

	<ul>
		<?php foreach($this->pages as $this->p): ?>
			<li><a href="#" title="<?php echo htmlspecialchars( $this->p ); ?>"><?php echo htmlspecialchars( $this->p ); ?></a></li>
		<?php endforeach; ?>
	</ul>

</header>