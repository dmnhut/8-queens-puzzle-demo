<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>8 queens problem</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="" sizes="32x32">
  <style>
    .Lobster {
      font-family: Lobster;
    }

    body {
      background-color: black;
      color: #1a1a1a;
    }

    p {
      font-size: 16px;
      font-family: Monospace;
    }

    .block {
      background-color: white;
      color: black;
      border: 2px solid #000000;
    }

    .block:hover {
      background-color: #000000;
      color: white;
    }
  </style>
  <script>
    var chessBoard = [
      [],
      [],
      [],
      [],
      [],
      [],
      [],
      []
    ];
    var col = [];
    var left = [];
    var right = [];
    var jsonString = 'json';
    var count = 0;
    var inputRow;
    var inputCol;

    function Go(x, y) {
      for (var i = 0; i < 8; i++) {
        for (var j = 0; j < 8; j++) {
          chessBoard[i][j] = 0;
        }
      }
      for (i = 0; i < 8; i++) {
        col[i] = 0;

      }
      for (i = 0; i < 15; i++) {
        left[i] = 0;
        right[i] = 0;
      }
      Input(x, y);
      Try(0);
    }

    function Input(x, y) {
      count = 0;
      inputRow = x;
      inputCol = y;
      chessBoard[inputRow][inputCol] = 1;
      col[inputCol] = 1;
      left[inputCol + inputRow] = 1;
      right[inputRow - inputCol + 7] = 1;
    }

    function Try(queen) {
      for (var i = 0; i < 8; i++) {
        if (queen === inputRow) {
          if (queen === 7) {
            Out();
          } else {
            Try(queen + 1);
            continue;
          }
        }
        if (col[i] === 0 && left[queen + i] === 0 && right[queen - i + 7] === 0 && i !== inputCol) {
          chessBoard[queen][i] = 1;
          col[i] = 1;
          left[queen + i] = 1;
          right[queen - i + 7] = 1;
          if (queen === 7) {
            Out();
          } else {
            Try(queen + 1);
            chessBoard[queen][i] = 0;
            col[i] = 0;
            left[queen + i] = 0;
            right[queen - i + 7] = 0;
          }
        }
      }
    }

    function Out() {
      count++;
      jsonString = JSON.stringify(chessBoard);
      document.cookie = "json=" + jsonString;
      console.log(count);
      console.log(jsonString);
    }
  </script>
</head>

<body>
  <script>
    function Result() {
      var arr = document.cookie;
      arr = arr.replace('json=', '');
      console.log(arr);
    }
  </script>
  <div class="container" style="margin-top: 1%;">
    <div class="jumbotron">
      <div class="row">
        <div class="col-xs-12 col-lg-8 col-lg-offset-2">
          <p class="Lobster">eight queens problem</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-lg-8 col-lg-offset-2">
          <table class="table table-hover table-bordered">
            <?php
              $json = json_decode($_COOKIE['json']);
              for($i = 0; $i < 8; $i++){
                echo '<tr>';
                for($j = 0; $j < 8; $j++){
                  $total = $i + $j;
                  if($total%2 == 0) {
                    $bg_color_td = "#901E1D";
                  } else {
                    $bg_color_td = "#421814";
                  }
                  if($json[$i][$j]){
                    echo '<td style="background-color: '.$bg_color_td.'">
                          <button class="btn btn-lg btn-block center-block block Lobster">Q</button>
                         </td>';
                  } else{
                    echo '<td style="background-color: '.$bg_color_td.'">
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
      <div class="row">
        <div class="text-center col-xs-12 col-lg-8 col-lg-offset-2">
          <?php
            echo '<p class="Lobster">'.$_COOKIE['json'].'</p>';
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
