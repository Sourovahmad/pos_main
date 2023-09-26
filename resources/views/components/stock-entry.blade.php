
@php
$GLOBALS['CurrentUser']= auth()->user();   
@endphp
<div class="card border-light bg-abasas-dark  text-center w-100 p-2">
    <h3 class="text-white"> {{ __('translate.Purchase ID') }} </h3>

    <div class="card-body">
        <div class="row no-gutters ">

            <input type="number" id="totalLimit_input_hidden" step="0.01" hidden>


            <form method="GET" id="supplierForm" style="margin: 0 auto;">
                @csrf
               

                    <span class="text-light  pl-2"> {{ __('translate.Search') }}</span>

                    <div class="col-auto " style="position: relative;">
                        
                        <input type="text" name="" id="supplierSearchField" class="form-control form-control-lg  mb-1 p-4 inputMinZero rounded-1 border-info"
                            autocomplete="off"  > <button type="button" id="purchaseSearchButton" class="btn btn-info btn-sm">Search</button>
                            
                        <div id="supplierSuggession" class="list-group" id="show-supplier-list" style="position: absolute;   left:20px; z-index:9999; max-height: 200px;overflow:scroll; "> iam supplier suggestion </div>
                    </div>



                    <div class="col-auto text-light font-weight-bold " id="supplierPhoneArea"></div>
                    <input type="number" name="supplier_id" id='purchase_input_id'  hidden>


             
            </form>
            
            
        </div>
    </div>


</div>






<script>
    $(document).ready(function () {

        function viewSupplierData(supplier) {
            

            $("#supplierPhoneAreaForm").hide();
           // $("#supplier_input_id").val(supplier.id); //no need

            html = "";
            html += '<div class="text-center text-light" id="supplierName" > {{ __('translate.Supplier Details') }}: </div> ';

            html += '<div class="text-center text-light" id="supplierName" > {{ __('translate.Name') }}: ' + supplier.name + '</div>';

             html += '<div class="text-center text-light" id="supplierPhone" > {{ __('translate.Phone') }}: ' + supplier.phone + '</div>';

            html += '<div class="text-center text-light"  id="supplierCompany"  >{{ __('translate.Company') }}: ' + supplier.company +
                '</div>';
            html += '<div class="text-center text-light" @if(! $GLOBALS["CurrentUser"]->can("Allow Supplier Due")  ) hidden @endif>{{ __('translate.Due') }} : <span class="text-danger" id="supplierDue">' +
                supplier.due + '</span></div>';
            $("#supplierPhoneArea").html(html);
            $("#supplierPhoneArea").show();


            ///////////////////////// ********************** ///////////////
            //                         this is the property of purchase create page
            $("#purchasePreviousDue").text(supplier.due);
            $("#totalDue").text(0);
            var finalTotal = parseInt($("#finalTotal").text().trim()) + parseInt(supplier.due);
            $("#finalTotal").text(finalTotal);
            $("#PayAmount").val(finalTotal);
            $("#changeAmount").html('');



            ///////////////////////************************* *///////////
        }

        


        function supplierFunction(id) {
            var link = "{{ route('home') }}/api/supplier-find?id=" +id;
            $.get(link, function (supplier, status) {
                viewSupplierData(supplier);
            });

            
        }


    //                               *****************************************************************************
    //                                           ##########  Add Supplier Section    #############
    //                               *******************************************************************************

        $(document).on('click','#NewSupplierButton',function(){
            $("#supplierPhoneAreaForm").toggle();
            $('#NewCustomerButtonIcon').toggleClass('fa-plus').toggleClass('fa-minus');
        });
        $("#addsupplierButton").on('click', function () {
            $('#SupplierPhoneComponantInputNameWarrning').hide()
            $('#SupplierPhoneComponantInputPhoneWarrning').hide()

            // if($('#SupplierPhoneComponantInputName').val() == ''){
            //     $('#SupplierPhoneComponantInputNameWarrning').show();
            //     return ;
            // }
            if($('#SupplierPhoneComponantInputphone').val() == ''){
                $('#SupplierPhoneComponantInputPhoneWarrning').show();
                return ;
            }
            var OPfrm = $('#supplierPhoneAreaForm');
            var act = OPfrm.attr('action');      
         
            $.ajax({
                type: OPfrm.attr('method'),
                url: act,
                data: OPfrm.serialize(),
                success: function (supplier) {
                    $("#supplier_id").val(supplier.id);
                    $("#supplierSearchField").val(supplier.name);
                    viewSupplierData(supplier);
                },
                error: function (data) {
                    alert("Failed to add supplier ..... Try Again !!!!!!!!!!!")
                },
            });

        });


    //                               *****************************************************************************
    //                                           ##########  Search Supplier suggession    #############
    //                               *******************************************************************************

    var databaseSupplier = @json($suppliers);
    
    $("#supplierSuggession").hide();
    localStorage.setItem("currentPurchaseId",0);


    $("#purchaseSearchButton").on('click', function () {


        const currentPurchaseId = localStorage.getItem("currentPurchaseId");
        if(currentPurchaseId == 0){

        $("#supplierSuggession").show();
        $("#supplierPhoneAreaForm").hide();
        $("#supplierPhoneArea").hide();
       

        var searchField = $("#supplierSearchField").val();
        var expression = new RegExp(searchField, "i");
        if (searchField.length == 0) {
            $("#supplierSuggession").hide();
            return false;
        }
        $("#supplierSuggession").html("");

        
     
         var resultQery = $.grep(databaseSupplier, function(e){ return e.purchase_order_id == searchField; });


            if (resultQery.length == 1) {

                console.log(resultQery[0]);
                $("#supplierSuggession").hide();
  
                viewSupplierData(resultQery[0].supplier);
                $("#purchase_input_id").val(resultQery[0].id);
                localStorage.setItem("currentPurchaseId", resultQery[0].id);


                // set totalAmount as t_score with an encryption 
                

                // insert as previous data
                let purchaseProducts = resultQery[0].purchase_details;
                let purchaseTotalAmount = resultQery[0].total;
                let leftStockForEntry = resultQery[0].stock_quantity_left_for_insert;
         
                if(leftStockForEntry == 0){

                    $("#totalLimit_input_hidden").val(resultQery[0].total);

                    $.each(purchaseProducts, function(index, value) {
                        $("#productIdHidden").val(value.product_id);
                        $("#purchaseProductInputId").val(value.product_id);
                        $("#purchaseProductInputName").val(value.product.name);
                        $("#purchaseProductInputPrice").val(value.price);
                        $("#purchaseProductInputSellPrice").val(value.sell_price);
                        $("#purchaseProductInputdiscount").val(value.discount);
                        $("#purchaseProductInputQuantity").val(value.quantity);
                        $("#purchaseProductInputTotal").val(value.total);
                     

                        $("#purchaseProductInputSubmit").click();
                    });

                }else{

                    $("#totalLimit_input_hidden").val(resultQery[0].stock_quantity_left_for_insert);
                    $("#finalTotal").text(resultQery[0].stock_quantity_left_for_insert.toFixed( 2 ));
                    $("#current_total_hidden_input").val(resultQery[0].stock_quantity_left_for_insert);
                    $("#PayAmount").val(resultQery[0].stock_quantity_left_for_inser.toFixed( 2 ));
                    $("#totalDue").text(0);
                }


                    $("#purchaseProductInputId").focus();


            }else{
               alert("no Data found")
               localStorage.setItem("currentPurchaseId",0);
               localStorage.setItem("t_score",0);

            }


            // end of result query

                     
        }else{
            alert("There is a unsaved Stock entry. please Reset or submit in order to continue")
        }
        

       



    });

    
    $('body').click(function () {
        $("#supplierSuggession").hide();
        $("#supplierSuggession").html("");
    });

    $(document).on('click', '.searchSupplier', function () {
        var id = $(this).attr('data-item-id');
        var name = $(this).attr('data-item-name');
        $("#supplier_input_id").val(id)
        $("#supplierSearchField").val(name)
        
        $("#supplierSuggession").hide();
        $("#supplierSuggession").html("");
        supplierFunction(id);
    });


    $("#supplierSearchField").keypress(function (e) {
        if (e.originalEvent.key === 'Enter' || e.originalEvent.keyCode === 13) {
         let value = $("#supplierSearchField").val();
           if(value == ''){
            alert("please input a purchase id first");
            return;
           }
           $("#purchaseSearchButton").click();
        }

    });




    });

</script>
