@extends('app')
@section('title', $data['pn'].' - Steam Finder')



@section('content')
@php
switch($data['ps']) 
{
	case 0:	$data['ps'] = "Offline";
		break;
	case 1: $data['ps'] = "Online";
		break;
	case 2: $data['ps'] = "Busy";
		break;
	case 3:	$data['ps'] = "Away";
		break;
	default: $data['ps'] = $data['ps'];
		break;
}

switch($bans['vb'])
{
	case 0: $bans['vb'] = "No Bans";
		break;
	case 1: $bans['vb'] = "Banned";
		break;
	default: $bans['vb'] = "No Bans";
}

switch($bans['dslb'])
{
	case 0: $bans['dslb'] = "No Bans";
		break;
	default: $bans['dslb'] = $bans['dslb'] . " day(s) since last ban";

}
@endphp

<div class="container">
<div class="card mb-3 shadow-sm">
<div class="card-body">
<h2>Result</h2>
	<div class="media">
	<img src="{{ $data['avf'] }}" class="align-self-start mr-3 img-thumbnail" alt="Profile images" width="64">
	<div class="media-body">
	<h5 class="mt-0">
	<i class="fab fa-steam"></i> {{ $data['pn'] }} <a href="{{ $data['purl'] }}" target="_blank" rel="noopener"><i class="fas fa-external-link-alt"></i></a>
	</h5>
	<p class="text-muted">{{ $data['rn'] }}</p>
	</div>
	</div>

	<br>
	<div class="row mb-5">
	<div class="col-md">
		<strong>Player Name</strong>
		<div class="input-group mb-3">
		<input type="text" id="personaname" class="form-control bg-white" value="{{ $data['pn'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#personaname"><i class="far fa-clone"></i></button>
		</div>

		<strong>SteamID</strong>
		<div class="input-group mb-3">
		<input type="text" id="steamid32" class="form-control bg-white" value="{{ $data['steam32'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#steamid32"><i class="far fa-clone"></i></button>
		</div>


		<strong>SteamID64</strong>
		<div class="input-group mb-3">
		<input type="text" id="steamid64" class="form-control bg-white" value="{{ $data['si64'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#steamid64"><i class="far fa-clone"></i></button>
		</div>

		<strong>SteamID3</strong>
		<div class="input-group mb-3">
		<input type="text" id="steamid3" class="form-control bg-white" value="{{ $data['steam3'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#steamid3"><i class="far fa-clone"></i></button>
		</div>

		<strong>Custom URL</strong>
		<div class="input-group mb-3">
		<input type="text" id="profilelink" class="form-control bg-white" value="{{ $data['purl'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#profilelink"><i class="far fa-clone"></i></button>
		</div>

		<strong>Profile URL / Permanent Profile link</strong>
		<div class="input-group mb-3">
		<input type="text" id="profilelink2" class="form-control bg-white" value="{{ $data['profile2'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#profilelink2"><i class="far fa-clone"></i></button>
		</div>

		

		{{-- Trade Ban
		<div class="input-group mb-3">
		<div class="input-group-prepend">
		<span class="input-group-text" id="basic-addon1">@</span>
		</div>
		<input type="text" id="tradeban" class="form-control bg-white" value="{{ $bans['eb'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#tradeban"><i class="far fa-clone"></i></button>
		</div> --}}


	</div>

	<div class="col-md">
		<strong>Real Name</strong>
		<div class="input-group mb-3">
		<input type="text" id="realname" class="form-control bg-white" value="{{ $data['rn'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#realname"><i class="far fa-clone"></i></button>
		</div>


		<strong>Profile State</strong>
		<div class="input-group mb-3">
		<input type="text" id="p_state" class="form-control bg-white" value="{{ $data['ps'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#p_state"><i class="far fa-clone"></i></button>
		</div>


		<strong>Profile Created</strong>
		<div class="input-group mb-3">
		<input type="text" id="p_created" class="form-control bg-white" value="{{ date("F j, Y", $data['createdat']) }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#p_created"><i class="far fa-clone"></i></button>
		</div>

		<strong>VACBanned</strong>
		<div class="input-group mb-3">
		<input type="text" id="vacbanned" class="form-control bg-white" value="{{ $bans['vb'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#vacbanned"><i class="far fa-clone"></i></button>
		</div>

		<strong>Days Since Last Ban</strong>
		<div class="input-group mb-3">
		<input type="text" id="dslb" class="form-control bg-white" value="{{ $bans['dslb'] }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#dslb"><i class="far fa-clone"></i></button>
		</div>

		{{-- @auth --}}
		Extra
		<div class="input-group mb-3">
		<input type="text" id="extra" class="form-control bg-white" value="{{ '// '.$data['pn']." ".date("d-F-Y") }}" aria-describedby="basic-addon1" readonly="">
		<button class="btn btn-outline-dark" type="button" data-clipboard-target="#extra"><i class="far fa-clone"></i></button>
		</div>
		{{-- @endauth --}}


	</div>

	</div>
	<!-- <h6 class="float-right">AnonymouS GAminG</h6> -->
</div>
</div>
</div>

@endsection