@extends('layouts.app')
        
@section('content')

<section class="breadcrumb justify-content-center">
<div class="background-image" data-background="{{ optional($information)->image }}" 
        style="background-image: url({{ optional($information)->image }}); background-position: {{ optional($information)->x_pos . '%' }} {{ optional($information)->y_pos . '%'}};"
         data-bg-posx="center" data-bg-posy="center" data-bg-overlay="4"></div> 
        <div class="breadcrumb-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="breadcrumb-title text-uppercase">{{ $information->title  }}</h1>
                          <nav class="breadcrumb-link">
                            <span><a href="/">Home</a></span> 
                            <span>{{ $information->title }}</span>
                        </nav>
                    </div>
                </div>
        </div>
    </div>
</section>
<section id="home">   
    <div class="container">
        <div class="row justifiy-content-center">        
          <div id="content" class="col-md-12  mb-5">  
              @if ($message = \Session::get('success'))
                  <p><a href=""> <<< Back </a></p>
                  <div class="alert alert-success color--light alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                      <strong>{{ $message }}</strong>
                  </div>
                @elseif ($errors->any() )
                  <p><a href=""> <<< Back </a></p>
                  <div class="alert alert-danger">
                      <ul>
                          @foreach($errors->all()  as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                    
                @else
                 <p><?php echo  html_entity_decode($information->description);  ?></p>
                @endif
          </div>
        <div class="margin-top-35"></div>
      </div> <!-- /row -->
    </div> <!-- /container -->
</section>


 
@endsection
