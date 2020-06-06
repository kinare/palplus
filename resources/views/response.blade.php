<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YUnited | Response</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 300;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
				flex-direction: column;
            }
            div.content {
                text-align: center;
				margin: -10px 5px;
            }
            .title {
                font-size: 24px;
            }
            .m-b-md {
                margin-bottom: 10px;
            }
			.button{

			}
			.app-logo{
				display:block;
			}
			.app-logo > img {
				display:block;
				height:150px;
				width:200px;

			}
			/* #d1a348 */
			.go-back-to-app > a{
				padding: 5px 6px;
				background-color: #9b389b;
				border-radius: 6px !important;
				color: #fff;
				text-decoration: none;
				border: 1px solid #d1a348;
				display: block;
			}
			.go-back-to-app > a:hover{
				background-color: #d1a348;
				border: 1px solid #bd7bbd;
			}
        </style>
    </head>
    <body>
        <div class="flex-center full-height">
			<div class="app-logo ">
				<img class="img-fluid" src="{{ asset('images/Yunited_logo.png') }}" alt="YUnited Logo">
			</div>
            <div class="content title">
                @if($status === 'successful')
				<p><span style="text-transform: capitalize;">{{$status}}</span> processed your transaction</p>
				@else
				<p>An error occurred during processing your tranctions. Please contact your Card Owenr</p>
				@endif
            </div>
			<br>

			<p class="go-back-to-app">
			<a href="https://yunited.page.link">
			<i class="fa fa-chevron-circle-left fa-24x"></i>
			Go Back to My Wallet</a>
			</div>
        </div>
    </body>
</html>