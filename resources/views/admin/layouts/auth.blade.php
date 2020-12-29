<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="/imgs/favicon.ico">
    <link rel="icon" href="/imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="/imgs/favicon.png">
    <link rel="apple-touch-icon" href="/imgs/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ohram Collections | Admin</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet" />
	<!--  Material Dashboard CSS    -->
	<link href="{{ asset('asset/css/material-dashboard-v=1.3.0.css') }}" rel="stylesheet"/>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7CMaterial+Icons" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="off-canvas-sidebar">
 
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">{{ Config('app.name')}}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                
            </ul>
        </div>
    </div>
</nav>
    @yield('content')
</body>
<!--   Core JS Files   -->
<script src="/asset/js/jquery.min.js" type="text/javascript"></script>
<script src="/asset/js/material.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="/asset/js/jquery.validate.min.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="/asset/js/material-dashboard-v=1.3.0.js"></script>
<script src="/asset/js/bootstrap-notify.js"></script>
<script src="/asset/js/scripts.js"></script>
<script src="/asset/js/custom.js"></script>








<script type="text/javascript">
    $().ready(function(){
        s.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700);

        
    });

    function setFormValidation(id){
        if(jQuery().validate) {
            $(id).validate({
                rules: {
                        name: {
                           required: true,
                           minlength: 3
                        },
                    },
                    highlight: function(element) {
                        $(element).closest('div').addClass('has-error');
                    },
            });
        } 
    }

    $(document).ready(function(){
        setFormValidation('#register');
        setFormValidation('#login');
    });
</script>

</html>
