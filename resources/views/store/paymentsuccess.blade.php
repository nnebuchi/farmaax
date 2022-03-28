@extends('layouts.store_master')
@section('title', 'Store')
@section('content')
<!-- Title page -->
<style type="text/css">
    @media(max-width: 576px){
        h4, h4{
            font-size: 17px;
        }

        h6{
            font-size: 14px;
        }

        .date-span{
            margin-top: 40px!important;
        }
    }
    
</style>
   {{--  <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{ asset('store_assets/img/breadcrumb.jpg') }});">
        <h2 class="ltext-105 cl0 txt-center">
            Order Summary and Receipt
        </h2>
    </section>   --}}


    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 pb-3 bg-white" style="border: 1px solid #8dd63e;" id="content">
                    <div class="row" style="background-color: white; height: 70px;">
                        <div style="text-align: center;" class="col-12 mt-2">
                            <h1 class="text-center display-4" style="font-size: 30px;">Purchase Reciept</h1>
                        </div>
                        <div style="text-align: right; position: absolute; margin-top: -25px;" class="col-12">
                            <strong class="text-right" style="text-align: right;"><img style="height: 60px; width: 120px;" src="{{ asset('store_assets/img/logo.png') }}" alt="IMG-LOGO"></strong>
                        </div>  
                    </div>
                    
                    
                    <div class="row text-dark mt-1 py-3">
                        <div class="col-md-6 mt-3">
                            <h5 class="mb-2 text-dark">From</h5>
                            <h4 class="mb-2">Farmmax Store</h4>
                            <h6 class="mb-2">sales@farmaxx.com</h6>

                        </div>
                        <div class="col-md-6 mt-3">
                            <h5 class="mb-2 text-dark">To</h5>
                            <h4 class="mb-2"><?=Auth::user()->firstname.' '.Auth::user()->lastname?></h4>
                            <h6 class="mb-2"><?=Auth::user()->email?></h6>
                        </div>
                    </div>
                    <hr style="background-color: #94bc45;">
                    <div class="row">
                        
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">Invoice Number :</div> <div class="col-6"> <?=$order->reference?></div>
                            </div>
                            <div class="row">
                                <div class="col-6">Date :</div><div class="col-6"> <?=$order->created_at?></div>
                            </div>
                            <div class="row">
                                <div class="col-6">Amount :</div> <div class="col-6">&#8358;<?=number_format($order->amount)?></div>
                            </div>
                            
                        </div>
                    </div>
                               
                     <hr style="background-color: #94bc45;">       
                        
                        <div class="col-12">
                            <table class="table mt-2">
                                <thead style="background-color: #94bc45; color: white;">
                                    <tr>
                                        <th>Item</th>
                                        <th>Price (&#8358;)</th>
                                        <th>Qty</th>
                                        <th>Total (&#8358;)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <?php #$product=\App\Product::where('id', $product->product_id)->first(); ?>
                                    <tr>
                                        <td><?=$product->title?></td>
                                        <td><?=number_format($product->price)?></td>
                                        <td><?=$product->quantity?></td>
                                        <td><?=number_format((float)$product->quantity * (float)$product->price)?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                    <tr>
                                        <td>Total Purchase Price</td>
                                        <td></td>
                                        <td></td>
                                        <td><?=number_format($order->amount)?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Cost</td>
                                        <td></td>
                                        <td></td>
                                        <td><?=number_format($order->cost)?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td>Grand Total</td>
                                        <td></td>
                                        <td></td>
                                        <td><?=$order->amount + $order->cost?></td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <?php if ($addr_detail->country=='nigeria'):?>
                                <?php if ((int)$addr_detail->state==23): ?>
                                    <p>To be delivered within 2-3 days</p>
                                <?php else: ?>
                                    <p style="color: #e00857;  font-weight: bold;">To be delivered within 3-5 days</p>  
                                <?php endif ?>
                            <?php else: ?>
                                <p style="color: #e00857;  font-weight: bold;">To be delivered within 7-14 days</p>
                            <?php endif ?> --}} 
                             <p style="color: #e00857;  font-weight: bold;">To be delivered within 3-5 days</p> 
                            receipt generated at <?=$order->created_at?>,
                            <h3 class="text-right mb-2"> <a href="{{ route('order-receipt', $order->reference) }}" target="_blank" style="background-color:#6c7ae0; color: white;" class="btn mr-3"> Download <i class="fa-download fa"></i></a> <a type="button" style="background-color:#6c7ae0; color: white;" class="btn" onclick="downloadPdf()">Print <i class="fa-print fa"></i></a>   </h3>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
            
        </div>
    </section> 

    <div id="elementH"></div>

@endsection 
    
    
    