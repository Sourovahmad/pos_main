
@extends('includes.app')


@section('content')



<style>
    .w-5{
            display: none;
        }

        #data_paginations{
            display: flex;
            flex-direction: row-reverse;
        }
</style>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{  __('translate.'.$error) }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{  __('translate.'.$message) }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif

<!-- Begin Page Content -->
<div class="container-fluid p-0">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                
                
                <span>

                    <h4> From : <b> {{ $request->start_date }} </b> </h4> <br>
                    <h4>To: <b>  {{ $request->end_date }} </b> </h4>

                </span>
                   
                    <button class="btn btn-success" data-toggle="modal" data-target="#filterModal" >{{ __("translate.Filter") }}</button>
           
            </nav>
        </div>
        @can('Product Read')
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-striped table-bordered" id="productTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                                <th> {{ __('id')  }}</th>
                                <th> {{ __('User')  }}</th>
                                <th> {{ __('Customer')  }}</th>
                                <th> {{ __('Total Amount')  }}</th>
                                <th> {{ __('Discount')  }}</th>
                                <th> {{ __('Created At')  }}</th>
                          
                         
                        </tr>




                    </thead>
    
                      <tbody>

                        @foreach ($statements as $item)
                        


                        <tr class="data-row">
                            
                            <td class="  word-break id "> {{ $item->id}}</td>
         
                            <td class="  word-break name "> {{ $item->user->name}}</td>
                        
                            @if(!is_null($item->customer_id))
                              <td class="  word-break category_id"> {{ $item->customer->name}}</td>
                            @else
                              <td class="  word-break category_id"> No Customer </td>
                            @endif
                      
                            <td class="  word-break price"> {{ $item->total}}</td>
                     

                            
                            <td class="  word-break tax"> {{ $item->discount}}</td>

                            <td class="  word-break tax"> {{ $item->created_at}}</td>
                        


                        </tr>
                        @endforeach 

                      

                    </tbody> 

                 
                </table>
             


            </div>



              
        </div>
        @endcan
    </div>

</div>




{{-- Modal --}}

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">

                <h4>Sell Statement Filter</h4>
              

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>




            </div>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Setting" role="tabpanel" aria-labelledby="setting-tab">


                    <div class="modal-body" >

                        <form action="{{ route("statement.sell") }}" method="GET"> 
                            @csrf

                    <div class="mb-3">  
                        <label class="form-label" for="start_date">Start Date:</label>
                        <input  class="form-control" value="{{ $request->start_date }}" type="date" name="start_date" required> 

                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="end_date">End Date:</label>
                        <input class="form-control" value="{{ $request->end_date }}" type="date" name="end_date" required>

                    </div>


                    <div class="mb-3">
                        <label for="user"> {{ __('translate.User') }}  </label>
             

 
                        <select  class="form-control" value="" name="user" id="user">

                            <option selected value="all"> All </option>

                            @foreach ($users as $singleUser)
                              <option @if($request->user == $singleUser->id)
                                    selected
                              @endif value="{{ $singleUser->id }}"> {{ $singleUser->name }}</option>
                          
                            @endforeach
               

                   
                        </select>


                    </div>
    
                      
              


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn bg-abasas-dark btn-block"> {{ __('translate.Save')  }}
                        </button>
                    </div>


                </form>


                </div>


                
            </div>




        </div>
    </div>



{{-- End Modal --}}












<script>
    $(document).ready(function(){
        
        $('#productTable').DataTable({   
            paging: false,
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel' , 'pdf' , 'print'
            ]
        });
        
    })
</script>



@endsection