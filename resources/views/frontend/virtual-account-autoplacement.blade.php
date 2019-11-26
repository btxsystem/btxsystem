@extends('frontend.default')
@section('title')
    Virtual Account
    @parent
@stop

@section('content')

<section class="content ecommerce-page">
	<div class="block-header">
		<div class="row">
			<div class="col-lg-12 col-md-6 col-sm-12">
				<h2 class="pull-left">Virtual Account
				<small class="text-muted">Bitrexgo</small>
				</h2>
			</div>
            <div class="clearfix">

            </div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="container-fluid">
						<div>
							<div class="col-md-12">
                                <br>
                                <div class="container-fluid h-100 bg-light text-dark">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                            <center>
                                                <img src="{{asset('img/bca.png')}}" alt="" srcset="" style="width:150px">
                                            </center>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                            <center>
                                                <h5>BCA Virtual Account Number</h5>
                                                <div class="form-line focused success">
                                                <input style="color:green; font-size:25px; font-weight:bold; text-align:center;" type="text" class="form-control" id="va" name="va" value="{{$profile['no_invoice']}}" readonly>
                                                </div>
                                                <br>
                                                <button type="button" class="btn btn-raised bg-grey waves-effect" style="cursor:pointer" id="copy">Copy</button>
                                            </center>
                                            <br><br>
                                            <center><h5>Nominal Transfer : {{number_format($profile['amount'],0,",",".");}} (Include fee)</h5></center>
                                            <br><br>
                                            <center><h5>Transfer Sebelum : {{$profile['expired']}} (Include fee)</h5></center>
                                            <br><br>
                                            <b><p style="font-size:10px">Bagaimana cara melakukan Pembayaran BCA Virtual Account ?</p></b>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <h5>1. ATM BCA</h5>
                                            <ul style="font-size:12px">
                                                <li>
                                                    <p>Masukkan kartu ATM dan PIN BCA anda</p>
                                                </li>
                                                <li>
                                                    <p>Pilih menu TRANSAKSI LAINNYA > TRANSFER > KE REKENING BCA VIRTUAL ACCOUNT</p>
                                                </li>
                                                <li>
                                                    <p id="des_noreq">Masukkan {{$profile['no_invoice']}} sebagai rekening tujuan</p>
                                                </li>
                                                <li>
                                                    <p>Masukkan jumlah transfer sesuai detail transaksi. (Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar).</p>
                                                </li>
                                                <li>
                                                    <p>Ikuti instruksi untuk menyelesaikan transaksi</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <h5>2. KLIK BCA</h5>
                                            <ul style="font-size:12px">
                                                <li>
                                                    <p>Masuk ke website KLIK BCA</p>
                                                </li>
                                                <li>
                                                    <p>Pilih menu TRANSFER DANA > TRANSFER KE BCA VIRTUAL ACCOUNT</p>
                                                </li>
                                                <li>
                                                    <p id="des_noreq2">Masukkan {{$profile['no_invoice']}} sebagai rekening tujuan</p>
                                                </li>
                                                <li>
                                                    <p>Masukkan jumlah transfer sesuai detail transaksi. Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar.</p>
                                                </li>
                                                <li>
                                                    <p>Ikuti instruksi untuk menyelesaikan transaksi</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <br><br>
                                            <h5>3. m-BCA (BCA MOBILE)</h5>
                                            <ul style="font-size:12px">
                                                <li>
                                                    <p>Masuk ke aplikasi mobile m-BCA</p>
                                                </li>
                                                <li>
                                                    <p>Pilih menu M-TRANSFER > BCA VIRTUAL ACCOUNT</p>
                                                </li>
                                                <li>
                                                    <p id="des_noreq3">Masukkan {{$profile['no_invoice']}} sebagai rekening tujuan</p>
                                                </li>
                                                <li>
                                                    <p>Masukkan jumlah transfer sesuai detail transaksi. Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar.</p>
                                                </li>
                                                <li>
                                                    <p>Masukkan PIN m-BCA Anda</p>
                                                </li>
                                                <li>
                                                    <p>Ikuti instruksi untuk menyelesaikan transaksi</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
</style>
<script>
</script>
@stop
