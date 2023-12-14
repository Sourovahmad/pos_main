<!DOCTYPE html>
<html>
<head>
  <title>     Digital Technology BD  (invoice)</title>
  <style>
    .receipt {
    width: 600px;
    margin: 0 auto;
    padding: 20px;
    /* border: 2px solid #aaa; /* Adds a border for attractiveness */
    /*border-radius: 10px;    /* Rounded corners */
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
    margin-top: 40px;
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
    padding: 0px;
    margin-bottom: 10px; /* Space between details and table */
  }
  
  .approval-section {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
  
  /* Make it look more attractive */
  .order-to {
    text-align: left;
    line-height:5px;
  }
  .order-2 p {
    font-weight: bold;
    color: #444;
  }
  
  body {
    font-family: Arial, sans-serif; /* Use a basic, readable font */
  }
  

  .table th {
    background-color: #ddd; /* Light gray background for header row */
  }
  

  .order-details {
    display: flex;
    justify-content: space-between;
    align-items: start;
  /*  background-color: #f2f2f2; /* Light gray background for details */
    padding: 0px;
    margin-bottom: 5px; /* Space between details and table */
   /* border: 1px solid #aaa; /* Adds a border for attractiveness */
    /* border-radius: 5px;    /* Rounded corners */
  }
  
  .order-to h3, .order-info h3 {
    margin-top: 0; /* Avoid extra space on top of section */
  }
  
  .order-to, .order-info {
    width: 48%; /* Almost half the container, leaving a gap in the center */
  }

.signature-container {
    display: inline-block;
    text-align: right;

    float: right;
}

.signature-container hr {
    width: auto;
    border: 0;
    height: 1px;
    background-color: #000;
    margin-bottom: 10px;
}
.rigtSection{
  margin-left: auto;
}




  
  </style>
</head>
<body>
  <div class="receipt">
  <div class="logo"><img src="{{ route('home') }}/image/logo.png" height="50px" alt="Logo"></div>
    <div class="header">
      <h2>Digital Technology BD</h2>
      <span>Computer sales & Servicing solution provider</span>
      <p>Dishari-106, Hawapara, Sylhet</p>
      <p> Mobile: 01891-471677</p>    
    </div>
    <div class="body">
        <h2 class="purchase-order-title"> <u>BILL</u></h2>
        <div class="order-details">
          <div class="order-to">
             <!-- <h3>Order To:</h3> --->
             <p><b>Invoice No: {{ now()->format('ds') }}10 </b></p>
            <p>Sold To: a company</p>
            <p>Address: Richi habiganj</p>
      
            <p>Mobile: 01726864047825</p>
                   
          </div>
          <div class="order-info">
            <p>Date: 20-07-25</p>
          </div>
        </div>
      <table class="table">
        <thead>
          <tr style="height: 49px">
            <th>S.I</th>
            <th>Items & Specification</th>
            <th>Quantity</th>
            <th>Unite Price</th>
            <th>Discount (%)</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>

            <tr>
              <td> 1 </td>
              <td> polo shirt</td>
              <td> 20 </td>
              <td>204025</td>
              <td>0</td>
              <td> 20415</td>
            </tr>
          




          {{--  total Table row --}}
          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b> Total </b> </td>



            <td style="border: none;"><b> 245  </b> </td>
          </tr>




          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b> Discount </b> </td>



            <td style="border: none;"><b> 00  </b> </td>
          </tr>




          {{--  total Table row --}}

          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Grand Total </b> </td>
            <td style="border: none;"><b> 45  </b> </td>
          </tr>


          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Due </b> </td>
            <td style="border: none;"><b> 00 </b> </td>


          </tr>


        </tbody>
      </table>

      <div class="in-word-text">
        <b>In Word :  five houdred  taka only (Excluding Vat & Tex)</b>
      </div>



    </div>




    <div class="footer">
      <div class="approval-section">
    
        <div class="signature-container" style="text-align: right; margin-top:28px">
          <!-- Horizontal line -->
          <hr>
  
          <!-- Authorized signature section -->
          <div class="authorized-signature-section">
              <span>
                  Customer Signature
              </span>
          </div>
      </div>
  


        <div class="signature-container" style="text-align: right; margin-top:28px">
            <!-- Horizontal line -->
            <hr>
    
            <!-- Authorized signature section -->
            <div class="authorized-signature-section rigtSection">
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
