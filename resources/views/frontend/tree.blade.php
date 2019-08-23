@extends('frontend.default')
@section('title')
    Tree
    @parent
@stop

@section('content')

    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel">Register</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			    <form action="{{route('member.register-downline')}}" method="POST">
							@csrf
							<input type="text" name="parent" id="parent" value="" hidden>
							<input type="text" name="position" id="position" value="" hidden>
							<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-line">
									<input class="form-control" name="username" id="username" type="text" min="3" required>
									<label class="form-label">Username</label>
								</div>
							</div>
							<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
								<div class="form-line form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
									<input class="form-control" name="first_name" id="first_name" type="text" min="2" required>
									<label class="form-label">First Name</label>
								</div>
								<div class="form-line form-group form-float col-lg-6 col-md-6 col-sm-6 col-xs-6">
									<input class="form-control" name="last_name" id="last_name" type="text" min="2" required>
									<label class="form-label">Last Name</label>
								</div>
							</div>
							<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-line">
									<input class="form-control" name="email" id="email" type="email" min="3" required>
									<label class="form-label">Email</label>
								</div>
							</div>
							<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-line">
									<input class="form-control" name="number_phone" id="number_phone" type="number" min="10" required>
									<label class="form-label">Phone Number</label>
								</div>
							</div>
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-line">
									<input type="text" name="birthdate" class="datepicker form-control" placeholder="Birthdate" required>
								</div>
							</div>
							<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h5 class="card-inside-title">Gender</h5>
                            <div class="demo-radio-button">
								<input name="gender" type="radio" value="1" class="with-gap radio-col-red" checked />
								<label for="male">Male</label>
								<input name="gender" type="radio" value="0" class="with-gap radio-col-red" />
								<label for="female">Female</label>
							</div>
							</div>
							<div class="modal-footer">
								<a class="btn btn-secondary" data-dismiss="modal">Close</a>
								<input type="submit" class="btn btn-primary" value="Register">
							</div>
						</form>
			</div>
		  </div>
		</div>
	  </div>

	<section class="content ecommerce-page">
		<div class="block-header">
			<div class="row">
				<div class="col-lg-7 col-md-6 col-sm-12">
					<h2>Tree
					<small class="text-muted">Bitrexgo</small>
					</h2>
				</div>
			</div>
		</div>
		<div class="container-fluid">        
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12">
					<div class="card">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<br>
									<div class="chart" id="tree"></div>

									<!-- <div class="chart" id="basic-example"></div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop

@section('footer_scripts')
		<style>
			rect {
				fill: #ebebeb;
				stroke: #ebebeb;
				width: 150px;
				height: 190px;
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
    <script>
      // new Treant( chart_config );
      $(document).ready(function() {
      	var element = document.querySelector('#bah')
				// And pass it to panzoom
				panzoom(element);
			});
			var svg = d3.select("#tree").append("svg")
				.attr("width",1040).attr("height",600)
				.append("g").attr("transform", "translate(-750,-80)")
				.attr('id', 'bah');
			$.ajax({
			    type: 'GET', //THIS NEEDS TO BE GET
			    url: '{{route("member.select.tree")}}',
			    success: function (data) {
					var treeStructure = d3.tree().size([2000,480]);

					var root = d3.hierarchy(data).sort(function(a, b) {return a.data.position - b.data.position ;});
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
						.attr("x", function(d){return d.x-75;})
						.attr("y", function(d){return d.y-50;});
						
					var names = svg.append("g").selectAll("text")
						.data(information.descendants());
					names.enter().append("text")
						.text(function(d){return d.data.username ? d.data.username : 'Available';})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+40;})
						.classed("bigger", true);

					var levels = svg.append("g").selectAll("text")
						.data(information.descendants());
					levels.enter().append("text")
						.text(function(d){return d.data.rank ? "Rank : " + d.data.rank : '';})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+60;})
						.classed("bigger", true)

					var pv_left = svg.append("g").selectAll("text")
						.data(information.descendants());
					pv_left.enter().append("text")
						.text(function(d){return d.data.pv_left >= 0 ? "L : " + d.data.pv_left : '';})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+80;})
						.classed("bigger", true);

					var pv_midle = svg.append("g").selectAll("text")
						.data(information.descendants());
					pv_midle.enter().append("text")
						.text(function(d){return d.data.pv_midle >= 0 ? "M : " + d.data.pv_midle : ''})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+100;})
						.classed("bigger", true);

					var pv_right = svg.append("g").selectAll("text")
						.data(information.descendants());
					pv_right.enter().append("text")
						.text(function(d){return d.data.pv_right >= 0 ? "R : " + d.data.pv_right : ''})
						.attr("x", function(d){return d.x+0;})
						.attr("y", function(d){return d.y+120;})
						.classed("bigger", true);

					var image = svg.append("g").selectAll("image")
						.data(information.descendants());
					image.enter().append("a")
						.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
					    .attr("value", function(d){return d.data.username ? d.data.username : "available"})
					    .attr("href","#")
						.append("image")
						.attr("xlink:href", function(d){return "https://img.icons8.com/bubbles/2x/user.png"})
						.attr("x", function(d){return d.x-30;})
						.attr("y", function(d){return d.y-40;})
						.classed("img-fluid", true);
			    },
			    error: function() { 
			      console.log("Error");
				}
			});

			var tree_submit = (a, parent, position) => {
                if(a!="available"){
                     
				}else{
					$('#register').modal('show');
					$('#parent').attr('value',parent);
					$('#position').attr('value',position);
				}
			};
    </script>
@stop