<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">

  <!-- Image and text -->
  <nav class="navbar navbar-custom">
    <a class="navbar-brand" href="#" style="font-weight: bold;">
      Edspert
    </a>
  </nav>

  <title>Farming Monitoring and Automation <br></title>
  <script type="text/javascript" src="jquery/jquery.min.js"></script>

  <!-- load realtime data -->
  <script type="text/javascript">
    $(document).ready(function() {
      setInterval(function() {
        $.ajax({
          url: "ceksuhu.php",
          dataType: "json",
          success: function(data) {
            // Calculate the percentage for ceksuhu
            $("#ceksuhu").css("width", (data.value / data.maxValue * 100) + "%")
            // Update the progress bar
            $("#ceksuhu").attr("aria-valuemin", 0);
            $("#ceksuhu").attr("aria-valuemax", data.maxValue);
            $("#ceksuhu").attr("aria-valuenow", data.value);
            $("#ceksuhu").text(data.value);
            
            var minthresholdValue = 25;
            var maxthresholdValue = 35;
            if (data.value < minthresholdValue) {
            $("#ceksuhu").removeClass("bg-success");
            $("#ceksuhu").removeClass("bg-danger");
            $("#ceksuhu").addClass("bg-warning");
          } else if (data.value > maxthresholdValue){
            $("#ceksuhu").removeClass("bg-success");
            $("#ceksuhu").removeClass("bg-warning");
            $("#ceksuhu").addClass("bg-danger");
          }
          else{
            $("#ceksuhu").removeClass("bg-danger");
            $("#ceksuhu").removeClass("bg-warning");
            $("#ceksuhu").addClass("bg-success");
          }
        }
        });
        $.ajax({
          url: "cekkelembaban.php",
          dataType: "json",
          success: function(data) {
            // Calculate the percentage for ceksuhu
            $("#cekkelembaban").css("width", (data.value / data.maxValue * 100) + "%")
            // Update the progress bar
            $("#cekkelembaban").attr("aria-valuemin", 20);
            $("#cekkelembaban").attr("aria-valuemax", data.maxValue);
            $("#cekkelembaban").attr("aria-valuenow", data.value);
            $("#cekkelembaban").text(data.value);

            var minthresholdValue = 27;
            var maxthresholdValue = 53;
            if (data.value < minthresholdValue) {
            $("#cekkelembaban").removeClass("bg-success");
            $("#cekkelembaban").removeClass("bg-danger");
            $("#cekkelembaban").removeClass("bg-info");
            $("#cekkelembaban").addClass("bg-warning");
          } else if (data.value > maxthresholdValue){
            $("#cekkelembaban").removeClass("bg-success");
            $("#cekkelembaban").removeClass("bg-warning");
            $("#cekkelembaban").removeClass("bg-info");
            $("#cekkelembaban").addClass("bg-danger");
          }
          else{
            $("#cekkelembaban").removeClass("bg-danger");
            $("#cekkelembaban").removeClass("bg-warning");
            $("#cekkelembaban").removeClass("bg-info");
            $("#cekkelembaban").addClass("bg-success");
          }
          }
        });
        $.ajax({
          url: "cekldr.php",
          dataType: "json",
          success: function(data) {
            // Calculate the percentage for ceksuhu
            $("#cekldr").css("width", (data.value / data.maxValue * 100) + "%")
            // Update the progress bar
            $("#cekldr").attr("aria-valuemin", 0);
            $("#cekldr").attr("aria-valuemax", data.maxValue);
            $("#cekldr").attr("aria-valuenow", data.value);
            $("#cekldr").text(data.value);

            var minthresholdValue = 1352;
            var maxthresholdValue = 2703;
            if (data.value < minthresholdValue) {
            $("#cekldr").removeClass("bg-success");
            $("#cekldr").removeClass("bg-danger");
            $("#cekldr").addClass("bg-warning");
          } else if (data.value > maxthresholdValue){
            $("#cekldr").removeClass("bg-success");
            $("#cekldr").removeClass("bg-warning");
            $("#cekldr").addClass("bg-danger");
          }
          else{
            $("#cekldr").removeClass("bg-danger");
            $("#cekldr").removeClass("bg-warning");
            $("#cekldr").addClass("bg-success");
          }
          }
        });
        $.ajax({
          url: "cektanah.php",
          dataType: "json",
          success: function(data) {
            // Calculate the percentage for ceksuhu
            $("#cektanah").css("width", (data.value / data.maxValue * 100) + "%")
            // Update the progress bar
            $("#cektanah").attr("aria-valuemin", 0);
            $("#cektanah").attr("aria-valuemax", data.maxValue);
            $("#cektanah").attr("aria-valuenow", data.value);
            $("#cektanah").text(data.value);

            var minthresholdValue = 338;
            var maxthresholdValue = 675;
            if (data.value < minthresholdValue) {
            $("#cektanah").removeClass("bg-success");
            $("#cektanah").removeClass("bg-danger");
            $("#cektanah").addClass("bg-warning");
          } else if (data.value > maxthresholdValue){
            $("#cektanah").removeClass("bg-success");
            $("#cektanah").removeClass("bg-warning");
            $("#cektanah").addClass("bg-danger");
          }
          else{
            $("#cektanah").removeClass("bg-danger");
            $("#cektanah").removeClass("bg-warning");
            $("#cektanah").addClass("bg-success");
          }
          }
        });
      }, 1000);
    });
  </script>
</head>

<body>
  <div class="heading">
    <h1 id=title>Smart Farming Monitoring and Automation for Smart City</h1>
    <p id="description">IoT Bootcamp Edspert Final Project by group 5</p>
  </div>
  <fieldset class="content">
    <div id="main" class="container mt-5">
      <div>
        <div class="col-md-5">
          <h5 class="sensor-value"> Temperature </h5>
          <div class="progress mb-3 custom-progress" style="height: 30px;">
            <div id="ceksuhu" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="50">0</div>
          </div>
          <h5 class="sensor-value"> Air Humidity </h5>
          <div class="progress mb-3 custom-progress" style="height: 30px;">
            <div id="cekkelembaban" class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="20" aria-valuemax="80">0</div>
          </div>
          <h5 class="sensor-value"> Sunlight Exposure </h5>
          <div class="progress mb-3 custom-progress" style="height: 30px;">
            <div id="cekldr" class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="4095">0</div>
          </div>
          <h5 class="sensor-value"> Soil Moisture </h5>
          <div class="progress mb-3 custom-progress" style="height: 30px;">
            <div id="cektanah" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="1023">0</div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br><br>
  </fieldset>

  <footer class="footer">
    <p class="copyright">&copy;2023 Rendy Christian | All Rights Reserved</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>