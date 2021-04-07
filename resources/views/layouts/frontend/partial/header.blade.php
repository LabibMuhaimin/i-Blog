<header>
		<style>
		
		</style>
		<div class="container-fluid position-relative no-side-padding" >

			<!--<a href="/" class="logo">iBlog</a>-->
			

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="nav_css"  class="main-menu visible-on-click" id="main-menu">
			<li class="nav_css"><img class="img-thumbnail" src="{{  Storage::url('site/sitelogo.png') }}" alt="" style="height:80px;width:150px;display:left;background:transparent;border-color:transparent;"></li>
				<li><h4><a class="hdr" href="{{route('home')}}">Home</a></h4></li>
				
				<li><h4><a class="hdr" href="{{route('post.index')}}">Posts</a></h4></li>
				@guest
					<li><h4><a class="hdr"  href="{{route('login')}}">Login</a></h4></li>
					<li><h4><a class="hdr" href="{{route('register')}}">Register</a></h4></li>

					@else
						@if(Auth::user()->role->id == 1)
							<li><h4><a class="hdr" href="{{route('admin.dashboard')}}">Dashboard</a></h4></li>
								<li>
								<h4><a class="hdr" class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											<i class="material-icons"></i>Sign Out
										</a></h4>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
								</li>
							
						@endif
						@if(Auth::user()->role->id == 2)
							<li><h4><a class="hdr" href="{{route('author.dashboard')}}">Dashboard</a></h4></li>
							<li>
                            <h4><a class="hdr" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons"></i>Sign Out
                                    </a></h4>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
						@endif
				@endguest
				<li class="hdr">
				<div  >
				<form method ="GET" action ="{{ route('search')}}">
					<!--<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>-->
					<input class="searchbar" class="src-input" value="{{ isset($query) ? $query : ''}}" name ="query" type="text" placeholder="Search...">
				</form>
				</div>
				</li>
				
			</ul><!-- main-menu -->

			

		</div><!-- conatiner -->
	</header>