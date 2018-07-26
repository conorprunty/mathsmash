/*
* operator.js *
* Rev 1 *
* 18/04/2015 *
*
* @author Eoin Sutton, Conor Prunty, David Byrne, Ciaran Byrne, Kevin Clarke *
*/ 

       //numbers
      var num1, num2, ans, count = 0,
          correct = 0,
          timer;

      function begin() {
		  scoreUpdate();
          setNum();
          show();
          countdownTimer(15000);
          hideBegin();
      }

      function setNum() {
          //set numbers
          num1 = document.getElementById("firstnum").innerHTML = (Math.floor(
              Math.random() * 100));
          num2 = document.getElementById("secondnum").innerHTML = (Math.floor(
              Math.random() * 100));
          $('#firstnum').val(num1);
          $('#secondnum').val(num2);
          $('#currentScore').val(correct);
          $('#totalPlays').val(count);
          //calculate
          var mul = num1 * num2;
          var add = num1 + num2;
          var sub = num1 - num2;
          var div = num1 / num2;
          //array
          var arr;
          if (div == 0) {
              arr = [mul, add, sub];
          } else {
              arr = [mul, add, sub, div];
          }
          ans = arr[parseInt(Math.random() * arr.length)];
          $('#ans').val(ans);
      }

      function mul() {
          if (num1 * num2 == ans) {
              count++;
              correct = correct + 1;
              setNum();
          } else {
              count++;
			  correct = correct - 1;
              setNum();
          }
      }

      function add() {
          if (num1 + num2 == ans) {
              count++;
              correct = correct + 1;
              setNum();
          } else {
              count++;
			  correct = correct - 1;
              setNum();
          }
      }

      function sub() {
          if (num1 - num2 == ans) {
              count++;
              correct = correct + 1;
              setNum();
          } else {
              count++;
			  correct = correct - 1;
              setNum();
          }
      }

      function div() {
          if (num1 / num2 == ans) {
              count++;
              correct = correct + 1;
              setNum();
          } else {
              count++;
			  correct = correct - 1;
              setNum();
          }
      }