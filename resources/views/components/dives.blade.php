

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dives</title>

@include('../../header')

</head>
<body class="app-body">
    <div class="body-content" >
    @include('../navigation/navigation')

    <div class=" container-fluid mt-3 ">
        <div class="sub-navigation" >
            <table>
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary position-relative">
                        View All | Total Dives
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{$total}}
                        </span>
                        </button>
                    </td>
                    @if(session('userType')=='Student')
                    <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
                    </td>
                    
                    @endif
                </tr>
            </table>
            
            
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
						<th class="text-center">Date</th>
						<th class="text-center">Student</th>
						<th class="text-center">Instructor</th>
						<th class="text-center">Location</th>
						<th class="text-center">Instructor Remarks</th>
                        @if(session('userType')=='Instructor')
						<th class="text-center">Remarks</th>
                        @endif
                        @if(session('userType')=='Student')
						<th class="text-center">Feed Back</th>
                        @endif
						<th class="text-center">Action1</th>
                        @if(session('userType')=='Admin')
						<th class="text-center">Action2</th>
						<th class="text-center">Action3</th>
                        @endif
					</tr>
				</thead>
				@foreach($data as $row)
				<tr class="row{{$row->id}}">
					<td class="text-center">{{$row->created_at}}</td>
					<td class="text-center">{{GeneralHelper::getStudentName($row->Student)}}</td>
					<td class="text-center">{{GeneralHelper::getInstructorName($row->Instructor)}}</td>
					<td class="text-center">{{$row->Location}}</td>
                    <td class="text-center">
                    @if($row->FeedBackStatus == 'Pending')
                    <button type="button" class="btn btn-warning">Pending</button>
                    @endif
                    @if($row->FeedBackStatus == 'Replied')
                    <button type="button" class="btn btn-primary">Replied</button>
                    @endif
                    </td>
                    @if(session('userType')=='Instructor')
                    <td class="text-center" >
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#instructorRemarkModal"
                        data-bs-student="{{GeneralHelper::getStudentName($row->Student)}}"
                        data-bs-instructor="{{GeneralHelper::getInstructorName($row->Instructor)}}"
                        data-bs-remarkStudentId="{{$row->Student}}"
                        >Give Remarks</button>
                    </td>
                    @endif
                    @if(session('userType')=='Student')
                    <td class="text-center" >
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#studentFeedBackModal"
                        data-bs-student="{{GeneralHelper::getStudentName($row->Student)}}"
                        data-bs-instructor="{{GeneralHelper::getInstructorName($row->Instructor)}}"
                        >My Feed Back</button>
                    </td>
                    @endif
                    <td class="text-center" >
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#showModal"
                        data-bs-student="{{GeneralHelper::getStudentName($row->Student)}}"
                        data-bs-instructor="{{GeneralHelper::getInstructorName($row->Instructor)}}"
                        data-bs-equipment="{{GeneralHelper::getEquipmentsName($row->Equipments)}}"
                        >Show</button>
                    </td>
                    @if(session('userType')=='Admin')
                    <td class="text-center">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#editModal"
                        data-bs-student="{{GeneralHelper::getStudentName($row->Student)}}"
                        data-bs-instructor="{{GeneralHelper::getInstructorName($row->Instructor)}}"
                        >  Edit</button>
                    </td>
                    
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#deleteModal"
                        data-bs-student="{{GeneralHelper::getStudentName($row->Student)}}"
                        data-bs-instructor="{{GeneralHelper::getInstructorName($row->Instructor)}}"
                        >Delete</button>
                    </td>
                    @endif
				</tr>
				@endforeach
			</table>

    
    <!-- The add Modal -->
    <div class="modal fade modal-xl" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
                <!-- Modal Header -->
                <div class="modal-header">
                    
                    <p class="modal-title text-center" >Registering A New Dives</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form  action="{{route('DivesResource.store')}}" method="post">
                    <input type="hidden" value="{{session('id')}}" name="Student" >
                        
                        {{ csrf_field() }}
                        @include('templates.dives-add')
                        
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
                    <p class="modal-title text-center" >Viewing Dives Details</p>
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
                                <b><p class="text-start">Instructor</p></b>
                                <p class="text-start" id="show-Instructor-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Status</p></b>
                                <p class="text-start" id="show-Status-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Site</p></b>
                                <p class="text-start" id="show-Site-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Date</p></b>
                                <p class="text-start" id="show-Date-id" ></p>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>
                                <b><p class="text-start">Location</p></b>
                                <p class="text-start" id="show-Location-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">DiveNo</p></b>
                                <p class="text-start" id="show-DiveNo-id" ></p>
                            </td>
                        
                            <td>
                                <b><p class="text-start">Depth</p></b>
                                <p class="text-start" id="show-Depth-id" ></p>
                            </td>
                        
                            <td>
                                <b><p class="text-start">TimeIn</p></b>
                                <p class="text-start" id="show-TimeIn-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">TimeOut</p></b>
                                <p class="text-start" id="show-TimeOut-id" ></p>
                            </td>
                        </tr>

                        <tr>
                            
                            <td>
                                <b><p class="text-start">Equipments</p></b>
                                <p class="text-start" id="show-Equipments-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Remarks</p></b>
                                <p class="text-start" id="show-Remarks-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">FeedBack</p></b>
                                <p class="text-start" id="show-FeedBack-id" ></p>
                            </td>
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

    <!-- The student FeedBack Modal -->
    <div class="modal fade modal-lg" id="studentFeedBackModal" tabindex="-1" aria-labelledby="studentFeedBackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Giving Feed Back On Dives Details</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>
                                <b><p class="text-start">Name</p></b>
                                <p class="text-start" id="feedback-Name-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Instructor</p></b>
                                <p class="text-start" id="feedback-Instructor-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Status</p></b>
                                <p class="text-start" id="feedback-Status-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Site</p></b>
                                <p class="text-start" id="feedback-Site-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Date</p></b>
                                <p class="text-start" id="feedback-Date-id" ></p>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>
                                <b><p class="text-start">Location</p></b>
                                <p class="text-start" id="feedback-Location-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">DiveNo</p></b>
                                <p class="text-start" id="feedback-DiveNo-id" ></p>
                            </td>
                        
                            <td>
                                <b><p class="text-start">Depth</p></b>
                                <p class="text-start" id="feedback-Depth-id" ></p>
                            </td>
                        
                            <td>
                                <b><p class="text-start">TimeIn</p></b>
                                <p class="text-start" id="feedback-TimeIn-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">TimeOut</p></b>
                                <p class="text-start" id="feedback-TimeOut-id" ></p>
                            </td>
                        </tr>

                        <tr>
                            
                            <td>
                                <b><p class="text-start">Equipments</p></b>
                                <p class="text-start" id="feedback-Equipments-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Remarks</p></b>
                                <p class="text-start" id="feedback-Remarks-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">FeedBack</p></b>
                                <p class="text-start" id="feedback-FeedBack-id" ></p>
                            </td>
                        </tr>
                    </table>
                    <form  action="{{route('DivesResource.update','null')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <input type="hidden"  id="editId" name="editId" >
                    <input type="hidden"  name="studentFeedBack" >
                    <input type="hidden" value="{{session('id')}}"  name="studentId" >
                    <input type="hidden" id="studentRowId" name="studentRowId">

                    <div class="my-grid-container" >
                        <div class="my-grid-item">
                            <input class="text-input-fields" type="text"   name="studentFeedBack" autocomplete="off" required="required" placeholder="Your Feed Back">
                        </div>

                        <div class="my-grid-item ">
                            <button type="submit" class="btn btn-primary">Save My Feed Back</button> 
                        </div>
                    </div>
                </form>
                </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- The Instructor Remark Modal -->
    <div class="modal fade modal-lg" id="instructorRemarkModal" tabindex="-1" aria-labelledby="instructorRemarkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Giving Remark On Dives Details</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>
                                <b><p class="text-start">Name</p></b>
                                <p class="text-start" id="remark-Name-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Instructor</p></b>
                                <p class="text-start" id="remark-Instructor-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Status</p></b>
                                <p class="text-start" id="remark-Status-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Site</p></b>
                                <p class="text-start" id="remark-Site-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Date</p></b>
                                <p class="text-start" id="remark-Date-id" ></p>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>
                                <b><p class="text-start">Location</p></b>
                                <p class="text-start" id="remark-Location-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">DiveNo</p></b>
                                <p class="text-start" id="remark-DiveNo-id" ></p>
                            </td>
                        
                            <td>
                                <b><p class="text-start">Depth</p></b>
                                <p class="text-start" id="remark-Depth-id" ></p>
                            </td>
                        
                            <td>
                                <b><p class="text-start">TimeIn</p></b>
                                <p class="text-start" id="remark-TimeIn-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">TimeOut</p></b>
                                <p class="text-start" id="remark-TimeOut-id" ></p>
                            </td>
                        </tr>

                        <tr>
                            
                            <td>
                                <b><p class="text-start">Equipments</p></b>
                                <p class="text-start" id="remark-Equipments-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Remarks</p></b>
                                <p class="text-start" id="remark-Remarks-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">FeedBack</p></b>
                                <p class="text-start" id="remark-FeedBack-id" ></p>
                            </td>
                        </tr>
                    </table>
                    <form  action="{{route('DivesResource.update','null')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <input type="hidden"  id="editId" name="editId" >
                    <input type="hidden"  name="instructorRemark" >
                    <input type="hidden" id="remarkStudentId"  name="remarkStudentId" >
                    <input type="hidden" value="{{session('id')}}" name="instructorId">
                    <input type="hidden" id="instructorRowId" name="instructorRowId">
                    <div class="my-grid-container" >
                        <div class="my-grid-item">
                            <input class="text-input-fields" type="text"   name="instructorRemark" autocomplete="off" required="required" placeholder="Your Remark ">
                        </div>

                        <div class="my-grid-item ">
                            <button type="submit" class="btn btn-primary">Save My Remark</button> 
                        </div>
                    </div>
                </form>
                </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- The edit Modal -->
    <div class="modal fade modal-xl" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content black-modal-text">
            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title text-center" >Editing A Dives</p>
            </div>

            <!-- Modal body -->
            <div class="edit-modal-body">
                <form  action="{{route('DivesResource.update','null')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    @include('templates.dives-edit')
                    <input type="hidden"  id="editId" name="editId" >
                    <input type="hidden" name="adminEdit">
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
                <h5 class="modal-title" id="deleteModalLabel">Deleting A Dives</h5>
            </div>
            
            <!-- Modal body -->
            <div class="delete-modal-body">
                <br><p class="modal-title text-center" >Are Sure You Want To Delete</p>
                <p id="Delete-Name" class="text-center" ></p>
                <p class="text-center" >Records</p>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No Close</button>
                <form  action="{{route('DivesResource.destroy','null')}}" method="post">
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
    var instructor = target.attr('data-bs-instructor');
    var student = target.attr('data-bs-student');
    var equipment  = target.attr('data-bs-equipment');
    var RequestUrl =  BaseUrl +"/DivesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#showModal').modal('show');
        $('#show-Name-id').html(student);
        $('#show-Date-id').html(data.data.created_at.split('T')[0]);
        $('#show-TimeIn-id').html(data.data.TimeIn);
        $('#show-Site-id').html(data.data.Site);
        $('#show-DiveNo-id').html(data.data.DiveNo);
        $('#show-Status-id').html(data.data.FeedBackStatus);
        $('#show-Location-id').html(data.data.Location);
        $('#show-Depth-id').html(data.data.Depth);
        $('#show-Instructor-id').html(instructor);
        $('#show-TimeOut-id').html(data.data.TimeOut);
        $('#show-Equipments-id').html(equipment);
        $('#show-Remarks-id').html(data.data.Remarks);
        $('#show-FeedBack-id').html(data.data.FeedBack);
    })
});


$('#studentFeedBackModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var student = target.attr('data-bs-student');
    var instructor = target.attr('data-bs-instructor');
    var RequestUrl =  BaseUrl +"/DivesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#studentFeedBackModal').modal('show');
        $('#feedback-Name-id').html(student);
        $('#studentRowId').val(id)
        $('#feedback-Date-id').html(data.data.created_at.split('T')[0]);
        $('#feedback-TimeIn-id').html(data.data.TimeIn);
        $('#feedback-Site-id').html(data.data.Site);
        $('#feedback-DiveNo-id').html(data.data.DiveNo);
        $('#feedback-Status-id').html(data.data.FeedBackStatus);
        $('#feedback-Location-id').html(data.data.Location);
        $('#feedback-Depth-id').html(data.data.Depth);
        $('#feedback-Instructor-id').html(instructor);
        $('#feedback-TimeOut-id').html(data.data.TimeOut);
        $('#feedback-Equipments-id').html(data.data.Equipments);
        $('#feedback-Remarks-id').html(data.data.Remarks);
        $('#feedback-FeedBack-id').html(data.data.FeedBack);
    })
});

$('#instructorRemarkModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var student = target.attr('data-bs-student');
    var instructor = target.attr('data-bs-instructor');
    var remarkStudentId = target.attr('data-bs-remarkStudentId');
    var RequestUrl =  BaseUrl +"/DivesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#instructorRemarkModal').modal('show');
        $('#remark-Name-id').html(student);
        $('#instructorRowId').val(id)
        $('#remarkStudentId').val(remarkStudentId)
        $('#remark-Date-id').html(data.data.created_at.split('T')[0]);
        $('#remark-TimeIn-id').html(data.data.TimeIn);
        $('#remark-Site-id').html(data.data.Site);
        $('#remark-DiveNo-id').html(data.data.DiveNo);
        $('#remark-Status-id').html(data.data.FeedBackStatus);
        $('#remark-Location-id').html(data.data.Location);
        $('#remark-Depth-id').html(data.data.Depth);
        $('#remark-Instructor-id').html(instructor);
        $('#remark-TimeOut-id').html(data.data.TimeOut);
        $('#remark-Equipments-id').html(data.data.Equipments);
        $('#remark-Remarks-id').html(data.data.Remarks);
        $('#remark-FeedBack-id').html(data.data.FeedBack);
    })
});

$('#editModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var student = target.attr('data-bs-student');
    var instructor = target.attr('data-bs-instructor');
    var RequestUrl =  BaseUrl +"/DivesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#editModal').modal('show');
        $('#editId').val(id);
        $('#edit-Student').val(student);
        $('#edit-DiveNo').val(data.data.DiveNo);
        $('#edit-Location').val(data.data.Location);
        $('#edit-Site').val(data.data.Site);
        $('#edit-Date').val(data.data.Date);
        $('#edit-TimeIn').val(data.data.TimeIn);
        $('#edit-TimeOut').val(data.data.TimeOut);
        $('#edit-Depth').val(data.data.Depth);

        $('#edit-Instructor').append($('<option>',
            {
                value: data.data.Instructor,
                text : data.data.Instructor
            }));
        $('#edit-Equipments').append($('<option>',
            {
                value: data.data.Equipments,
                text : data.data.Equipments
            }));
    })
});



$('#deleteModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var student = target.attr('data-bs-student');
    var RequestUrl =  BaseUrl +"/DivesResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#deleteModal').modal('show');
        $('#deleteId').val(data.data.id);
        $('#Delete-Name').html(student);
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

