Dear admin, 

<p>{!!$msg!!}</p>

<h3>Product Details</h3>
<p>Shop Name : {!!$shop_name!!}</p>
<p>Shop Email : {!!$shop_email!!}</p>
<p>Shop Account Number : {!!$shop_account_number!!}</p>


                        <div class="table-responsive">
                                <table border = "1" cellpadding="10">
                                    <thead>
                                    <tr>
                                        <th>Product Code</th>
                                        <th>QTY</th>
                                        <th>Reason for return</th>
                                        <th>Invoice no</th>
                                        <th>Replacement/​Credit</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product_code as $key =>  $product)
                                       
                                        @if(!empty($product_code[$key]))
                                        <tr>
                                            <td>{!! $product_code[$key] !!}</td>
                                            <td>{!! $quantity[$key] !!}</td>
                                            <td>{!! $reason[$key] !!}</td>
                                            <td>{!! $invoice_number[$key] !!}</td>
                                            <td>{!! $return_type[$key] !!} </td>
                                            
                                            
                                        </tr>
                                        @endif
                                    @endforeach
                                
                                    </tbody>
                                    
                                </table>
                        </div>


Thanks,<br>
{{ config('app.name') }}