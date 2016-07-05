<html>

	<head>
		<title>Test</title>
	</head>

	<body>

		{{ block "body" }}

			{{ block "header" }}
				<header>
					<ul>
						{{ for @p in @pages }}
							<li><a href="#" title="{{ @p }}">{{ @p }}</a></li>
						{{ /for }}
					</ul>
				</header>
			{{ /block }}

			{{ block "content" }}

				<div>
					{{ block "home" }}
						<h1>Home</h1>
					{{ /block }}
				</div>

				<div>
					{{ block "contact" }}
						<h1>Contact</h1>
					{{ /block }}
				</div>

			{{ /block }}

		{{ /block }}

	</body>

</html>