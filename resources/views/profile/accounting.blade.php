@extends('layouts.app')

@section('content')
	<div  class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="container-fluid" id="acc-content">
					<div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
			  <a href="#" class="close" data-dismiss="alert">&times;</a>
			  <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
		  </div>
			<div class="row">
				<div class="col-sm-3">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12 shadow-box" id="side-header">
								<ul class="nav navbar-nav pull-left">
									<li class="dropdown" value="">
										@if($status->success)
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" value="" name="currAccount">
													@if(Session::has('accName') )
														{{ Session::get('accName') }} 
													@endif
													
													<span class="caret" id="accounts"></span>
												</a>
			                  <ul class="dropdown-menu" role="menu" id="account_menu">
													@if (isset($accounts))
														@foreach($accounts as $key => $account)
															@if (is_int($key))
																<li class="" value="{{ $accounts[$key]->accName }}">
																	<span class="btn btn-link" value="{{ $accounts[$key]->accName }}">{{ $accounts[$key]->accName }}</span>
																</li>
															@elseif($key == 'accName')
																<li class="" value="{{ $accounts->accName }}">
																	<span class="btn btn-link" value="{{ $accounts->accName }}">{{ $accounts->accName }}</span>
																</li>
															@endif
														@endforeach
													@endif
												  <li>
													  <a class="btn" data-toggle="modal" data-target="#add-account" type="button" id="">Add Account</a>
												  </li>
												</ul>
			             	@else
			                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" value="">
													ACCOUNTS
													<span class="caret" id="accounts"></span>
												</a>
												<ul class="dropdown-menu" role="menu" id="account_menu">
												  <li>
													  <a class="btn" data-toggle="modal" data-target="#add-account" type="button" id="">Create Account</a>
												  </li>
												</ul>
			             	@endif			
									</li>
									<!-- .dropdown -->
								</ul>
							</div>
							@include('accounting.addAccount')		
							<!-- #side-header -->
						</div>

						<div class="row">
							<div class="summary">
								<div class="col-sm-12 summary-item summary-income">
									<span class="summary-number">Php 0.00</span>
									<span class="summary-title">Income</span>
								</div>
								<div class="col-sm-12 summary-item summary-expense">
									<span class="summary-number">Php 0.00</span>
									<span class="summary-title">Expense</span>
								</div>
								<div class="col-sm-12 summary-item summary-balance">
									<span class="summary-number">Php 0.00</span>
									<span class="summary-title">Balance</span>
								</div>
							</div>
							<!-- .summary -->
						</div>
					</div>
				</div>

				@if($status->success)
					@include('accounting.income')
				@else
					@include('accounting.prompt')	
				@endif

				

			</div>
		
		</div>
	  <!-- #acc-content -->
			</div>
		</div>
	</div>
	<!-- .container -->
@endsection

@section('script')
<script type="text/javascript">

	var showOption = true;

	$(document).ready(function(){
		$(".show-options").click(function(){
	   	$(".collapse-options").collapse('toggle');
	   	if (showOption){
				$(".show-options")
			  .empty()
			  .append('<span class="glyphicon glyphicon-menu-up"></span>Less Options') 
			  showOption = false;
	   	}
	   	else {
			$(".show-options")
			  .empty()
			  .append('<span class="glyphicon glyphicon-menu-down"></span>More Options') 
			  showOption = true;
	  	}
	 	});
  });

/*  $(document).ready(function(e){
  	$('#account_menu li').click(function(){
  		var child = $(this).value;
		  console.log(child);
		});
  });*/

</script>
@endsection