@if (isset($allPublishedProducts))
    @foreach($allPublishedProducts as $allPublishedProduct)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img width="400" height="300" src="{{ getProductPhotoSearch($allPublishedProduct)  }}" class="img-responsive">
                <div class="price-label">
                    <span>{{ $allPublishedProduct->product_price }}$</span>
                </div>

                <div class="caption">
                    <h4>{{ $allPublishedProduct->product_name }}</h4>
                    <p>
                        {{ substr($allPublishedProduct->product_description, 0, 20) . '...' }}
                    </p>
                    <div class="pull-right">
                        Available Quantity: {{ $allPublishedProduct->product_quantity }}
                    </div>
                        <a href="{{ route('display_product', $allPublishedProduct->id) }}"
                           onclick="displayProduct(event, this.href)"
                           class="btn btn-primary" id="more-details">More Details</a>
                </div>
            </div>
        </div>
    @endforeach
@endif

<div class="col-md-9">
    <div class="clear-fix"></div>
    <div class="col-sm-12 text-center">
        @if(isset($allPublishedProducts))
            {{ $allPublishedProducts->links() }}
        @endif
    </div>
</div>