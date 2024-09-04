<div class="lhsTbl theialhsTbl">
    <div class="theiaStickySidebar">
        @if ($category->isNotEmpty())
            <ul class="navigation">
                <li class="ic_delhi {{ request()->is('/') || request()->is('top-news') ? 'active' : '' }}">
                    <a href="{{ url('top-news') }}" title="टॉप न्यूज़">
                        टॉप न्यूज़
                    </a>
                </li>
                @foreach ($category as $c)
                    <li class="ic_delhi {{ request()->is($c->slug) ? 'active' : '' }}">
                        <a href="{{ url($c->slug) }}" title="{{ $c->name }}">
                            {{ $c->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif


        <!--<div class="lftAds"><img src="https://static.tricitytoday.com/images/img_epaper_banner.png" ></div>-->

        {{-- <div class="lftAds">
            <a href="https://tricitytoday.com/epaper" target="_blank">
                <img src="https://static.tricitytoday.com/images/magzine_event.jpeg">
            </a>
        </div> --}}
        <div class="lhsSocial">'
            Follow us on:
            <ul>
                <li><a href="https://www.facebook.com/TricityTodayLive" class="fb" title="Facebook" target="_blank"
                        rel="noopener">Facebook</a></li>
                <li><a href="https://twitter.com/tricitytoday" class="twitter" title="Twitter" target="_blank"
                        rel="noopener"> Twitter</a></li>
                <li><a target="_blank" href="https://instagram.com/tricitytoday_?igshid=1glpy0dn0uzeg" class="photo"
                        rel="noopener"> Photo</a></li>
                <li><a target="_blank" href="https://youtube.com/c/TricityTodaylive" class="youtube" title="YouTube"
                        rel="noopener"> YouTube</a></li>
            </ul>
        </div>
    </div>
</div>
