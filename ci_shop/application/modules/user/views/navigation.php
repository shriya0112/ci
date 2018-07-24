 <nav class="navbar navbar-expand-md bg-light navbar-light">
  <!-- Brand -->
  <a class="navbar-brand" href="#"></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('user/home');?>">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('user/cart');?>">Cart</a>
      </li>
       <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
       My Account
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Change Password</a>
        <a class="dropdown-item" href="#">Update Details</a>
        <a class="dropdown-item" href="<?php echo base_url('user/logout');?>">Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav> 