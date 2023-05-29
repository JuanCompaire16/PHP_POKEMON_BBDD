<!doctype html>
<html>
  <head>
    <title>INSERTAR/ELIMINAR</title>
    <link rel="icon" type="image/x-icon" href="/imagenes/unkown.png" >
    <link rel="stylesheet" href="insertar_eliminar.css" type="text/css">
  </head>
  <body><!--haz para que la imagen de fondo se vaya moviendo -->
    <h1>INSERTAR/ELIMINAR</h1>
    
    
    <table id="insert_table">
    <form id="insertar" name="insertar" method="get" action="lista_pokemon.php">
      <th colspan=2>Insertar Pokemon</th>
      <tr>
          <tr></tr>
          <tr></tr>
          <tr></tr>
          <tr></tr>
      </tr>
          
      <tr>
        <td>Id pokedex</td>          
        <td><!--que su valor sea siempre el numero mas alto de id_pokedexx +1 -->
         
          <input type="number" name="id_pokedex" id="id_pokedex">


        </td>
      <tr>
        <td>Nombre</td>
        <td><input type="text" name="nombre" id="nombre"  ></td>
      </tr>
      <tr>
        <td>Altura</td>
        <td><input type="number" name="altura" id="altura"  ></td>
      </tr>
      <tr>
        <td>Peso</td>
        <td><input type="number" name="peso" id="peso"  ></td>
      </tr>
      <tr>
        <td>Xp</td>
        <td><input type="number" name="xp" id="xp"  ></td>
      </tr>
      
      <tr>
      <button type="submit" id="boto">AÑADIR</button>
      </tr>
      <tfoot>
        <tr>
          
        </tr>
      </tfoot>
      
    </form>
  </table>
  </table>

  

  <div class="inicio">
      <ul>
      <li><a href="index.html">INICIO</a></li>
      </ul>
    </div>
    <div class="filtro">
      <ul>
      <li><a href="lista_pokemon.php">LISTA POKEMON</a></li>
      </ul>
    </div>
    
    
    
  </body>
</html>
