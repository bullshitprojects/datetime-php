<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guia de ejercicios</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<style>
  *{
    font-family: 'Open Sans', sans-serif;
  }
</style>
<body>
  <center>
    <h2>Alumno: Julio Eduardo Canizalez Salinas</h2>
    <h2>Desarrollo Web con Software Libre</h2>
  </center>
  <ol>
    <li>
      <h4>Solicitar fecha de nacimiento</h4>
      <form action="" method="POST">
        <input type="date" name="birthday" id="" value="1994-04-09" />
        <button type="submit" name="ex1">Calcular</button>
      </form>
      <ol>
        <li>
          <h4>Determinar cuántos días faltan para su próximo cumpleaños.</h4>
          <h5>
            <?php 
              if(isset($_POST['ex1'])){
                $now = date('Y-m-d');
                $birthday =$_POST['birthday'];

                $now_arr = explode('-',$now);
                $birthday_arr = explode('-',$birthday);
                $current_birthday = $now_arr[0]."-".$birthday_arr[1]."-".$birthday_arr[2];
                
                if(strtotime($current_birthday) < time()){
                  $next_year = date('Y', strtotime('+1 year'));
                  $current_birthday = $next_year."-".$birthday_arr[1]."-".$birthday_arr[2];
                  $diff = strtotime($current_birthday) - time();
                  $days=floor($diff/(60*60*24));
                  echo "Faltan $days días para tu cumpleaños";
                } else {
                  $diff = strtotime($current_birthday) - time();
                  $days=floor($diff/(60*60*24));
                  echo "Faltan $days días para tu cumpleaños";
                }
              }
            ?>
          </h5>
        </li>
        <li>
          <h4>Calcular la edad en años</h4>
          <h5>
            <?php 
              if(isset($_POST['ex1'])){
                $years = floor((strtotime($now) - strtotime($birthday)) / 31556926 );
                echo "Tienes $years años";
              }
            ?>
          </h5>  
        </li>
      </ol>
    </li>
    <li>
      <h4>Solicite la fecha e indique a qué día corresponde</h4>
      <form action="" method="POST">
        <input type="date" name="date" id="" />
        <button type="submit" name="ex2">Calcular</button>
      </form>
      <h5>
        <?php
          if(isset($_POST['ex2'])){
            setlocale(LC_TIME, "spanish");
            $inputDate = strtotime($_POST['date']);
            $day = date('l', $inputDate);
            $daySpanish = strftime("%A", strtotime($day));

            echo "El día es $daySpanish";
          }
        ?>
      </h5>
    </li>
    <li>
      <h4>Solicite 2 fechas y calcular la diferencia en años, meses, semanas, días.</h4>
      <form action="" method="POST">
        <p>Fecha 1</p>
        <input type="date" name="date1" id="" />
        <p>Fecha 2</p>
        <input type="date" name="date2" id="" />
        <button type="submit" name="ex3">Calcular</button>
      </form>
      <h5>
        <?php
          if(isset($_POST['ex3'])){
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $dateDifference = abs(strtotime($date2) - strtotime($date1));
            $years = floor($dateDifference / (365*60*60*24));
            $months = floor(($dateDifference - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($dateDifference - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            printf("La diferencia es de\n%d Años, %d Mes, %d Días", $years, $months, $days);
          }
        ?>
      </h5>
    </li>
    <li>
      <h4>Un dentista necesita: capturar la fecha actual, y asignar la fecha de la
        próxima cita <br /> solo contando con la diferencia en “días” que él introduce. 
        <br /><br />a. Si la fecha fuera domingo deberá asignarla para el lunes más
        cercano.
      </h4>
      <form action="" method="POST">
        <p>Cantidad de días para la cita</p>
        <input type="number" name="days" id="" min="0">
        <button type="submit" name="ex4">Calcular</button>
      </form>
      <h5>
        <?php
          if(isset($_POST['ex4'])){
            date_default_timezone_set("America/El_Salvador");
            $days = $_POST['days'];
            $actualDate = date("d-m-Y");
            do {
                $date = date('Y-m-d', strtotime($actualDate . " + $days days"));
                $day = date("l", strtotime($date));
                $days += 1;
            } while ($day == "Sunday");
            echo  "Fecha de la próxima cita: $date";
          }
        ?>
      </h5>
    </li>
    <li>
      <h4>
        Calcular la hora actual en una ciudad introducida por el usuario
      </h4>
      <form action="" method="POST">
        <h5>Escribe una ciudad</h5>
        <small>
          Ejemplos:<br><br>
          Europe/Madrid<br>
          Europe/London<br>
          Asia/Tokyo <br>
          Europe/Berlin <br>
          Asia/Kyoto <br><br>
        </small>
        <input type="text" name="city" />
        <button type="submit" name="ex5">Calcular</button>
      </form>
      <h5>
        <?php
          if(isset($_POST['ex5'])){
            $city = $_POST['city'];
            date_default_timezone_set($city);
            echo "La hora es " . date("d-m-Y h:i:s");
          }
        ?>
      </h5>
    </li>
    <li>
      <h4>
        El usuario introducirá una cantidad de segundos, <br /> deberá devolverle los
        días, horas y minutos a los que es equivalente.
      </h4>
      <form action="" method="POST">
        <p>Cantidad de segundos</p>
        <input type="number" name="seconds" id="" min="0">
        <button type="submit" name="ex6">Calcular</button>
      </form>
      <h5>
        <?php
          if(isset($_POST['ex6'])){
            $seconds = $_POST['seconds'];
            $dateFormat = new \DateTime('@0');
            $dateSeconds = new \DateTime("@$seconds");
            echo $dateFormat->diff($dateSeconds)->format('%a Días, %h Horas, %i Minutos');
          }
        ?>
      </h5>
    </li>
  </ol>
</body>
</html>