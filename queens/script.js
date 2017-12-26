var board = [];
var column = [];
var arrLeft = [];
var arrRight = [];
var json = "json";
var n;
var inputRow;
var inputCol;

function Go() {
  var args = Array.from(arguments);
  switch (args.length) {
    case 0:
      inputRow = 0;
      inputCol = 0;
      n = 8;
      break;
    case 1:
      inputRow = 0;
      inputCol = 0;
      n = args[0];
      break;
    case 2:
      inputRow = args[0];
      inputCol = args[1];
      n = 8;
      break;
    case 3:
      inputRow = args[0];
      inputCol = args[1];
      n = args[2];
      break;
    default:
      console.log("Fail");
      return;
  }
  var i, j;
  for (i = 0; i < n; i++) {
    board[i] = [];
  }
  for (i = 0; i < n; i++) {
    for (j = 0; j < n; j++) {
      board[i][j] = 0;
    }
  }
  for (i = 0; i < n; i++) {
    column[i] = 0;
  }
  for (i = 0; i < 2 * n - 1; i++) {
    arrLeft[i] = 0;
    arrRight[i] = 0;
  }
  Input();
  Try(0, n);
  location.reload();
  Result();
}

function Input() {
  board[inputRow][inputCol] = 1;
  column[inputCol] = 1;
  arrLeft[inputCol + inputRow] = 1;
  arrRight[inputRow - inputCol + n - 1] = 1;
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
    if (column[i] === 0 && arrLeft[row + i] === 0 && arrRight[row - i + n - 1] === 0 && i !== inputCol) {
      board[row][i] = 1;
      column[i] = 1;
      arrLeft[row + i] = 1;
      arrRight[row - i + n - 1] = 1;
      if (row === n - 1) {
        Out();
      } else {
        Try(row + 1, n);
        board[row][i] = 0;
        column[i] = 0;
        arrLeft[row + i] = 0;
        arrRight[row - i + n - 1] = 0;
      }
    }
  }
}

function Out() {
  json = JSON.stringify(board);
  arrFromJson = json;
  document.cookie = "json=" + json;
  document.cookie = "num=" + n;
  document.cookie = "row=" + inputRow;
  document.cookie = "col=" + inputCol;
}

function Result() {
  var arrFromCookie = document.cookie;
  arrFromCookie = JSON.parse(arrFromCookie.split(";")[0].replace("json=", ""));
  console.log(arrFromCookie.join("\n").split(",").join(" "));
}
