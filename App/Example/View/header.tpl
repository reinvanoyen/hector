<header>

	<h1>{{ block "title" }}Default title{{ /block }}</h1>

	<ul>
		{{ for @p in @pages }}
			<li><a href="#" title="{{ @p }}">{{ @p }}</a></li>
		{{ /for }}
	</ul>

</header>