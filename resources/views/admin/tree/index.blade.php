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
				fill: white;
				stroke: silver;
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
				panzoom(element)
			});

			var svg = d3.select("#example").append("svg")
				.attr("width",1000).attr("height",600)
				.append("g").attr("transform", "translate(-300,0)")
				.attr('id', 'bah');
			var data = [
				{"img":"https://img.icons8.com/bubbles/2x/user.png", "name":"Jarwo", "member":"id:1", "parent":"",},
				{"img":"https://img.icons8.com/bubbles/2x/user.png", "name":"Sutri", "member":"id:2", "parent":"id:1"},
				{"img":"https://img.icons8.com/bubbles/2x/user.png", "name":"Tejo", "member":"id:3", "parent":"id:4"},
				{"img":"https://img.icons8.com/bubbles/2x/user.png", "name":"Sulis", "member":"id:4", "parent":"id:1"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"bambang", "parent":"kevin"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"tukiyem", "parent":"kevin"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"gio", "parent":"kevin"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"haru", "parent":"sarah"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"ani", "parent":"sarah"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"jarwo", "parent":"sarah"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"suri", "parent":"marno"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"korim", "parent":"marno"},
				// {"img":"https://img.icons8.com/bubbles/2x/user.png", "member":"ida", "parent":"marno"},
			];
			var dataStructure = d3.stratify()
				.id(function(d){return d.member;})
				.parentId(function(d){return d.parent;})
				(data);
			var treeStructure = d3.tree().size([1500,400]);
			var information = treeStructure(dataStructure);
			console.log(information.descendants());
			
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
				.text(function(d){return d.data.name;})
				.attr("x", function(d){return d.x+0;})
				.attr("y", function(d){return d.y+50;})
				.classed("bigger", true);

			var image = svg.append("g").selectAll("image")
				.data(information.descendants());
			image.enter().append("image")
				.attr("xlink:href", function(d){return d.data.img})
				.attr("x", function(d){return d.x-30;})
				.attr("y", function(d){return d.y-20;})
				.classed("img-fluid", true);

    </script>
@stop