<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
  <a class="nav-link" href="/">
    <i class=" fas fa-home"></i><span>Inicio</span>
  </a>
  <a class="nav-link" href="/usuarios">
    <i class=" fas fa-users"></i><span>Usuarios</span>
  </a>
  <a class="nav-link" href="/roles">
    <i class=" fas fa-user-lock"></i><span>Roles</span>
  </a>
  <a class="nav-link" href="/blog">
    <i class=" fas fa-blog"></i><span>Blog</span>
  </a>
  <a class="nav-link" href="/empleado">
    <i class=" fas fa-address-book"></i><span>Empleados</span>
  </a>
  <a class="nav-link" href="/">
    <i class=" fas fa-building"></i><span>Dashboard</span>
  </a>
  <a class="nav-link" href="{{ route('contact') }}">
    <i class=" fas fa-building"></i><span>Contacto</span>
  </a>
  <a class="nav-link" href="{{ route('faker') }}">
    <i class=" fas fa-accusoft"></i><span>faker</span>
  </a>
  <a class="nav-link" href="{{ route('iconos') }}">
    <i class=" fab accessible-icon"></i><span>iconos</span>
  </a>
  <a class="nav-link" href="{{ route('bootstrap') }}">
    <i class=" fab accessible-icon"></i><span>bootstrap</span>
  </a>
</li>
