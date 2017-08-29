@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Events</h1>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{ $event->iiName }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->iiDesc }}</td>
                            <td>{{ $event->iiUnitPrice }}</td>
                            <td>
                                <a class='btn btn-primary' href="{{ route('viewEventAttendees', [$event->iiId]) }}">View Attendees</a>
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
    $('#example').dataTable();
</script>
@endsection