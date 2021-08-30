<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255, 'required' => true]) !!}
</div>

<!-- Brand Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Brand') !!}
{{--    {!! Form::text('brand_id', null, ['class' => 'form-control','maxlength' => 255]) !!}--}}

    <select name="brand_id" class="form-control" required>
        <option value="">Please Select</option>
        @foreach($brands as $key => $brand)
            <option {{(isset($product) && $product->brand_id === $key) ? 'selected' : ''}} value="{{$key}}">{{$brand}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price') !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('desc', 'Desc') !!}
    {!! Form::text('desc', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

@if(isset($product) && count($product->media))
    @foreach($product->media as $media)
        <div class="row form-group col-sm-12">
                <div class="col-sm-6">
                    <img class="img-rounded" src="{{$media->file_name}}" alt="{{$media->file_name}}" />
                    <button data-value="{{$media->id}}" type="button" class="deleteImage btn btn-danger">Delete</button>
                </div>
        </div>
    @endforeach
@endif

<div class="form-group col-sm-12">
    {!! Form::label('images', 'Images') !!}
    <input id="images" name="images[]" type="file" class="file" accept="image/*"  data-show-upload="false" data-show-caption="true" multiple>
</div>
