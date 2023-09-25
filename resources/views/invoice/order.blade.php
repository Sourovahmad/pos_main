<!DOCTYPE html>
<html>
<head>
  <title>Sourov Heart Foundation (invoice)</title>
  <style>
    .receipt {
    width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 2px solid #aaa; /* Adds a border for attractiveness */
    border-radius: 10px;    /* Rounded corners */
  }
  
  .logo {
    width: 80px;
    float: left;
  }
  
  .header {
    text-align: center;
    padding-top: 30px; /* Space for the logo */
  }
  
  .purchase-order-title {
    text-align: center;
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
  .order-2 p {
    font-weight: bold;
    color: #444;
  }
  
  body {
    font-family: Arial, sans-serif; /* Use a basic, readable font */
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
  
  </style>
</head>
<body>
  <div class="receipt">
    <div class="header">
      <h4>সৌরভ হাসপাতাল সিলেট</h4>
      <h2>SOUROV HEART FOUNDATION HOSPITAL SYLHET</h2>
      <p>East Shahi Eidgah, Sylhet, Bangladesh</p>
      <p> Mobile: 01729-867026</p>
    </div>
    <div class="body">
        <h2 class="purchase-order-title">Invoice</h2>
        <div class="order-details">
          <div class="order-to">
            <h3>Order To:</h3>
            <p>{{ $data['purchase']->customer->name }}</p>
            <p>{{ $data['purchase']->customer->company }}</p>
            <p>{{ $data['purchase']->customer->address }}</p>
          </div>
          <div class="order-info">
            <p>Order Number: {{ $data['purchase']->id }} </p>
            <p>Order Date: {{ now()->format('Y-m-d') }}</p>
            <p>Prepared By: {{ auth()->user()->name }}</p>
          </div>
        </div>
      <table class="table">
        <thead>
          <tr>
            <th>S.I</th>
            <th>ProductName</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Discount</th>
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
              <td>{{ $singleProduct['discount'] }}</td>
              <td> {{ $singleProduct['total'] }} </td>
            </tr>
          
          @endforeach




          {{--  total Table row --}}

          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Grand Total </b> </td>
            <td style="border: none;"><b> {{ $data['purchase']->total }}  </b> </td>
          </tr>


          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Due </b> </td>
            <td style="border: none;"><b> {{ $data['purchase']->due }}  </b> </td>


          </tr>

         


        </tbody>
      </table>

      <div class="in-word-text">
        <b>In Word :  {{ $data['totalNumberInWord'] }} taka only</b>
      </div>



    </div>




    <div class="footer">
      <div class="approval-section">
        
        <div>
          <p>Created By:</p>

          <p>{{ auth()->user()->name }}</p>
         
        </div>
      </div>

      <div class="ourwebistInfo"> 
        <p style="font-size:12px">Developed by </p>
        <p style="font-size:12px">easy Solution (+8801729867026)</p>

      </div>
     
    </div>
  </div>
</body>
</html>
