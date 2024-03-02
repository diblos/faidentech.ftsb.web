$(function() {
    "use strict";
    
    var cal2;
        var output2 = running2 = stop2 = ng2 = timepass2 = planOutpu2t = realTime2 = yiel2 = efficiency2 = warmup2 = utilization2 = availability2 = performance2 = quality2 = OEE2 = 0;
        
        var getCalculate2 = "";
                      $.ajax
                              ({
                                type: "POST",
                                url: "./data.php",
                                data: { "getCalculate": getCalculate },
                                success: function (result) {
                    
                                    cal2 = JSON.parse(result);
                                    
                                    running2 = parseInt(cal2["running"]);
                                    idle2 = parseInt(cal2["idle"]);
                                    stop2 = parseInt(cal2["stop"]);
                                    output2 = parseInt(cal2["output"]);
                                    ng2 = parseInt(cal2["ng"]);
                                    timepass2 = parseInt(cal2["timepass"]);
                                    planOutput2 = parseInt(cal2["planOutput"]);
                                    realTime2 = parseInt(cal2["realTime"]);
                                    yiel2 = parseInt(cal2["yield"]);
                                    efficiency2 = parseInt(cal2["efficiency"]);
                                    warmup2 = parseInt(cal2["warmup"]);
                                    utilization2 = parseInt(cal2["utilization"]);
                                    availability2 = parseInt(cal2["availability"]);
                                    performance2 = parseInt(cal2["performance"]);
                                    quality2 = parseInt(cal2["quality"]);
                                    OEE2 = parseInt(cal2["OEE"]);

     // chart 1
	 
		  var ctx = document.getElementById('chart1').getContext('2d');
		
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
					datasets: [{
						label: 'New Visitor',
						data: [3, 3, 8, 5, 7, 4, 6, 4, 6, 3],
						backgroundColor: '#fff',
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 3
					}, {
						label: 'Old Visitor',
						data: [7, 5, 14, 7, 12, 6, 10, 6, 11, 5],
						backgroundColor: "rgba(255, 255, 255, 0.25)",
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 1
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: false,
				  labels: {
					fontColor: '#ddd',  
					boxWidth:40
				  }
				},
				tooltips: {
				  displayColors:false
				},	
			  scales: {
				  xAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#ddd'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(221, 221, 221, 0.08)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#ddd'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(221, 221, 221, 0.08)"
					},
				  }]
				 }

			 }
			});  
		
		
    // chart 2

		var ctx2 = document.getElementById("chart2").getContext('2d');
		
		
			var myChart2 = new Chart(ctx2, {
				type: 'doughnut',
				data: {
					labels: ["Output", "Plan Output", "Warm-up", "Reject"],
					datasets: [{
						backgroundColor: [
							"#ffffff",
							"rgba(255, 255, 255, 0.70)",
							"rgba(255, 255, 255, 0.50)",
							"rgba(255, 255, 255, 0.20)"
						],
						data: [200, 100, 50, 150],
						borderWidth: [0, 0, 0, 0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"bottom",	
				 display: false,
				    labels: {
					  fontColor: '#ddd',  
					  boxWidth:15
				   }
				}
				,
				tooltips: {
				  displayColors:false
				}
			   }
			});
		

                                }
                              });
		
   });	 
   