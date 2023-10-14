

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Students</title>

@include('../../header')

</head>
<body class="app-body">
    <div class="body-content" >
    @include('../navigation/navigation')

    <div class=" container-fluid mt-3 ">
        <div class="sub-navigation" >
            <button type="button" class="btn btn-primary position-relative">
            View All | Total Students
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{$total}}
            </span>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @if(session('userType')=='Admin')
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
            @endif
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
		<div class="main-body">
			<table class="table table-hover"  id="table">
				<thead>
					<tr>
						<th class="text-center">FName</th>
						<th class="text-center">LName</th>
						<th class="text-center">Contact</th>
						<th class="text-center">UserName</th>
						<th class="text-center">Date</th>
						<th class="text-center">Action1</th>
                        @if(session('userType')=='Admin')
						<th class="text-center">Action2</th>
						<th class="text-center">Action3</th>
                        @endif
					</tr>
				</thead>
				@foreach($data as $row)
				<tr class="row{{$row->id}}">
					<td class="text-center">{{$row->FName}}</td>
					<td class="text-center">{{$row->LName}}</td>
					<td class="text-center">{{$row->Contact}}</td>
					<td class="text-center">{{$row->UserName}}</td>
					<td class="text-center">{{$row->created_at}}</td>
                    <td class="text-center" >
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#showModal">Show</button>
                    </td>
                    @if(session('userType')=='Admin')
                    <td class="text-center">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#editModal">  Edit</button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#deleteModal">Delete</button>
                    </td>
                    @endif
				</tr>
				@endforeach
			</table>


    
    <!-- The add Modal -->
    <div class="modal fade modal-lg" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
                <!-- Modal Header -->
                <div class="modal-header">
                    
                    <p class="modal-title text-center" >Adding New Student</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form  action="{{route('StudentsResource.store')}}" method="post">
                        
                        {{ csrf_field() }}
                        @include('templates.students-add')
                        
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
    <div class="modal fade modal-lg" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Viewing Student Details</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>
                                <b><p class="text-start">Name</p></b>
                                <p class="text-start" id="show-Name-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Gender</p></b>
                                <p class="text-start" id="show-Gender-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Contact</p></b>
                                <p class="text-start" id="show-Contact-id" ></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b><p class="text-start">Student Id</p></b>
                                <p class="text-start" id="show-StudentId-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Course</p></b>
                                <p class="text-start" id="show-Course-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Cost</p></b>
                                <p class="text-start" id="show-EntryYear-id" ></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b><p class="text-start">Address</p></b>
                                <p class="text-start" id="show-Address-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">UserName</p></b>
                                <p class="text-start" id="show-UserName-id" ></p>
                            </td>
                            @if(session('userType')=='Admin')
                            <td>
                                <b><p class="text-start">Password</p></b>
                                <p class="text-start" id="show-Password-id" ></p>
                            </td>
                            @endif
                        </tr>
                    </table>
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
            <div class="modal-content black-modal-text">
            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title text-center" >Editing User</p>
            </div>

            <!-- Modal body -->
            <div class="edit-modal-body">
                <form  action="{{route('StudentsResource.update','test')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    @include('templates.students-edit')
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


    <!-- The delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deleting A User</h5>
            </div>
            
            <!-- Modal body -->
            <div class="delete-modal-body">
                <br><p class="modal-title text-center" >Are Sure You Want To Delete</p><br>
                <p id="Delete-Name" class="text-center" ></p><br>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No Close</button>
                <form  action="{{route('StudentsResource.destroy','null')}}" method="post">
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
    var RequestUrl =  BaseUrl +"/StudentsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        var Name = data.data.FName+" "+" "+data.data.LName
        $('#showModal').modal('show');
        $('#show-Name-id').html(Name);
        $('#show-Contact-id').html(data.data.Contact);
        $('#show-Password-id').html(data.data.PassWord);
        $('#show-UserName-id').html(data.data.UserName);
        $('#show-EntryYear-id').html(data.data.EntryYear);
        $('#show-StudentId-id').html(data.data.StudentId);
        $('#show-Course-id').html(data.data.Course);
        $('#show-Address-id').html(data.data.Address);
        $('#show-Gender-id').html(data.data.Gender);
    })
});

$('#editModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl =  BaseUrl +"/StudentsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#editModal').modal('show');
        $('#editId').val(data.data.id);
        $('#edit-FName').val(data.data.FName);
        $('#edit-LName').val(data.data.LName);
        $('#edit-Contact').val(data.data.Contact);
        $('#edit-UserName').val(data.data.UserName);
        $('#edit-Password').val(data.data.PassWord);
        $('#edit-Gender').val(data.data.Gender);
        $('#edit-StudentId').val(data.data.StudentId);
        $('#edit-Address').val(data.data.Address);
        $('#edit-CourseName').val(data.data.Course);
        $('#edit-CourseCost').val(data.data.EntryYear);

    })
});



$('#deleteModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl =  BaseUrl +"/StudentsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#deleteModal').modal('show');
        $('#deleteId').val(data.data.id);
        $('#deleteId').val(data.data.id);
        var Name = data.data.FName+" "+" "+data.data.LName
        $('#Delete-Name').html(Name);
    })
});

function getCourseAmount ()
{
    var name =  document.getElementById('CourseName').value;
    var RequestUrl =  BaseUrl +"{{url('/get/course/amount/')}}"+"/"+name;
    $.get(RequestUrl, function (data) {
        var Amount = data[0].Cost
        $('#CourseCost').val(Amount);
    })
}
function getEditCourseAmount ()
{
    var name =  document.getElementById('edit-CourseName').value;
    var RequestUrl =  BaseUrl +"{{url('/get/course/amount/')}}"+"/"+name;
    $.get(RequestUrl, function (data) {
        var Amount = data[0].Cost
        $('#edit-CourseCost').val(Amount);
    })
}
</script>
</body>
</html>

