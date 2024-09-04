@extends('website.layout.app')

@section('content')
    @include('website.layout.sidebar')
    <div class="middleText">

        <div class="articleWrap factPage fact10 live">
            <ul class="breadcrumb">
                <!-- Breadcrumb start-->
                <li><a href="{{ url('/') }}">Home: </a></li>
                <li><a href="/hapur">{{ ucfirst($latestNews->cities->slug) }}</a></li>
                {{-- <li>{{ ucwords($latestNews->slug) }}</li> --}}
                <!-- End Breadcrumb -->
            </ul>
            <h1 class="title"> <span>{{ $latestNews->title }} :</span> {{ $latestNews->sub_title }}</h1>

            <div class="flex">
                <div class="timestamp">
                    <a href="javascript:void(0)">{{ $latestNews->cities->name }}</a>
                    <a href="javascript:void(0)">{{ date('d-M-Y h:i A', strtotime($latestNews->created_at)) }}</a>
                    <a href="javascript:void(0)">{{ $latestNews->reporter->name }}</a>
                </div>
                <div class="socialicon">
                    <a href="https://www.facebook.com/sharer.php?u=https://tricitytoday.com/hapur/muslim-community-showered-flowers-on-kanwariyas-in-hapur-58196.html&?utm_source=facebook&utm_medium=social&utm_campaign=article"
                        class="fb" target="_blank" rel="noopener">Faceback</a>
                    <a href="https://twitter.com/intent/tweet?url=https://tricitytoday.com/hapur/muslim-community-showered-flowers-on-kanwariyas-in-hapur-58196.html&text=%E0%A4%B9%E0%A4%BE%E0%A4%AA%E0%A5%81%E0%A5%9C+%E0%A4%AE%E0%A5%87%E0%A4%82+%E0%A4%A6%E0%A4%BF%E0%A4%96%E0%A4%BE+%E0%A4%AD%E0%A4%BE%E0%A4%88%E0%A4%9A%E0%A4%BE%E0%A4%B0%E0%A4%BE+%3A+%E0%A4%AE%E0%A5%81%E0%A4%B8%E0%A5%8D%E0%A4%B2%E0%A4%BF%E0%A4%AE+%E0%A4%B8%E0%A4%AE%E0%A5%81%E0%A4%A6%E0%A4%BE%E0%A4%AF+%E0%A4%A8%E0%A5%87+%E0%A4%95%E0%A4%BE%E0%A4%82%E0%A4%B5%E0%A5%9C%E0%A4%BF%E0%A4%AF%E0%A5%8B%E0%A4%82+%E0%A4%AA%E0%A4%B0+%E0%A4%95%E0%A5%80+%E0%A4%AA%E0%A5%81%E0%A4%B7%E0%A5%8D%E0%A4%AA+%E0%A4%B5%E0%A4%B0%E0%A5%8D%E0%A4%B7%E0%A4%BE%2C+%E0%A4%AC%E0%A5%8B%E0%A4%B2%E0%A5%87+%E0%A4%86%E0%A4%AA%E0%A4%95%E0%A4%BE+%E0%A4%B8%E0%A5%8D%E0%A4%B5%E0%A4%BE%E0%A4%97%E0%A4%A4+%E0%A4%B9%E0%A5%88&?utm_source=twitter&utm_medium=social&utm_campaign=article"
                        class="twitter" target="_blank" rel="noopener">Twitter</a>
                    <a href="https://web.whatsapp.com/send?text=%E0%A4%B9%E0%A4%BE%E0%A4%AA%E0%A5%81%E0%A5%9C+%E0%A4%AE%E0%A5%87%E0%A4%82+%E0%A4%A6%E0%A4%BF%E0%A4%96%E0%A4%BE+%E0%A4%AD%E0%A4%BE%E0%A4%88%E0%A4%9A%E0%A4%BE%E0%A4%B0%E0%A4%BE+%3A+%E0%A4%AE%E0%A5%81%E0%A4%B8%E0%A5%8D%E0%A4%B2%E0%A4%BF%E0%A4%AE+%E0%A4%B8%E0%A4%AE%E0%A5%81%E0%A4%A6%E0%A4%BE%E0%A4%AF+%E0%A4%A8%E0%A5%87+%E0%A4%95%E0%A4%BE%E0%A4%82%E0%A4%B5%E0%A5%9C%E0%A4%BF%E0%A4%AF%E0%A5%8B%E0%A4%82+%E0%A4%AA%E0%A4%B0+%E0%A4%95%E0%A5%80+%E0%A4%AA%E0%A5%81%E0%A4%B7%E0%A5%8D%E0%A4%AA+%E0%A4%B5%E0%A4%B0%E0%A5%8D%E0%A4%B7%E0%A4%BE%2C+%E0%A4%AC%E0%A5%8B%E0%A4%B2%E0%A5%87+%E0%A4%86%E0%A4%AA%E0%A4%95%E0%A4%BE+%E0%A4%B8%E0%A5%8D%E0%A4%B5%E0%A4%BE%E0%A4%97%E0%A4%A4+%E0%A4%B9%E0%A5%88 https://tricitytoday.com/hapur/muslim-community-showered-flowers-on-kanwariyas-in-hapur-58196.html&utm_source=whatsup&utm_medium=social&utm_campaign=article"
                        class="whatsup" target="_blank" rel="noopener">Whats</a>
                    <a href="https://news.google.com/publications/CAAqBwgKMMzQlwsw7vmuAw?hl=hi&gl=IN&ceid=IN%3Ahi"
                        class="googlenewsIcon" target="_blank" rel="noopener"> <span>Follow us on</span> <img
                            src="https://static.tricitytoday.com/images/googlenewsimage.svg" /></a>
                </div>
            </div>
            <section class="articleTxt factTxt">
                <figure class="imgSize">
                    <picture>

                        <img src="https://static.tricitytoday.com/images/lazy_image.jpg"
                            data-src="https://image.tricitytoday.com/thumb/845x545/whatsapp-image-2024-07-31-at-32342-pm-3742_4.jpeg"
                            alt="मुस्लिम समुदाय ने कांवड़ियों पर की पुष्प वर्षा, बोले आपका स्वागत है" class="lazyload" />
                    </picture>


                </figure>
                <p class="intro">Tricity Today | कांवड़ियों पर की पुष्प वर्षा</p>
                <strong>Hapur News :</strong> बुधवार को कांवड़ यात्रा के दौरान बहुत खूबसूरत नजारा दिखाने को मिला। जहां शहर से
                निकल रहे कांवड़ियों पर सामुदाय विशेष के लोगों ने ना केवल पुष्प वर्षा की बल्कि अपितु कांवड़ियों को पानी पिलाया
                और उनकी सेवा की। मुख्य रूप से शहर से निकल रहे कांवड़ यात्रा के दौरान यह तस्वीर बुलंदशहर रोड पर दिखाई
                दी।&nbsp;<br />
                <br />
                <strong>प्रेममय नजारा देखने को मिला</strong><br />
                एक ओर जहां देश में बिगड़ते माहौल में तमाम लोग आग को हवा देने के काम करते हैं, वहीं दूसरी ओर हर समुदाय में
                ऐसे लोग भी हैं जो समय-समय पर सामप्रदायिक सौहार्द्र को बढ़ावा देने के लिए आगे आते हैं। हापुड़ जिले में भी ऐसा
                ही प्रेममय नजारा देखने को मिला हैं। जो पूरे देश के लिए मिसाल बन रहा है। बुलंदशहर रोड पर स्थित सांप्रदायिक
                सद्भाव का परिचय देते हुए मुस्लिम समुदाय के लोगों ने कांवड़ियों पर पुष्प वर्षा करके उनका स्वागत किया। सावन के
                पवित्र महीने में कांवड़ियों की श्रद्धा का ऐसा सम्मान कर मुस्लिम समुदाय के लोगों ने भाई चारे का जीवंत उदाहरण
                प्रस्तुत किया है। इस पहल की लोग खूब सराहना कर रहे हैं।<br />
                <br />
                <strong>यह रहे मौजूद&nbsp;</strong><br />
                इस स्वागत के दौरान दौरान मौलाना कारी इरशाद, छोटे खा, फैज अंसारी, बाबू अंसारी, हुसमुदीन सैफी, चंद, बाबू
                सियालिया, कबीर खान, ओरेंजिएब सैफी, इलियास अंसारी आदि मौजूद रहे। <div id="csc-paywall" class="cscPaywall"
                    style="margin-top: 30px;"></div>
                <p>
                <ul class="TagsList">
                    <li><strong>Tags:</strong></li>
                    <li><a href="https://tricitytoday.com/topic/kanwar-yatra">Kanwar Yatra</li>
                    <li><a href="https://tricitytoday.com/topic/hapur-news"> Hapur News</li>
                </ul>
                </p>
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
            </section>

        </div>


        <div class="otherNews">
            <h3>अन्य खबरे</h3>
            <input type="hidden" name="cat_page" id="cat_page" value="45">
            <input type="hidden" name="type_data" id="type_data" value="category">
            <div id="results">
            </div>
            <div id="load-msg"></div>
        </div>
    </div>

    @include('website.layout.rightbar')

    <div id="overlay"></div>
@endsection
