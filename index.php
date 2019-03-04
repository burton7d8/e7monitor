<?php
/*
The MIT License (MIT)
Copyright (c) 2019 pon & ont eth port monitor
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
/*
jquery.js
Copyright JS Foundation and other contributors, https://js.foundation/
Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:
The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
/*
moment-min.js
Copyright (c) JS Foundation and other contributors
Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:
The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/
/*
charts.js
The MIT License (MIT)
Copyright (c) 2018 Chart.js Contributors
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
/*
chartjs-plugin-streaming
The MIT License (MIT)
Copyright (c) 2018 Akihiko Kusanagi
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/



$e7s = array('node-name-1','node-name-2','node-name-3');  // add your e7 nodes here
asort($e7s); // remove this line if you want them in your own set order above



if(!$op)
{
	print "<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-1.10.1.js\"></script>";

	print "
	  <script type=\"text/javascript\">
	   function showMe (box) {
	    var chboxs = document.getElementById(box).style.display;
	    var vis = \"none\";
		if(chboxs==\"none\"){
		 vis = \"block\";
		document.getElementById('mon_ont').value = \"yes\";
		 }
		if(chboxs==\"block\"){
		 vis = \"none\"; 
		document.getElementById('mon_ont').value = \"\";
		}

	    document.getElementById(box).style.display = vis;
	}
	</script>";

        print "<center>";
        print "<font size=5>E7 PON / ETH PORT MONITOR</font><br><br>";
        print "<form method=post>";
        print "<b>E7 NODE:</b><select name=node>";
        foreach($e7s as $key => $e7)
        {
                print "<option value=$e7>$e7</option>";
        }
        print "</select><br>";

        print "<b>SHELF:</b><select name=shelf>";
        for($shelf=1;$shelf <= 6;$shelf++)
        {
                print "<option value=$shelf>$shelf</option>";
        }
        print "</select><br>";

        print "<b>SLOT:</b><select name=slot>";
        print "<option value=1>1</option>";
        print "<option value=2>2</option>";
        print "<select><br>";

        print "<b>PON:</b><select name=pon>";
        for($pon=1;$pon <= 8;$pon++)
        {
                print "<option value=$pon>$pon</option>";
        }
        print "</select><br>";

        print "<b>PON DOWN MAX Mb:</b><input type=text size=5 maxlenght=4 name=pondownmax value=2500><br>";
        print "<b>PON UP MAX Mb:</b><input type=text size=5 maxlenght=4 name=ponupmax value=1250><br><br>";



	print "<input type=\"checkbox\" name=\"check1\" value=\"checkbox\" onchange=\"showMe('ont_div')\" /> ONT MONITOR<br><br>";

	print "<div id=\"ont_div\" style=\"display:none;\">";

        print "<b>ONT ID:</b><input type=text size=5 maxlenght=4 name=ont><br>";

        print "<b>ONT TYPE:</b><select name=ont_type>";
        print "<option value=\"---\">Please Choose Your ONT Type</option>";
        print "<option value=\"normal\">800 Series</option>";
        print "<option value=\"halfer\">700 Series</option>";
        print "</select><br>";
	print "<i>NOTE: 812G-V2's can lock up when using this tool <br> [ also not all ont types have been tested, use at your own discretion ]</i> <br><br>";
        
	print "<b>ONT ETH PORT:</b><select name=ethport>";
        for($ethport=1;$ethport <= 8;$ethport++)
        {
                print "<option value=$ethport>$ethport</option>";
        }
        print "</select><br>";


        print "<b>ONT ETH DOWN MAX Mb:</b><input type=text size=5 maxlenght=4 name=ethdownmax value=1000><br>";
        print "<b>ONT ETH UP MAX Mb:</b><input type=text size=5 maxlenght=4 name=ethupmax value=1000><br>";
	
	print "</div><br><br>";

        print "<input type=hidden id=\"mon_ont\" name=mon_ont value=\"\">";
        print "<input type=hidden name=op value=\"go\">";
        print "<input type=submit value=\"GO\">";
        die();
}
elseif($op == "go")
{

        $node = $_POST["node"];
        $shelf = $_POST["shelf"];
        $slot = $_POST["slot"];
        $pon = $_POST["pon"];
        $pondownmax = $_POST["pondownmax"];
        $ponupmax = $_POST["ponupmax"];
        $ont = $_POST["ont"];
        $ont_type = $_POST["ont_type"];
        $ethport = $_POST["ethport"];
        $ethdownmax = $_POST["ethdownmax"];
        $ethupmax = $_POST["ethupmax"];
        


	if($mon_ont == "yes")
	{
		if($ont_type == "---" || !$ont)
		{
			print "<center>";
			if(!$ont)
				print "<font size=5 color=red>YOU MUST SPECIFY AN ONT ID!</font><br><br>";
			if($ont_type == "---")
				print "<font size=5 color=red>YOU MUST CHOSE AN ONT TYPE!</font><br><br>";
			

			print "
			<form method=post>
			<input type=hidden name=op value=''>
			<input type=submit value='BACK'>
			</form>
			</center>";
			
					
			die();
		}

		if($ont_type == "halfer")
		{
			$sleeper = 6000;
			$slower = "yes";
		}
		else
			$sleeper = 5000;
	}
	else
		$sleeper = 5000;

	$pon_url = "query2.php?node=$node&shelf=$shelf&slot=$slot&pon=$pon&type=pon&slower=$slower";
        $eth_url = "query2.php?node=$node&ont=$ont&ethport=$ethport&type=eth&ont_type=$ont_type&slower=$slower";
	$starttime = time() * 1000;
}

?>

<html>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script type="text/javascript" src="https://github.com/nagix/chartjs-plugin-streaming/releases/download/v1.7.1/chartjs-plugin-streaming.min.js"></script>

<div style="width:880px; margin:auto;">
<canvas id="chart1"></canvas>
</div>
<div style="width:880px; margin:auto;">
<canvas id="chart2"></canvas>
</div>


<script>
//what you can do to make it less cpu intense
//options: {
//        animation: {
//            duration: 0                    // general animation time
//        },
//        hover: {
//            animationDuration: 0           // duration of animations when hovering an item
//        },
//        responsiveAnimationDuration: 0,    // animation duration after a resize
//        plugins: {
//            streaming: {
//                frameRate: 5               // chart is drawn 5 times every second
//            }
//        }
//    }
				//duration: 50000,   //can set this for faster chart but less kept data
				//ttl: 60000, 
				//refresh: 3000, 
				//delay: 5000,


var starttime = Date.now();

var ctx1 = document.getElementById('chart1').getContext('2d');
var chart1 = new Chart(ctx1, {
type: 'line',
data: { 
	datasets: [{
		data: [],
		label: 'DOWNLOAD Mb',
		borderColor: 'rgb(255, 99, 132)',
		backgroundColor: 'rgba(255, 99, 132, 0.5)',
		lineTension: 0
		//borderDash: [8, 4]
	}, 
	{
		data: [],
		label: 'UPLOAD Mb',
		borderColor: 'rgb(54, 162, 235)',
		backgroundColor: 'rgba(54, 162, 235, 0.5)'
	}] 
},
options: {
	title: {
		display: true,
		text: '<?php print "$node-$shelf-$slot-$pon GPON PORT USAGE OUT OF $pondownmax/$ponupmax Mb";?>'
	}, 
	scales: { 
		xAxes: [{
		  type: 'realtime',
		  realtime: { 
				duration: 300000, 
				//ttl: 300000, 
				refresh: <?php print $sleeper?>, 
				delay: <?php print $sleeper?>,
		                onRefresh: function(chart) 
				{
					if(window.starttime == "stop")
						return;
					//answer = Date.now() - <?php print "$starttime";?>;
					//console.log(answer);
					//if((Date.now() - <?php print "$starttime";?>) >= 40000)
					if((Date.now() - window.starttime) >= 600000)
					{
						//alert("Done");
						return;
					}
					$.ajax({
						url: '<?php print $pon_url;?>',
						dataType: 'json',
						async: true,
						success:  function(data) {
							//console.log("im here ajax");
							//console.log(data);
							chart.data.datasets[0].data.push({
								x: data[0][0],
								y: data[0][1]
							});
							
							chart.data.datasets[1].data.push({
								x: data[1][0],
								y: data[1][1]
							});
						},
						cache: false
					})
					 .fail(function() {
					    console.log( "fail" );
					  })
					 .error(function() {
					    console.log( "error" );
					  });
					//console.log("==================");
                    		}
			}
			}], 
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'Current Rate (Mb)'
				}
			}] 
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		}
	}
});
<?php
	if($mon_ont != "yes")
	{
		print "
		</script>
		<center>
		<form method=post>
		<input type=hidden name=op value=''>
		<input type=submit value='BACK'>
		</form>
		</center>

		</html>";
		die();
	}
?>

var ctx2 = document.getElementById('chart2').getContext('2d');
var chart2 = new Chart(ctx2, {
type: 'line',
data: { 
	datasets: [{
		data: [],
		label: 'DOWNLOAD Mb',
		borderColor: 'rgb(255, 99, 132)',
		backgroundColor: 'rgba(255, 99, 132, 0.5)',
		lineTension: 0
		//borderDash: [8, 4]
	}, 
	{
		data: [],
		label: 'UPLOAD Mb',
		borderColor: 'rgb(54, 162, 235)',
		backgroundColor: 'rgba(54, 162, 235, 0.5)'
	}] 
},
options: { 
	title: {
		display: true,
		text: 'ONT: <?php print "$ont ";?> ETHERNET PORT: <?php print "$ethport USAGE OUT OF $ethdownmax/$ethupmax Mb";?>'
	}, 
	scales: { 
		xAxes: [{
		  type: 'realtime',
		  realtime: { 
				duration: 300000, 
				//ttl: 300000, 
				refresh: <?php print $sleeper?>, 
				delay: <?php print $sleeper?>,
		                onRefresh: function(chart) 
				{
					if(window.starttime == "stop")
						return;

					//answer = Date.now() - <?php print "$starttime";?>;
					//answer = Date.now() - window.starttime;
					//console.log(answer);
					//var currentTime = new Date();
					//console.log(currentTime.getHours() + ":" + currentTime.getMinutes() + ":" + currentTime.getSeconds());
					//if((Date.now() - <?php print "$starttime";?>) >= 40000)
					if((Date.now() - window.starttime) >= 600000)
					{
						//console.log("in confirm 1");
						if(confirm("Graph has Timed Out! Click OK to continue or CANCEL to quit."))
						{
							//console.log("in confirm 2 ");
							
							window.starttime = Date.now();
						}
						else
						{
							//console.log("in else");
							window.starttime = "stop";
							return;
						}
					}
					$.ajax({
						url: '<?php print $eth_url;?>',
						dataType: 'json',
						async: true,
						success:  function(data) {
							//console.log("im here ajax");
							//console.log(data);
							chart.data.datasets[0].data.push({
								x: data[0][0],
								y: data[0][1]
							});
							
							chart.data.datasets[1].data.push({
								x: data[1][0],
								y: data[1][1]
							});
						},
						cache: false
					})
					 .fail(function() {
					    console.log( "fail" );
					  })
					 .error(function() {
					    console.log( "error" );
					  });
					//console.log("==================");
                    		}
			}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'Current Rate (Mb)'
				}
			}] 
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		}
	}
});
</script>
<center>
<form method=post>
<input type=hidden name=op value=''>
<input type=submit value='BACK'>
</form>
</center>

</html>
