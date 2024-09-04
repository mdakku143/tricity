<div class="topRow">
    <div class="topStrip">
        <a class="logo" href="{{ route('home-page') }}" title="PHM">PHM News</a>
        <nav>
            <ul class="mobile">
                <li class="search"><a href="javascript:void(0);" title=" सर्"><i> </i><span> सर् </span> </a></li>
                <li class="menubar"><a href="javascript:void(0);"><i> </i><span>Menu</span> </a></li>
            </ul>
            <ul class="desktop">

                <li class="home"><a href="{{ route('home-page') }}" title="होम"><i> </i><span> होम </span></a></li>

                <li class="trading"><a href="https://tricitytoday.com/trending-news" title="ट्रेंडिंग"><i> </i><span>
                            ट्रेंडिंग </span></a></li>
                {{-- <li class="search"><a href="javascript:void(0);" title="सर्च"><i> </i><span> सर्च </span> </a></li> --}}
                <li class="app"><!--<a href="/epaper" title="e-पेपर">--><a href="/epaper"> <i> </i><span> e-पेपर
                        </span></a>
                </li>
                {{-- <li class="LogMenu"><a href="https://tricitytoday.com/login/" class="LogoutMenu"> <img width="100%"
                            src="https://tricitytoday.com/images/logout-btn.svg" /> लॉग इन</a></li> --}}

                <!--/Misson shakti.pdf-->
                <!-- only Mobile -->
                <li class="onlyMobile"><a href="https://tricitytoday.com/terms-condition" title="Terms of Use">Terms of
                        Use</a></li>
                <!--<li class="onlyMobile"><a href="https://tricitytoday.com/terms-condition" title="Terms of Use"> Contact Us </a></li> -->
                <li class="onlyMobile"><a href="https://tricitytoday.com/cookie-policy" title="Cookie Policy">Cookie
                        Policy</a></li>
                <li class="onlyMobile"><a href="https://tricitytoday.com/privacy-policy" title="Privacy Policy">Privacy
                        Policy</a></li>
                <li class="onlyMobile"><a href="https://uttarpradeshtimes.com/" target="_blank"
                        title="Uttar Pradesh Times">Uttar Pradesh Times</a></li>
                <li class="onlyMobile copyright">Copyright © 2019-2020 Tricity. All Rights Reserved.</li>
                <li class="onlyMobile menuAds"> </li>
                <li class="onlyMobile">
                    <div class="lhsSocial"> Follow us on:
                        <ul>
                            <li><a href="https://www.facebook.com/Tricitytoday/" class="fb"
                                    title="Facebook">Facebook</a></li>
                            <li><a href="https://twitter.com/tricitytoday" class="twitter" title="Twitter"> Twitter</a>
                            </li>
                            <li><a href="https://instagram.com/tricitytoday_?igshid=1glpy0dn0uzeg" target="_blank"
                                    class="photo">
                                    Photo</a></li>
                            <li><a href="https://youtube.com/c/TricityTodaylive" target="_blank" class="youtube"
                                    title="YouTube">YouTube</a></li>
                        </ul>
                    </div>
                </li>
                <!-- only Mobile END -->
            </ul>
        </nav>
        <div class="searchBox">
            <div class="input-group">
                <input type="text" value="" placeholder="Search" class="form-control " name="searchText"
                    id="searchText" onKeyUp="dataSearch(event, 'search');">
                <input class="btn" type="button" name="Search" onClick="return check_search('search');">
            </div>
        </div>
    </div>
</div>
