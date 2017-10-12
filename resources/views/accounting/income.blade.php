<div class="col-sm-9">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12" id="main-content">
				<div class="shadow-box">
					<div class="content-header">
						<h5>New Entry</h5>
					</div>

					<form method="POST" action="">
						{{ csrf_field() }}
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-sm-6 group-margin">
									<div class="input-group">
										<div class="input-group-addon">₱</div>
										<input type="number" name="amount" id="" class="form-control required invalid" placeholder="Amount" value="" required>
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
						<!-- #more-options -->

						<div class="form-horizontal options">
							<div class="col-sm-6">
								<span class="show-options btn btn-link" data-toogle="collapse" data-target="#more-options">
										<span class="glyphicon glyphicon-menu-down"></span>More Options
								</span>
							</div>
							<div class="form-group">
								<div class="col-md-6" id="save_income">
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