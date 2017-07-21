<?php
$conn=mysqli_connect("localhost","root","","finances");
if(!$conn)
	die("Connection failed: ".mysqli_connect_error());
$sector=$_POST["sector_year-sector"];
$year=$_POST["sector_year-year"];
$sql_c="select company from ".$sector.";";
$res_c=mysqli_query($conn,$sql_c);
if (! $res_c){
   throw new My_Db_Exception('Database error: ' . mysql_error());
}
$data_array = array();
$i=0;
while($rs = mysqli_fetch_array($res_c,MYSQLI_ASSOC))
{	
    $data_array[$i]=$rs['company'];
    $i++;
}

$sql_y="select ".$year." from ".$sector.";";

$res_y=mysqli_query($conn,$sql_y);
if (! $res_y){
   throw new My_Db_Exception('Database error: ' . mysql_error());
}
$year_array = array();
$j=0;
while($res = mysqli_fetch_array($res_y,MYSQLI_ASSOC))
{	
    $year_array[$j]=$res[$year];
    $j++;
}
echo"sector-year";
mysqli_close($conn);

?>
<!Doctype html>
<html>
<head>
<title>Sector-Year</title>
<script src="https://d3js.org/d3.v4.min.js"></script>
<style>
body {
text-align:center;
 margin-left:30vw;
 height: 50%;
}
.bar {
  fill: #565656
}
</style>
</head>
<h1 style='text-align:center;margin-left:-35vw;padding-left:-15;color:#565656'>Sector-Year Comparison.</h1>
<?php
echo"
<body class='text' style='text-align:center;background-color:#e8b968'>	
</body>
<body class='graph' id='graph' style='margin:15vw;text-align:center;background-color:#e8b968'>
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
  <p style='text-align:center;margin-top:-95vw;margin-left:-42vw;padding-left:-12;color:#565656;font-size:2vw;'>$data_array[0]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data_array[1]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data_array[2]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data_array[3]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data_array[4]</p>

</body>
";
	?>

</html>