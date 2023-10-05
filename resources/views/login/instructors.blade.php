

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin LogIn</title>

@include('../../header')

</head>
<body class="app-body">
<div class="main-content-card card-login">
<div id="card-content">
<div id="login-logo-div">
    <table>
        <tr>
            <td>
            <center>
            <img  class="logo-img" src="{{asset('imgs/ins-1.png')}}" />
            </center>
        </td>

        <td>
            <div class="log-in-card-right-div">

                <div id="card-title">
                @if ($message = Session::get('error'))
                    <div class="alert alert-success" >
                    <label class="login-title-label main-label-style" > {{$message}}</label>
                    </div>
                @endif
                <br><br><br>
            
                <label class="login-title-label main-label-style" > Please Login First.</label>
            </div>
            <form  style="max-width:500px;margin:auto" action="{{url('users/instructors/login')}}" method="post">
            {{ csrf_field() }}
            <div class="input-container">
                <input class="text-input-fields" type="text"  name="UserName" autocomplete="off" required="required" placeholder="Username">
            </div><br>

            

            <div class="input-container">
                <input  class="text-input-fields" type="password" name="Password" autocomplete="off" required="required" placeholder="Password" name="password">
            </div><br>
            <button type="submit"   name="user-login-btn" class="log-in-btn">Instructors Log In</button>
            <br>
            
        </form>
    <br><a  href="/" class="btn btn-primary">Main Menu</a><br>

            </td>
        </tr>
    </table>
    
    </div>

</div>
</div>

</body>
</html>
