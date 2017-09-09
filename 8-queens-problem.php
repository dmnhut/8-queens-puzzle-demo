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
      color: #0d0d0d;
    }

    p {
      font-size: 16px;
      font-family: Monospace;
    }

    .block {
      background-color: #ffeead;
      color: black;
      border: 0px solid #000000;
    }

    .block:hover {
      background-color: #ffcc5c;
      color: white;
    }
  </style>
  <script>
    var chessBoard = [];
    var col = [];
    var left = [];
    var right = [];
    var json = "json";
    var num;
    var count = 0;
    var inputRow;
    var inputCol;

    function Go(x, y, n) {
      var args = Array.from(arguments);
      switch (args.length) {
        case 0:
          x = 0;
          y = 0;
          n = 8;
          break;
        case 1:
          x = 0;
          y = 0;
          n = args[0];
          break;
        case 2:
          x = args[0];
          y = args[1];
          n = 8;
          break;
        case 3:
          x = args[0];
          y = args[1];
          n = args[2];
          break;
        default:
          console.log("Fail");
          return;
      }
      for (var i = 0; i < n; i++) {
        chessBoard[i] = [];
      }
      for (i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
          chessBoard[i][j] = 0;
        }
      }
      for (i = 0; i < n; i++) {
        col[i] = 0;
      }
      for (i = 0; i < 2 * n - 1; i++) {
        left[i] = 0;
        right[i] = 0;
      }
      Input(n, x, y);
      Try(0, n);
      location.reload();
      Result();
    }

    function Input(n, x, y) {
      count = 0;
      num = n;
      inputRow = x;
      inputCol = y;
      chessBoard[inputRow][inputCol] = 1;
      col[inputCol] = 1;
      left[inputCol + inputRow] = 1;
      right[inputRow - inputCol + n - 1] = 1;
    }

    function Try(queen, n) {
      for (var i = 0; i < n; i++) {
        if (queen === inputRow) {
          if (queen === n - 1) {
            Out();
            break;
          } else {
            Try(queen + 1, n);
            continue;
          }
        }
        if (
          col[i] === 0 &&
          left[queen + i] === 0 &&
          right[queen - i + n - 1] === 0 &&
          i !== inputCol
        ) {
          chessBoard[queen][i] = 1;
          col[i] = 1;
          left[queen + i] = 1;
          right[queen - i + n - 1] = 1;
          if (queen === n - 1) {
            Out();
          } else {
            Try(queen + 1, n);
            chessBoard[queen][i] = 0;
            col[i] = 0;
            left[queen + i] = 0;
            right[queen - i + n - 1] = 0;
          }
        }
      }
    }

    function Out() {
      count++;
      json = JSON.stringify(chessBoard);
      document.cookie = "json=" + json;
      document.cookie = "num=" + num;
      document.cookie = "row=" + inputRow;
      document.cookie = "col=" + inputCol;
      document.cookie = "count=" + count;
    }

    function Result() {
      var arrFromCookie = document.cookie;
      arrFromCookie = JSON.parse(arrFromCookie.split(";")[0].replace("json=", ""));
      console.log(arrFromCookie.join("\n").split(",").join(" "));
    }
  </script>
</head>

<body>
  <div class="container container-fluid">
    <div class="jumbotron">
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
        <div class="col-xs-12">
          <table style="width: 80%; margin-left: 10%" class="table table-bordered">
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
                    echo '<td style="background-color: '.$bg_color_td.'">
                          <button class="btn btn-sm center-block block"><span class="glyphicon glyphicon-queen"></span></button>
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
      <!--<div class="row">
          <div class="text-center col-xs-12 col-lg-8 col-lg-offset-2">
            <table class="table table-hover">
              <tr>
                <td>
                  <?php
                  $result = $_COOKIE['json'];
                  echo '<p class="text-right">'.str_replace('],[', ']<br />[', $result).'</p>';
                ?>
                </td>
              </tr>
            </table>
          </div>
        </div>-->
    </div>
  </div>
</body>

</html>
