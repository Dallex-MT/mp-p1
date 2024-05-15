<?php
    include_once("../security/Security.php");
    Security::verifySession('');
    Security::verifyUserType('admin','');
    if (session_status() == PHP_SESSION_NONE) session_start();
    include_once("../security/CRUD/Tables.php");
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

    <!-- JS -->
    <script src="../assets/js/weather.js"></script>
    <script src="../assets/js/modal.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <button class="navbar-toggler py-2 my-3" type="button" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li class="nav-item active">
                    <a class="nav-link" href="Admin.php"><i class="fas fa-tachometer-alt"></i>Principal</a>
                </li>
                <li class="nav-item">
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="mdl-card mdl-shadow--2dp trending">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Tienda</h2>
                    </div>
                    <img src="../assets/img/logos/logo.png" class="card-img-top mx-auto" alt="logo">
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4 result fondo-clima">
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="mdl-card mdl-shadow--2dp trending">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Información</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <ul class="mdl-list">
                            <li class="mdl-list__item">
                                <span class="mdl-list__item-primary-content list__item-text"># Actividads</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent"></span>
                            </li>
                            <li class="mdl-list__item list__item--border-top">
                                <span class="mdl-list__item-primary-content list__item-text"># Productos</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent"></span>
                            </li>
                            <li class="mdl-list__item list__item--border-top">
                                <span class="mdl-list__item-primary-content list__item-text "># Compras</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                <div class="num_rows mb-3 col-12 col-md-auto d-flex flex-column justify-content-center">
                    <div class="form-group">
                        <label>Mostrar
                            <select class="form-control" name="state" id="maxRows">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="50">todos (Max:50)</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="mb-3 col-12 col-md-auto d-flex justify-content-center">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored" id="agregar">
                    <i class="material-icons mdl-js-ripple-effect">add</i>
                    </button>
                </div>
                <div class="tb_search mb-3 col-12 col-md-auto d-flex justify-content-center">
                    <input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Buscar.." class="form-control">
                </div>
            </div>
            <div class="wrapper mb-4">
                <table class="table table-dark" id="table-id">
                    <thead>
                        <tr class="align-middle">
                            <th>#</th>
                            <th>Actividad</th>
                            <th>Progreso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo Tables::showActivities($_SESSION['user']);
                        ?>
                    <tbody>
                </table>
            </div>

            <!--		Start Pagination -->
            <div class='pagination-container'>
                <nav>
                    <ul class="pagination">
                        <!--	Here the JS Function Will Add the Rows -->
                    </ul>
                </nav>
            </div>
            <div class="rows_count">Showing # to # of # entries</div>
        </div>
        <script>
            getPagination("#table-id");
            $("#maxRows").trigger("change");
            function getPagination(table) {
                $("#maxRows").on("change", function () {
                    $(".pagination").html(""); // reset pagination div
                    var trnum = 0; // reset tr counter
                    var maxRows = parseInt($(this).val()); // get Max Rows from select option

                    var totalRows = $(table + " tbody tr").length; // numbers of rows
                    $(table + " tr:gt(0)").each(function () {
                        // each TR in  table and not the header
                        trnum++; // Start Counter
                        if (trnum > maxRows) {
                            // if tr number gt maxRows

                            $(this).hide(); // fade it out
                        }
                        if (trnum <= maxRows) {
                            $(this).show();
                        } // else fade in Important in case if it ..
                    }); //  was fade out to fade it in
                    if (totalRows > maxRows) {
                        // if tr total rows gt max rows option
                        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
                        //	numbers of pages
                        for (var i = 1; i <= pagenum;) {
                            // for each page append pagination li
                            $(".pagination")
                                .append(
                                    '<li data-page="' +
                                    i +
                                    '">\
                                                                <span>' +
                                    i++ +
                                    '<span class="sr-only">(current)</span></span>\
                                                                </li>'
                                )
                                .show();
                        } // end for i
                    } // end if row count > max rows
                    $(".pagination li:first-child").addClass("active"); // add active class to the first li

                    //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
                    showig_rows_count(maxRows, 1, totalRows);
                    //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

                    $(".pagination li").on("click", function (e) {
                        // on click each page
                        e.preventDefault();
                        var pageNum = $(this).attr("data-page"); // get it's number
                        var trIndex = 0; // reset tr counter
                        $(".pagination li").removeClass("active"); // remove active class from all li
                        $(this).addClass("active"); // add active class to the clicked

                        //SHOWING ROWS NUMBER OUT OF TOTAL
                        showig_rows_count(maxRows, pageNum, totalRows);
                        //SHOWING ROWS NUMBER OUT OF TOTAL

                        $(table + " tr:gt(0)").each(function () {
                            // each tr in table not the header
                            trIndex++; // tr index counter
                            // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                            if (
                                trIndex > maxRows * pageNum ||
                                trIndex <= maxRows * pageNum - maxRows
                            ) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            } //else fade in
                        }); // end of for each tr in table
                    }); // end of on click pagination list
                });
                // end of on select change

                // END OF PAGINATION
            }

            //ROWS SHOWING FUNCTION
            function showig_rows_count(maxRows, pageNum, totalRows) {
                //Default rows showing
                var end_index = maxRows * pageNum;
                var start_index = maxRows * pageNum - maxRows + parseFloat(1);
                var string =
                    "Showing " +
                    start_index +
                    " to " +
                    end_index +
                    " of " +
                    totalRows +
                    " entries";
                $(".rows_count").html(string);
            }

            // All Table search script
            function FilterkeyWord_all_table() {
                // Count td if you want to search on all table instead of specific column

                var count = $(".table")
                    .children("tbody")
                    .children("tr:first-child")
                    .children("td").length;

                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("search_input_all");
                var input_value = document.getElementById("search_input_all").value;
                filter = input.value.toLowerCase();
                if (input_value != "") {
                    table = document.getElementById("table-id");
                    tr = table.getElementsByTagName("tr");

                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 1; i < tr.length; i++) {
                        var flag = 0;

                        for (j = 0; j < count; j++) {
                            td = tr[i].getElementsByTagName("td")[j];
                            if (td) {
                                var td_text = td.innerHTML;
                                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                                    //var td_text = td.innerHTML;
                                    //td.innerHTML = 'shaban';
                                    flag = 1;
                                } else {
                                    //DO NOTHING
                                }
                            }
                        }
                        if (flag == 1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                } else {
                    //RESET TABLE
                    $("#maxRows").trigger("change");
                }
            }
        </script>
        <!-- MODALES -->
        <div class="modal fade" id="modalCrudEliminar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-register-label">Eliminar Actividad</h3>
                        <p class="modal">Edite los datos de la Actividad:</p>
                        <a data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                    </div>
                    <form id="formBorrar">
                        <div class="modal-body">
                            <p class="text-white contenido">¿Está seguro de que desea eliminar la Actividad?</p>
                            <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
                            <input type="hidden" id="tokenD" name="csrf_token" value="<?php echo $_SESSION['CSRF']; ?>">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-danger" value=" Eliminar Actividad ">
                            <input type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close"
                                value="Cancelar" id="cancelButton">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-register-label">Editar Actividad</h3>
                        <p class="modal">Edite los datos de la Actividad:</p>
                        <a data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="formEditar" class="registration-form">
                            <div class="form-group">
                                <label class="d-block" for="form-first-name">Actividad: </label>
                                <input type="text" name="activityE" class="w-100 text-center" id="activityE">
                            </div>
                            <input type="hidden" id="tokenE" name="csrf_token" value="<?php echo $_SESSION['CSRF']; ?>">
                            <div class="form-group">
                                <label class="d-block" for="form-email">Progreso: </label>
                                <select name="status" id="statusE" required class="w-100">
                                    <option value="toStart">Por Empezar</option>
                                    <option value="doing">Haciendo</option>
                                    <option value="ended">Finalizada</option>
                                </select>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value=" Editar Actividad ">
                                <input type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close"
                                    value=" Cancelar ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCrudAgregar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-register-label">Agregar Actividad</h3>
                        <p class="modal">Ingrese los datos de la Actividad:</p>
                        <a data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="../security/CRUD/Rest.php" method="post" class="registration-form">
                            <div class="form-group">
                                <label for="activity" class="d-block">Actividad:</label>
                                <input type="text" name="activity" placeholder="Actividad..." class="w-100" id="activity" required>
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['CSRF']; ?>">
                            </div>

                            <div class="form-group">
                            <label class="d-block" for="form-email">Progreso: </label>
                                <select name="status" id="statusE" required class="w-100">
                                    <option value="toStart">Por Empezar</option>
                                    <option value="doing">Haciendo</option>
                                    <option value="ended">Finalizada</option>
                            </select>
                            </div>

                            <div class="modal-footer mt-3">
                            <input type="submit" class="btn btn-success" value=" Agregar Actividad ">
                            <input type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" value=" Cancelar ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                let confirmDelete = false;
                activityJS="";

                $(document).on("click", ".editar", function () {
                    fila = $(this).closest("tr");

                    activityJS = fila.find("td:eq(1)").text();

                    $("#activityE").val(activityJS);
                    $("#modalCrud").modal("show");
                });

                $(document).on("click", ".eliminar", function () {
                    fila = $(this).closest("tr");

                    activityJS = fila.find("td:eq(1)").text();

                    $("#modalCrudEliminar").modal("show");
                    $(".contenido").text("¿Está seguro de que desea eliminar la Actividad: " + activityJS + "?");

                    confirmDelete = true;
                });

                // Manejador de clic en el botón "Cancelar"
                $(document).on("click", "#cancelButton", function () {
                    confirmDelete = false; // Desactivar la confirmación de eliminación
                });

                // Manejador del envío del formulario de eliminación
                $("#formBorrar").submit(function (e) {
                    if (confirmDelete) {
                        token = $("#tokenD").val();
                        opcion = 4;
                        $.ajax({
                            url: "http://localhost/MirandaProyecto/security/CRUD/Rest.php",
                            type: "POST",
                            data: { activity: activityJS, opcion: opcion, opcion,csrf_token: token},
                            success: function (resultado) {
                                window.location.href = "Admin.php";
                            }
                        });
                    }
                    $("#modalCrudEliminar").modal("hide"); // Ocultar el modal de eliminación
                    confirmDelete = false; // Restablecer la confirmación de eliminación
                    e.preventDefault(); // Evitar la acción predeterminada del formulario
                });

                $("#formEditar").submit(function (e) {
                    e.preventDefault();
                    activityE = $("#activityE").val();
                    statusE = $("#statusE").val();
                    token = $("#tokenE").val();

                    opcion = 3;
                    $.ajax({
                        url: "http://localhost/MirandaProyecto/security/CRUD/Rest.php",
                        type: "POST",
                        data: {
                            role: statusE, activity: activityJS, opcion: opcion,csrf_token: token
                        },
                        success: function (resultado) {
                            window.location.href = "Admin.php";
                        }
                    });
                });
            });
        </script>
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