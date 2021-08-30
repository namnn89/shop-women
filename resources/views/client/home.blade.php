@extends('client.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach(@$products as $productDetail)
            <div class="card m-2" style="width: 18rem;">
                @if(count($productDetail->media))
                    <img src="{{$productDetail->media[0]->file_name}}" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                        <h5 class="card-title">{{ $productDetail['name'] }}</h5>
                    <p class="card-text">{{$productDetail->desc}}</p>
                    <p class="card-text">Price: {{$productDetail->price}} $</p>
                    <a href="{{ route('products.detail', ['id' => $productDetail->id]) }}" class="btn btn-primary" id="add-cart-button">Show detail</a>
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <div class="row justify-content-center">
        {{ @$products->onEachSide(5)->links() }}
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/product.js') }}" ></script>
@endsection
