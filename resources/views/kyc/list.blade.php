@extends('layouts.app')

@section('style')
<style type="text/css">
    table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
      cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Know Your Client/Members</h3>
            <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered select" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><input name="select_all" value="1" type="checkbox"></th>
                                    <th>Name</th>
                                    <th>Birthdate</th>
                                    <th>Gender</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members->result as $member)
                                <tr>
                                    <td><input type="checkbox" value="{{$member->profileId}}"></td>
                                    <td>{{ $member->lastname.", ".$member->firstname." ".$member->middlename}}</td>
                                    <td>{{ Carbon\Carbon::parse($member->birthDate)->format('Y-m-d') }}</td>
                                    <td>{{ $member->gender }}</td>
                                    <td>
                                        <a class='btn btn-success' href="{{ route('printUserId', ['id'=>$member->profileId]) }}"><span class="fa fa-id-card"></span></a>
                                        <a class='btn btn-success' href="{{ route('printUserQr', ['id'=>$member->profileId]) }}"><span class="fa fa-qrcode"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>
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
            "lengthMenu": [[10, 25, 50, 100, 260, -1], [10, 25, 50, 100, 260, "All"]],
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
             "dom": '<"toolbar">lfrtip'
         });
        // $('<button id="refresh">Print</button>').appendTo('div.dataTables_filter');
        $("div.toolbar").html("<div class='row' style><a href='{{ url('admin/kyc/new') }}' class='btn btn-success'><span class='fa fa-plus'></span> New</a> <form id='printAllUserQr' action='{{route('printAllUserQr')}}' method='GET'><button class='btn btn-primary printQrSelected'><span class='fa fa-qrcode'> - (<span class='selectedCount'>0</span> Selected)</button></form> <form id='printAllUserBadge' action='{{route('printAllUserBadge')}}' method='GET'><button class='btn btn-primary printBadgeSelected'><span class='fa fa-id-card'> - (<span class='selectedCount'>0</span> Selected)</button></form></div>");

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
            count--;
             rows_selected.splice(index, 1);
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
       $(document).on('click', '.printQrSelected', function(e){
            // e.preventDefault();
         // var form = $('form');
          var printAllUserQrForm = $('#printAllUserQr');
          $.each(rows_selected, function(index, rowId){
            $(printAllUserQrForm).append(
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
          console.log("Form submission", $(printAllUserQrForm).serialize());
           
          // // Remove added elements
          // $('input[name="id\[\]"]', form).remove();
           
          // // Prevent actual form submission
          // e.preventDefault();
       });

       // Handle form submission event 
       $(document).on('click', '.printBadgeSelected', function(e){
            // e.preventDefault();
         // var form = $('form');
          var printAllUserBadgeForm = $('#printAllUserBadge');
          $.each(rows_selected, function(index, rowId){
            $(printAllUserBadgeForm).append(
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
          console.log("Form submission", $(printAllUserBadgeForm).serialize());
           
          // // Remove added elements
          // $('input[name="id\[\]"]', form).remove();
           
          // // Prevent actual form submission
          // e.preventDefault();
       });
    </script>
@endsection