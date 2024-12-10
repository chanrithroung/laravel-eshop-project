@extends('frontend.layout')
@section('title')
    Shop
@endsection
@section('content')
<main class="shop">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        @foreach($product as $value)
                                {{-- Check Product Promotion --}}
                                @if($value->sale_price > 0)
                                   @php 
                                        $statusRegularPrice = 'd-none';
                                        $statusSalePrice     = '';
                                    @endphp
                                @else 
                                    @php 
                                        $statusRegularPrice = '';
                                        $statusSalePrice     = 'd-none';
                                    @endphp
                                @endif

                                {{-- Check Stock Available --}}
                                @if($value->quantity >0)
                                    @if($value->sale_price > 0)
                                        @php
                                            $promoStatus = '';
                                            $label       = 'Promotion'
                                        @endphp
                                    @else
                                        @php
                                           $promoStatus = 'd-none';
                                            $label       = '';
                                        @endphp
                                    @endif
                                @else   
                                    @php
                                        $promoStatus = '';
                                        $label       = 'Out Of Stock'; 
                                    @endphp
                                @endif
                            <div class="col-4">
                                <figure>
                                    <div class="thumbnail">
                                        <div class="status {{$promoStatus}}">
                                            {{ $label }}
                                        </div>
                                        <a href="/product/{{ $value->slug }}">
                                            <img src="/uploads/{{ $value->thumbnail }}" alt="thumbanil">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            <div class="price {{ $statusRegularPrice }}">US ${{ $value->regular_price }}</div>
                                            <div class="regular-price {{ $statusSalePrice }}"><strike> US ${{ $value->regular_price }}</strike></div>
                                            <div class="sale-price {{ $statusSalePrice }}">US ${{ $value->sale_price }}</div>
                                        </div>
                                        <h5 class="title">{{ $value->name }}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                        
                        @if($filterType=='')
                            @php
                                $statusFilter = '';
                            @endphp
                        @else
                            @php 
                                $statusFilter = $filterType;
                            @endphp
                        @endif
                        <div class="col-12">
                            <ul class="pagination">
                                @for ($i = 1; $i <= $page; $i++)
                                    <li>
                                        <a href="/shop?{{ $statusFilter.'&' }}page={{$i}}">{{$i}}</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-3 filter">
                    <h4 class="title">Category</h4>
                    <ul>
                        <li>
                            <a href="/shop">ALL</a>
                        </li>
                        @foreach($category as $cat)
                            <li>
                                <a href="/shop?cat={{ $cat->slug }}"> {{ $cat->name }} </a>
                            </li> 
                        @endforeach 
                    </ul>
                    
                    <h4 class="title mt-4">Price</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?price=max">High</a>
                        <a href="/shop?price=min">Low</a>
                    </div>

                    <h4 class="title mt-4">Promotion</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?promotion=true">Promotion Product</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection