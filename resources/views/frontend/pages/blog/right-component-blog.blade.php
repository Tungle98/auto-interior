<aside id="search-2" class="widget widget_search ">
    <form class="d-flex"  action="{{route('search-blog')}}" method="GET">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm..."
               aria-label="Search" name="key">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</aside>
<aside id="flatsome_recent_posts-4" class="widget flatsome_recent_posts"> <span
        class="widget-title "><span>Bài viết nổi bật</span></span>
    <div class="is-divider small"></div>
    <ul>
        @foreach($blogTop as $blog)
            <li class="recent-blog-posts-li">
                <div class="flex-row-cus recent-blog-posts align-top pt-half pb-half">
                    <a href="{{route('blog',['slug' => $blog->slug])}}">
                        <div class="flex-col mr-half left-img">
                            <div class="badge post-date  badge-circle">
                                <div class="badge-inner bg-fill">
                                    <img src="{{$blog->image}}"
                                         class="img-new-right">
                                </div>
                            </div>
                        </div><!-- .flex-col -->
                    </a>

                    <div class="flex-col flex-grow new-text-box">
                        <a href="{{route('blog',['slug' => $blog->slug])}}"
                           title="{{$blog->title}}">{{$blog->title}}</a>

                    </div>
                </div><!-- .flex-row -->
            </li>
        @endforeach
    </ul>
</aside>
