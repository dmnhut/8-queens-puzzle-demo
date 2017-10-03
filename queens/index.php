<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>8 queens problem</title>
  <link rel="icon" type="image/png" href="" sizes="32x32">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="stylesheet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="script.js"></script>
  <script>
   $(document).ready(function(){
   $("#btn-Go").click(function(){
      Go(Number(document.getElementById('txt-row').value), Number(document.getElementById('txt-col').value), Number(document.getElementById('txt-size').value));
   });
  });
  Result();
 </script>
</head>

<body>
  <div class="container container-fluid">
    <div class="jumbotron">
      <hr />
      <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
              <input class="form-control" id="txt-row" placeholder="nhập cột" />
            </div>
            <div class="col-sm-3">
              <input class="form-control" id="txt-col" placeholder="nhập hàng" />
            </div>
            <div class="col-sm-3">
              <input class="form-control" id="txt-size" placeholder="cỡ bàn cờ" />
            </div>
            <div class="col-sm-3">
              <button class="btn btn-primary" id="btn-Go">Go</button>
            </div>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-hover">
            <tr>
              <td>
                <p class="Lobster">8 queens problem:</p>
              </td>
              <td>
                <?php
                  $x = json_decode($_COOKIE['row']);
                  $y = json_decode($_COOKIE['col']);
                  $n = json_decode($_COOKIE['num']);
                  echo '<p class="text-right">Go('.$x.', '.$y.', '.$n.')</span></p>';
                 ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <table class="table table-bordered">
            <?php
              $json = json_decode($_COOKIE['json']);
              for($i = 0; $i < $n; $i++){
                echo '<tr>';
                for($j = 0; $j < $n; $j++){
                  $total = $i + $j;
                  if($total%2 == 0) {
                    $bg_color_td = "#588c7e";
                  } else {
                    $bg_color_td = "#f2e394";
                  }
                  if($json[$i][$j]){
                    echo '<td style="background-color:'.$bg_color_td.'">
                          <button class="btn btn-sm center-block block"><span class="glyphicon glyphicon-queen"></span></button>
                         </td>';
                  } else{
                    echo '<td style="background-color:'.$bg_color_td.'">
                          <label></label>
                         </td>';
                  }
                }
                echo'</tr>';
              }
            ?>
          </table>
        </div>
      </div>
    </div>
    <div class="jumbotron">
      <?php
      for($i = 0; $i < $n; $i++){
        echo '<h3>';
        for($j = 0; $j < $n; $j++){
          echo $json[$i][$j].'&nbsp&nbsp';
        }
        echo '</h3>';
      }
      ?>
    </div>;
  </div>
</body>

</html>
