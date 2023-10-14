<nav class="navbar navbar-expand-sm navbar-dark nav-bg-color">
<div class="container-fluid">
<a class="navbar-brand" href="#">RDRMS</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/courses')}}"role="button" >Courses</a>
    </li>
    @if(session('userType')=='Admin')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/students')}}" role="button" >Students</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/dives')}}" role="button" >Dives</a>
    </li>
    @endif
    @if(session('userType')=='Instructor')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/students')}}" role="button" >Students</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/dives',['viewType'=>'instructor','keyId'=>session('id')])}}" role="button" >Dives</a>
    </li>
    @endif
    @if(session('userType')=='Student')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/student',['viewType'=>'student','keyId'=>session('id')])}}" role="button" >Student</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/dives',['viewType'=>'student','keyId'=>session('id')])}}" role="button" >Dives</a>
    </li>
    @endif



    

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/equipments')}}" role="button" >Equipments</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/instructors')}}" role="button" >Instructors</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/safety')}}" role="button" >Safety Info</a>
    </li>
    @if(session('userType')=='Admin')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{url('components/admin')}}" role="button">Admin</a>
    </li>
    @endif
    </ul>


</div>
<div style="float:right" >
    <table>
        <tr>
            <td>
                <p class="text-center user-name">{{session('user')}}</p>
            </td>
            <td>
                @if (session('userType') === 'Admin')
                    || Logged In As An {{session('userType')}} ||
                    <a  href="/users/admin/logout" class="btn btn-danger log-out-btn"><span class="log-out-span">Log Out</span></a>
                @endif
                @if (session('userType') === 'Student')
                    || Logged In As A {{session('userType')}} ||
                    <a  href="/users/students/logout" class="btn btn-danger log-out-btn"><span class="log-out-span">Log Out</span></a>
                @endif
                @if (session('userType') === 'Instructor')
                    || Logged In As An {{session('userType')}} ||
                    <a  href="/users/instructors/logout" class="btn btn-danger log-out-btn"><span class="log-out-span">Log Out</span></a>
                @endif
            </td>
        </tr>
    </table>
</div>
</div>
</nav>


