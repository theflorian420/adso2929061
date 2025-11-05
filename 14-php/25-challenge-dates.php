<?php 
    date_default_timezone_set('America/Bogota'); // Ajusta a tu zona horaria si es necesario

    $title       = '25-challenge-dates';
    $description = 'Calcula tu edad';
    include 'template/header.php';
    $resultadoHTML = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['fecha_nacimiento'])) {
        $fechaNacimientoStr = $_POST['fecha_nacimiento'];       
        try {
            $fechaNacimiento = new DateTime($fechaNacimientoStr);
            $fechaActual     = new DateTime();
            $intervalo  = $fechaNacimiento->diff($fechaActual);
            $edadEnAnos = $intervalo->y;
            $resultadoHTML = "
                <div style='padding: 15px; border: 1px solid #007bff; background-color: #e6f3ff; margin-top: 20px;'>
                    <h4>Tu Edad es: {$edadEnAnos}
                    años</h4>
                </div>
            ";
        } catch (Exception $e) {
            $resultadoHTML = "<p style='color: red;'>Error: Por favor, ingresa una fecha válida.</p>";
        }
    }
?>
<section>
    <h3>Calcula tu edad</h3>
    <?php echo $resultadoHTML; ?>
    <h4>Fecha de nacimiento:</h4>
    <form method='POST' action=''>
        <label for='fecha_nacimiento'></label>
        <input 
            type='date' 
            id='fecha_nacimiento' 
            name='fecha_nacimiento' 
            required 
            style='margin-right: 10px; padding: 5px;'
        >
        <button 
            type='submit' 
            style='padding: 5px 15px; background-color: #007bff; color: white; border: none; cursor: pointer;'
        >
            Calcular Edad
        </button>
    </form>
</section>
<?php 
    include 'template/footer.php';
?>