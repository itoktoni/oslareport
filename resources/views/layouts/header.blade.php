 <!-- begin::header -->
 <div class="header">

 	<div>
 		<ul class="navbar-nav">

 			<li class="nav-item dropdown">
 				<a href="#" class="nav-link header-title" title="User menu" data-toggle="dropdown" aria-expanded="false">
 					<h1>{{ env('APP_TITLE', env('APP_NAME', 'SYSTEM')) }}</h1>
 				</a>
             </li>

			 @if(Session::get('navigation') && env('BREADCRUMB_ENABLED', false))
			 @forelse (collect(Session::get('navigation'))->take(6) as $breadcrumb)
			 <li class="nav-item" style="margin-right: 10px">
				 <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
					<a href="{{ $breadcrumb['url'] }}" class="nav-link btn btn-primary btn-sm" title="Hide navigation">
						{{ $breadcrumb['menu_name'] }}
					</a>
					<a class="btn btn-dark" href="{{ route('delete_url', ['code' => $breadcrumb['menu_action']]) }}">x</a>
				</div>
			 </li>
			 @empty
			 @endforelse

			@endif

 			<li class="nav-item navigation-toggler mobile-toggler">
 				<a href="#" class="nav-link" title="Show navigation">
 					<i class="bi bi-list"></i>
				 </a>
 			</li>

			@livewire('progress')

			<livewire:megaphone></livewire:megaphone>

			<li class="nav-item profile">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">[ {{ Auth::user()->name }} ]</a>
				<div class="dropdown-menu">
					<a href="{{ route('getProfile') }}" class="dropdown-item">My Profile</a>
					<a href="#" class="dropdown-item">Settings</a>
					<a href="#" class="dropdown-item">Billing</a>
					<a href="{{ route('signout') }}" class="dropdown-item">Logout</a>
				</div>
			</li>

 		</ul>

 	</div>

 	<div style="margin-right: 50px;">

 		<ul class="navbar-nav">
			<li class="nav-item ">
			</li>
 		</ul>
 	</div>


 </div>
 <!-- end::header -->