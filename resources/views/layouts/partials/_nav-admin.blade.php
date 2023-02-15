<nav class="back-color">
            
    <div class="nav wrapper">
         
        <div class="container">
             
            <a href="#" class="brand-logo center" style="font-size: 18px;">{{config('app.name')}}</a>
            <a href="#" class="button-collapse sidenav-trigger show-on-large" data-target="sidenav"><i class="material-icons">menu</i></a>

            <ul class="right hide-on-small-and-down collection" style="margin: 0px; border: 0px solid transparent">
                <li class="collection-item avatar" style="background: transparent;"><a class="tooltipped " data-position="bottom" data-tooltip='Bienvenue {{Auth::user()->name}} sur votre espace'><i class="material-icons white icon_color circle">account_circle</i></a></li>
            </ul>

        </div>

    </div>

</nav>

<!--Menu Lateral -->

<ul class="sidenav sidenav-fixed sidenav_back" id="sidenav">
            
    <li>

        <div class="user-view">
            
            <div class="background">
                <div class="material-placeholder">
                    <img src="{{asset('uploads/default.jpeg')}}" alt="Logo" class="materialboxed responsive-img">
                </div>
            </div>
            <br>
            <div class="material-placeholder">
                <img src="{{asset('uploads/logo.png')}}" alt="" class="circle materialboxed">
            </div>
        </div>        

    </li>

    <br>

    <li>
        <a href="{{route('admin.home')}}" class="icon_link"><i class="material-icons icon_color">dashboard</i>Tableau de bord</a>
    </li>

    @hasrole('category_manager|super_admin')

        <li>
            <a href="{{route('category.index')}}" class="icon_link"><i class="material-icons icon_color">local_offer</i>Categories</a>
        </li>

    @endhasrole

    @hasrole('post_manager|super_admin')

        <li>
            <a href="{{route('post.index')}}" class="icon_link"><i class="material-icons icon_color">movie_creation</i>Posts</a>
        </li>

    @endhasrole

    @hasrole('user_manager|super_admin')

        <li>
            <a href="{{route('user.index')}}" class="icon_link"><i class="material-icons icon_color">camera_roll</i>Users</a>
        </li>

    @endhasrole

    @hasrole('access_manager|super_admin')

        <li>
            <a href="{{route('role.index')}}" class="icon_link"><i class="material-icons icon_color">access_time</i>Roles</a>
        </li>

        <li>
            <a href="{{route('permission.index')}}" class="icon_link"><i class="material-icons icon_color">security</i>Permissions</a>
        </li>

    @endhasrole


    <li>
        <div class="divider"></div>
    </li>

    <li>
        <a href="{{ route('logout') }}" class="icon_link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons icon_color">exit_to_app</i>Logout</a> 

        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
          @csrf
        </form>           
    </li>

    <br><br>

</ul>