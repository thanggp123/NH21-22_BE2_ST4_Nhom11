@extends('layout')
@section('main-content')

<!-- HOT DEAL SECTION -->
				<div class="slideshow-container">

					<div class="mySlides fade">
						<div class="numbertext">1 / 3</div>
						<img src="img/05_May1e223449d6c9ac2b913b7497adc56ae2.jpg" style="width:100%">
					</div>

					<div class="mySlides fade">
						<div class="numbertext">2 / 3</div>
						<img src="img/05_Maye8b9efc284bac3ff13a2909299a60182.jpg" style="width:100%">
					</div>

					<div class="mySlides fade">
						<div class="numbertext">3 / 3</div>
						<img src="img/hlogo.jpg" style="width:100%">
					</div>

				</div>
				<br>

				<div style="text-align:center">
					<span class="dot"></span>
					<span class="dot"></span>
					<span class="dot"></span>
				</div>

				<script>
				let slideIndex = 0;
				showSlides();

					function showSlides() {
						let i;
						let slides = document.getElementsByClassName("mySlides");
						let dots = document.getElementsByClassName("dot");
						for (i = 0; i < slides.length; i++) {
							slides[i].style.display = "none";
						}
						slideIndex++;
						if (slideIndex > slides.length) {
							slideIndex = 1
						}
						for (i = 0; i < dots.length; i++) {
							dots[i].className = dots[i].className.replace(" active", "");
						}
						slides[slideIndex - 1].style.display = "block";
						dots[slideIndex - 1].className += " active";
						setTimeout(showSlides, 2000); // Change image every 2 seconds
				}
				</script>

<!-- /HOT DEAL SECTION -->
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./img/apple-macbook-pro-14-m1-pro-2021-600x600.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptop<br>Bộ Sưu Tập</h3>
                        <a href="{{ url('/store') }}" class="cta-btn">Mua nào <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./img/samsung-galaxys22ultra.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Điện Thoại<br>Bộ Sưu Tập</h3>
                        <a href="{{ url('/store') }}" class="cta-btn">Mua nào <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./img/product02.png" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Phụ Kiện<br>Bộ Sưu Tập</h3>
                        <a href="{{ url('/store') }}" class="cta-btn">Mua nào <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản Phẩm Mới</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#np">Alls</a></li>
                            @foreach($allmanus as $value)
                            <li><a data-toggle="tab" href="#np{{ $value->manu_id }}">{{ $value->manu_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="np" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-np">
                                <!-- product -->
                                @foreach($newproducts as $value)
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img
                                                src="{{ asset('img/'.$value->image) }}" alt=""></a>
                                        <?php if ($value->sale > 0) { ?>
                                        <div class="product-label">
                                            <span class="sale">{{ "-".$value->sale."%" }}</span>
                                            <span class="new">NEW</span>
                                        </div>
                                        <?php } else { ?>
                                        <div class="product-label">
                                            <span class="new">NEW</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $value->manufacturers->manu_name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a>
                                        </h3>
                                        <?php if ($value->sale > 0) { ?>
                                        <h4 class="product-price">
                                            {{ number_format($value->price - ($value->price * $value->sale / 100)) . " VNĐ" }}<del
                                                class="product-old-price">{{ number_format($value->price)." VNĐ" }}</del>
                                        </h4>
                                        <?php } else { ?>
                                        <h4 class="product-price">{{ number_format($value->price)." VNĐ" }}</h4>
                                        <?php } ?>
                                        <div class="product-rating">
                                            <?php for ($i = 0; $i < 5; $i++) {
												if ($i < $value->star) { ?>
                                            <i class="fa fa-star"></i>
                                            <?php } else { ?>
                                            <i class="fa fa-star-o"></i>
                                            <?php }
											} ?>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{ url('/carts/add/'.$value->product_id) }}">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-np" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                        @foreach($allmanus as $manu)
                        <!-- tab -->
                        <div id="np{{ $manu->manu_id }}" class="tab-pane">
                            <div class="products-slick" data-nav="#slick-nav-np{{ $manu->manu_id }}">
                                <!-- product -->
                                @foreach(${'newproduct'.$manu->manu_id} as $value)
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img
                                                src="{{ asset('img/'.$value->image) }}" alt=""></a>
                                        <?php if ($value->sale > 0) { ?>
                                        <div class="product-label">
                                            <span class="sale">{{ "-".$value->sale."%" }}</span>
                                        </div>
                                        <?php } else { ?>
                                        <div class="product-label">
                                            <span class="new">NEW</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $value->manufacturers->manu_name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a>
                                        </h3>
                                        <?php if ($value->sale > 0) { ?>
                                        <h4 class="product-price">
                                            {{ number_format($value->price - ($value->price * $value->sale / 100)) . " VNĐ" }}<del
                                                class="product-old-price">{{ number_format($value->price)." VNĐ" }}</del>
                                        </h4>
                                        <?php } else { ?>
                                        <h4 class="product-price">{{ number_format($value->price)." VNĐ" }}</h4>
                                        <?php } ?>
                                        <div class="product-rating">
                                            <?php for ($i = 0; $i < 5; $i++) {
												if ($i < $value->star) { ?>
                                            <i class="fa fa-star"></i>
                                            <?php } else { ?>
                                            <i class="fa fa-star-o"></i>
                                            <?php }
											} ?>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{ url('/carts/add/'.$value->product_id) }}">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-np{{ $manu->manu_id }}" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
				<div class="s-banner__left">
                <img src="img/banner-img.png" alt="">
            </div>			
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">HOT HOT GIẢM GIÁ SỐC</h2>
                    <p>GIẢM GIÁ SỐC 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản Phẩm Bán Chạy</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#ts">Alls</a></li>
                            @foreach($allmanus as $value)
                            <li><a data-toggle="tab" href="#ts{{ $value->manu_id }}">{{ $value->manu_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="ts" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-ts">
                                <!-- product -->
                                @foreach($topsellings as $value)
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img
                                                src="{{ asset('img/'.$value->image) }}" alt=""></a>
                                        <?php if ($value->sale > 0) { ?>
                                        <div class="product-label">
                                            <span class="sale">{{ "-".$value->sale."%" }}</span>
                                        </div>
                                        <?php } else { ?>
                                        <div class="product-label">
                                            <span class="new">NEW</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $value->manufacturers->manu_name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a>
                                        </h3>
                                        <?php if ($value->sale > 0) { ?>
                                        <h4 class="product-price">
                                            {{ number_format($value->price - ($value->price * $value->sale / 100)) . " VNĐ" }}<del
                                                class="product-old-price">{{ number_format($value->price)." VNĐ" }}</del>
                                        </h4>
                                        <?php } else { ?>
                                        <h4 class="product-price">{{ number_format($value->price)." VNĐ" }}</h4>
                                        <?php } ?>
                                        <div class="product-rating">
                                            <?php for ($i = 0; $i < 5; $i++) {
												if ($i < $value->star) { ?>
                                            <i class="fa fa-star"></i>
                                            <?php } else { ?>
                                            <i class="fa fa-star-o"></i>
                                            <?php }
											} ?>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{ url('/carts/add/'.$value->product_id) }}">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-ts" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                        @foreach($allmanus as $manu)
                        <!-- tab -->
                        <div id="ts{{ $manu->manu_id }}" class="tab-pane">
                            <div class="products-slick" data-nav="#slick-nav-ts{{ $manu->manu_id }}">
                                <!-- product -->
                                @foreach(${'topselling'.$manu->manu_id} as $value)
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img
                                                src="{{ asset('img/'.$value->image) }}" alt=""></a>
                                        <?php if ($value->sale > 0) { ?>
                                        <div class="product-label">
                                            <span class="sale">{{ "-".$value->sale."%" }}</span>
                                        </div>
                                        <?php } else { ?>
                                        <div class="product-label">
                                            <span class="new">NEW</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $value->manufacturers->manu_name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a>
                                        </h3>
                                        <?php if ($value->sale > 0) { ?>
                                        <h4 class="product-price">
                                            {{ number_format($value->price - ($value->price * $value->sale / 100)) . " VNĐ" }}<del
                                                class="product-old-price">{{ number_format($value->price)." VNĐ" }}</del>
                                        </h4>
                                        <?php } else { ?>
                                        <h4 class="product-price">{{ number_format($value->price)." VNĐ" }}</h4>
                                        <?php } ?>
                                        <div class="product-rating">
                                            <?php for ($i = 0; $i < 5; $i++) {
												if ($i < $value->star) { ?>
                                            <i class="fa fa-star"></i>
                                            <?php } else { ?>
                                            <i class="fa fa-star-o"></i>
                                            <?php }
											} ?>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{ url('/carts/add/'.$value->product_id) }}">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-ts{{ $manu->manu_id }}" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <?php for ($i = 0; $i < 3; $i++) { ?>
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Sản Phẩm Bán Chạy <?php echo $allmanus[$i]->manu_name ?></h4>
                    <div class="section-nav">
                        <div id="slick-nav-sl{{ $i }}" class="products-slick-nav"></div>
                    </div>
                </div>
                <div class="products-widget-slick" data-nav="#slick-nav-sl{{ $i }}">
                    @foreach(${'topselling'.$i + 1} as $value)
                    <!-- product widget -->
                    <div class="product-widget">
                        <div class="product-img">
                            <a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img
                                    src="{{ asset('img/'.$value->image) }}" alt=""></a>
                        </div>
                        <div class="product-body">
                            <p class="product-category">{{ $value->manufacturers->manu_name }}</p>
                            <h3 class="product-name"><a
                                    href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a>
                            </h3>
                            <?php if ($value->sale > 0) { ?>
                            <h4 class="product-price">
                                {{ number_format($value->price - ($value->price * $value->sale / 100)) . " VNĐ" }}<del
                                    class="product-old-price">{{ number_format($value->price)." VNĐ" }}</del></h4>
                            <?php } else { ?>
                            <h4 class="product-price">{{ number_format($value->price)." VNĐ" }}</h4>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /product widget -->
                    @endforeach
                </div>
                <div class="products-widget-slick" data-nav="#slick-nav-sl{{ $i }}">
                    @foreach(${'topselling'.$i + 1} as $value)
                    <!-- product widget -->
                    <div class="product-widget">
                        <div class="product-img">
                            <a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img
                                    src="{{ asset('img/'.$value->image) }}" alt=""></a>
                        </div>
                        <div class="product-body">
                            <p class="product-category">{{ $value->manufacturers->manu_name }}</p>
                            <h3 class="product-name"><a
                                    href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a>
                            </h3>
                            <?php if ($value->sale > 0) { ?>
                            <h4 class="product-price">
                                {{ number_format($value->price - ($value->price * $value->sale / 100)) . " VNĐ" }}<del
                                    class="product-old-price">{{ number_format($value->price)." VNĐ" }}</del></h4>
                            <?php } else { ?>
                            <h4 class="product-price">{{ number_format($value->price)." VNĐ" }}</h4>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /product widget -->
                    @endforeach
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection