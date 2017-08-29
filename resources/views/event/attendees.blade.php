@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 col-md-offset-">
			<h1>Attendees</h1>
			<div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
            </div>
			<div class="panel panel-default">
				<div class="panel-body">
					<form id="frm-example" action="{{route('printAllUserQr')}}" method="GET">
						<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th>Name</th>
									<th>Amount</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($attendees as $attendee)
								<tr>
									<td><input type="checkbox" value="{{$attendee->profileId}}"></td>
									<td>{{ $attendee->firstname . " " . $attendee->lastname }}</td>
									<td>&#8369;{{ $attendee->ilUnitPrice }}</td>
									<td></td>
									<td>
										<a class='btn btn-success' href="{{ route('printUserId', ['id'=>$attendee->profileId]) }}"><span class="fa fa-id-card"></span></a>
										<a class='btn btn-success' href="{{ route('printUserQr', ['id'=>$attendee->profileId]) }}"><span class="fa fa-qrcode"></span></a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<form method="GET" action="{{ route('registerMember', $eventId) }}">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Attendee</h4>
				</div>
				<div class="modal-body">

					<div class="col-md-8 col-md-offset-2">
						<center>
							<label for="memberId">Existing Member</label>
							<select class="selectpicker" id="memberId" name="memberId" data-show-subtext="true" data-live-search="true">
								<option value="">-Select Member-</option>
								@foreach($members as $member)
									<option value="{{ $member->profileId }}" data-subtext="{{$member->firstname." ".$member->middlename}}">{{$member->lastname}}</option>
								@endforeach
						      </select>
					     </center>
					</div>
					<div class="col-md-12" style="padding-bottom: 20px;">
						<center>
							<p>or</p>
							<a class="btn btn-info" href="{{ url('admin/kyc/new') }}">Create new member</a>
						</center>
					</div>

				</div>
				<div class="modal-footer" style="clear: both;">
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

		   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
			  chkbox_select_all.checked = false;
			  if('indeterminate' in chkbox_select_all){
				 chkbox_select_all.indeterminate = false;
			  }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
			  chkbox_select_all.checked = true;
			  if('indeterminate' in chkbox_select_all){
				 chkbox_select_all.indeterminate = false;
			  }

		   // If some of the checkboxes are checked
		   } else {
			  chkbox_select_all.checked = true;
			  if('indeterminate' in chkbox_select_all){
				 chkbox_select_all.indeterminate = true;
			  }
		   }
		}

		var rows_selected = [];
		var table = $("#example").DataTable({
			'columnDefs': [{
			 'targets': 0,
			 'searchable':false,
			 'orderable':false,
			 'width':'1%',
			 'className': 'dt-body-center',
			 'render': function (data, type, full, meta){
				 return '<input type="checkbox">';
			 }},{
              'targets': 4,
              'searchable':false,
              'orderable': false,
              'className': 'dt-body-center',
              'width': '13%'
             }],
			 "dom": '<"toolbar">frtip'
		 });
		// $('<button id="refresh">Print</button>').appendTo('div.dataTables_filter');
		$("div.toolbar").html("<button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal'><span class='fa fa-plus'></span> Add Attendee</button>  <button class='btn btn-primary printSelected'><span class='fa fa-qrcode'> - (<span class='selectedCount'>0</span> Selected)</button>");
		var count = 0;
		 // Handle click on checkbox
	   $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
		  var $row = $(this).closest('tr');

		  // Get row data
		  var data = table.row($row).data();

		  // Get row ID
		  var rowId = $(data[0]).val();

		  // Determine whether row ID is in the list of selected row IDs 
		  var index = $.inArray(rowId, rows_selected);

		  // If checkbox is checked and row ID is not in list of selected row IDs
		  if(this.checked && index === -1){
			 rows_selected.push(rowId);
			 count++;

		  // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
		  } else if (!this.checked && index !== -1){
			 rows_selected.splice(index, 1);
			 count--;
		  }

		  $(".selectedCount").html(count);

		  if(this.checked){
			 $row.addClass('selected');
		  } else {
			 $row.removeClass('selected');
		  }

		  // Update state of "Select all" control
		  updateDataTableSelectAllCtrl(table);

		  // Prevent click event from propagating to parent
		  e.stopPropagation();
	   });

	   // Handle click on table cells with checkboxes
	   $('#example').on('click', 'tbody td, thead th:first-child', function(e){
		  $(this).parent().find('input[type="checkbox"]').trigger('click');
	   });

	   // Handle click on "Select all" control
	   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
		  if(this.checked){
			 $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
		  } else {
			 $('#example tbody input[type="checkbox"]:checked').trigger('click');
		  }

		  // Prevent click event from propagating to parent
		  e.stopPropagation();
	   });

	   // Handle table draw event
	   table.on('draw', function(){
		  // Update state of "Select all" control
		  updateDataTableSelectAllCtrl(table);
	   });

	   // Handle form submission event 
	   $(document).on('click', '.printSelected', function(e){
			// e.preventDefault();
		 var form = $('form');
		  $.each(rows_selected, function(index, rowId){
			$(form).append(
				 $('<input>')
					.attr('type', 'hidden')
					.attr('name', 'id[]')
					.val(rowId)
			 );
			console.log(rowId);
		  });

		  // // FOR DEMONSTRATION ONLY     
		  
		  // // Output form data to a console     
		  // $('#example-console').text($(form).serialize());
		  console.log("Form submission", $(form).serialize());
		   
		  // // Remove added elements
		  // $('input[name="id\[\]"]', form).remove();
		   
		  // // Prevent actual form submission
		  // e.preventDefault();
	   });
</script>
@endsection