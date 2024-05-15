<?php
function loginError($error){
 echo '<html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Error</title>
     <link href="../../assets/img/logos/iconPage.webp" rel="icon">
     <link rel="stylesheet" href="../../assets/css/loginStyle.css">
 </head>
 <body>
     <div class="main">  	
         <input type="checkbox" id="chk" aria-hidden="true">
         <div class="signup">
             <form  action="../../pages/Login.php">
                 <center><label for="chk" aria-hidden="true">Error<br>Algo ha ido mal</label>
                 <br>
                 <p>'.$error.'</p></center>
                 <button type="submit" >Volver a intentar</button>
             </form>
         </div>			
     </div>
 </body>
 </html>' ;
} 
?>