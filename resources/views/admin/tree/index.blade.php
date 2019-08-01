@extends('admin/layouts/default')

@section('header_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/Treant.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/basic-example.css') }}">

  <!-- end of page level css-->
@stop

@section('content')
	<section class="content-header">
    <!--section starts-->
    <h1>Tree</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">Admin</a>
        </li>
        <li class="active">Tree</li>
    </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="chart" id="example"></div>
			</div>
		</div>
	</section>
@stop

@section('footer_scripts')
		<style>
			/*circle{
				fill: white;
				stroke: silver;
				width: 80px;
				height: 40px;
				stroke-width: 2;
			}*/
			rect {
				fill: #ebebeb;
				stroke: #ebebeb;
				width: 100px;
				height: 100px;
				stroke-width: 2;
			}
			path {
				fill: none;
				stroke: #666;
			}
			text {
				dominant-baseline: middle;
				text-anchor: middle;
			}
			.bigger {
				font-size: 13px;
			}
			.img-fluid {
				width: 60px;
				height: 60px;
				display: block;
				dominant-baseline: middle;
				text-anchor: middle;
				margin-right: auto;
				margin-left: auto;
			}
		</style>
    <script type="text/javascript" src="{{ asset('assets/tree/Treant.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/tree/basic-example.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/tree/raphael.js') }}" ></script>
    <script src='https://unpkg.com/panzoom@8.0.0/dist/panzoom.min.js'></script>
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script>
      // new Treant( chart_config );
      $( document ).ready(function() {
      	var element = document.querySelector('#bah')
				// And pass it to panzoom
				panzoom(element);
			});
			var svg = d3.select("#example").append("svg")
				.attr("width",1000).attr("height",500)
				.append("g").attr("transform", "translate(-300,0)")
				.attr('id', 'bah');
			$.ajax({
			    type: 'GET', //THIS NEEDS TO BE GET
			    url: '/admin/membership',
			    success: function (data) {
			      var data = data[0];
			      console.log(data)
			   //    var data = {
						//   "name": "A1",
						//   "img":"https://img.icons8.com/bubbles/2x/user.png",
						//   "level":"Silver",
						// 	  "children": [
						// 	    {
						// 	      "name": "B1",
						//   			"img":"https://img.icons8.com/bubbles/2x/user.png",
						//   			"level":"Silver",
						// 	      "children": [
						// 	        {
						// 	          "name": "C1",
						//   					"img":"https://img.icons8.com/bubbles/2x/user.png",
						//   					"level":"Silver",
						// 	        },
						// 	        {
						// 	          "name": "C2",
						//   					"img":"https://img.icons8.com/bubbles/2x/user.png",
						//   					"level":"Silver",
						// 	        },
						// 	        {
						// 	          "name": "C3",
						// 	          "img":"https://img.icons8.com/bubbles/2x/user.png", 
						// 	          "level":"Silver",
						// 	        }
						// 	      ]
						// 	    },
						// 	    {
						// 	      "name": "B2",
						// 	      "img":"https://img.icons8.com/bubbles/2x/user.png",
						// 	      "level":"Silver",
						// 	      "children": [
						// 	        {
						// 	          "name": "C4",
						//   					"img":"https://img.icons8.com/bubbles/2x/user.png",
						//   					"level":"Silver",
						// 	        },
						// 	        {
						// 	          "name": "C5",
						//   					"img":"https://img.icons8.com/bubbles/2x/user.png",
						//   					"level":"Silver",
						// 	        },
						//         ]
						// 	    },
						// 	    {
						// 	      "name": "B3",
						// 	      "img":"https://img.icons8.com/bubbles/2x/user.png",
						// 	      "level":"Silver",
						// 	      "children": [
						// 	        {
						// 	          "name": "C6",
						//   					"img":"https://img.icons8.com/bubbles/2x/user.png",
						//   					"level":"Silver",
						// 	        },
						//         ]
						// 	    }
						// 	  ]
						// }
						// console.log(data)
						// var dataStructure = d3.stratify()
						// 	.id(function(d){return d.id;})
						// 	.parentId(function(d){return d.sponsor_id;})
						// 	(this.data);
						var treeStructure = d3.tree().size([800,270]);
						var root = d3.hierarchy(data);
						treeStructure(root);
						var information = treeStructure(root);
						// console.log(information.descendants());
						
						var connections = svg.append("g").selectAll("path")
							.data(information.links());

						connections.enter().append("path")
							.attr("d", function(d){
								return "M" + d.source.x + "," + d.source.y + " v 100 H" +
								d.target.x + " V" + d.target.y;
							});

						var rectangles = svg.append("g").selectAll("rect")
							.data(information.descendants());
						rectangles.enter().append("rect")
							.attr("x", function(d){return d.x-50;})
							.attr("y", function(d){return d.y-20;});

						// var circles = svg.append("g").selectAll("circle")
						// 	.data(information.descendants());
						// circles.enter().append("circle")
						// 	.attr("cx", function(d){return d.x})
						// 	.attr("cy", function(d){return d.y})
						// 	.attr("r", 5);

						var names = svg.append("g").selectAll("text")
							.data(information.descendants());
						names.enter().append("text")
							.text(function(d){return "Name : " + d.data.name;})
							.attr("x", function(d){return d.x+0;})
							.attr("y", function(d){return d.y+50;})
							.classed("bigger", true);

						var levels = svg.append("g").selectAll("text")
							.data(information.descendants());
						levels.enter().append("text")
							.text(function(d){return "Level : " + d.data.level;})
							.attr("x", function(d){return d.x+0;})
							.attr("y", function(d){return d.y+70;})
							.classed("bigger", true);

						var image = svg.append("g").selectAll("image")
							.data(information.descendants());
						image.enter().append("image")
							.attr("xlink:href", function(d){return d.data.img})
							.attr("x", function(d){return d.x-30;})
							.attr("y", function(d){return d.y-20;})
							.classed("img-fluid", true);
			    },
			    error: function() { 
			      console.log("Error");
			    }
			});

    </script>
@stop