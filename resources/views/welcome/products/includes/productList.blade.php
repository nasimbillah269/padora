<div class="row">
    @forelse($products as $product)
        <div class="col-md-4 col-6" style="padding: 10px;">
            @include(welcomeTheme().'products.includes.productCard')
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h5>No products found matching your filters.</h5>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4" id="paginationLinks">
    {{ $products->links('pagination') }}
</div>