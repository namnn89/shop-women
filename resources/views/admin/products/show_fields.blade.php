<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Brand Id Field -->
<div class="col-sm-12">
    {!! Form::label('brand_id', 'Brand Id:') !!}
    <p>{{ $product->brand_id }}</p>
</div>

<!-- Desc Field -->
<div class="col-sm-12">
    {!! Form::label('desc', 'Desc:') !!}
    <p>{{ $product->desc }}</p>
</div>

