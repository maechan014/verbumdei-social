@extends('layouts.app')

@section('content')
	<div  class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="container-fluid" id="acc-content">
      	<div class="row">
      		<div class="col-sm-3">
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-sm-12 shadow-box" id="side-header">
    							<div class="navbar-collapse collapse">
    								<ul class="nav navbar-nav pull-left">
    									<li class="dropdown">
    										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                         ACCOUNTS
                        	<span class="caret"></span>
                      	</a>
                    		<ul class="dropdown-menu" role="menu">
                          <li>
                              <!-- @if(Session::get('usertype') == 'CLIENT')
                                  <a href="{{ url('profile') }}">Profile</a>
                                  <a href="{{ url('personal-accounting') }}">Personal Accounting</a>
                              @endif -->
                              <a href="{{ url('accounting/add-account') }}">Add Account</a>
                          </li>
                      	</ul>
    									</li>
    								</ul>
    							</div>
      					</div>
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
	      						<form action="" method="POST" name="" class="">

	      							<div class="form-horizontal">
	      								<div class="form-group">

	      									<div class="col-sm-6">
	      										<div class="input-group">
	      											<div class="input-group-addon">₱</div>
	      											<input type="text" name="amount" id="" class="form-control required invalid" placeholder="Amount">
	      										</div>
	      									</div>

	      									<div class="col-sm-6">
	      										<div class="input-group">
	      											<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
	      											<input type="text" name="payee" id="" class="form-control required invalid" placeholder="Payee">
	      										</div>
	      									</div>
	      								</div>
	      							</div>

	      							<div class="form-horizontal">
	      								<div class="form-group">

	      									<div class="col-sm-6">
	      										<div class="input-group">
	      											<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
	      											<input type="date" name="a_date" id="" class="form-control required" placeholder="Date" data-date-format="yyyy-mm-dd" data-toogle="dropdown" value="">
	      										</div>
	      									</div>

	      									<div class="col-sm-6">
	      										<div class="input-group">
	      											<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
	      											<input type="text" name="payee" id="" class="form-control required invalid" placeholder="Payee">
	      										</div>
	      									</div>
	      								</div>
	      							</div>

	      							<div class="form-horizontal">
	      									<div class="form-group">

	      										<div class="col-sm-6">
		      										<div class="input-group">
		      											<div class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></div>
		      											<select name="category" class="form-control">
		      												<option value="" disabled selected>Categories</option>
		      												<option value="">Bills</option>
		      												<option value="">Education</option>
		      												<option value="">Food</option>
		      												<option value="">Insurance</option>
		      												<option value="">Housing</option>
		      												<option value=""value="" >Debt</option>
		      											</select>
		      										</div>
		      									</div>

		      									<div class="col-sm-6">
		      										<div class="input-group">
		      											<div class="input-group-addon"><i class="fa fa-paypal" aria-hidden="true"></i></div>
		      											<select name="category" class="form-control">
		      												<option value="" disabled="disabled" selected>Payment Method</option>
		      												<option value="">ATM</option>
		      												<option value="">Cash</option>
		      												<option value="">Bank</option>
		      												<option value="">Credit Card</option>
		      												<option value="">Debit Card</option>
		      											</select>
		      										</div>
		      									</div>
	      								</div>
	      							</div>

	      							<div class="form-horizontal">
	      								<div class="form-group">
	      									
	      									<div class="col-sm-6">
	      										<div class="input-group">
	      											<div class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></div>
	      											<select name="category" class="form-control">
	      												<option value="" disabled="disabled" selected>Status</option>
	      												<option value="">Cleared</option>
	      												<option value="">Uncleared</option>
	      												<option value="">Void</option>
	      											</select>
	      										</div>
		      								</div>

		      								<div class="col-sm-6">
	      										<div class="input-group">
	      											<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
	      											<input type="text" name="refNumber" id="" class="form-control required invalid" placeholder="Reference/Cheque No.">
	      										</div>
		      								</div>
	      								</div>
	      							</div>
	

	      							<div class="form-horizontal collapse-options collapse" id="more-options">
	      								<div class="form-group">

	      									<div class="col-md-6 col-sm-12">
	      										<input type="text" name="description" id="" class="form-control" placeholder="Description">
	      									</div>

	      									<div class="col-md-6 col-sm-12">
	      										<div class="input-group">
	      											<div class="input-group-addon"><i class="fa fa-paperclip" aria-hidden="true"></i></div>
	      											<input name="attachment" id="" class="form-control" placeholder="Attachment" type="file">						
	      										</div>
	      									</div>
      									</div>
      									<div class="form-group">
	      										<div class="col-sm-6">
		      										<div class="input-group">
		      											<div class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i></div>
		      											<input type="text" name="tags" id="" class="form-control required invalid" placeholder="Tags">
		      										</div>
		      									</div>

		      									<div class="col-sm-6">
		      										<div class="input-group">
		      											<div class="input-group-addon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
		      											<input type="text" name="quantity" id="" class="form-control required invalid" placeholder="Quantity">
		      										</div>
		      									</div>
	      								</div>
	      							</div>



	      							<div class="form-horizontal options">
	      								<div class="col-sm-12">
		      								<span class="show-options btn btn-link" data-toogle="collapse" data-target="#more-options">
				      								<span class="glyphicon glyphicon-menu-down"></span>More Options
				      						</span>
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
       } else {
       		$(".show-options")
              .empty()
              .append('<span class="glyphicon glyphicon-menu-down"></span>More Options') 
              showOption = true;
       }
    }); 
	});

</script>
@endsection