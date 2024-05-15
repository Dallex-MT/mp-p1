<?php
    include("../security/Security.php");
    Security::verifySession('');
    Security::verifyUserType('client','');
    if (session_status() == PHP_SESSION_NONE) session_start();
    include("../security/CRUD/Products.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="../assets/img/logos/iconPage.webp" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'>
        
    <!-- Enlace al archivo CSS de LineIcons -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    
    <!-- CSS -->
    <link href="../assets/css/styleClient.css" rel="stylesheet">
    
    <!-- JS -->
    <script src="../assets/js/scroll.js"></script>
    
</head>
<body>
    <div class="go-top-container">
        <div class="go-top-button">
            <i class="fas fa-chevron-up"></i>
        </div>
    </div>
    <!-- NavBar -->
    <div class="container-fluid navCont">
        <nav class="navbar navbar-expand-lg bg-transparent navbar-dark py-3">
            <a href="Client.php" class="navbar-brand px-lg-4 m-0">
                <span class="m-0 display-3 text-uppercase text-white"><img class="navlogo" src="../assets/img/logos/iconPage.webp"></span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="Client.php" class="nav-item nav-link text-uppercase">Inicio</a>
                    <a href="store.php" class="nav-item nav-link text-uppercase">Tienda</a>
                    <a href="us.php" class="nav-item nav-link text-uppercase">Nosotros</a>
                    <a href="cart.php" class="nav-item nav-link active text-uppercase">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge"><?php echo $_SESSION['cart'] ?></span>
                    </a>
                    <div class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                            <?php echo $_SESSION['user'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                            <?php 
                              if(isset($_SESSION['picture']) && !empty($_SESSION['picture'])){
                                echo '
                                <div class="d-flex my-2">
                                    <img class="mx-auto" src="data:image/jpeg;base64,'.$_SESSION['picture'].'" alt="Perfil">
                                </div>
                                ';
                              }
                            ?>
                            <div class="dropdown-header text-center">
                                <?php echo $_SESSION['email'] ?>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item"> <i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="contenedor-fluido page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain">
                Carrito
            </h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="Client.php">Inicio</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Carrito</p>
            </div>
        </div>
    </div>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td class="text-primary">Foto</td>
                    <td class="text-primary">Producto</td>
                    <td class="text-primary">Talla</td>
                    <td class="text-primary">Precio</td>
                    <td class="text-primary">Remover</td>
                </tr>
            </thead>
            <tbody>
                <?php echo Products::showCart($_SESSION['cartID']) ?>
    </section>
    <!-- Footer -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4 titleFooter" style="letter-spacing: 3px;">Contactanos</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Huachi Chico</p>
                <p><i class="fa fa-phone-alt mr-2"></i>0999999999</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>dmiranda1870@uta.edu.ec</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4 titleFooter" style="letter-spacing: 3px;">Siguenos</h4>
                <p>Siguenos en nuestras Redes Sociales</p>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://twitter.com/"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://www.facebook.com/"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://ec.linkedin.com"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="https://www.instagram.com/"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4 titleFooter" style="letter-spacing: 3px;">ATENDEMOS
                </h4>
                <div>
                    <h6 class="text-white text-uppercase">Lunes - Viernes</h6>
                    <p>8.00 AM - 6.00 PM</p>
                    <h6 class="text-white text-uppercase">Sabados</h6>
                    <p>2.00 PM - 8.00 PM</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4 titleFooter" style="letter-spacing: 3px;">Suscribirse</h4>
                <p></p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Email...">
                        <button class="btn btn-primary font-weight-bold px-3">Ingresar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5"
            style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy;Dallex. Todos los Derechos Reservados.</p>
        </div>
    </div>
</body>
</html>
