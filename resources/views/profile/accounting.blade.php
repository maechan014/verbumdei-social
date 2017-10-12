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
							<!-- This form is to add an account -->
								<div class="col-sm-12 shadow-box" id="side-header">
											<ul class="nav navbar-nav pull-left">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								 ACCOUNTS
									<span class="caret"></span>
								</a>
									<ul class="dropdown-menu" role="menu">
												@if (isset($accounts))
													@foreach($accounts as $key => $account)
														@if (is_int($key))
															<li class="" value="{{ $accounts[$key]->accName }}">
														<a href="">{{ $accounts[$key]->accName }}</a>
													</li>
														@else
															@if($key == 'accName')
															<li class="" value="">
																<a href="">{{ $accounts->$key }}</a>
															</li>								
															@endif
														@endif
														
													@endforeach
												@endif
								  <li>
									  <a class="btn" data-toggle="modal" data-target="#add-account" type="button" id="">Add Account</a>
								  </li>
								</ul>
												</li>
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
				<div class="col-sm-9">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12" id="main-content">
								<div class="shadow-box">
									<div class="content-header">
										<h5>New Entry</h5>
									</div>

									<form method="POST" action="" role="form">
										{{ csrf_field() }}
										<div class="form-horizontal">
											<div class="form-group">
												<div class="col-sm-6 group-margin">
													<div class="input-group">
														<div class="input-group-addon">₱</div>
														<input type="text" name="amount" id="" class="form-control required invalid" placeholder="Amount" value="">
													</div>
												</div>

												<div class="col-sm-6">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
														<input type="text" name="payer" id="payer" class="form-control required invalid" placeholder="Payer" value="">
													</div>
												</div>
											</div>
										</div>

										<div class="form-horizontal">
											<div class="form-group">
												<div class="col-sm-6 group-margin">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
														<input type="date" name="a_date" id="a_date" class="form-control required" placeholder="Date" data-date-format="yyyy-mm-dd" data-toogle="dropdown" value="<?php echo date("Y-m-d");?>">
													</div>
												</div>

												<div class="col-sm-6">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i></div>
														<input type="text" name="a_tax" id="a_tax" class="form-control required invalid" placeholder="Tax" value="">
													</div>
												</div>
											</div>
										</div>

										<div class="form-horizontal">
												<div class="form-group">
													<div class="col-sm-6 group-margin">
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></div>
															<select class="form-control" id="a-category" name="a-category">
																<option selected disabled>Categories</option>
																<option>Bills</option>
																<option>Education</option>
																<option>Food</option>
																<option>Insurance</option>
															</select>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-paypal" aria-hidden="true"></i></div>
															<select class="form-control" id="a_paymentMethod" name="a_paymentMethod">
																<option selected disabled>Payment Method</option>
																<option>ATM</option>
																<option>Bank</option>
																<option>Credit Card</option>
																<option>Debit Card</option>
															</select>
														</div>
													</div>
											</div>
										</div>

										<div class="form-horizontal">
											<div class="form-group">
												<div class="col-sm-6 group-margin">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></div>
														<select class="form-control" id="a_status" name="a_status">
																<option selected disabled>Status</option>
																<option>Cleared</option>
																<option>Void</option>
																<option>Uncleread</option>
															</select>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
														<input type="text" name="a_refChequeNo" id="a_refChequeNo" class="form-control required invalid" placeholder="Reference/Cheque No.">
													</div>
												</div>
											</div>
										</div>
		
										<div class="form-horizontal collapse-options collapse" id="more-options">
											<div class="form-group">
												<div class="col-md-6 col-sm-12 group-margin">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></div>
														<input type="text" name="a_description" id="a_description" class="form-control" placeholder="Description">
													</div>
												</div>

												<div class="col-md-6 col-sm-12">
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-paperclip" aria-hidden="true"></i></div>
														<input name="a_attachment" id="a_attachment" class="form-control" placeholder="Attachment" type="file">						
													</div>
												</div>
											</div>

											<div class="form-group">
													<div class="col-sm-6 group-margin">
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i></div>
															<input type="text" name="a_tag" id="a_tag" class="form-control required invalid" placeholder="Tags" value="">
														</div>
													</div>

													<div class="col-sm-6">
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
															<input type="text" name="a_quantity" id="a_quantity" class="form-control required invalid" placeholder="Quantity" value="">
														</div>
													</div>
											</div>
										</div>

										<div class="form-horizontal options">
											<div class="col-sm-6">
												<span class="show-options btn btn-link" data-toogle="collapse" data-target="#more-options">
														<span class="glyphicon glyphicon-menu-down"></span>More Options
												</span>
											</div>

											<div class="form-group">
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary">
										Save
									</button>
								</div>
							</div>
										</div>
												
									</form>
								</div>
							</div>
							<!-- #main-content -->
						</div>
					</div>
				</div>
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

</script>
@endsection