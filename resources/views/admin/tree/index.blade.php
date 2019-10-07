@extends('layouts.admin')
{{-- Page title --}}
@section('title')
Tree
@parent
@stop
{{-- Page content --}}
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
				<div class="chart" id="example">
					
				</div>

				<!-- <div class="chart" id="basic-example"></div> -->
			</div>
		</div>
	</section>
@stop

@section('footer_scripts')
		<style>
			
			rect {
				fill: #eeeeee;
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
				.attr("width",1060).attr("height",500)
				.append("g").attr("transform", "translate(60,0)")
				.attr('id', 'bah');
			$.ajax({
			    type: 'GET', //THIS NEEDS TO BE GET
			    url: '{{route("tree.select")}}',
			    success: function (data) {
			      	var data = data;
					var treeStructure = d3.tree().size([1000,380]);

					var root = d3.hierarchy(data).sort(function(a, b) { return a.data.position - b.data.position ;});
					treeStructure(root);
					var information = treeStructure(root);
					
					var connections = svg.append("g").selectAll("path")
						.data(information.links());

					connections.enter().append("path")
						.attr("d", function(d){
							return "M" + d.source.x + "," + d.source.y + " v 150 H" +
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
						.text(function(d){return d.data.username;})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+70;})
						.classed("bigger", true);

					var levels = svg.append("g").selectAll("text")
						.data(information.descendants());
					levels.enter().append("text")
						.text(function(d){return "Rank : " + d.data.rank_id;})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+90;})
						.classed("bigger", true)

					var pv_left = svg.append("g").selectAll("text")
						.data(information.descendants());
					pv_left.enter().append("text")
						.text(function(d){return "L : " + 0})
						.attr("x", function(d){return d.x-40;})
						.attr("y", function(d){return d.y+110;})
						.classed("bigger", true);

					var pv_midle = svg.append("g").selectAll("text")
						.data(information.descendants());
					pv_midle.enter().append("text")
						.text(function(d){return "M : " + 0})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+110;})
						.classed("bigger", true);

					var pv_right = svg.append("g").selectAll("text")
						.data(information.descendants());
					pv_right.enter().append("text")
						.text(function(d){return "R : " + 0})
						.attr("x", function(d){return d.x+40;})
						.attr("y", function(d){return d.y+110;})
						.classed("bigger", true);

					var image = svg.append("g").selectAll("image")
						.data(information.descendants());
					image.enter().append("a")
						.attr("xlink:href", function(d){return "/"})
						.append("image")
						.attr("xlink:href", function(d){return "https://img.icons8.com/bubbles/2x/user.png"})
						.attr("x", function(d){return d.x-30;})
						.attr("y", function(d){return d.y-0;})
						.classed("img-fluid", true);
			    },
			    error: function() { 
			      console.log("Error");
			    }
			});

    </script>
@stop