 {% extends "cashinmybag.layouts.app" %} {% block title %}{{ settings.name }} | Orders{% endblock %} {% block content %}

<section class="sec-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                @include('account.nav')
             </div>
            <div class="col-md-9">
                <h2 class="page-title">Change Password</h2>

                <div class="card card-plain">
                    <div class="card-body">
                       <form method="POST" action="/change/password">
                            @include('errors.errors')                           


                            <h2></h2>
                            @csrf

                             <p class="form-field-wrapper">
                                <label for="old_password">Email</label>
                                <input id="old_password" type="password" class="input--lg form-full" name="old_password"  required autofocus>

                            </p>
                             <p class="form-field-wrapper">
                                <label for="new_password">New Password</label>
                                <input id="new_password" type="password" class="input--lg form-full" name="new_password" value="" required autofocus>
                            </p>
                          
                             
                        
                            <p class="form-field-wrapper form-row"></p>
                            <p class="form-field-wrapper lost_password">
                                <button type="submit" class="btn btn--lg btn--primary" name="register" value="Log in">Submit</button>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!--End Contact Form & Info-->

{% endblock %}