<!doctype html>
  <html>
    <head>
      <title>MOVIMIENTOS</title>
      <link rel="stylesheet" href="movimientos.css" type="text/css">   
      <script type="text/javascript">
        function mostrarCantidad(valor){
                verCantidad.innerHTML = valor; 
            }
      </script>
    </head>
    <body>
      <h1>MOVIMIENTOS</h1> 
     
      <form action="movimientos.php" >
        <select id="tipo" name=tipo  >
          <option selected disabled>TIPO</option>
          <img src=imagenes_tipos/bug.png>
          <option value="normal">normal</option>
          <option value="fighting">fighting</option>
          <option value="flying">flying</option>
          <option value="poison">poison</option>
          <option value="ground">ground</option>
          <option value="rock">rock</option>
          <option value="bug">bug</option>
          <option value="ghost">ghost</option>
          <option value="steel">steel</option>
          <option value="fire">fire</option>
          <option value="water">water</option>
          <option value="grass">grass</option>
          <option value="electric">electric</option>
          <option value="psychic">psychic</option>
          <option value="ice">ice</option>
          <option value="dragon">dragon</option>
          <option value="dark">dark</option>
          <option value="fairy">fairy</option>
        </select>
        <button type="submit" class="btn1">BUSCAR</button>
        <input type="range" min="0" max="250" value="0" name="power" id="power" onchange="mostrarCantidad(this.value)"><span id="verCantidad">0</span>
        <input type="text" id="name" placeholder="BUSCAR POKEMON" autofocus name="name">  

      </form>
      <h3>PODER</h3>

<div class="poke">

      <?php
      
        $mysqli = mysqli_connect("172.17.0.2","root","1234","pokemonPlus");
        if(!$mysqli){
          echo "<p>Error: No se pudo conectar a Mysql". PHP_EOL;
          echo "<p>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
          echo "<p>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
          exit;
        }

      $type = $_GET['tipo'];
      $power = $_GET['power'];
      $name = $_GET['name'];

      $sql_moves_default ='SELECT m.move_id ,m.move_name ,t.type_name ,m.move_power, m.move_pp ,m.move_accuracy 
      FROM moves m,types t 
      WHERE m.type_id = t.type_id ';

      $sql_moves_power = 'SELECT m.move_id ,m.move_name ,t.type_name ,m.move_power, m.move_pp ,m.move_accuracy 
      FROM moves m,types t 
      WHERE m.type_id = t.type_id and m.move_power <= "' .$power.'" ;';

      $sql_moves_poke = 'SELECT DISTINCT m.move_id, m.move_name ,t.type_name , m.move_power, m.move_pp ,m.move_accuracy
      FROM pokemon p ,pokemon_moves pm ,moves m ,types t 
      WHERE p.pok_id = pm.pok_id and pm.move_id =m.move_id and m.type_id =t.type_id ';
      
      $sql_power = ' and m.move_power <= "' .$power.'"';
      $sql_types = ' and t.type_name ="' .$type.'"';
      $sql_order = 'ORDER BY m.move_id;';
      $sql_name = ' and p.pok_name ="' .$name.'"';


        if($type == null){
          $sql1 = $sql_moves_default.$sql_order;
        }
        else if($type != null){
          $sql1 = $sql_moves_default.$sql_types.$sql_order;
        }
        
        if($power == 0){
          $sql1 = $sql_moves_default.$sql_order;
        }
        else if($power !=0){
          $sql1 = $sql_moves_default.$sql_types.$sql_power.$sql_order;
        }
        
        if($power == 0 && $type != null){
          $sql1 = $sql_moves_default.$sql_types.$sql_order;
        }

        if($type == null && $power != 0){
          $sql1 = $sql_moves_power;
        }

        if($name != null){
          $sql1 = $sql_moves_poke.$sql_name;
          echo "<h3>MOVIMIENTOS DE $name</h3>";
        }
        


        
      $result = mysqli_query($mysqli,$sql1);  
      if(!$result){
          die("Consulta inválida: " . mysql_error());
        } else {
          echo "<table border=1 >";
          echo "<tr><th>ID</th><th>Nombre</th><th>Tipo</th><th>Poder</th><th>PP</th><th>PRECISION</th></tr>";
          while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>  $row[move_id]  </td>";
            echo "<td>  $row[move_name]  </td>";
            echo "<td>  $row[type_name]   </td>";
            echo "<td>  $row[move_power]  </td>";
            echo "<td>  $row[move_pp]  </td>";
            echo "<td>  $row[move_accuracy]   </td>";
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
      
      
      
      
      
    </body>
  </html>
