<?php
	include_once("../security/Security.php");
    Security::verifySession('');
    Security::verifyUserType('client','');
    if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

    <!-- Archivo CSS de OwlCarousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- Archivo JavaScript de OwlCarousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    
    <!-- CSS -->
    <link href="../assets/css/styleClient.css" rel="stylesheet">
    
    <!-- JS -->
    <script src="../assets/js/scroll.js"></script>
</head>
<body>
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
                    <a href="Client.php" class="nav-item nav-link active text-uppercase">Inicio</a>
                    <a href="store.php" class="nav-item nav-link text-uppercase">Tienda</a>
                    <a href="us.php" class="nav-item nav-link text-uppercase">Nosotros</a>
                    <a href="cart.php" class="nav-item nav-link text-uppercase">
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
    <!-- Carousel Start -->
    <div class="go-top-container">
        <div class="go-top-button">
            <i class="fas fa-chevron-up"></i>
        </div>
    </div>
    <div class="container-fluid p-0 mb-5 carouselCont">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="container-img" src="../assets/img/backgrounds/3.webp" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Piensa con Estilo</h2>
                        <h1 class="display-1 text-white m-0 text-uppercase titleCarousel">UrbanStep</h1>
                        <h2 class="text-white m-0">* Vive Urbano *</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="container-img" src="../assets/img/backgrounds/2.webp" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Tus Pasos tu Ciudad</h2>
                        <h1 class="display-1 text-white m-0 text-uppercase titleCarousel">UrbanStep</h1>
                        <h2 class="text-white m-0">* Deja Huella en la Jungla de Asfalto *</h2>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#blog-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#blog-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Sobre Nosotros</h4>
                <h1 class="display-4 text-primary">A la Moda desde 2020</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5 text-end">
                    <h1 class="mb-3 text-primary">Nuestra Historia</h1>
                    <h5 class="mb-3 text-white">Fundada en el 2020, UrbanStep se ha establecido eficazmente como
                         una marca de referencia para los amantes de las zapatillas urbanas. </h5>
                    <p class="text-white"> UrbanStep es más que vender zapatillas, es crear una comunidad de individuos
                         que valoran la expresión personal y el estilo de vida activo. La Tienda proporciona productos 
                         que no solo se ven bien, sino que también ofrecen un rendimiento excepcional </p>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="../assets/img/backgrounds/main.png"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3 text-primary">Nuestra Vision</h1>
                    <p class="text-white">"Con UrbanStep, los clientes no solo adquieren un producto, se sumergen en un 
                        estilo de vida que celebra la individualidad y la expresión personal a través de la moda. Es una
                         marca para aquellos que se atreven a pisar fuerte y dejar su huella en la ciudad."</p>
                    <h5 class="mb-3 text-white"><i class="fa fa-check text-primary mr-3 "></i>Urban Style</h5>
                    <h5 class="mb-3 text-white"><i class="fa fa-check text-primary mr-3 "></i>Rendimiento Excepcional</h5>
                    <h5 class="mb-3 text-white"><i class="fa fa-check text-primary mr-3 "></i>Calidad y Variedad</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-img mb-4">
        <section class="container fabric12Jump cameMeet bg_img pb-80"
            data-background="../assets/img/backgrounds/1.webp">
            <div class="container">
                <div class="row mm-reverse">
                    <div class="col-xl-6 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1200">
                        <div class="about__left about__left--4">
                            <div class="section-heading">
                                <h1 class="text-primary pt-40 pb-25">Ven a conocernos</h1>
                                <p>Abrimos nuestras puertas para que todos los apasionados por el mundo de los sneakers
                                    conozcan más sobre esta pasión.</p>
                                <p>Es más que una tienda, es un punto de encuentro para la comunidad de moda urbana, un 
                                    lugar donde la creatividad y la expresión personal se celebran a través de la moda. 
                                    Con eventos regulares y lanzamientos exclusivos, UrbanStep se mantiene a la vanguardia 
                                    del streetwear</p>
                            </div>
                            <div class="btn btn-primary mt-45 font-weight-bold btn-test">
                                <a href="https://api.whatsapp.com/send?phone=593985184705" target="_blank"
                                    class="text-white" style="text-decoration: none;">RESERVAR VISITA</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 offset-xl-2 aos-init aos-animate" data-aos="fade-right"
                        data-aos-duration="1200">
                        <div class="big-product-wrapper d-flex justify-content-center position-relative">
                            <img class="img-reserva" src="../assets/img/backgrounds/5.webp" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container-fluid pt-5 mt-4">
        <div class="container pt-5 mt-5">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Servicios</h4>
                <h1 class="display-4 text-primary">Es importante servirte</h1>
            </div>

            <div class="wrapper">
                <div class="box-area-services text-end">
                    <div class="icon-area">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h6 class="text-primary">REALIZAMOS PEDIDOS</h6>
                    <p>Si no contamos con el modelo o la talla que necesitas, te la podemos importar.</p>
                </div>
                <div class="box-area-services text-center">
                    <div class="icon-area">
                        <i class="fas fa-box"></i>
                    </div>
                    <h6 class="text-primary">CAJAS ORIGINALES</h6>
                    <p>Con su compra se lleva las cajas originales de los sneakers.</p>
                </div>
                <div class="box-area-services">
                    <div class="icon-area">
                        <i class="fas fa-shoe-prints"></i>
                    </div>
                    <h6 class="text-primary">GRANDES MARCAS</h6>
                    <p>Ofrecemos sneakers de marcas reconocidas mundialmente como Nike, Adidas, Louis Vuitton.</p>
                </div>
            </div>

        </div>
    </div>
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
