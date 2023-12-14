<!DOCTYPE html>
<html>
<head>
  <title> R.M. Medicine & Medi Science (purchase Order)</title>
  <style>
    body {
    font-family: Arial, sans-serif; /* Use a basic, readable font */
    font: size 10px;
  }
    .receipt {
    width: 600px;
    margin: 0 auto;
    padding: 20px;
    /*border: 2px solid #aaa; /* Adds a border for attractiveness */
    border-radius: 10px;    /* Rounded corners */
  }
  
  .logo {
    width: 80px;
    float: left;
  }
  
  .header {
    text-align: center;
    padding-top: 15px; /* Space for the logo */
    line-height:5px;
  }
  
  .purchase-order-title {
    text-align: center;
    margin-top: 40px;
  }
  
  .body {
    margin-top: 20px;
  }
  
  .table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
  }
  
  th, td {
    border: 1px solid black;
    padding: 5px;
  }
  
  .footer {
    margin-top: 20px;
    text-align: center;
  }
  
  .order-details {
    text-align: center;
    background-color: #f2f2f2; /* Light gray background for details */
    padding: 10px;
    margin-bottom: 20px; /* Space between details and table */
  }
  
  .approval-section {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
  
  /* Make it look more attractive */
  .order-to {
    text-align: left;
    line-height:15px;
  }
  .order-to p {
    font-weight: bold;
    color: #444;
  }
   
  h1, h2 {
    color: #333; /* Darker color for headers */
  }
  
  p {
    color: #555; /* Slightly lighter color for text */
  }
  
  .table th {
    background-color: #ddd; /* Light gray background for header row */
  }
  

  .order-details {
    display: flex;
    justify-content: space-between;
    align-items: start;
    background-color: #f2f2f2; /* Light gray background for details */
    padding: 10px;
    margin-bottom: 20px; /* Space between details and table */
    border: 1px solid #aaa; /* Adds a border for attractiveness */
    border-radius: 5px;    /* Rounded corners */
  }
  
  .order-to h3, .order-info h3 {
    margin-top: 0; /* Avoid extra space on top of section */
  }
  
  .order-to, .order-info {
    width: 48%; /* Almost half the container, leaving a gap in the center */
  }
  .ourwebistInfo:{
    margin-bottom: 100px;
  }


  .signature-container {
    display: inline-block;
    text-align: right;
    margin-left: auto;
    float: right;
}

.signature-container hr {
    width: auto;
    border: 0;
    height: 1px;
    background-color: #000;
    margin-bottom: 10px;
}




  </style>
</head>
<body>
  <div class="receipt">
    <div class="logo"><img src="image/logo.png" height="50px" alt="Logo"></div>
    <div class="header">
     <h2>Medicine & Medi Science</h2>
      <p> <b>Proprietor: Md. Zahangir Alam</b></p>
      <p>Kazitula Bazar, Sylhet</p>
      <p> Whatsapp no: +8801748433393</p>
      <p> Email: zahangiralam3393@gmail.com</p>       
    </div>

    <div class="body">
        <h2 class="purchase-order-title">Quotation</h2>
        <div class="order-details">
          <div class="order-to">
            <h3>Order To:</h3>
            <p>{{ $data['purchase']->supplier->name }}</p>
            <p>{{ $data['purchase']->supplier->company }}</p>
            <span>{{ $data['purchase']->supplier->address }}</span>
       
          </div>
          <div class="order-info">
            <p>Order id: {{ $data['purchase_order_id']}} </p>
            <p>Order Date: {{ now()->format('Y-m-d') }}</p>
            <p>Prepared By: {{ auth()->user()->name }}</p>
          </div>
        </div>
      <table class="table">
        <thead>
          <tr style="height: 49px">
            <th>SI.No</th>
            <th>ProductName</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Discount (%)</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($data['products'] as  $singleProduct)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td> {{ $singleProduct['name'] }}</td>
              <td>{{ $singleProduct['quantity'] }}</td>
              <td>{{ $singleProduct['price'] }}</td>
              <td>{{ $singleProduct['discount'] }}%</td>
              <td> {{ $singleProduct['total'] }} </td>
            </tr>
          
          @endforeach


       


          {{--  total Table row --}}
          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b> Total </b> </td>

            @php
              $totalAmountWithDiscount = intval($data['purchase']->total) + intval($data['purchase']->discount);
            @endphp

            <td style="border: none;"><b> {{ $totalAmountWithDiscount }}.00  </b> </td>


            
          </tr>


          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b> Discount </b> </td>



            <td style="border: none;"><b> {{ $data['purchase']->discount }}.00  </b> </td>
          </tr>


          




          {{--  total Table row --}}

          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Grand Total </b> </td>
            <td style="border: none;"><b> {{ $data['purchase']->total }}.00  </b> </td>
          </tr>


          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Due </b> </td>
            <td style="border: none;"><b> {{ $data['purchase']->due }}.00  </b> </td>


          </tr>



         


        </tbody>
      </table>

      <div class="in-word-text">
        <b>In Word :  {{ $data['totalNumberInWord'] }} taka only</b>
      </div>



    </div>




    <div class="footer">
      <div class="approval-section">
        
        <div style="text-align: left; float:left">
          <p>Created By:</p>

          <p>sourov
         
        </div>


        <div class="signature-container" style="text-align: right; margin-top:28px">
            <!-- Horizontal line -->
            <hr>
    
            <!-- Authorized signature section -->
            <div class="authorized-signature-section">
                <span>
                    Authorize signature
                </span>
            </div>
        </div>
    


      </div>




    
    <div class="ourwebistInfo"> 
        <p style="font-size:12px; text-align: center;">Developed by: AS Coroporation (+8801723500532, +8801729867026) </p>
    
      </div>

     
    </div>
  </div>
</body>
</html>
