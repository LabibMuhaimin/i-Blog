<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ Storage::url('profile/'.Auth::user()->image) }}" width="48" height="48" style="margin-top:10px;"alt="User" />
                </div>
                <div class="info-container">
                    <div style="margin-left:10px;" class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name}}</div>
                    <div style="margin-left:10px;margin-bottom:5px;" class="email">{{ Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">

                            <li>
                                <a href="{{ Auth::user()->role->id == 1 ? route('admin.settings') 
                                : route ('author.settings')}}"><i class="material-icons">settings</i>Settings</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>Sign Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div style="background-color:#202020;" class="menu">
                <ul class="list">
                    <li style="background-color:#202020;color:#5cffe9;" class="header">MAIN NAVIGATION</li>

                    @if(Request::is('admin*'))
                        <li>
                        <a style="color:white;" href="{{ route('admin.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span style="color:white;">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a  style="color:white;" href="/">
                            <i class="material-icons">home</i>
                            <span  style="color:white;">Home</span>
                        </a>
                    </li>
                                            <!--class="{{ Request:: is('admin/tag*') ? 'active' : ''}}"-->
                    <li>
                        <a style="color:white;" href="{{ route('admin.tag.index')}}">
                            <i class="material-icons">label</i>
                            <span style="color:white;">Tag</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/category*') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.category.index')}}">
                            <i class="material-icons">apps</i>
                            <span style="color:white;">Category</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/post*') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.post.index')}}">
                            <i class="material-icons">library_books</i>
                            <span style="color:white;">Posts</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/pending/post') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.post.pending')}}">
                            <i class="material-icons">library_books</i>
                            <span style="color:white;">Pending Posts</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/favorite') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.favorite.index')}}">
                            <i class="material-icons">favorite</i>
                            <span style="color:white;">Favourite Posts</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/likes') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.like.index')}}">
                            <i class="material-icons">favorite</i>
                            <span style="color:white;">Own Posts Like</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/comments') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.comment.index')}}">
                            <i class="material-icons">comment</i>
                            <span style="color:white;">Comments</span>
                        </a>
                    </li>
                    <!--<li class="{{ Request:: is('admin/notifications') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.notifications')}}">
                            <i class="material-icons">notifications</i>
                            <span style="color:white;">Notifications</span>
                        </a>
                    </li>-->
                    <li class="{{ Request:: is('admin/authors') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.author.index')}}">
                            <i class="material-icons">account_circle</i>
                            <span style="color:white;">Authors</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/admins') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.admins.index')}}">
                            <i class="material-icons">account_circle</i>
                            <span style="color:white;">Admins</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('admin/subscriber') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.subscriber.index')}}">
                            <i class="material-icons">subscriptions</i>
                            <span style="color:white;">Subscribers</span>
                        </a>
                    </li>
                    
                    <li class="header">System</li>

                    <li class="{{ Request:: is('admin/settings') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('admin.settings')}}">
                            <i class="material-icons">settings</i>
                            <span style="color:white;">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a style="color:white;" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>
                                        <span style="color:white;">Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                    </li>

                    @endif

                    @if(Request::is('author*'))

                        <li class="{{ Request:: is('author/dashboard') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('author.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span style="color:white;">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a style="color:white;" href="/">
                            <i class="material-icons">home</i>
                            <span style="color:white;">Home</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('author/post*') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('author.post.index')}}">
                            <i class="material-icons">library_books</i>
                            <span style="color:white;">Posts</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('author/favorite') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('author.favorite.index')}}">
                            <i class="material-icons">favorite</i>
                            <span style="color:white;">Favorite Posts</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('author/likes') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('author.like.index')}}">
                            <i class="material-icons">favorite</i>
                            <span style="color:white;">Own Posts Like</span>
                        </a>
                    </li>
                    <li class="{{ Request:: is('author/comments') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('author.comment.index')}}">
                            <i class="material-icons">comment</i>
                            <span style="color:white;">Comments</span>
                        </a>
                    </li>
                   <!-- <li class="{{ Request:: is('author/notifications') ? 'active' : ''}}">
                        <a href="{{ route('author.notifications')}}">
                            <i class="material-icons">notifications</i>
                            <span>Notifications</span>
                        </a>
                    </li>-->
                    
                    <li class="header">System</li>
                    <li class="{{ Request:: is('author/settings') ? 'active' : ''}}">
                        <a style="color:white;" href="{{ route('author.settings')}}">
                            <i class="material-icons">settings</i>
                            <span style="color:white;">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a style="color:white;" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>
                                        <span style="color:white;">Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                    </li>
                        
                    @endif

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal" style="background-color:black;">
                <div style="color:grey;" class="copyright">
                    &copy; 2021 - Present <a href="javascript:void(0);">iBlog</a>.
                </div>
                <div  style="color:grey;" class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>