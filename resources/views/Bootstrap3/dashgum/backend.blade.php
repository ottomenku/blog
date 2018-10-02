<!DOCTYPE html>
 @php
if(isset($data['param'])){$param=array_merge($param,$data['param']);}   
$header= $param['header'] ?? true;
$sidebar = $param['sidebar'] ?? true ;
$modaltitle=$param['modal']['title'] ?? '' ;
@endphp

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DASHGUM - FREE Bootstrap Admin Template</title>
   


    <!-- Bootstrap core CSS -->
    <link href="/admin/assets/css/bootstrap.css" rel="stylesheet">


    <link  href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="//fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">                                
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js" ></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/vendor/jasekz/laradrop/js/enyo.dropzone.js"></script>
    <script src="/vendor/jasekz/laradrop/js/laradrop.js"></script> 

  

    <!--  external css -->
  <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet"> 
    <!-- Custom styles for this template -->
    <link href="/admin/assets/css/style.css" rel="stylesheet">
    <link href="/admin/assets/css/style-responsive.css" rel="stylesheet">

    <!-- <link href="/admin/assets/css/custom.css" rel="stylesheet" /> -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]
<script src="/admin/assets/js/jquery-1.8.3.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>  


  <link rel="stylesheet" href="/admin/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script> 
  <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

 <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
 
 </head>

<body>
        <!--path:Bootstrap3.dashgum name:backend-->
<section id="container" >
   <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box"  >
                <div style="position:relative;top:-5px;" class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            @include('Bootstrap3.dashgum.mo_worker_script')       
            </div>
@if(Auth::user())
  <center><span style="position:relative;top:25px;left:-50px;color:white;">Szép napot {{ Auth::user()->name  }} !</span></center>
      
         <div style="max-width:100px;position:relative;left:-20px; " class="nav navbar-nav navbar-right">

                <a href="admin{{ url('/logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    Kijelentkezés
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
           </div>                                  
   @endif                
        
        </header>
      <!--header end-->

    @if (Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }}
                </div>
            </div>
    @endif 

     @include('Bootstrap3.dashgum.sidebar')

<section id="main-content">
       
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <div class="panel panel-default">

                    <div class="panel-heading">

                         

                            @yield('content')                   

                    </div>
                </div>
            </div>
        </div>

    </section>
</section>

   
      <!--main content end-->
 
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
<!--
        <script src="//admin/assets/js/jquery.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
-->
    <script class="include" type="text/javascript" src="/admin/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/admin/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/admin/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="/admin/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="/admin/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="/admin/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="/admin/assets/js/sparkline-chart.js"></script>    
	<script src="/admin/assets/js/zabuto_calendar.js"></script>	
  

	
    <script type="application/javascript">
        
  $( ".datepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
});
$( ".datepickernoyear" ).datepicker({
  dateFormat: "mm-dd",setDate: "10-10" 
});
      
        $(document).ready(function () {

            $(document.body).on('hidden.bs.modal', function () {
                $('#myModal').removeData('bs.modal')
            });

          //  jQuery('.laradrop').laradrop();
    
            // With custom params:
            jQuery('.laradrop').laradrop({
                breadCrumbRootText: 'Home', // optional 
                actionConfirmationText: 'Biztos törlöd?', // optional
                onInsertCallback: function (src){
               //   jQuery('#avatar').attr('src', src);
                    changeImage(src);
                    $('#myModal2').modal('toggle');
                },
                onErrorCallback: function(jqXHR,textStatus,errorThrown){
                    // if you need an error status indicator, implement here
                    alert('An error occured: '+ errorThrown);
                },
                onSuccessCallback: function(serverData){
                    // if you need a success status indicator, implement here
                }
            }); 
        

        });
        
    </script>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-header" style="background-color:blue;">
            <button type="button" style="color:red;background-color:white; opacity: 0.6;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ $modaltitle }}</h4>
    
        </div>
            <div class="modal-content">
             
                <div class="modal-body"><div id="myModalContent" class="te"></div></div>
             
            </div>    
            <!-- /.modal-content -->
             <div class="modal-footer">
              <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
       
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->  
   


  </body>
</html>
