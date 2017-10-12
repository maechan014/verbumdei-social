	
	<div class="container">
		
	</div>
	<div class="modal fade" id="add-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="col-md-12">
			 <div class="modal-dialog">
	        <div class="modal-content">

	            <!-- Modal Header -->
	            <div class="modal-header">
	                <button type="button" class="close" 
	                   data-dismiss="modal">
	                       <span aria-hidden="true">&times;</span>
	                       <span class="sr-only">Close</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">
	                    Add Account
	                </h4>
	            </div>
	            
	            <!-- Modal Body -->
	            <div class="modal-body">  

	              <form class="form-horizontal" method="POST" action="{{ route('accounting/addAccount', ['profileId'=>$user->profileId]) }}">
	              	{{ csrf_field() }}
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                    	<div class="input-group">
                    		<div class="input-group-addon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                    		<input type="text" class="form-control" name="accName" id="accName" placeholder="Acount Name"/>
                    	</div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                    	<div class="input-group">
                    		<div class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="accDescription" name="accDescription" placeholder="Description"/>
                    	</div>
                    		
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                    	<div class="input-group">
                    		<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
                    		<input type="number" class="form-control" id="accInitBalance" name="accInitBalance" placeholder="Initial Balance"/>
                    	</div>
                    </div>
                  </div>

			            <!-- Modal Footer -->
			            <div class="modal-footer">
		                	<button type="" class="btn btn-default" data-dismiss="modal">CANCEL</button>
		                	<button type="submit" class="btn btn-primary">SAVE</button>
			            </div>
	              </form>          
	            </div>
	        </div>
	        <!-- .modal-content -->
	    </div>
	    <!-- .modal-dialog -->
		</div>
	   
	</div>
