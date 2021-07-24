<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet"/>

	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="/css/style.css">

	@notifyCss
</head>

<body class="bg-light">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
		  <a class="navbar-brand" href="/">Steam Finder</a>
		  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<li class="nav-item">
			  <a class="nav-link active" aria-current="page" href="/"><i class="fas fa-home"></i> Home</a>
				</li>
			  <li>
				<a class="nav-link" href="https://amsgaming.in">Website</a>
			  </li>
			  <li>
			  <a class="nav-link" href="https://amsgaming.in/buyvip"> VIP Store</a>
			  </li>

			  @if(session()->get('steam'))
			  <li>
				<a class="nav-link" href="/{{ session()->get('steam')->id }}">Profile</a>
			  </li>
			  @endif
			</ul>

			  <div class="d-flex align-items-center">
				
				@if(session()->get('steam'))
				<a href="/auth/steam/logout" type="button" class="btn btn-link px-3 me-2">
				  Log Out
				</a>
				@else
				<a href="/auth/steam" type="button" class="btn btn-link px-3 me-2">
					Login via Steam
				</a>
				@endif
				
				<a
				  class="btn btn-dark px-3"
				  href="https://github.com/sanjaysrocks"
				  role="button"
				  ><i class="fab fa-github"></i
				></a>
			  </div>


			</div>
		  </div>
		</div>
	  </nav>





<div class="container mt-5">

	<form action="/search" method="post">
	@yield('msg')

	@csrf
	<h5>Enter SteamID</h5>
	<div class="input-group mb-3">
	<div class="input-group-prepend">
	<span class="input-group-text"><i class="fab fa-steam-symbol"></i></span>
	</div>
		<input id="searchText" name="steamid" type="text" class="form-control" placeholder="SteamID / SteamID3 / SteamID64 / Custom URL / Complete URL" autofocus required>
	</div>

	<button id="search" class="btn btn-primary btn-block mb-3"><i class="fas fa-search"></i> Search</button>
	</form>
</div>

@yield('content')




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>


<x:notify-messages />
@notifyJs

<footer style="padding-top: 60px;" class="mb-4">
<div class="container text-center">
<br>
<hr> 
<h6>© SteamID Finder 2020 AnonymouS Gaming | <a target="_blank" href="http://steampowered.com/">Powered by Steam</a></h6>
</div>
</footer>

</body>
</html>