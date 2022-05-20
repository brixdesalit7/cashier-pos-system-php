<?php
  include('config.php');
  session_start();
  date_default_timezone_set("Asia/Manila");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    * {
        margin: 0;
        padding: 0;
    }
    .receipt {
        margin: 0 auto;
        display:block;
        width: 500px;
        padding: 15px 20px;
    }  
    .title {
        text-align: center;
    } 
    .info {
        margin-top: 15px;
        line-height: 30px;
    }
    table, td, th {
    padding: 5px 3px;
    text-align: left;
    margin-top: 20px;
    }

    table {
    width: 100%;
    border-collapse: collapse;
    }
    th {
        text-transform: uppercase;
    }
    .total {
        text-align: right;
        line-height: 30px;
    }
    </style>
</head>
<body>
<div class="receipt">
    <div class="title">
         <h3>Cashier POS System</h3>
    </div>
    <div class="info">
        <p>Store: Sample</p>
        <p>Store Number: Sample</p>
        <p>Address: Sample</p>
    </div>
    <div class="receipt-content">
        <table>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Price</th>
        </tr>
        <tr>
            <td><?php echo $_GET['productname'];?></td>
            <td><?php echo $_GET['quantity'];?></td>
            <td><?php echo $_GET['unit'];?></td>
            <td><?php echo $_GET['price'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_2'];?></td>
            <td><?php echo $_GET['quantity_2'];?></td>
            <td><?php echo $_GET['unit_2'];?></td>
            <td><?php echo $_GET['price_2'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_3'];?></td>
            <td><?php echo $_GET['quantity_3'];?></td>
            <td><?php echo $_GET['unit_3'];?></td>
            <td><?php echo $_GET['price_3'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_4'];?></td>
            <td><?php echo $_GET['quantity_4'];?></td>
            <td><?php echo $_GET['unit_4'];?></td>
            <td><?php echo $_GET['price_4'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_5'];?></td>
            <td><?php echo $_GET['quantity_5'];?></td>
            <td><?php echo $_GET['unit_5'];?></td>
            <td><?php echo $_GET['price_5'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_6'];?></td>
            <td><?php echo $_GET['quantity_6'];?></td>
            <td><?php echo $_GET['unit_6'];?></td>
            <td><?php echo $_GET['price_6'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_7'];?></td>
            <td><?php echo $_GET['quantity_7'];?></td>
            <td><?php echo $_GET['unit_7'];?></td>
            <td><?php echo $_GET['price_7'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_8'];?></td>
            <td><?php echo $_GET['quantity_8'];?></td>
            <td><?php echo $_GET['unit_8'];?></td>
            <td><?php echo $_GET['price_8'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_9'];?></td>
            <td><?php echo $_GET['quantity_9'];?></td>
            <td><?php echo $_GET['unit_9'];?></td>
            <td><?php echo $_GET['price_9'];?></td>
        </tr>
        <tr>
            <td><?php echo $_GET['productname_10'];?></td>
            <td><?php echo $_GET['quantity_10'];?></td>
            <td><?php echo $_GET['unit_10'];?></td>
            <td><?php echo $_GET['price_10'];?></td>
        </tr>
        </table>
        <div class="total">
            <h4>Discount: <?php echo $_GET['discount'];?>%</h4>
            <h4>Total: <?php echo $_GET['total'];?></h4>
        </div>
    </div>
</div>
</body>
</html>

<!-- <script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	document.loaded = function(){
		
	}
	window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
</script>
 -->
