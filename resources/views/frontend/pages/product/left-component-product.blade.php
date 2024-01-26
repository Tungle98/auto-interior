<aside id="flatsome_recent_posts-4" class="widget flatsome_recent_posts"> <span
        class="widget-title "><span>DANH MỤC SẢN PHẨM</span></span>
    <div class="is-divider small"></div>
    <div class="menu-danh-muc-san-pham-vertical-menu-container">
        <ul id="menu-danh-muc-san-pham-vertical-menu" class="menu">
            @foreach($categories as $item)
                <li id="menu-item-437"
                    class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-437">
                    <a href="{{route('danh-muc',['slug'=>$item->slug])}}">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
</aside>
<aside id="" class="widget  mt-4"><span class="widget-title "><span>SẢN PHẨM </span></span>
    <div class="is-divider small"></div>
    <ul class="product_list_widget">
        @foreach($productTop as $i)
            <li>
                <div class="d-flex flex-row bd-highlight ">
                    <div class="p-2 bd-highlight">
                        <img width="100" height="100"
                             src="{{$i->image}}"
                             class="attachment-woocommerce_gallery_thumbnail size-woocommerce_gallery_thumbnail"
                             alt=""
                             sizes="(max-width: 100px) 100vw, 100px">
                    </div>
                    <div class="p-2 bd-highlight"><a
                            href="{{route('san-pham',['slug' => $i->slug])}}">
                            <span class="product-title">{{$i->name}}</span>
                        </a>
                        <span class="woocommerce-Price-amount amount">{{number_format($i->price)}}&nbsp;<span
                                class="woocommerce-Price-currencySymbol">₫</span></span></div>

                </div>

            </li>
        @endforeach
    </ul>
</aside>
