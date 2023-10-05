

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome</title>

@include('header')

</head>
<body class="app-body">
<div class="main-content-card card-welcome">
<div id="card-content">
<div id="login-logo-div">
    <table>
        <tr>
            <td>
                <center>
                <img  class="welcome-img" src="{{asset('imgs/log-2.png')}}" />
                </center>
                </div>
            </td>

            <td>
                <div class="log-in-card-right-div">
                <br><br><br>
                <label class="login-title-label main-label-style" > Select Log In Type </label><br><br><br>

                    <a href="{{url('/students/login')}}" > 
                    <button type="button"    class="log-in-btn welcome-labels main-label-style">Log In As Students</button>
                    </a>
                    <br><br>
                    <a href="{{url('/admin/login')}}" >
                    <button type="button"    class="log-in-btn welcome-labels main-label-style">Log In As Admin</button>
                    </a>
                    <br><br>
                    <a href="{{url('/instructors/login')}}" >
                    <button type="button"    class="log-in-btn welcome-labels main-label-style">Log In As Instructor</button>
                    </a>
                    <br><br>
                </div>
            </td>
        </tr>
    </table>
   

    
    
</div>
</div>

</body>
</html>
