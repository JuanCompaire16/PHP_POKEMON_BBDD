<!doctype html>
<html>
<head>
  <title>POKEDEX</title>
  <link rel="icon" type="image/x-icon" href="/imagenes/poki.png" >
  <link rel="stylesheet" href="pokedex.css" type="text/css">
</head>
<body>
  <h1>POKEDEX</h1>
  <form action="pokedex.php" method="GET">
    <input type="text" id="buscador" placeholder="BUSCAR POKEMON" autofocus name="busqueda">  
    <select id="orden" name="orden">
      <option selected disabled>ORDENAR POR</option>
      <option value="p.pok_id">ID</option>
      <option value="p.pok_name">A-Z</option>
      <option value="t.type_name">TIPO</option>
      <option value="bs.b_hp">PS</option>
      <option value="bs.b_atk">ATAQUE</option>
      <option value="bs.b_def">DEFENSA</option>
      <option value="bs.b_speed">VELOCIDAD</option>
    </select>
    <button type="submit">BUSCAR</button>
  </form>
  <div class="poked">
    <?php
      $mysqli = mysqli_connect("172.17.0.2","root","1234","pokemonPlus");
      if (!$mysqli) { 
        echo "<p>Error: No se pudo conectar a MySQL" . PHP_EOL;
        echo "<p>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
      }

      

      // Obtener los resultados
      $nombre = isset($_GET['busqueda']) ? $_GET['busqueda'] : "";
      $orden = isset($_GET['orden']) ? $_GET['orden'] : "";

      $sql = "SELECT p.pok_id, p.pok_name, t.type_name, bs.b_hp, bs.b_atk, bs.b_def, bs.b_speed
              FROM pokemon p
              JOIN pokemon_types pt ON p.pok_id = pt.pok_id
              JOIN types t ON pt.type_id = t.type_id
              JOIN base_stats bs ON p.pok_id = bs.pok_id
              WHERE 1=1";

      if (!empty($nombre)) {
        $sql .= " AND p.pok_name LIKE '%$nombre%'";
      }

      if (!empty($orden)) {
        $sql .= " ORDER BY $orden";
      }

      $result = mysqli_query($mysqli, $sql);
      if (!$result) {
        die("Consulta inválida: " . mysqli_error($mysqli));
      } else {
        echo "<table border=0 >";
        echo "<tr><th>Fotos</th><th>ID</th><th>Nombre</th><th>Tipo</th><th>PS</th><th>ATAQUE</th><th>DEFENSA</th><th>VELOCIDAD</th></tr>";
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          $pok_id = str_pad($row['pok_id'], 3, "0", STR_PAD_LEFT);
          echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/$pok_id.png' height=150 alt=''> </td>";
          echo "<td>  $row[pok_id]  </td>";
          echo "<td>  $row[pok_name]  </td>";
          echo "<td>  $row[type_name]  </td>";
          echo "<td>  $row[b_hp]  </td>";
          echo "<td>  $row[b_atk]  </td>";
          echo "<td>  $row[b_def]   </td>";
          echo "<td>  $row[b_speed]   </td>";
          echo "</tr>";
        }
        echo "</table>";
      }

      mysqli_close($mysqli);
    ?>
  </div>
  <div class="inicio">
    <ul>
      <li><a href="index.html">INICIO</a></li>
    </ul>
  </div>
  <div class="filtro">
    <ul>
      <li><a href="filtro.php">FILTRO</a></li>
    </ul>
  </div>
</body>
</html>