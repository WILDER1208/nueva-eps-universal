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



    <title>EPS UNIVERSAL | Crear perfil del pacientes</title>
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
                    
                    <li><a href="../recursos/laboratiorios.php">unidades medicas</a></li>
                   
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
            <h1 class="title">Bienvenido <?php echo '<strong>'.$_SESSION['username'].'</strong>'; ?></h1>
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Home</a></li>
                <li class="divider">></li>
                <li><a href="../pacientes/mostrar.php">Listado de los pacientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Crear perfil del paciente</a></li>
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
    <h1>Crear perfil del paciente</h1>
    <?php include_once '../../backend/php/add_profile.php' ?>

    <br>
    <hr>

    <label for="email"><b>Nombre y apellidos del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->nompa; ?> &nbsp; <?php echo $d->apepa; ?>" placeholder="ejm: admin@gmail.com" disabled>

    <label for="email"><b>Correo electrónico del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: admin@gmail.com" name="cop"  required>
    <input type="hidden" name="pid" value="<?php echo $d->idpa; ?>">

    <label for="psw"><b>Usuario del paciente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: juanjo" name="usp" required>

    <label for="psw"><b>Contraseña del paciente</b></label><span class="badge-warning">*</span>
    <input type="password" placeholder="*******" name="pwdp" required>

    <label for="psw"><b>Rol del paciente</b></label><span class="badge-warning">*</span>
    <select required name="rlp">
        <option value="2">Paciente</option>

    </select>

    <hr>
   
    <button type="submit" name="add_profile" class="registerbtn">Guardar</button>
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

    

   
</body>
</html>


