<?php 
	// require 'fpdf.php';
	 //A4 width:219mm
  //default margin: 10mm each side
  //writable horizontal: 219-(10*2)=189mm
	$total_price=0;
	$total_delivery_price=0;
	/*$date_time=[];
   	$item_count=1;
   	$confirmed_orders=$this->ProductModel->get_receipt_items($_SESSION['order_code'], $user['id']);
	foreach ($confirmed_orders as $order) {
   		if ($item_count==1) {
			array_push($date_time, $order['date']);
		}
		$total_price 					= 	$total_price+$order['total'];
		$total_delivery_price 	= 	$total_delivery_price+$order['delivery_price'];

	}

	$g_total=$total_price+$total_delivery_price;

   	
	$new_date_time=$date_time[0];

   	$date_time=explode(' ', $new_date_time);
	$date  	=	$date_time[0];
	$time 	= 	$date_time[1];

	$time 	= explode(':', $time);

	$time 	= $time[0].':'.$time[1];*/
	$pdf= new FPDF('p', 'mm', 'A5');
  // new Nnesco;
  	$pdf->AddPage();
  	$pdf->setDrawColor(141, 214, 62);
  	$pdf->rect(3, 3, 143, 205);
  	//set font to arial, bold, 14pt

  	$pdf->SetFont('Arial', 'B', 14);
  	$pdf->Cell(40 ,12, '', 0,0);
   	$pdf->Cell(40 ,12, 'Purchase Reciept', 0,1);

   	$pdf->SetFont('Arial', '', 12);
   	$pdf->Cell(85,8, 'From', 0,0);
   	$pdf->Cell(85,8, 'For', 0,1);
   	$pdf->Cell(85,8, 'Farmaax Store', 0,0);
   	$pdf->Cell(85,8, Auth::user()->firstname.' '.Auth::user()->lastname, 0,1);

   	$pdf->SetFont('Arial', '', 8);
   	$pdf->Cell(85,8, 'sales@shopafricanfoodstuff.com', 0,0);
   	$pdf->Cell(85,8, Auth::user()->email, 0,1);

   	$pdf->setDrawColor(141, 214, 62);
   	$pdf->setLineWidth(0.1);
   	$pdf->Line(11, 51, 142,51);

   	// Payment Info

   	$pdf->SetFont('Arial', '', 10);
   	$pdf->setTextColor(102, 102, 102);
   	// empty cell to create margin-top
   	$pdf->Cell(80,6, '', 0,1);
   	// end of margin-top
   	$pdf->Cell(50,6, 'Receipt Number', 0,0);
   	$pdf->Cell(50,6, $order->reference, 0,1);

   	$pdf->Cell(50,6, 'Date', 0,0);
   	$pdf->Cell(50,6, $order->created_at, 0,1);

   	$pdf->Cell(50,6, 'Amount', 0,0);
   	$pdf->Cell(50,6, 'N'.number_format($order->amount + $order->cost), 0,1);

   	// Item and Price Table

   	// Table heading
   	$pdf->SetFont('Arial', 'B', 12);
   	$pdf->SetFillColor(141, 214, 62);
   	$pdf->setTextColor(255, 255, 255);

   	$pdf->Cell(60 ,15, 'Item', 0,0,'L',1);
   	$pdf->Cell(30 ,15, 'Price(N)', 0,0,'L',1);
   	$pdf->Cell(10 ,15, 'Qty', 0,0,'L',1);
   	$pdf->Cell(30 ,15, 'Total (N)', 0,1,'L',1);


   	$pdf->SetFont('Arial', '', 10);
   	$pdf->SetFillColor(255, 255, 255);
   	$pdf->setTextColor(102, 102, 102);

   /*	$confirmed_orders=$this->ProductModel->get_receipt_items($_SESSION['order_code'], $user['id']);
   
   	$ship_cost=$_SESSION['delivery_cost'];*/
   	  $total=0;
   	foreach ($products as $product) {
   		
   		// $product=$this->ProductModel->get_product_detail($product['product_id']);
   		$pdf->Cell(60 ,8, $product->title, 0,0);
   		$pdf->Cell(30 ,8, $product->price, 0,0);
   		$pdf->Cell(10 ,8, $product->quantity, 0,0);
   		$pdf->Cell(30 ,8, number_format($product->price * $product->quantity), 0,1);

   		$total=$total+($product->price * $product->quantity);
   		// $ship_cost=$ship_cost+$order['delivery_price'];
   		
   	}
   		// empty cell to create margin-top
	   	$pdf->Cell(10,2, '', 0,1);
	   	// end of margin-top
   		$pdf->Cell(60 ,8, 'Total Purchase Price', 0,0);
   		$pdf->Cell(30 ,8, '', 0,0);
   		$pdf->Cell(10 ,8, '', 0,0);
   		$pdf->Cell(30 ,8, number_format($total), 0,1);


	   	$pdf->Cell(60 ,8, 'Delivery Cost', 0,0);
   		$pdf->Cell(30 ,8, '', 0,0);
   		$pdf->Cell(10 ,8, '', 0,0);
   		$pdf->Cell(30 ,8, number_format($order->cost), 0,1);

   		// empty cell to create margin-top
	   	$pdf->Cell(10,2, '', 0,1);
	   	// end of margin-top
   		$pdf->Cell(60 ,8, 'Grand Total', 0,0);
   		$pdf->Cell(30 ,8, '', 0,0);
   		$pdf->Cell(10 ,8, '', 0,0);
   		$pdf->Cell(30 ,8, number_format($total+$order->cost), 0,1);

     /*if ($addr_detail->country=='nigeria'):
         if ((int)$addr_detail->state==23): 
          $pdf->Cell(100 ,8, 'To be delivered within 2-3 days', 0,1);
          // <p>To be delivered within 2-3 days</p>
       else: 
        $pdf->Cell(100 ,8, 'To be delivered within 3-5 days', 0,1); 
       endif; 
    else: 
        $pdf->Cell(100 ,8, 'To be delivered within 7-14 days', 0,1);     
    endif ;*/
      $pdf->Cell(100 ,8, 'To be delivered within 3-5 days', 0,1); 
   		$pdf->Cell(100 ,8, 'receipt generated at '.$order->created_at.', ', 0,1);

      $pdf->Output();
   	 // $pdf->Output('', "S");
 ?>
<!-- Title page -->
	