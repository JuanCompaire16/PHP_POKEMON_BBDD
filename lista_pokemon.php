<!doctype html>
<html>
  <head>
    <title>POKEDEX</title>
    <link rel="icon" type="image/x-icon" href="/imagenes/poki.png" >
    <link rel="stylesheet" href="pokedex.css" type="text/css">
  </head>
  <body><!--haz para que la imagen de fondo se vaya moviendo -->
    <h1>LISTA POKEMONS</h1>
    <form action="pokedex.php" method="POST" >
    <input type="text" id="buscador1" placeholder="BUSCAR POKEMON" autofocus name="buscador1">  
    
    
    </form>
    <div class="poked">
    
    <?php
    
      $mysqli = mysqli_connect("172.17.0.2","root","1234","pokemonPlus");
      if(!$mysqli){ 
        echo "<p>Error: No se pudo conectar a Mysql". PHP_EOL;
        echo "<p>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
      }

      

      $createFunctionSQL = "
      CREATE FUNCTION cuenta_pokemones() RETURNS INTEGER
      BEGIN
        DECLARE contador INTEGER;
        SELECT COUNT(*) INTO contador FROM pokemon;
        RETURN contador;
      END";

      if (mysqli_query($mysqli, $createFunctionSQL)) {
        // Retrieve the count using the function
        $countSQL = "SELECT cuenta_pokemones() AS total_pokemons";
        $countResult = mysqli_query($mysqli, $countSQL);

        // Check if the query was successful
        if (!$countResult) {
          echo "Error retrieving count: " . mysqli_error($mysqli);
        } else {
          // Fetch the count value
          $row = mysqli_fetch_assoc($countResult);
          $count = $row['total_pokemons'];
          echo "Total Pokemons: " . $count;
        }
      } else {
        echo "Error creating function: " . mysqli_error($mysqli);
      }
      //recoge los datos que he mandado en insertar_eliminar.php


      
      $id = $_GET['id'];
      $nombre = $_GET['name'];
      $altura = $_GET['height'];
      $peso = $_GET[' weight'];
      $xp = $_GET['xp'];

      if($id && $nombre && $altura && $peso && $xp)
        $sql = 'INSERT INTO pokemon (pok_id,pok_name,pok_height,pok_weight,pok_base_experience) VALUES ('.$id.',"'.$nombre.'",'.$altura.','.$peso.','.$xp.') ';
      else
        $sql = 'SELECT * FROM pokemon';

      

      
    
     
      $result = mysqli_query($mysqli,$sql); //mandamos la consulta a la base de datos
      if(!$result){
            die("Consulta inválida: " . mysqli_error().$sql);
          }
      else{
            
            }
      $sql = 'SELECT * FROM pokemon';


      
      //$sql = $sql_main.$sql_name;
      $result = mysqli_query($mysqli,$sql);    
      if(!$result){
        die("Consulta inválida: " . mysqli_error());
      } else {
        echo "<table border=0 >";
        echo "<tr><th>Fotos</th><th>ID</th><th>Nombre</th><th>ALTURA</th><th>PESO</th><th>XP</th><th>ELIMINAR</th></tr>";
        while($row = mysqli_fetch_array($result)){
          
          echo "<tr>";
          if ($row['pok_id'] < 10) {
            echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/"."00"."$row[pok_id].png'  alt=''> </td>";
          } else if ($row['pok_id'] < 100) {
            echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/"."0"."$row[pok_id].png'height=150 alt=''> </td>";
          } else if ($row['pok_id']< 722){
            echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/$row[pok_id].png' height=150 alt=''> </td>";
          } else if ($row['pok_id']>=722){
            echo "<td> <img src='imagenes/new.png' height=150 alt=''> </td>";
          }


          echo "<td>  $row[pok_id]  </td>";
          echo "<td>  $row[pok_name]  </td>";
          echo "<td>  $row[pok_height]  </td>";
          echo "<td>  $row[pok_weight]  </td>";
          echo "<td>  $row[pok_base_experience]  </td>";
          echo "<td> <a href='eliminar.php?id=$row[pok_id]'> <button type=button>DELETE</button></a> </td>";
          
          
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
      <li><a href="insertar_eliminar.php">INSERTAR</a></li>
      </ul>
    </div>
    
    
  </body>
</html>