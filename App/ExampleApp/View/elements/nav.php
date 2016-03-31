<nav>
	<ul>
		<?php foreach( $blogposts as $b ) : ?>
			<li>
				<a href="<?=$b->id?>-<?=$b->slug?>/" title="<?=$b->title?>">
					<?=$b->title?>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</nav>