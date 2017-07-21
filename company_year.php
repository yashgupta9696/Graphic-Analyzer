<?php
$conn=mysqli_connect("localhost","root","","finances");
if(!$conn)
	die("Connection failed: ".mysqli_connect_error());
$sector=$_POST["company_year-sector"];
$company=$_POST["company_year-company"];
$sql_y="select one,two,three,four,five from ".$sector." where company='".$company."';";
echo "company_year";
$res_y=mysqli_query($conn,$sql_y);
if (! $res_y){
   throw new My_Db_Exception('Database error: ' . mysql_error());
}
$year_array = array();
$j=0;
while($res = mysqli_fetch_array($res_y,MYSQLI_ASSOC))
{	
    $year_array[0]=$res['one'];
    $year_array[1]=$res['two'];
    $year_array[2]=$res['three'];
    $year_array[3]=$res['four'];
    $year_array[4]=$res['five'];
}
mysqli_close($conn);

?>
<!Doctype html>
<html>
<head>
<title>Company-Year</title>
<script src="https://d3js.org/d3.v4.min.js"></script>
<style>
body {
text-align:center;
 margin-left:30vw;
 height: 50%;
}
.text {
  fill: white;
  font-family: sans-serif
}
.bar {
  fill: #e8b968;
}
</style>
</head>
<h1 style='text-align:center;margin-left:-35vw;padding-left:-15;color:#e8b968'>Company-Year Comparison</h1>
<?php
echo"
<body class='text' style='text-align:center;background-color:#565656'>	
</body>
<body class='graph' id='graph' style='margin:15vw;text-align:center;background-color:#565656'>
<script>
var bodyclass=document.getElementById('graph');
var dataArray = [$year_array[0],$year_array[1],$year_array[2],$year_array[3],$year_array[4]];
var svg = d3.select(bodyclass).append(\"svg\").attr(\"height\",\"500%\").attr(\"width\",\"500%\");
svg.selectAll(\"rect\")
    .data(dataArray)
    .enter().append(\"rect\")
          .attr(\"class\", \"bar\")
          .attr(\"height\", function(d, i) {return (d/300)})
          .attr(\"width\",\"40\")
          .attr(\"x\", function(d, i) {return (i*100)})
          .attr(\"y\", function(d, i) {return (100000-(d))/300});
          svg.selectAll('text')
    .data(dataArray)
    .enter().append('text')
    .text(function(d) {return d;}).attr(\"x\", function(d, i) {return (i*100)})
          .attr(\"y\", function(d, i) {return (100000-(d))/300});
  </script>
  <p style='text-align:center;margin-top:-95vw;margin-left:-42vw;padding-left:-15;color:#e8b968;font-size:2vw;'>2012&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2013&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2014&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2015&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2016</p>
</body>
";
	?>

</html>