
@extends('includes.app')


@section('content')




<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">


    <!-- Begin Page Content -->
    <div class="container-fluid  p-1">


      <!-- Content Row -->
      <div class="row">

        <!-- Growth Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
          <div class="card border-left-primary shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.TODAYS SELL') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">5545456464</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!--Today order  Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center vtopCard">
          <div class="card border-left-primary shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.TODAYS BUY') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">545645648</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Today item selll Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
          <div class="card border-left-primary shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.TODAYS SELL PROFIT') }}  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">545</div>
                </div>

              </div>
            </div>
          </div>
        </div>
        



        <!-- Today sell Amount Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
          <div class="card border-left-primary shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.TODAYS EXPENSE') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"> 54568</div>
                </div>

              </div>
            </div>
          </div>
        </div>


        
        <!-- Content Row -->

        
        </div>

        <!-- Content Row -->



      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->


</div>
<!-- End of Content Wrapper -->


<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>







@endsection



