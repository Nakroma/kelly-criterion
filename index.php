<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>The Kelly Criterion</title>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-xs-2 col-md-4"></div>
        <div class="col-md-col-xs-16 col-sm-6 col-md-4">

          <center><h1>The Kelly Criterion</h1></center>
          <br>

          Your Bankroll
          <div class="input-group">
            <span class="input-group-addon" id="bankrolldesc">$</span>
            <input type="text" class="form-control" id="bankroll" aria-describedby="bankrolldesc" placeholder="2.99">
          </div><br>

          CSGL Odds (Team 1 / Team 2)
          <div class="input-group">
            <span class="input-group-addon" id="odddesc">%</span>
            <div class="row">
              <div class="col-md-6"><input type="text" class="form-control" id="csgl1" aria-describedby="bankrolldesc" placeholder="70"></div>
              <div class="col-md-6"><input type="text" class="form-control" id="csgl2" aria-describedby="bankrolldesc" placeholder="30"></div> 
            </div>
          </div><br>

          Your Odds (Team 1 / Team 2)
          <div class="input-group">
            <span class="input-group-addon" id="odddesc">%</span>
            <div class="row">
              <div class="col-md-6"><input type="text" class="form-control" id="real1" aria-describedby="bankrolldesc" placeholder="60"></div>
              <div class="col-md-6"><input type="text" class="form-control" id="real2" aria-describedby="bankrolldesc" placeholder="40"></div> 
            </div>
          </div><br>

          <br>
          <button class="btn btn-default btn-block" onclick="calculate();">Calculate</button><br><br>

          <div id="output">

          </div>
        </div>
        <div class="col-xs-2 col-md-4"></div>
      </div>
    </div>

    <script>
        var bankroll = document.getElementById("bankroll");
        var csgl1 = document.getElementById("csgl1");
        var csgl2 = document.getElementById("csgl2");
        var real1 = document.getElementById("real1");
        var real2 = document.getElementById("real2");

      function calculate() {
        if (bankroll.value != "" && csgl1.value != "" && csgl2.value != "" && real1.value != "" && real2.value != "") {
          var c1 = csgl1.value/100;
          var c2 = csgl2.value/100;
          var r1 = real1.value/100;
          var r2 = real2.value/100;
          var fraction = ((c1 / c2) * r2 - r1) / (c1 / c2);

          var value = bankroll.value * fraction;
          value = +value.toFixed(2);

          var str = "<center>The Kelly Criterion says:<br><h4>";

          if (c1 > c2) {
            if (r1 < c1) {
              str += "You should bet $" + value + " on Team 2";
            } else if (r1 > c1) {
              value = Math.abs(value);
              str += "You should bet $" + value + " on Team 1";
            }
          } else if (c1 < c2) {
            if (r2 < c2) {
              value = Math.abs(value);
              str += "You should bet $" + value + " on Team 1";
            } else if (r2 > c2) {     
              str += "You should bet $" + value + " on Team 2";
            }
          } else {
            if (r1 < c1) {
              str += "You should bet $" + value + " on Team 2";
            } else if (r1 > c1) {
              value = Math.abs(value);
              str += "You should bet $" + value + " on Team 1";
            } else {
              str += "This match is a coin toss";
            }
          }

          str += "</h4>Suggested Bet: $" + (value/3).toFixed(2) + " (<a href='#' data-toggle='tooltip' data-placement='right' title='Due to human error and/or luck, it is suggested to take only 1/2, 1/3 or even 1/4 of the Kelly Criterion'>?</a>)</center>";

          document.getElementById("output").innerHTML = str;

          $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
        }
      }

      csgl1.onkeyup = function() {
        if (csgl1.value >= 0 && csgl1.value <= 100) {
          csgl2.value = 100 - csgl1.value;
        }
      }

      csgl2.onkeyup = function() {
        if (csgl2.value >= 0 && csgl2.value <= 100) {
          csgl1.value = 100 - csgl2.value;
        }
      }

      real1.onkeyup = function() {
        if (real1.value >= 0 && real1.value <= 100) {
          real2.value = 100 - real1.value;
        }
      }

      real2.onkeyup = function() {
        if (real2.value >= 0 && real2.value <= 100) {
          real1.value = 100 - real2.value;
        }
      }

      
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>

</html>