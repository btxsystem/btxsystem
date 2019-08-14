@extends('frontend.default')
@section('title')
    Tree
    @parent
@stop

@section('header_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/Treant.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/basic-example.css') }}">
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

				<!-- <div class="chart" id="basic-example"></div> -->
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
			.link {
				text-decoration: none;
				background: red;
				padding: 20px;
			}
			.img-fluid {
				width: 60px;
				height: 60px;
				display: block;
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
			    url: '{{route("member.select.tree")}}',
			    success: function (data) {
			      var data = data;
			      console.log(data)
						var treeStructure = d3.tree().size([1000,270]);

						var root = d3.hierarchy(data).sort(function(a, b) { return a.data.position - b.data.position ;});
						treeStructure(root);
						var information = treeStructure(root);
						
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
							
						var names = svg.append("g").selectAll("text")
							.data(information.descendants());
						names.enter().append("text")
							.text(function(d){return d.data.first_name;})
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
						image.enter().append("a")
							.attr("xlink:href", function(d){return "/"})
							.append("image")
							.attr("xlink:href", function(d){return "https://img.icons8.com/bubbles/2x/user.png"})
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