@extends('frontend.layout')
@section('title')
    Search
@endsection
@section('content')
<main class="shop">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        Product Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach($product as $value)
                   {{-- Check Prodcut Promotion --}}
                    @if($value->sale_price > 0)
                        @php
                            $statusRegularPrice = 'd-none';
                            $statusSalePrice    = '';
                        @endphp
                    @else
                        @php
                            $statusRegularPrice = '';
                            $statusSalePrice    = 'd-none';
                        @endphp
                    @endif

                    {{-- Check Stock Available --}}
                    @if($value->quantity > 0)
                        @if($value->sale_price > 0)
                            @php 
                                $promoStatus  = '';
                                $label        = 'Promotion'; 
                            @endphp
                        @else
                            @php 
                                $promoStatus  = 'd-none';
                                $label        = ''; 
                             @endphp
                        @endif
                    @else
                        @php 
                            $promoStatus  = '';
                            $label        = 'Out Of Stock'; 
                        @endphp
                    @endif
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <div class="status {{ $promoStatus }} ">
                                    {{ $label }}
                                </div>
                                <a href="/product/{{ $value->slug }}">
                                    <img src="uploads/{{ $value->thumbnail }}" alt="thumbnail">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    <div class="price {{ $statusRegularPrice }}">US ${{ $value->regular_price }}</div>
                                    <div class="regular-price {{ $statusSalePrice }}"><strike>US ${{ $value->regular_price }} </strike></div>
                                    <div class="sale-price {{ $statusSalePrice }} ">US ${{ $value->sale_price }}</div>
                                </div>
                                <h5 class="title">{{ $value->name }}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="main-title">
                        News Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($news as $new)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="/news-detail/{{ $new->id }}">
                                    <img src="/uploads/{{ $new->thumbnail }}" alt="thumbnail">
                                </a>
                            </div>
                            <div class="detail">
                                <h5 class="title">{{ $new->title }}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</main>
@endsection