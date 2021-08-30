<li class="nav-item">
    <p>Brands</p>
</li>

@if(isset($brands))
    @foreach($brands as $brand)
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.home', ['brand_id' => $brand->id])}}">{{$brand->name}}</a>
        </li>
    @endforeach
@endif




