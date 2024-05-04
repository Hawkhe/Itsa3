<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $canal = curl_init();
    $url= 'http://localhost/ApiRestDiego/get_all_animal.php';
    curl_setopt($canal, CURLOPT_URL,$url);
    curl_setopt($canal, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($canal);

    if(curl_errno($canal))
    {
        $error_msg=curl_error($canal);
        echo "Error al conectarse";
    }
    else{
        curl_close($canal);
        $datos= json_decode($respuesta, true);

        if (!empty($datos)) {
            echo '<table border="1">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Edad</th>';
            echo '<th>Especie</th>';
            echo '<th>Clasificacion</th>';
            echo '<th>Estado</th>';
            echo '<th>Acciones</th>';
            echo '</tr>';

            foreach ($datos as $animal) {
                echo '<tr>';
                echo '<td>' . $animal['id'] . '</td>';
                echo '<td>' . $animal['edad'] . '</td>';
                echo '<td>' . $animal['especie'] . '</td>';
                echo '<td>' . $animal['clasificacion'] . '</td>';
                echo '<td>' . $animal['estado'] . '</td>';
                echo '<td>';
                echo '<button onclick="editAnimal(' . $animal['id'] . ')">Editar</button>';
                echo '<button onclick="deleteAnimal(' . $animal['id'] . ')">Eliminar</button>';
                echo '</td>';
                echo '</tr>';
            }

            // Botón para agregar un nuevo animal
            echo '<tr>';
            echo '<td colspan="5"></td>'; // Espacio para las acciones
            echo '<td><button onclick="addAnimal()">Agregar Nuevo</button></td>';
            echo '</tr>';

            echo '</table>';
        } else {
            echo "No hay datos disponibles.";
        }
    }
    ?><!-- Modal para editar animal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Animal</h2>
            <div id="editFormContainer"></div> <!-- Contenedor para el formulario de edición -->
        </div>
    </div>
    
    <script>
      function editAnimal(id) {
            console.log("Editar animal con ID: " + id);
            fetch('http://localhost/ApiRestDiego/get_all_animal.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    // Llenar el formulario con los datos del animal
                    document.getElementById('edit-id').value = data.id;
                    document.getElementById('edit-edad').value = data.edad;
                    document.getElementById('edit-especie').value = data.especie;
                    document.getElementById('edit-clasificacion').value = data.clasificacion;
                    document.getElementById('edit-estado').value = data.estado;
                    
                    // Abrir el modal
                    document.getElementById('editModal').style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        }
        function deleteAnimal(id) {
    console.log("Eliminar animal con ID: " + id);
    if (confirm('¿Estás seguro de eliminar este animal?')) {
        fetch('http://localhost/ApiRestDiego/delete_animal.php?id=' + id, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
}
        function addAnimal() {
            console.log("Agregar nuevo animal");
            // Redirigir a la página de creación de animal
            window.location.href = 'agregar_animal.php';
        }
    </script>
</body>
</html>
