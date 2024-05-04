<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Proyectos de Titulación</title>
    <!-- Agrega aquí tus enlaces a archivos CSS y fuentes si es necesario -->
</head>
<body>
    <header>
        <h1>Catálogo de Proyectos de Titulación</h1>
    </header>
    <main>
        <section>
            <h2>Buscar Proyecto</h2>
            <form action="buscar.php" method="GET">
                <label for="buscar">Buscar por título, autor, carrera, etc.:</label>
                <input type="text" id="buscar" name="buscar" placeholder="Ingrese término de búsqueda">
                <button type="submit">Buscar</button>
            </form>
        </section>
        <section>
            <h2>Resultados de la Búsqueda</h2>
            <!-- Aquí se mostrarán los resultados de la búsqueda -->
            <!-- Puedes usar PHP para iterar sobre los resultados y mostrarlos -->
            <!-- Ejemplo: -->
            <!-- <?php foreach ($resultados as $proyecto) : ?> -->
            <!--     <div class="proyecto"> -->
            <!--         <h3><?php echo $proyecto['titulo']; ?></h3> -->
            <!--         <p>Autor: <?php echo $proyecto['autor']; ?></p> -->
            <!--         <p>Carrera: <?php echo $proyecto['carrera']; ?></p> -->
            <!--         <p>Fecha: <?php echo $proyecto['fecha']; ?></p> -->
            <!--         <a href="descargar.php?id=<?php echo $proyecto['id']; ?>">Descargar PDF</a> -->
            <!--     </div> -->
            <!-- <?php endforeach; ?> -->
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Catálogo de Proyectos de Titulación - ITSA</p>
    </footer>
    <!-- Agrega aquí tus enlaces a archivos JavaScript si es necesario -->
</body>
</html>
