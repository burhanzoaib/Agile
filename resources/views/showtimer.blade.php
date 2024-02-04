<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session Timer</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

  <h2>Session Timer</h2>
  <label for="timeInput">Enter time in seconds:</label>
  <input type="number" id="timeInput" placeholder="Enter time in seconds">
  <button id="startTimer">Start Timer</button>

  <div id="timerDisplay"></div>

  <script>
    $(document).ready(function () {
      var timer;

      function startSessionTimer(seconds) {
        // Clear any existing timers
        clearTimeout(timer);

        var endTime = new Date().getTime() + seconds * 1000;

        function updateTimerDisplay() {
          var currentTime = new Date().getTime();
          var remainingTime = endTime - currentTime;
          var secondsRemaining = Math.ceil(remainingTime / 1000);

          if (secondsRemaining > 0) {
            $("#timerDisplay").text("Time remaining: " + secondsRemaining + " seconds");
            timer = setTimeout(updateTimerDisplay, 1000);
          } else {
            // Session expired, you can perform logout or other actions here
            $("#timerDisplay").text("Session expired!");
            alert("Session expired!");
          }
        }

        updateTimerDisplay();
      }

      $("#startTimer").on("click", function () {
        var timeInput = $("#timeInput").val();

        if (timeInput !== "") {
          var seconds = parseInt(timeInput, 10);
          startSessionTimer(seconds);
        }
      });
    });
  </script>

</body>
</html>
