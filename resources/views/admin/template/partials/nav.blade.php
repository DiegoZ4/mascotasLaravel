@if(Auth::user())
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">ASSITPET</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuarios</a>
      </li>
      <li class="nav-item {{ Request::is('admin/pets*') ? 'active' : '' }}" >
        <a class="nav-link " href="{{ route('pets.index') }}">Mascotas</a>
      </li>
      <li class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">Categorias</a>
      </li>
      <li class="nav-item {{ Request::is('admin/tags*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tags.index') }}">Tags</a>
      </li>
      <li class="nav-item {{ Request::is('admin/articles*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('articles.index') }}">Artículos</a>
      </li>
    </ul>
    
    <ul class="navbar-nav my-2 my-lg-0">
      <li class="nav-item dropdown my-2 my-lg-0">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('admin.auth.logout') }}">Salir</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
@endif