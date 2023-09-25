<!DOCTYPE html>
<html>
<head>
  <title>Hospital Receipt</title>
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
      <h4>ন্যাশনাল হার্ট ফাউন্ডেশন হাসপাতাল সিলেট</h4>
      <h2>NATIONAL HEART FOUNDATION HOSPITAL SYLHET</h2>
      <p>East Shahi Eidgah, Sylhet, Bangladesh</p>
      <p>Phone: 0821-728413 Mobile: 01787-487117, 01902-452191</p>
    </div>
    <div class="body">
        <h2 class="purchase-order-title">Purchase Order</h2>
        <div class="order-details">
          <div class="order-to">
            <h3>Order To:</h3>
            <p>[Recipient Name]</p>
            <p>[Recipient Address]</p>
          </div>
          <div class="order-info">
            <p>Order Number: #######</p>
            <p>Order Date: DD/MM/YYYY</p>
            <p>Prepared By: [Name]</p>
          </div>
        </div>
      <table class="table">
        <thead>
          <tr>
            <th>S.I</th>
            <th>ProductName</th>
            <th>Quantity</th>
            <th>Formation (Unit)</th>
            <th>Rate</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Avil 2ml</td>
            <td>250</td>
            <td>injectoin (Piece)</td>
            <td>6.64</td>
            <td>1660.00</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Ovenox 40mg</td>
            <td>50</td>
            <td>INJECTION (Piece)</td>
            <td>401.20</td>
            <td>20060.00</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Ovenox 6000 IU</td>
            <td>50</td>
            <td>INJECTION (Piece)</td>
            <td>566.92</td>
            <td>28346.00</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Ovenox 8000 IU</td>
            <td>35</td>
            <td>INJECTION (Piece)</td>
            <td>697.75</td>
            <td>24421.25</td>
          </tr>


          {{--  total Table row --}}

          <tr style="border: none">
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"> <b>Grand Total </b> </td>
            <td style="border: none;"><b>   </b> </td>
          </tr>

         


        </tbody>
      </table>

      <div class="in-word-text">
        <b>In Word :  Twenty Thousand lorem20 taka only</b>
      </div>



    </div>




    <div class="footer">
      <div class="approval-section">
        <div>
          <p>Checked By:</p>
          <p>[Name]</p>
          <p>[Position]</p>
          <p>NHFH, Sylhet</p>
        </div>
        <div>
          <p>Approved By:</p>

          <p>Dr. Abdul Munim Chowdhury</p>
          <p>Deputy Director</p>
          <p>NHFH, Sylhet</p>
        </div>
      </div>
      <p>Pharmacist</p>
      <p>NHFH, Sylhet</p>
    </div>
  </div>
</body>
</html>
