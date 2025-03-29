<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{{ env('APP_NAME') }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		@vite(['resources/auth/css/style.scss'])

		<style>
			.wrapper {
				background: url(/storage/{{ env('APP_BACKGROUND') }}) no-repeat right center;
			}
		</style>
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">

                @yield('content')

			</div>
		</div>


	</body>
</html>
