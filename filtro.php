  <!doctype html>
  <html>
    <head>
      <title>FILTRO</title>
      <link rel="stylesheet" href="filtro.css" type="text/css">   
    </head>
    <body>
      <h1>FILTRO</h1> 
      <form action="filtro.php" >
        <select id="tipo" name=tipo  >
          <option selected disabled>TIPO</option>
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
        <select id="habitat" name="habitat" >
        <option selected disabled>HABITAT</option>
          <option value="cave">cave</option>
          <option value="forest">forest</option>
          <option value="grassland">grassland</option>
          <option value="mountain">mountain</option>
          <option value="rare">rare</option>
          <option value="rough-terrain">rough-terrain</option>
          <option value="sea">sea</option>
          <option value="urban">urban</option>
          <option value="waters-edge">waters-edge</option>
        </select>

    
        <button type="submit" class="btn1">BUSCAR</button>
    

    
    </form>
      

<div class="poke">

      <?php
      
        $mysqli = mysqli_connect("172.17.0.2","root","1234","pokemonPlus");
        if(!$mysqli){
          echo "<p>Error: No se pudo conectar a Mysql". PHP_EOL;
          echo "<p>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
          echo "<p>Error de depuración: " . mysqli_connect_error() . PHP_EOL;
          exit;
        }
        $nombre = $_GET['tipo'];
        $habitat = $_GET['habitat'];

        $sql_default = 'SELECT p.pok_id ,p.pok_name ,t.type_name ,p.pok_height ,p.pok_weight ,p.pok_base_experience,ph.hab_name
        FROM pokemon p ,pokemon_types pt ,types t,pokemon_habitats ph,pokemon_evolution_matchup pem
        WHERE p.pok_id = pt.pok_id and pt.type_id =t.type_id and p.pok_id = pem.pok_id and 
        pem.hab_id =ph.hab_id ';
        $sql_default1 = 'SELECT p.pok_id ,p.pok_name ,t.type_name ,p.pok_height ,p.pok_weight ,p.pok_base_experience 
        FROM pokemon p ,pokemon_types pt ,types t 
        WHERE p.pok_id = pt.pok_id and pt.type_id =t.type_id
        ORDER BY p.pok_id ;
        ';
        $sql_type = 'and t.type_name = "'.$nombre.'" ';
        $sql_habi = 'and ph.hab_name ="'.$habitat. '" ';
        $sql_order ='ORDER BY p.pok_id ;';
        
        if($nombre == "")
          $sql1 = $sql_default.$sql_order;
        else{
          $sql1 = $sql_default.$sql_type;
        }

        if($habitat == "")
          $sql1 = $sql_default.$sql_order;
        else {
          $sql1 = $sql_default.$sql_habi;
        }

        if($nombre != "" && $habitat != "")
          $sql1 = $sql_default.$sql_type.$sql_habi.$sql_order;

        if($nombre != "" && $habitat == "")
          $sql1 = $sql_default.$sql_type.$sql_order;

        
        

        
        $result = mysqli_query($mysqli,$sql1);  
        if(!$result){
          die("Consulta inválida: " . mysql_error());
        } else {
          echo "<table border=1 >";
          echo "<tr><th>FOTO</th><th>ID</th><th>Nombre</th><th>Tipo</th><th>Altura</th><th>Peso</th><th>XP</th><th>HABITAT</th></tr>";
          while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            if ($row['pok_id'] < 10) {
              echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/"."00"."$row[pok_id].png'  alt=''> </td>";
            } else if ($row['pok_id'] < 100) {
              echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/"."0"."$row[pok_id].png'height=150 alt=''> </td>";
            } else {
              echo "<td> <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/$row[pok_id].png' height=150 alt=''> </td>";
            }
            echo "<td>  $row[pok_id]  </td>";
            echo "<td>  $row[pok_name]  </td>";
            echo "<td>  $row[type_name]   </td>";
            echo "<td>  $row[pok_height]  </td>";
            echo "<td>  $row[pok_weight]  </td>";
            echo "<td>  $row[pok_base_experience]   </td>";
            echo "<td>  $row[hab_name]   </td>";
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
      <div class="movimientos">
        <ul>
        <li><a href="movimientos.php">MOVIMIENTOS</a></li>
        </ul>
      </div>
      
      
      
    </body>
  </html>
