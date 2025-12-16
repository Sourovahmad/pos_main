
@include('includes.formLink')






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{  session('shop_name') }} </title>
    <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}" type="text/css">


    <link rel="stylesheet" href="{{asset('css/admin/sb-admin-2.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/admin/datatables.min.css')}}">
    <link rel="stylesheet" src="{{asset('bootstrap-select/css/bootstrap-select.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/admin/jquery-ui.min.css')}}">
    <style>
        .border-dotted{
            border-style: dotted;
            border-width: 3px;
        }
        .dataTables_wrapper .dt-buttons {
            float:left;  
            text-align:center;
            margin-left: 20px;
        }

        
    .loader {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.5;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader > img {
    width: 50px;
}
   
.bg-abasas-dark {

    background-color: #2a3f5c;
    color: #fff;

}

.demo-expired-modal {
    z-index: 9999 !important;
}

.demo-expired-backdrop {
    background-color: rgba(0, 0, 0, 0.8) !important;
    z-index: 9998 !important;
}

.demo-expired-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9997;
    pointer-events: all;
}


    </style>



    <script src="{{asset('js/admin/jquery.min.js')}}"></script>
    <script src="{{asset('js/admin/bootstrapbundle.js')}}"></script>
    <script src="{{asset('js/admin/easing.min.js')}}"></script>
    <script src="{{asset('js/admin/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/admin/Chart.min.js')}}"></script>
    <script src="{{asset('js/admin/datatables.min.js')}}"></script>
    <script src="{{asset('bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    {{-- <script src="{{ asset('js/encrypter.min.js') }}"></script> --}}

   

    
    <script src="{{asset('js/abasas/app.js')}}"></script>
    
 
</head>

<body id="page-top">


    


        <!-- Page Wrapper -->
        <div id="wrapper">
    
    
            <x-sidebar />
       
    
        
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    
                    <x-navbar/>
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid pl-1 pl-md-2 ">
    
                        @yield('content')
    
                </div>
                <!-- End of Main Content -->
    
                <!-- Footer -->
                <x-footer>

                </x-footer>
                <!-- End of Footer -->
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    
    @if(session('demo_expired') && session('developer_info'))
        @php
            $devInfo = session('developer_info');
        @endphp
        <!-- Demo Expired Modal -->
        <div class="demo-expired-overlay"></div>
        <div class="modal fade demo-expired-modal show" id="demoExpiredModal" tabindex="-1" role="dialog" aria-labelledby="demoExpiredModalLabel" aria-hidden="false" style="display: block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="demoExpiredModalLabel">
                            <i class="fas fa-exclamation-triangle"></i> Demo Period Expired
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            <h6 class="alert-heading"><strong>Your demo period has expired!</strong></h6>
                            <p class="mb-2">The demo period for this application has ended. To continue using the application, please contact our agent.</p>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Contact Information</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>Company:</strong> {{ $devInfo['company_name'] ?? 'OrbiTax Corporation Limited' }}</p>
                                <p class="mb-2"><strong>Contact Person:</strong> {{ $devInfo['demo_owner_account'] ?? 'Sourov Ahmad' }}</p>
                                <p class="mb-2"><strong>Address:</strong> {{ $devInfo['address'] ?? 'Via Carlo della rocca 36' }}</p>
                                <p class="mb-0"><strong>License Key:</strong> <code>{{ $devInfo['license_key'] ?? '' }}</code></p>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="fas fa-dollar-sign"></i> Pricing Plans</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3 text-center">
                                            <h5 class="text-primary">Monthly Plan</h5>
                                            <h3 class="font-weight-bold">${{ number_format($devInfo['monthly_price'] ?? 39, 2) }}</h3>
                                            <small class="text-muted">per month</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3 text-center">
                                            <h5 class="text-success">One-Time Payment</h5>
                                            <h3 class="font-weight-bold">${{ number_format($devInfo['one_time_price'] ?? 399, 2) }}</h3>
                                            <small class="text-muted">lifetime access</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="window.location.reload();">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show demo-expired-backdrop"></div>
        
        <script>
            $(document).ready(function() {
                // Prevent closing the modal
                $('#demoExpiredModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                
                // Disable all form submissions and links
                $('form').on('submit', function(e) {
                    e.preventDefault();
                    alert('Demo period has expired. Please contact the agent to continue.');
                    return false;
                });
                
                $('a:not([href^="#"]):not([href^="mailto:"]):not([href^="tel:"])').on('click', function(e) {
                    e.preventDefault();
                    alert('Demo period has expired. Please contact the agent to continue.');
                    return false;
                });
            });
        </script>
    @endif
    
    </body>


</html>