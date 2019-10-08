@extends('layouts.admin')
{{-- Page title --}}
@section('title')
Tree
@parent
@stop
{{-- Page content --}}
@section('content')
<!-- 
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
						<div>
							<b style="color:red" id="username_danger"></b>
						</div>
					</div>
					<div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
						<div class="form-line col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<input class="form-control" name="first_name" id="first_name" type="text" min="2" required>
							<label class="form-label">First Name</label>
						</div>
						<div class="form-line col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
							<input class="form-control" name="nik" id="number_phone" type="number" min="10" required>
							<label class="form-label">NIK / Passport</label>
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
							<input name="gender" type="radio" value="1" id="male" class="with-gap radio-col-red" checked />
							<label for="male">Male</label>
							<input name="gender" type="radio" value="0" id="female" class="with-gap radio-col-red" />
							<label for="female">Female</label>
						</div>
					</div>
					<div class="modal-footer">
						<a class="btn btn-secondary" data-dismiss="modal">Close</a>
						<input type="submit" class="btn btn-primary register" value="Register">
					</div>
				</form>
			</div>
		</div>
	</div>
</div> -->

<!--<div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="modal-warning" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-warning">Warning!!!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>You do not have enough points, you must refill!</h5>
			</div>
			<div class="modal-footer">
				<a class="btn btn-secondary" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>-->
	

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
	<div class="card" style="background-color:white;">
		<div class="container-fluid">
			<div>
				<div class="col-md-12">
					<h3>Detail Summary</h3>
					<hr>
					<div class="row col-md-12">
						<div class="col-md-4">
							<h5 id="_name"></h5>
						</div>
						<div class="col-md-4">
							<h5 id="_username"></h5>
						</div>
						<div class="col-md-4">
							<h5 id="_id_member"></h5>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-4">
							<h5 id="_pv_pairing_l"></h5>
						</div>
						<div class="col-md-4">
							<h5 id="_pv_pairing_m"></h5>
						</div>
						<div class="col-md-4">
							<h5 id="_pv_pairing_r"></h5>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-4">
							<h5 id="_pv_group_l"></h5>
						</div>
						<div class="col-md-4">
							<h5 id="_pv_group_m"></h5>
						</div>
						<div class="col-md-4">
							<h5 id="_pv_group_r"></h5>
						</div>
					</div>
					<hr>
					<div class="row col-md-12">
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="container">
        <table class="table table-striped">
           <tbody>
              <tr>
                 <td colspan="1">
                       <fieldset>
                            <div class="form-group">
								<br>
								<div class="col-md-12 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-male"></i></span>
										<select name="sponsor_id" id="sponsor_id" class="form-control cari" value="{{old('sponsor_id')}}"></select>
									</div>
								</div>
								<br><br>
                            </div>
                       </fieldset>
                    </form>
                 </td>
              </tr>
           </tbody>
        </table>
    </div>
	<div class="container-fluid">        
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<br>
								<div class="chart" id="tree">
									<button id="upline" class='btn btn-primary fa fa-sort-up'></button>
								</div>
								
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
			fill: #eeeeee;
			stroke: #ebebeb;
			width: 150px;
			height: 190px;
			stroke-width: 2;
			cursor: pointer;
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
	<script src="{{ asset('assets/tree/panzoom.js') }}"></script>
	<script src="{{ asset('assets/tree/d3.js') }}"></script>
	<script type="text/javascript">
		
		var dataUser = '';
		var parent_id = null;
        $(document).ready(function () {
			var element = document.querySelector('#bah');
			panzoom(element);
            $('.cari').select2({
            placeholder: "Select member...",
            ajax: {
                url: '{{ route("select.sponsor") }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
                },
                minimumInputLength: 2,
            });
        });

		$('.cari').on('select2:select', function (e) {
			// var dataUser = ;
			$.ajax({
				
				type: 'GET',

				url: '/member/select/child-tree/'+e.params.data.text,
				success: function (data) {
					$('#bah').empty('g');
					tree(data);
				},
				error: function() { 
					console.log("Error");
				}
			});
		});

		$('#upline').click(function(){
			$.ajax({
				type: 'GET',
				url: '/member/select/tree-upline/'+parent_id,
				success: function (data) {
					parent_id = data.parent_id;
					$('#bah').empty('g');
					tree(data);
					if (!data.parent) {
						$('#upline').hide();
					}
				},
				error: function() {
					console.log("Error");
				}
			});
		})

		var svg = d3.select("#tree").append("svg")
			.attr("width",1190).attr("height",600)
			.append("g").attr("transform", "translate(-750,-50)")
			.attr('id', 'bah');

		var tree_submit = (a, parent, position) => {
			parent_id = parent;
			if(a!="available"){
				$.ajax({
					type: 'GET',
					url: '/member/select/child-tree/'+a,
					success: function (data) {
						$('#bah').empty('g');
						//$('#upline').show();
						tree(data)
					},
					error: function() { 
						console.log("Error");
					}
				});
			}else{
				$.ajax({
					type: 'GET',
					url: '/member/select/bitrex-points',
					success: function (data) {
						if (data.bitrex_points >= 280) {
							$('#register').modal('show');
							$('#parent').attr('value',parent);
							$('#position').attr('value',position);		
						}else{
							$('#warning').modal('show');
						}
					},
					error: function() { 
						console.log("Error");
					}
				});
			}
		};

		var tree = (data) => {
			$.ajax({
            url: '/member/select/summary/'+data.id,
            success:function(data){
				$('#_name').text('Name: ' + data.member.first_name + ' ' +data.member.last_name);
				$('#_username').text('Username: ' + data.member.username);
				$('#_id_member').text('Id Member: ' + data.member.id_member);
				data.pairings ? $('#_pv_pairing_l').text('PV Pairing L: ' + addCommas(data.pairings.pv_left)) : $('#_pv_pairing_l').text('PV Pairing L: 0 ') ;
				data.pairings ? $('#_pv_pairing_m').text('PV Pairing M: ' + addCommas(data.pairings.pv_midle)) : $('#_pv_pairing_m').text('PV Pairing M: 0 ');
				data.pairings ? $('#_pv_pairing_r').text('PV Pairing R: ' + addCommas(data.pairings.pv_right)) : $('#_pv_pairing_r').text('PV Pairing R: 0 ');
				data.pv_group ? $('#_pv_group_l').text('PV Rank L: ' + addCommas(data.pv_group.pv_left)) : $('#_pv_group_l').text('PV Rank: 0 ');
				data.pv_group ? $('#_pv_group_m').text('PV Rank M: ' + addCommas(data.pv_group.pv_midle)) : $('#_pv_group_m').text('PV Rank: 0 ');
				data.pv_group ? $('#_pv_group_r').text('PV Rank R: ' + addCommas(data.pv_group.pv_right)) : $('#_pv_group_r').text('PV Rank: 0 ');
				}
			});
			parent_id = data.parent_id;
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
				.attr("onclick", function(d){ return `tree_submit(${d.data.username ? `'${d.data.username}'` : `'${"available"}'`}, ${d.data.parent_id}, ${d.data.position} )` })
				.attr("value", function(d){return d.data.username ? d.data.username : "available"})
				.attr("href","#")
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
				.text(function(d){return d.data.pv_left >= 0 ? "L : " + addCommas(d.data.pv_left) : '';})
				.attr("x", function(d){return d.x+0;})
				.attr("y", function(d){return d.y+80;})
				.classed("bigger", true);

			var pv_midle = svg.append("g").selectAll("text")
				.data(information.descendants());
			pv_midle.enter().append("text")
				.text(function(d){return d.data.pv_midle >= 0 ? "M : " + addCommas(d.data.pv_midle) : ''})
				.attr("x", function(d){return d.x+0;})
				.attr("y", function(d){return d.y+100;})
				.classed("bigger", true);

			var pv_right = svg.append("g").selectAll("text")
				.data(information.descendants());
			pv_right.enter().append("text")
				.text(function(d){return d.data.pv_right >= 0 ? "R : " + addCommas(d.data.pv_right) : ''})
				.attr("x", function(d){return d.x+0;})
				.attr("y", function(d){return d.y+120;})
				.classed("bigger", true);

			var image = svg.append("g").selectAll("image")
				.data(information.descendants());
			image.enter().append("a")
				.append("image")
				.attr("xlink:href", function(d){return "https://img.icons8.com/bubbles/2x/user.png"})
				.attr("x", function(d){return d.x-30;})
				.attr("y", function(d){return d.y-40;})
				.classed("img-fluid", true);
		}

    </script>
@stop