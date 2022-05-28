@extends('layout')
@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Details product</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Details product</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="{{ asset('/img/'.$product->image) }}" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="{{ asset('/img/'.$product->image) }}" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{ $product->product_name }}</h2>
                    <div>
                        <div class="product-rating">
                            <?php for ($i = 0; $i < 5; $i++) {
                                if ($i < $product->star) { ?>
                            <i class="fa fa-star"></i>
                            <?php } else { ?>
                            <i class="fa fa-star-o"></i>
                            <?php }
                            } ?>
                        </div>
                        <a class="review-link" href="#">10 Review(s) | Add your review</a>
                    </div>
                    <div>
                        <?php if ($product->sale > 0) { ?>
                        <h3 class="product-price">
                            {{ number_format($product->price - ($product->price * $product->sale / 100)) . "đ " }}<del
                                class="product-old-price">{{ number_format($product->price)."đ" }}</del>
                        </h3>
                        <span class="product-available">In Stock</span>
                        <?php } else { ?>
                        <h3 class="product-price">{{ number_format($product->price)."đ" }}</h3>
                        <span class="product-available">In Stock</span>
                        <?php } ?>
                    </div>
                    <div>
                        <?php $temp = explode("#", $product->description); ?>
                        <table>
                            <tbody>
                                @foreach($temp as $value)
                                <tr>{{ $value }}</tr><br>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="product-options">
                        <label>
                            Size
                            <select class="input-select">
                                <option value="0">X</option>
                            </select>
                        </label>
                        <label>
                            Color
                            <select class="input-select">
                                <option value="0">Red</option>
                            </select>
                        </label>
                    </div>
                    <form action="{{ url('/carts/add/'.$product->product_id) }}" method="get">
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" name="quantity" value="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </form>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab3">Reviews
                            </a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-2">
                                    <div>
                                        <?php $temp = explode("#", $product->description); ?>
                                        <table>
                                            <tbody>
                                                @foreach($temp as $value)
                                                <tr>{{ $value }}</tr><br>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle">Manufacturers
                                                </th>
                                                <th style="text-align: center; vertical-align: middle">Star Users</th>
                                                <th style="text-align: center; vertical-align: middle">Like</th>
                                                <th style="text-align: center; vertical-align: middle">Comment</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->

                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">

                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum"></span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum"></span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum"></span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum"></span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">

                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">

                                        <form action="" class="review-form" method="GET">
                                            <textarea name="submit" class="input" placeholder="Your Review"
                                                required></textarea>
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"
                                                        required><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"
                                                        required><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"
                                                        required><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"
                                                        required><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"
                                                        required><label for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Submit</button>
                                        </form>



                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">SẢN PHẨM LIÊN QUAN</h3>
                </div>
            </div>
            <?php for ($i = 0, $k = 0; $i < count($productManus) && $k < 4; $i++) {
                if ($productManus[$i]->product_id != $product->product_id) {
                    $k++ ?>
            <!-- product -->
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <a href="{{ url('/products/'.$productManus[$i]->product_id.'/'.$productManus[$i]->manu_id) }}"><img
                                src="{{ asset('img/'.$productManus[$i]->image) }}" alt=""></a>
                        <?php if ($productManus[$i]->sale > 0) { ?>
                        <div class="product-label">
                            <span class="sale">{{ "-".$productManus[$i]->sale."%" }}</span>
                        </div>
                        <?php } else { ?>
                        <div class="product-label">
                            <span class="new">NEW</span>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{ $productManus[$i]->manufacturers->manu_name }}</p>
                        <h3 class="product-name"><a
                                href="{{ url('/products/'.$productManus[$i]->product_id.'/'.$productManus[$i]->manu_id) }}">{{ $productManus[$i]->product_name }}</a>
                        </h3>
                        <?php if ($productManus[$i]->sale > 0) { ?>
                        <h4 class="product-price">
                            {{ number_format($productManus[$i]->price - ($productManus[$i]->price * $productManus[$i]->sale / 100)) . " VNĐ " }}<del
                                class="product-old-price">{{ number_format($productManus[$i]->price)." VNĐ " }}</del>
                        </h4>
                        <?php } else { ?>
                        <h4 class="product-price">{{ number_format($productManus[$i]->price)." VNĐ " }}</h4>
                        <?php } ?>
                        <div class="product-rating">
                            <?php for ($j = 0; $j < 5; $j++) {
                                        if ($j < $productManus[$i]->star) { ?>
                            <i class="fa fa-star"></i>
                            <?php } else { ?>
                            <i class="fa fa-star-o"></i>
                            <?php }
                                    } ?>
                        </div>
                        <div class="product-btns">
                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to
                                    wishlist</span></button>
                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to
                                    compare</span></button>
                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                    view</span></button>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <a href="{{ url('/carts/add/'.$productManus[$i]->product_id) }}">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /product -->
            <?php }
            } ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->

@endsection