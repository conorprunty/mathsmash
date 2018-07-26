/*
* snap.js *
* Rev 1 *
* 18/04/2015 *
*
* @author Eoin Sutton, Conor Prunty, David Byrne, Ciaran Byrne, Kevin Clarke *
*/     
    
      var ran1, ran2, count = 0,
          correct = 0,
          myTime, timer;

      function begin() {
		  scoreUpdate();
          generateNums();
          hideBegin();
          setNum();
          countdownTimer(15000);
          myTime = setInterval(setBackgroundTimer, 550);
      }

      function setBackgroundTimer() {
          generateNums();
          randLeft();
          randRight();
      }

      function setNum() {
          show();
          hideBegin();
          randLeft();
          randRight();
          $('#currentScore').val(correct);
          $('#totalPlays').val(count);
      }

      function randLeft() {
          document.getElementById("leftBox").innerHTML = ran1;
      }

      function randRight() {
          document.getElementById("rightBox").innerHTML = ran2;
      }

      function checkNums() {
          if (ran1 == ran2) {
              correct=correct+3;
              count++;
          } else {
              correct--;
              count++;
          }
      }

      function snapFunction() {
          checkNums();
          generateNums();
          setNum();
      }

      function generateNums() {
          ran1 = parseInt(((Math.random() * 10) + 1));
          ran2 = parseInt(((Math.random() * 10) + 1));
      }