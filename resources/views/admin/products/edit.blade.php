@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Product</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($product, ['route' => ['product-update', $product->id], 'method' => 'post', 'files'=>'true']) !!}

            <div class="card-body">
                <div class="row">
                    @include('admin.products.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
            </div>

            <input type="hidden" id="remove_images" name="remove_images">

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('page_scripts')

    <script>
        let imageRemove = [];
        $(document).on('click', '.deleteImage', function(event) {
            $(this).html('Undo');
            $(this).addClass('undo btn-success').removeClass('deleteImage btn-danger');
            imageRemove.push($(this).data('value'))
            console.log(imageRemove)
        });

        $(document).on('click', '.undo', function(event) {
            $(this).html('Delete');
            $(this).addClass('deleteImage btn-danger').removeClass('undo btn-success');
            const value = $(this).data('value');
            imageRemove = imageRemove.filter(function(item) {
                return item !== value
            })
        });

        $( "form" ).submit(function( event ) {
            console.log('imageRemove', imageRemove);
            $("#remove_images").val(imageRemove);
            return true;
            // event.preventDefault();
        });
    </script>
@endsection
