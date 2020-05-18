
</head>
<body>

<?php
  if (isset($_SESSION['userdata'])) 
  {
    if ($_SESSION['userdata']['Tipo']==0) //opciones de usuario Normal
    {  
      ?>
        <!--Dropdown de sesión iniciada-->
        <ul id="dropdown2" class="dropdown-content myDropdown">
          <li> <a href="historial.php"><i class="material-icons">history</i>Historial</a></li>
          <li><a href="salir.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
        </ul>
      <?php
    }
    else
    {
      ?>
        <ul id="dropdown2" class="dropdown-content myDropdown">
          <li> <a href="subirLibro.php"><i class="material-icons">file_upload</i>Subir Libro Nuevo</a></li>
          <li> <a href="gestionLibro.php"><i class="material-icons">local_library</i>Gestión de Libros</a></li>
          <li> <a href="historial.php"><i class="material-icons">history</i>Historial</a></li>
          <li><a href="salir.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
        </ul>
      <?php
    }
  }
  else
  { 
    ?>
      <!-- Dropdown Público general -->
      <ul id="dropdown1" class="dropdown-content myDropdown">
        <li> <a href="login.php"><i class="material-icons">account_circle</i>Iniciar Sesión</a></li>
        <!--li class="divider"></li-->
        <li><a href="registro.php"><i class="material-icons">assignment</i>Registrarse</a></li>
      </ul>
    <?php
  }
?>
	



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
            <?php
              if (isset($_SESSION['userdata'])) 
              {  
            ?>
                
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">¡Hola <?= $_SESSION['userdata']['Nombre'];?>!<i class="material-icons right">arrow_drop_down</i></a></li>

            <?php
              }
              else
              { 
            ?>

                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Cuenta<i class="material-icons right">arrow_drop_down</i></a></li>
            
            <?php
              }
            ?>
        	  

          </ul>
        </div>
      </div>
  </nav>  
</div>

<ul id="menu_responsive" class="sidenav">
      <li>
        <div class="user-view">
            <div class="background">
              <img class="responsive-img" src="../../public/img/fondoResponsive.jpg">
            </div>
            <?php
              if (isset($_SESSION['userdata'])) 
              {  
                ?>
                  <a href="#user"><img class="circle" src="../../public/img/userImg.jpg"></a>
                  <a href="#name"><span class="white-text name">¡Hola <?= $_SESSION['userdata']['Nombre']?>!</span></a>
                  <a href="#email"><span class="white-text email"><?= $_SESSION['userdata']['Correo']?></span></a>
                <?php
              }
              else
              { 
                ?>  
                  <a href="#user"><img class="circle" src="https://freesvg.org/img/abstract-user-flat-3.png"></a>
                  <div style="margin-top: 30px;">
                    <a href="login.php"><span class="white-text email">Iniciar Sesión</span></a>
                  </div>
                <?php
              }
            ?>
        </div>
      </li>


      <li><a class="subheader">Inicio</a></li>
      <li><a href="index.php"><i class="material-icons">home</i>Inicio</a></li>
      <li><a href="libros.php"><i class="material-icons">book</i>Libros</a></li>
      <li><a href="faq.php"><i class="material-icons">question_answer</i>FAQ</a></li>

      <div class="row"><div class="col s10 offset-s1 divider"></div></div>
      <li><a class="subheader">Cuenta</a></li>

      <?php
        if (isset($_SESSION['userdata'])) 
        { 
          if($_SESSION['userdata']['Tipo'] == 0)
          { 
            ?>
              <li> <a href="historial.php"><i class="material-icons">history</i>Historial</a></li>
              <li><a href="salir.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
            <?php
          }
          else
          {
            ?>
              <li> <a href="subirLibro.php"><i class="material-icons">file_upload</i>Subir Libro Nuevo</a></li>
              <li><a href="gestionLibro.php"><i class="material-icons">local_library</i>Gestión de Libros</a></li>
              <li> <a href="historial.php"><i class="material-icons">history</i>Historial</a></li>
              <li><a href="salir.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
            <?php
          }
        }
        else
        { 
          ?>  
            <li> <a href="login.php"><i class="material-icons">account_circle</i>Iniciar Sesión</a></li>
            <!--li class="divider"></li-->
            <li><a href="registro.php"><i class="material-icons">assignment</i>Registrarse</a></li>
          <?php
        }
      ?>
      
</ul>


<!--img src="https://image.flaticon.com/icons/png/512/2702/2702069.png" height="50px" width="50px"-->