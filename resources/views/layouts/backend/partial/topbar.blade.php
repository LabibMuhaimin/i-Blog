<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <img class="navbar-brand" src="{{  Storage::url('site/sitelogo.png') }}" alt="" style="height:60px;width:120px;display:left;background:transparent;border-color:transparent;">
                @if(Auth::user()->role_id == 1)
                <a class="navbar-brand"  href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @else
                    <a class="navbar-brand"  href="{{ route('author.dashboard') }}">Author Panel</a>
                @endif
                
            </div>
           
            <div style="background-color:black;">
            
            <div style="background-color:black;color:white;margin-left:15px;">
				<form method ="GET" action ="{{ route('search')}}">
					
					<input style="color:white;border-bottom:2px solid white;border-top:transparent;border-right:none;border-left:none;margin-top:10px;margin-left:650px;height:50px;width:350px;background:transparent;" class="src-input" value="{{ isset($query) ? $query : ''}}" name ="query" type="text" placeholder="Search...">
				</form>
				</div>
                
                </div>
        </div>
    </nav>
    