<?php
include 'connect.php';
?>

<?php
$query = "SELECT * FROM complaint WHERE general_user_ID = 1";
$result = mysqli_query($con, $query);

// type 1 unsatisfied feedback
$countQuery = "SELECT COUNT(*) AS total_complaints FROM complaint WHERE complaint_type = 'unsatisfiedFeedback' AND general_user_ID = 1";
$countResult = mysqli_query($con, $countQuery);
$row = mysqli_fetch_assoc($countResult);
$totalComplaints = $row['total_complaints'];

// type 2 lack clarity
$countQuery2 = "SELECT COUNT(*) AS total_complaints FROM complaint WHERE complaint_type = 'lackClarity' AND general_user_ID = 1";
$countResult2 = mysqli_query($con, $countQuery2);
$row2 = mysqli_fetch_assoc($countResult2);
$totalComplaints2 = $row2['total_complaints'];

// type 3 wrong research area
$countQuery3 = "SELECT COUNT(*) AS total_complaints FROM complaint WHERE complaint_type = 'wrongResearchArea' AND general_user_ID = 1";
$countResult3 = mysqli_query($con, $countQuery3);
$row3 = mysqli_fetch_assoc($countResult3);
$totalComplaints3 = $row3['total_complaints'];

// complex query to retrieve the general user name

// $query1 = "SELECT c.*, gu.general_user_name
// FROM complaint c
// INNER JOIN general_user gu ON c.general_user_ID = gu.general_user_ID
// WHERE c.general_user_ID = 1;
// ";

// $result1 = mysqli_query($con, $query1);

// if ($row5 = mysqli_fetch_assoc($result1)) {
//   $complaintID = $row5['complaint_ID'];
//   // Retrieve other complaint details as needed
//   $generalUserName = $row5['general_user_name'];
//   // Continue processing or display the retrieved data
// } else {
//   // No complaint found
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Count'],
        ['Unsatisfied Feedback', <?php echo $totalComplaints; ?>],
        ['Lack Clarity', <?php echo $totalComplaints2; ?>],
        ['Wrong Research Area', <?php echo $totalComplaints3; ?>]
        // Add other data rows if needed
      ]);

      var options = {
        title: 'Complaint Types',
        pieHole: 0.4 // Set a value between 0 and 1 for the size of the hole in the center of the pie chart (optional)
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <?php
  include_once('../common/navbar.html');
  ?>
  <div class="container-fluid" style="width:600px; margin-top:20px;">
    <h4>
      <center>Complaint Report</center>
    </h4>
    <div class="container" style="width: 600px">
      <p>
        <center style="font-weight: bold;">This pie chart represents the distribution of complaint types recorded.
        </center>
      </p>
    </div>
  </div>


  <!-- <div class="mb-3 container-fluid" style="margin-top: 50px;">
    <label for="com-name" class="form-label">Name</label>
    <div class="col-md-2">
      <input name="expert" type="text" class="form-control" id="" value="<?php echo $generalUserName; ?>" disable readonly>
    </div>
  </div> -->

  <div class="container-fluid pie-chart" id="piechart" style="width: 900px; height: 500px;"></div>

  <style>
    .pie-chart {
      border-radius: 10px;
    }
  </style>


</body>

</html>