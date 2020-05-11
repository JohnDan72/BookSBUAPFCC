
</head>
<body>

	<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li> <a href="login.php"><i class="material-icons">account_circle</i>Iniciar Sesión</a></li>
  <!--li class="divider"></li-->
  <li><a href="#!"><i class="material-icons">assignment</i>Registrarse</a></li>
</ul>

<div class="navbar-fixed z-depth-2">
  <nav class="grey darken-3">
      <div class="nav-wrapper">
        <div class="container">

          <a href="#" data-target="menu_responsive" class="sidenav-trigger"><i class="material-icons">menu</i></a>

          <a href="index.php" class="brand-logo"><img id="id_logo" src="<?= $BASE_PATH;?>public/img/Logo.png" height="60px" width="140px"></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <!-- Dropdown Trigger -->
        	  <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Cuenta<i class="material-icons right">arrow_drop_down</i></a></li>

          </ul>
        </div>
      </div>
  </nav>  
</div>

<ul id="menu_responsive" class="sidenav">
      <li><div class="user-view">
        <div class="background">
          <img src="<?= $BASE_PATH;?>public/img/fondoResponsive.jpg">
        </div>
        <a href="#user"><img class="circle" src="<?= $BASE_PATH;?>public/img/userImg.jpg"></a>
        <a href="#name"><span class="white-text name">John Doe</span></a>
        <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
      </div></li>
      <li><a href="index.php"><i class="material-icons">home</i>Inicio</a></li>
      <li><a href="libros.php"><i class="material-icons">book</i>Libros</a></li>
      <li><a href="faq.php"><i class="material-icons">question_answer</i>FAQ</a></li>
      <li> <a href="login.php"><i class="material-icons">account_circle</i>Iniciar Sesión</a></li>
      <!--li class="divider"></li-->
      <li><a href="#!"><i class="material-icons">assignment</i>Registrarse</a></li>
  </ul>


<!--img src="https://image.flaticon.com/icons/png/512/2702/2702069.png" height="50px" width="50px"-->