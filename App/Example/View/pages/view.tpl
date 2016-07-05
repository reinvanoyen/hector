{{ extends "base" }}

	{{ block @slug append }}

		<div>
			<p>We are viewing a page with slug {{ @slug }} now</p>
		</div>

	{{ /block }}

{{ /extends }}