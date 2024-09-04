@extends('website.layout.app')

@section('content')
    @include('website.layout.sidebar')

    <div class="middleText">

        <div class="bigStory" id="58196">
            <div class="ribbon">
                @if ($slug == null)
                    {{ 'टॉप न्यूज़' }}
                @else
                    {{ $latestNews->newsCategory->name }}
                @endif

                <span class="rhsRibbon"></span>
            </div>
            <h1>
                <a href="{{ route('category-detail-news', ['city' => $latestNews->cities->slug, 'slug' => $latestNews->slug]) }}"
                    title="{{ $latestNews->sub_title }}">
                    <span>{{ $latestNews->title }} :</span>
                    {{ $latestNews->sub_title }}
                </a>
            </h1>
            <div class="flex">
                <div class="socialicon">
                    <a href="https://www.facebook.com/sharer.php?u=https://tricitytoday.com/hapur/muslim-community-showered-flowers-on-kanwariyas-in-hapur-58196.html&?utm_source=facebook&utm_medium=social&utm_campaign=article"
                        class="fb" target="_blank" rel="noopener">Faceback</a>
                    <a href="https://twitter.com/intent/tweet?url=https://tricitytoday.com/hapur/muslim-community-showered-flowers-on-kanwariyas-in-hapur-58196.html&text=&?utm_source=twitter&utm_medium=social&utm_campaign=article"
                        class="twitter" target="_blank" rel="noopener">Twitter</a>
                    <a href="https://web.whatsapp.com/send?text= https://tricitytoday.com/hapur/muslim-community-showered-flowers-on-kanwariyas-in-hapur-58196.html&utm_source=whatsup&utm_medium=social&utm_campaign=article"
                        class="whatsup" target="_blank" rel="noopener">Whats</a>
                </div>
            </div>

            <a href="{{ route('category-detail-news', ['city' => $latestNews->states->slug, 'slug' => $latestNews->slug]) }}"
                title="{{ $latestNews->sub_title }}">
                <figure class="imgSize w100">
                    <figcaption>{{ $latestNews->states->name }}</figcaption>
                    <picture>
                        <source media="(min-width:320px) and (max-width:760px)"
                            srcset="{{ asset('admin/assets/images/news/' . $latestNews->image) }}">
                        <source media="(min-width:760px) and (max-width:1480px)"
                            srcset="{{ asset('admin/assets/images/news/' . $latestNews->image) }} 2x">
                        <img src="{{ asset('admin/assets/images/news/' . $latestNews->image) }} 2x" />
                    </picture>
                </figure>
            </a>
            <content class="content">
                {!! mb_strlen(strip_tags($latestNews->news_detail)) > 400
                    ? mb_substr(strip_tags($latestNews->news_detail), 0, 400) . '...'
                    : strip_tags($latestNews->news_detail) !!}
            </content>
            @if (request()->routeIs('category-detail-news') && request()->route('city'))
                {!! strip_tags($latestNews->news_detail) !!}
            @else
                {!! mb_strlen(strip_tags($latestNews->news_detail)) > 400
                    ? mb_substr(strip_tags($latestNews->news_detail), 0, 400) . '...'
                    : strip_tags($latestNews->news_detail) !!}
            @endif

        </div>


        <div class="middleAds">
            <div class="ads">
                <!-- /21849124645/Top_Header -->
                <div id='div-gpt-ad-1613124975497-0'>
                    <script>
                        googletag.cmd.push(function() {
                            googletag.display('div-gpt-ad-1613124975497-0');
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="otherNews">
            <h3>अन्य खबरें</h3>
            @if (isset($news) && $news->isNotEmpty())
                @foreach ($news as $item)
                    <div class="list">
                        <div class="lhs">
                            <p>
                                <a href="{{ route('category-detail-news', ['city' => $item->cities->slug, 'slug' => $item->slug]) }}"
                                    title="{{ $item->sub_title }}">
                                    <span>{{ $item->title }} :</span>
                                    {{ $item->sub_title }}
                                </a>
                            </p>
                            <span class="location">
                                <a href="{{ url($item->newsCategory->slug) }}" title="{{ $item->newsCategory->name }}">
                                    {{ $item->newsCategory->name }}
                                </a>
                            </span>
                            <span class="padleft">{{ date('d-M-Y h:i A', strtotime($item->created_at)) }}</span>
                        </div>
                        <div class="rhs">
                            <a href="https://tricitytoday.com/noida/noida-hindon-riverfront-project-will-be-developed-on-sabarmati-model-58198.html"
                                title="साबरमती मॉडल पर विकसित होगा नोएडा का तटीय क्षेत्र, छह सदस्यीय समिति गठित">
                                <figure class="img">
                                    <picture>

                                        <img src="https://static.tricitytoday.com/images/lazy_image.jpg"
                                            data-src="https://image.tricitytoday.com/thumb/140x108/22222-89654_3.jpg"
                                            width="144" height="108"
                                            alt="साबरमती मॉडल पर विकसित होगा नोएडा का तटीय क्षेत्र, छह सदस्यीय समिति गठित"
                                            class="lazyload" />
                                    </picture>
                                </figure>
                            </a>
                            <div class="socialicon">
                                <a href="https://www.facebook.com/sharer.php?u=https://tricitytoday.com/noida/noida-hindon-riverfront-project-will-be-developed-on-sabarmati-model-58198.html&?utm_source=facebook&utm_medium=social&utm_campaign=article"
                                    class="fb" target="_blank" rel="noopener">Faceback</a>
                                <a href="https://twitter.com/intent/tweet?url=https://tricitytoday.com/noida/noida-hindon-riverfront-project-will-be-developed-on-sabarmati-model-58198.html&text=Hindon+Riverfront+Project+%3A+%E0%A4%B8%E0%A4%BE%E0%A4%AC%E0%A4%B0%E0%A4%AE%E0%A4%A4%E0%A5%80+%E0%A4%AE%E0%A5%89%E0%A4%A1%E0%A4%B2+%E0%A4%AA%E0%A4%B0+%E0%A4%B5%E0%A4%BF%E0%A4%95%E0%A4%B8%E0%A4%BF%E0%A4%A4+%E0%A4%B9%E0%A5%8B%E0%A4%97%E0%A4%BE+%E0%A4%A8%E0%A5%8B%E0%A4%8F%E0%A4%A1%E0%A4%BE+%E0%A4%95%E0%A4%BE+%E0%A4%A4%E0%A4%9F%E0%A5%80%E0%A4%AF+%E0%A4%95%E0%A5%8D%E0%A4%B7%E0%A5%87%E0%A4%A4%E0%A5%8D%E0%A4%B0%2C+%E0%A4%9B%E0%A4%B9+%E0%A4%B8%E0%A4%A6%E0%A4%B8%E0%A5%8D%E0%A4%AF%E0%A5%80%E0%A4%AF+%E0%A4%B8%E0%A4%AE%E0%A4%BF%E0%A4%A4%E0%A4%BF+%E0%A4%97%E0%A4%A0%E0%A4%BF%E0%A4%A4&?utm_source=twitter&utm_medium=social&utm_campaign=article"
                                    class="twitter" target="_blank" rel="noopener">Twitter</a>
                                <a href="https://web.whatsapp.com/send?text=Hindon+Riverfront+Project+%3A+%E0%A4%B8%E0%A4%BE%E0%A4%AC%E0%A4%B0%E0%A4%AE%E0%A4%A4%E0%A5%80+%E0%A4%AE%E0%A5%89%E0%A4%A1%E0%A4%B2+%E0%A4%AA%E0%A4%B0+%E0%A4%B5%E0%A4%BF%E0%A4%95%E0%A4%B8%E0%A4%BF%E0%A4%A4+%E0%A4%B9%E0%A5%8B%E0%A4%97%E0%A4%BE+%E0%A4%A8%E0%A5%8B%E0%A4%8F%E0%A4%A1%E0%A4%BE+%E0%A4%95%E0%A4%BE+%E0%A4%A4%E0%A4%9F%E0%A5%80%E0%A4%AF+%E0%A4%95%E0%A5%8D%E0%A4%B7%E0%A5%87%E0%A4%A4%E0%A5%8D%E0%A4%B0%2C+%E0%A4%9B%E0%A4%B9+%E0%A4%B8%E0%A4%A6%E0%A4%B8%E0%A5%8D%E0%A4%AF%E0%A5%80%E0%A4%AF+%E0%A4%B8%E0%A4%AE%E0%A4%BF%E0%A4%A4%E0%A4%BF+%E0%A4%97%E0%A4%A0%E0%A4%BF%E0%A4%A4 https://tricitytoday.com/noida/noida-hindon-riverfront-project-will-be-developed-on-sabarmati-model-58198.html&utm_source=whatsup&utm_medium=social&utm_campaign=article"
                                    class="whatsup" target="_blank" rel="noopener">Whats</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <input type="hidden" name="cat_page" id="cat_page" value="0">
            <input type="hidden" name="type_data" id="type_data" value="category">
            <div id="results">
            </div>
            <div id="load-msg"></div>
        </div>

    </div>
    @include('website.layout.rightbar')

    <div id="overlay"></div>
@endsection
