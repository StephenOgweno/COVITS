@extends('layouts.app', ['nav' => false])
@section('title', 'Welcome - Installation')

@section('content')
<div class="container">
    <div class="row">
      <h3 class="text-center">{{ config('app.name', 'POS') }} Installation <small>Step 2 of 3</small></h3>
    </div>

    <div class="row">
      <div class="card">
        @include('ic.partials.nav', ['active' => 'app_details'])
        <div class="card-body">

            @if(session('error'))
              <div class="alert alert-danger">
                {!! session('error') !!}
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
                </ul>
              </div>
            @endif

            <form id="details_form" method="post" 
                      action="{{route('install.postDetails')}}">
                  {{ csrf_field() }}

                  <h4>Application Details</h4>
                  <hr/>

                <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="app_name">Application Name:*</label>
                      <input type="text" class="form-control" name="APP_NAME" id="app_name" placeholder="" required>
                  </div>

                  <div class="form-group col-md-6">
                      <label for="app_title">Application Title:</label>
                      <input type="text" name="APP_TITLE" class="form-control" id="app_title">
                  </div>
                </div>
                <br/>
                <h4> License Details <small class="text-danger">Make sure to provide correct information from Envato/codecanyon</small></h4>
                <hr/>
                <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="envato_purchase_code">Envato Purchase Code:*</label>
                      <input type="password" name="ENVATO_PURCHASE_CODE" required class="form-control" id="envato_purchase_code">
                  </div>
                  
                  <div class="form-group col-md-4">
                      <label for="envato_username">Envato Username:*</label>
                      <input type="text" name="ENVATO_USERNAME" required class="form-control" id="envato_username">
                  </div>
              
                  <div class="form-group col-md-4">
                      <label for="envato_email">Your Email:</label>
                      <input type="email" name="ENVATO_EMAIL" class="form-control" id="envato_email" placeholder="optional">
                      <p class="help-block">For Newsletter & support</p>
                  </div>
                </div>
                  
                <div class="clearfix"></div>
                  
                <h4> Database Details <small class="text-muted">Make sure to provide correct information</small></h4>
                <hr/>

                <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="db_host">Database Host:*</label>
                      <input type="text" class="form-control" id="db_host" name="DB_HOST" required placeholder="localhost / 127.0.0.1">
                  </div>

                  <div class="form-group col-md-4">
                      <label for="db_port">Database Port:*</label>
                      <input type="text" class="form-control" id="db_port" name="DB_PORT" required value="3306">
                  </div>

                  <div class="form-group col-md-4">
                      <label for="db_database">Database Name:*</label>
                      <input type="text" class="form-control" id="db_database" name="DB_DATABASE" required>
                      <p class="help-block text-danger"><small>Name of empty database</small></p>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="db_username">Database Username:*</label>
                      <input type="text" class="form-control" id="db_username" name="DB_USERNAME" required>
                  </div>

                  <div class="form-group col-md-6">
                      <label for="db_password">Database Password:*</label>
                      <input type="password" class="form-control" id="db_password" name="DB_PASSWORD" required>
                  </div>
                </div>
                
                <hr/>
                  <div class="col-md-12">
                    <a href="{{route('install.index')}}" class="btn btn-default pull-left back_button" tabindex="-1">Back</a>
                    <button type="submit" id="install_button" class="btn btn-primary float-md-right">Install</button>
                  </div>

                  <div class="col-md-12 text-center text-danger install_msg d-none">
                    <strong>Installation in progress, Please do not refresh, go back or close the browser.</strong>
                  </div>

              </form>

        </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
  <script type="text/javascript">
    $(document).ready(function(){
      $('select#MAIL_DRIVER').change(function(){
        var driver = $(this).val();

        if(driver == 'smtp'){
          $('div.smtp').removeClass('d-none');
          $('input.smtp_input').attr('disabled', false);
        } else {
          $('div.smtp').addClass('d-none');
          $('input.smtp_input').attr('disabled', true);
        }
      });

      $('form#details_form').submit(function(){
        $('button#install_button').attr('disabled', true).text('Installing...');
        $('div.install_msg').removeClass('d-none');
        $('.back_button').d-none();
      });

    })
  </script>
@endsection