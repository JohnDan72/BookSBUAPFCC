
</head>
<body>

	<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li> <a href="#!"><i class="large material-icons">account_circle</i>Iniciar Sesión</a></li>
  <!--li class="divider"></li-->
  <li><a href="#!"><i class="large material-icons">assignment</i>Registrarse</a></li>
</ul>

<div id="blue" class="block blue">
  <nav class="pushpin-demo-nav   blue-grey darken-4" data-target="blue">
      <div class="nav-wrapper">
        <div class="container">
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
  <div id="imgIndex" class="row">
    <div class="row">
      <div class="col s12 m6 l6"><h4>Hola y bienvenidos</h4></div>
      <div class="col s12 m6 l6"><h6>Esto es la entrada</h6></div>
    </div>
    <img src="https://pixabay.com/get/54e5dc454252a514f6d1867dda35367b1d37d8ec5458744a_1920.jpg">
  </div>
  

</div>

<!--img src="https://image.flaticon.com/icons/png/512/2702/2702069.png" height="50px" width="50px"-->