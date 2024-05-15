<?php
    include_once("../security/Security.php");
    Security::verifySession('');
    Security::verifyUserType('admin','');
    if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="../assets/img/logos/iconPage.webp" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>    
    
    <!-- CSS -->
    <link href="../assets/css/styleAdmin.css" rel="stylesheet">
    <link href="https://foliotek.github.io/Croppie/croppie.css" rel="stylesheet">

    <!-- JS -->
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script src="../assets/js/password.js"></script>
    <script src="../assets/js/cropImage.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <button class="navbar-toggler py-2 my-3" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <div class="hori-selector">
                <div class="left"></div>
                <div class="right"></div>
            </div>
            <li class="nav-item">
                <a class="nav-link" href="Admin.php"><i class="fas fa-tachometer-alt"></i>Principal</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="account.php"><i class="far fa-address-book"></i>Cuenta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php"><i class="far fa-calendar-alt"></i>Administrar Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="products.php"><i class="far fa-chart-bar"></i>Administrar Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sales.php"><i class="far fa-copy"></i>Administrar Compras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="far fa-copy"></i>Cerrar Sesión</a>
            </li>
            </ul>
        </div>
    </nav>
    <div class="account container mt-5">
    <div class="container">
        <h1>Editar Perfil</h1>
        <hr>
        <div class="row ">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="data:image/jpeg;base64,<?php echo $_SESSION['picture'] ?>" class="avatar img-circle" alt="avatar">
                    <h6 class="my-4" style="color:#fff;">Subir otra foto...</h6>
                    <div class='container-form'>
                        <form id="form-upload" role="form" action="../security/CRUD/Rest.php" enctype="multipart/form-data" method="POST">
                            <input id='selectedFile' type='file' accept=".png, .jpg, .jpeg, .svg">
                            <a id="upload-aphoto" class="w-100 btn">Seleccionar</a>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['CSRF']; ?>">
                            <input type="hidden" name="userID" value="<?php echo $_SESSION['user']; ?>">
                            <input type="hidden" name="opcion" value="7">
                            <input type="submit" class="btn btn-success" value=" Actualizar Imagen ">
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <h3>Personal info</h3>

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre de Usuario:</label>
                        <div class="col-md-8 mx-auto">
                            <input class="w-75 text-center" type="text" value="<?php echo $_SESSION['user'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-md-8 mx-auto">
                            <input class="w-75 text-center" type="text" value="<?php echo $_SESSION['email'] ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Contraseña:</label>
                        <div class="col-md-8 mx-auto">
                            <input class="w-75 text-center" id="password" type="password" required>
                            <span class="toggle-password" onclick="togglePasswordVisibility(this)"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirme Contraseña:</label>
                        <div class="col-md-8 mx-auto">
                            <input class="w-75 text-center" id="password2" type="password" required>
                            <span class="toggle-password" onclick="togglePasswordVisibility(this)"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="mismatch">
                        <p id="passwordMismatch">Las contraseñas no coinciden.</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="mx-auto col-md-8 d-flex justify-content-evenly">
                            <button type="button" class="align-middle btn btn-primary">Guardar</button>
                            <button type="reset" class="align-middle btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    </div>
    <div class="modal fade" id="imageModalContainer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-register-label">Recortar Imagen</h3>
                    <a data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                </div>
                <div class="modal-body modal-body1">
                    <div id='crop-image-container'class="pb-5">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-modal mx-3">Guardar</button>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function test() {
            var tabsNewAnim = $("#navbarSupportedContent");
            var selectorNewAnim = $("#navbarSupportedContent").find("li").length;
            var activeItemNewAnim = tabsNewAnim.find(".active");
            var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
            var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
            var itemPosNewAnimTop = activeItemNewAnim.position();
            var itemPosNewAnimLeft = activeItemNewAnim.position();
            $(".hori-selector").css({
            top: itemPosNewAnimTop.top + "px",
            left: itemPosNewAnimLeft.left + "px",
            height: activeWidthNewAnimHeight + "px",
            width: activeWidthNewAnimWidth + "px"
            });
            $("#navbarSupportedContent").on("click", "li", function (e) {
            $("#navbarSupportedContent ul li").removeClass("active");
            $(this).addClass("active");
            var activeWidthNewAnimHeight = $(this).innerHeight();
            var activeWidthNewAnimWidth = $(this).innerWidth();
            var itemPosNewAnimTop = $(this).position();
            var itemPosNewAnimLeft = $(this).position();
            $(".hori-selector").css({
                top: itemPosNewAnimTop.top + "px",
                left: itemPosNewAnimLeft.left + "px",
                height: activeWidthNewAnimHeight + "px",
                width: activeWidthNewAnimWidth + "px"
            });
            });
        }
        $(document).ready(function () {
            setTimeout(function () {
            test();
            });
        });
        $(window).on("resize", function () {
            setTimeout(function () {
            test();
            }, 500);
        });
        $(".navbar-toggler").click(function () {
            $(".navbar-collapse").slideToggle(300);
            setTimeout(function () {
            test();
            });
        });
        
        // --------------add active class-on another-page move----------
        jQuery(document).ready(function ($) {
            // Get current path and find target link
            var path = window.location.pathname.split("/").pop();
            console.log(path)
        
            // Account for home page with empty path
            if (path == "") {
                path = "index.html";
            }
        
            var target = $('#navbarSupportedContent ul li a[href="' + path + '"]');
            // Add active class to target link
            target.parent().addClass("active");
        });
        
        // Add active class on another page linked
        // ==========================================
        // $(window).on('load',function () {
        //     var current = location.pathname;
        //     console.log(current);
        //     $('#navbarSupportedContent ul li a').each(function(){
        //         var $this = $(this);
        //         // if the current path is like this link, make it active
        //         if($this.attr('href').indexOf(current) !== -1){
        //             $this.parent().addClass('active');
        //             $this.parents('.menu-submenu').addClass('show-dropdown');
        //             $this.parents('.menu-submenu').parent().addClass('active');
        //         }else{
        //             $this.parent().removeClass('active');
        //         }
        //     })
        // });
    </script>
</body>
</html>