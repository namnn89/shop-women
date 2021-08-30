@extends('client.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            @foreach($product->media as $index => $media)
                                <div class="tab-pane {{  !$index ? 'active' : '' }}" id="pic-{{ $index }}"><img  width="300" height="200" src="{{ $media->file_name }}" /></div>
                            @endforeach
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            @foreach($product->media as $index => $media)
                                <li class="{{  !$index ? 'active' : '' }}"><a data-target="#pic-{{ $index }}" data-toggle="tab"><img  width="100%" height="100%" src="{{ $media->file_name }}" /></a></li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="details col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{ $product->name }}</h4>
                            </div>

                            <div class="col-md-6 text-right">
                                <del>{{ $product->price * 13 / 10 }}</del>€ <span class="h5">{{ $product->price }} €</span>
                            </div>
                        </div>

                        <p class="product-brand">{{ $product->brand->name }}</p>
                        <p class="product-description">{{ $product->desc }}</p>

                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <span id="amount">{{ $product->price }}</span>€
                            </div>

                            <div class="col-md-4 text-center">
                                <button class="btn-sm btn btn-secondary productReduce">-</button>
                                <span id="delivery">1</span>
                                <button class="btn-sm btn btn-secondary productAdd" >+</button>
                            </div>

                            <div class="col-md-4 action text-center align-items-end">
                                <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                            </div>

                            <input type="hidden" id="product_id" value="{{$product->id}}">
                            <input type="hidden" id="product_price" value="{{$product->price}}">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/product.js') }}"></script>
    <script type="text/javascript">





    </script>
@endsection
@section('style')
    <link href="{{ asset('css/product_detail.css') }}" rel="stylesheet">
@endsection
