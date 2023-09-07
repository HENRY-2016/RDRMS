

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Courses</title>

@include('../../header')

</head>
<body class="app-body">
    <div class="body-content" >
    @include('../navigation/navigation')

    <div class=" container-fluid mt-3 ">
        <div class="sub-navigation" >
            <button type="button" class="btn btn-primary position-relative">
            View All | Total Courses
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{$total}}
            </span>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-primary" role="alert" >
            <p class="text-center">{{$message}}</p>
        </div>
    @endif


    @if ($errors -> any())
        <div  class="alert alert-danger" role="alert">
            <ul>
            @foreach($errors -> all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <br>

    {{ csrf_field() }}
		<div class="main-body" >
			<table class="table  table-hover"  id="table">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Cost</th>
						<th class="text-center">Period</th>
						<th class="text-center">Description</th>
						<th class="text-center">Date</th>
						<th class="text-center">Action1</th>
						<th class="text-center">Action2</th>
						<th class="text-center">Action3</th>
					</tr>
				</thead>
				@foreach($data as $row)
				<tr class="row{{$row->id}}">
					<td class="text-center">{{$row->Name}}</td>
					<td class="text-center">{{$row->Cost}}</td>
					<td class="text-center">{{$row->Period}}</td>
					<td class="text-center">{{$row->Description}}</td>
					<td class="text-center">{{$row->created_at}}</td>
                    <td class="text-center" >
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#editModal">  Edit</button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#showModal">Show</button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#deleteModal">Delete</button>
                    </td>
				</tr>
				@endforeach
			</table>


    
    <!-- The add Modal -->
    <div class="modal fade modal-lg" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    
                    <p class="modal-title text-center" >Adding New Course</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form  action="{{route('CoursesResource.store')}}" method="post">
                        
                        {{ csrf_field() }}
                        @include('templates.courses-add')
                        
                    </form>
                </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- The show Modal -->
    <div class="modal fade modal-sm" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Viewing A Course Details</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <b><p class="text-start">Name</p></b>
                    <p class="text-start" id="show-Name-id" ></p>
                    <b><p class="text-start">Cost</p></b>
                    <p class="text-start" id="show-cost-id" ></p>
                    <b><p class="text-start">Period</p></b>
                    <p class="text-start" id="show-period-id" ></p>
                    <b><p class="text-start">Description</p></b>
                    <p class="text-start" id="show-description-id" ></p>
                </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- The edit Modal -->
    <div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title text-center" >Editing Course</p>
            </div>

            <!-- Modal body -->
            <div class="edit-modal-body">
                <form  action="{{route('CoursesResource.update','null')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    @include('templates.courses-edit')
                    <input type="hidden"  id="editId" name="editId" >
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deleting A Course</h5>
            </div>
            
            <!-- Modal body -->
            <div class="delete-modal-body">
                <br><p class="modal-title text-center" >Are Sure You Want To Delete</p><br>
                <p id="Delete-Name" class="text-center" ></p><br>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No Close</button>
                <form  action="{{route('CoursesResource.destroy','null')}}" method="post">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button  type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes Delete</button>
                    <input type="hidden"  id="deleteId" name="deleteId" >
                </form>
            </div>
            </div>
        </div>
    </div>



    </div>
    </div>
    <script>

$(document).ready(function() {$('#table').DataTable();});

$('#showModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/CoursesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        var amount = parseInt(data.data.Cost);
        var Amount = amount.toLocaleString();
        $('#showModal').modal('show');
        $('#show-Name-id').html(data.data.Name);
        $('#show-cost-id').html(Amount);
        $('#show-period-id').html(data.data.Period);
        $('#show-description-id').html(data.data.Description);
    })
});


$('#editModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/CoursesResource/"+id+"/edit";
    console.log(RequestUrl)
    $.get(RequestUrl, function (data) {
        // {"data":{"id":1,"Name":"Course 1","Cost":"400000","Period":"7","Description":"description","created_at":"2023-09-02T15:05:30.000000Z","updated_at":"2023-09-02T15:05:30.000000Z"}}
        console.log(data.data)
        $('#editModal').modal('show');
        $('#editId').val(data.data.id);
        $('#edit-Name').val(data.data.Name);
        $('#edit-Cost').val(data.data.Cost);
        $('#edit-Period').val(data.data.Period);
        $('#edit-Description').val(data.data.Description);
    })
});



$('#deleteModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/CoursesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#deleteModal').modal('show');
        $('#deleteId').val(data.data.id);
        $('#Delete-Name').html(data.data.Name);
    })
});


</script>
</body>
</html>
