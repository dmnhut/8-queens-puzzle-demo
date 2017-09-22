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

function Try(row, n) {
  for (var i = 0; i < n; i++) {
    if (row === inputRow) {
      if (row === n - 1) {
        Out();
        break;
      } else {
        Try(row + 1, n);
        continue;
      }
    }
    if (
      col[i] === 0 &&
      left[row + i] === 0 &&
      right[row - i + n - 1] === 0 &&
      i !== inputCol
    ) {
      chessBoard[row][i] = 1;
      col[i] = 1;
      left[row + i] = 1;
      right[row - i + n - 1] = 1;
      if (row === n - 1) {
        Out();
      } else {
        Try(row + 1, n);
        chessBoard[row][i] = 0;
        col[i] = 0;
        left[row + i] = 0;
        right[row - i + n - 1] = 0;
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
