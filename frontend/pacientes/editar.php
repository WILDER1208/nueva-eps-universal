<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

    $id=$_SESSION['id'];
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/neu.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">



    <title>EPS UNIVERSAL | Actualizar paciente</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">

        <a href="../admin/escritorio.php" class="brand"><i class='bx bxs-heart icon'></i> EPS UNIVERSAL</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon' ></i> Citas <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las citas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    <li><a href="../citas/calendario.php">Calendario</a></li>
                   
                </ul>
            </li>

            <li>
                <a href="#" class="active"><i class='bx bxs-user icon' ></i> Pacientes <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../pacientes/mostrar.php" >Lista de pacientes</a></li>
                  
                    <li><a href="../pacientes/historial.php">Historial de los pacientes</a></li>
                 
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-briefcase icon' ></i> Médicos <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../medicos/mostrar.php">Lista de médicos</a></li>
                    <li><a href="../medicos/historial.php">Historial de los médicos</a></li>
                   
                </ul>
            </li>


           

            <li>
                <a href="#"><i class='bx bxs-user-pin icon' ></i> Recursos humanos<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
           
                    <li><a href="../recursos/laboratiorios.php">UNIDADES MEDICAS</a></li>
                     
                </ul>
            </li>

            
           
        </ul>
       

    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">

        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
            
           
            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                <ul class="profile-link">
                    <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    
                    <li>
                     <a href="../salir.php"><i class='bx bxs-log-out-circle' ></i> Logout</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->

        <main>
           
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Home</a></li>
                <li class="divider">></li>
                <li><a href="../pacientes/mostrar.php">Listado de los pacientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Actualizar paciente</a></li>
            </ul>
           
           <!-- multistep form -->
<?php 
require '../../backend/bd/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM patients  WHERE idpa= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
   ?>
   <?php if(count($data)>0):?>
        <?php foreach($data as $d):?>

<form action="" enctype="multipart/form-data" method="POST"  autocomplete="off" onsubmit="return validacion()">
  <div class="containerss">
    <h1>Actualizar pacientes</h1>
    <?php include_once '../../backend/php/upd_patiens.php' ?>
  <br>
    <hr>

    <label for="email"><b>Identificacion del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: ASCS855CS74" value="<?php echo $d->numhs; ?>" name="nhi" maxlength="10" required>
    <input type="hidden" name="pid" value="<?php echo $d->idpa; ?>">

    <label for="psw"><b>Nombre del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: Juan Raul" name="namp" value="<?php echo $d->nompa; ?>" required>

    <label for="psw"><b>Apellido del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: Ramirez Requena" value="<?php echo $d->apepa; ?>" name="apep" required>

    <label for="psw"><b>Dirección del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: calle los medanos" value="<?php echo $d->direc; ?>" name="dip" required>

    <label for="psw"><b>Género del paciente</b></label><span class="badge-warning">*</span>
    <select required name="gep" id="gep">
        <option value="<?php echo $d->sex; ?>"><?php echo $d->sex; ?></option>
        <option>----------------------</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>

    <label for="psw"><b>Grupo sanguíneo del paciente</b></label><span class="badge-warning">*</span>
    <select required name="grp" id="grp">
        <option value="<?php echo $d->grup; ?>"><?php echo $d->grup; ?></option>
        <option>-----------------------</option>
        <option value="A+">A+</option>
        <option value="O-">O-</option>
    </select>

    <label for="psw"><b>Teléfono del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" maxlength="13" value="<?php echo $d->phon; ?>" placeholder="ejm: +51 999 888 111" name="telp" required>

    <label for="psw"><b>Fecha de nacimiento del paciente</b></label><span class="badge-warning">*</span>
    <input type="date" value="<?php echo $d->cump; ?>" name="cump" required>

    <hr>
   
    <button type="submit" name="upd_patiens" class="registerbtn">Guardar</button>
  </div>
  
</form>
        <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>

        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    
    

    <script type="text/javascript">
    let popUp = document.getElementById("cookiePopup");
//When user clicks the accept button
document.getElementById("acceptCookie").addEventListener("click", () => {
  //Create date object
  let d = new Date();
  //Increment the current time by 1 minute (cookie will expire after 1 minute)
  d.setMinutes(2 + d.getMinutes());
  //Create Cookie withname = myCookieName, value = thisIsMyCookie and expiry time=1 minute
  document.cookie = "myCookieName=thisIsMyCookie; expires = " + d + ";";
  //Hide the popup
  popUp.classList.add("hide");
  popUp.classList.remove("shows");
});
//Check if cookie is already present
const checkCookie = () => {
  //Read the cookie and split on "="
  let input = document.cookie.split("=");
  //Check for our cookie
  if (input[0] == "myCookieName") {
    //Hide the popup
    popUp.classList.add("hide");
    popUp.classList.remove("shows");
  } else {
    //Show the popup
    popUp.classList.add("shows");
    popUp.classList.remove("hide");
  }
};
//Check if cookie exists when page loads
window.onload = () => {
  setTimeout(() => {
    checkCookie();
  }, 2000);
};
    </script>
   
</body>
</html>


