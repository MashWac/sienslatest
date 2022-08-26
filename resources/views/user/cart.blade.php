@extends('layouts.user')
@section('content')
<div id="cartpage" class="py-3">
        <div class="card-header">
            <div class="headie">
            <h2 id="headline">My Cart</h2>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-stripped table-hover" id="ticketstable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productcart as $item)
                    <tr>
                        <td>{{$item['productname']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['stock']}}</td>
                        <td>
                            <form action="{{url('updatecart')}}" method="post">
                                @csrf
                                <select type='number' class="form-select form-select-sm formquan" onchange="this.form.submit()" name="productquantity" id="productquantity" value="{{$item['Quantity']}}" aria-label=".form-select-sm example">
                                    <option value="1" <?=$item['Quantity']==1 ? ' selected="selected"' : '';?>>1</option>
                                    <option value="2" <?=$item['Quantity']==2 ? ' selected="selected"' : '';?>>2</option>
                                    <option value="3" <?=$item['Quantity']==3 ? ' selected="selected"' : '';?>>3</option>
                                    <option value="4" <?=$item['Quantity']==4 ? ' selected="selected"' : '';?>>4</option>
                                    <option value="5" <?=$item['Quantity']==5 ? ' selected="selected"' : '';?>>5</option>
                                    <option value="6" <?=$item['Quantity']==6 ? ' selected="selected"' : '';?>>6</option>
                                    <option value="7" <?=$item['Quantity']==7 ? ' selected="selected"' : '';?>>7</option>
                                    <option value="8" <?=$item['Quantity']==8 ? ' selected="selected"' : '';?>>8</option>
                                    <option value="9" <?=$item['Quantity']==9 ? ' selected="selected"' : '';?>>9</option>
                                    <option value="10" <?=$item['Quantity']==10 ? ' selected="selected"' : '';?>>10</option>
                                </select>
                                <input type='hidden'  name="prodid" value="{{$item['product_ID']}}" width="0px">
                                <input type='hidden'  name="prodprice" value="{{$item['price']}}" width="0px">
                                <input type='hidden'  name="prodstock" value="{{$item['stock']}}" width="0px">
                            </form>

                        </td>
                        <td id="loop" class="ptotal">
                        {{$item['subtotal']}}
                        </td>
                        <td>
                        <a href="{{url('deletefromcart/'.$item['product_ID'])}}" class="btn btn-primary "id="btnpurch" style="color:white; vertical-align: middle;"><ion-icon name="trash"></ion-icon>Remove from Cart</a>
                        <td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card">
                <div class="card-header">
                    <h2>Order Summary</h2>
                    <h3 id="headline">Total: KES <span id="totalpurchase"> </span></h3>
 
                </div>
                <div class="card-body">
                    <h4>Delivery Details</h4>
                    <h6>Please note if you are outside Kenya Contact Us for advice on Purchase</h6>
                    <form action="{{url('checkout')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <select type='number' class="form-select form-select-sm formquan" onchange="toggle()" name="regionselected" id="regionselected" aria-label=".form-select-sm example">
                                    <option value="none" >Select Region</option>
                                    <option value="nairobi" >Nairobi</option>
                                    <option value="outsidenairobi" >Outside Nairobi</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="fieldnairobi" style="display:none;">
                                <label for="address">Address:</label>
                                <input type="text" name="nairobiadd" value="{{ old('nairobiadd') }}"class="form-control">
                            </div>
                            <div class="col-md-12" id="fieldoutside" style="display:none;">
                                <label for="address">Town:</label>
                                <input type="text" name="town" value="{{ old('town') }}"class="form-control">
                                <label for="address">Address:</label>
                                <input type="text" name="outsideadd" value="{{ old('outsideadd') }}" class="form-control">
                            </div>
                            <input type="number" class="form-control" id="totalpay" name="amount" hidden>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Confirm delivery details</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
</div>

@endsection  


