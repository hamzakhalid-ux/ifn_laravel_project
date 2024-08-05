<div class="container">
    <main class="mt-20">
        <div class="launch-partners">
            <aside class="left">
                <span class="button d-2">LAUNCH PARTNERS</span>
                <ul class="partners">
                    <li class="left"> <img src="./assets/images/1.png" alt=""></li>
                    <li class="left"> <img src="./assets/images/2.png" alt=""></li>
                    <li class="left"> <img src="./assets/images/3.png" alt=""></li>
                    <li class="left"> <img src="./assets/images/4.png" alt=""></li>
                </ul>
            </aside>
            <aside class="right">
                <div class="search-fields left">
                    <span class="form-fields search d1 mt-20">
                        <input type="text" placeholder="Article Search">
                        <img src="./assets/images/vector.png" alt="">
                    </span>
                    <span class="form-fields search d2 mt-10">
                        <label>Advanced Search
                            <img src="./assets/images/vector1.png" alt="">
                        </label>
                    </span>

                    <div class="right-aside left mt-20">
                        <span class="button d-2">EDITOR’S PICK</span>
                    </div>
                </div>
                <div class="fund-btns right">
                    <span class="button d-1 fw mt-20">Fund Database</span>
                    <span onclick="window.location.href = '{{ route('directory.list') }}';" class="button d-1 fw mt-10">Fund Directory</span>

                   <span class="button d-1 fw mt-10">

                        <img src="./assets/images/Vector (4).png" alt="" class="img-2">
                        Add Your Fund
                </span>

                </div>
            </aside>
        </div>
        <section class="editor-picks mt-40">
            <div class="left-aside left"></div>
           <!--- <div class="right-aside right">
                <span class="button d-2">EDITOR’S PICK</span>
            </div>--->
            <div class="clearfix"></div>
            <div class="cards d-1">
                <div class="inner ">
                    @foreach($setting['settingmappersession']['slider_session'] as $key =>$item)
                     @if ($key == 0)
                        <div class="left-aside left">
                            <img src="{{ asset('post/' . $item['settingpost']['post_image']) }}" style="width:597px;height:480px" alt="">
                        </div>
                        <div class="right-aside right">
                            <h3 class="label label-1">
                                {{$item['settingpost']['post_title'] ?? ''}}
                            </h3>
                            <p class="label para-1">
                                {!! $item['settingpost']['post_content'] ?? ''!!}
                            </p>
                        </div>
                     @endif
                    @endforeach
                </div>
                <div class="bottom mt--10">
                    <div class="left-aside left"></div>
                    <div class="right-aside right">
                        <span class="slide-arrrows left">
                        <img src="assets/images/arrow.png">
                        </span>
                        <span class="button d-1 right ">What’s Happening?</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="reports-news mt-40">
            <div class="left-aside left">
                @if(!empty($setting['settingmappersession']['middle_left'][0]['settingpost']))
                <span class="button d-2">{{$setting['settingmappersession']['middle_left'][0]['settingpost']['post_category'][0]['categorytitle']['title'] ?? ''}}</span>
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img style="width: 281px; height: 309px;" src="{{ asset('post/' . $setting['settingmappersession']['middle_left'][0]['settingpost']['post_image']) }}" alt="">
                        </div>
                        <div class="right-aside right pr-5">
                            <h3 class="label label-2">
                                {{ $setting['settingmappersession']['middle_left'][0]['settingpost']['post_title'] ?? '' }}
                            </h3>
                            <p class="label para-2">
                                {!! $setting['settingmappersession']['middle_left'][0]['settingpost']['post_content'] ?? '' !!}
                            </p>
                            <div class="bottom mt-40 pr-5 ">
                                <span class="slide-arrrows left mt-20">
                                    <img src="assets/images/arrow.png" class="img-1">
                                </span>
                                <span class="button d-3 right">More Reports</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!---Logo Banner-->
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img src="./assets/images/hsbc.png" alt="">

                        </div>
                        <div class="right-aside right">
                            <img src="./assets/images/eiger.png" alt="">
                        </div>
                    </div>
                </div>
                <!---Card-->
                <div class="cards d-2">
                    @if(!empty($setting['settingmappersession']['middle_left'][1]['settingpost']))
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img src="{{ asset('post/' . $setting['settingmappersession']['middle_left'][1]['settingpost']['post_image']) }}" class="worldimg" style="width: 281px; height: 309px;">
                        </div>
                        <div class="right-aside right pr-5">
                            <h3 class="label label-2">
                                {{ $setting['settingmappersession']['middle_left'][1]['settingpost']['post_title'] ?? '' }}
                            </h3>
                            <p class="label para-2">
                                {!! $setting['settingmappersession']['middle_left'][1]['settingpost']['post_content'] ?? '' !!}
                            </p>
                            <div class="bottom mt-30">
                                <span class="slide-arrrows left mt-20">
                                    <img src="assets/images/arrow.png" class="img-1">
                                </span>
                                <span class="button d-3 right">More Funds</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="right-aside right">
                @if(!empty($setting['settingmappersession']['middle_right']))
                <span class="button d-2">{{$setting['settingmappersession']['middle_right'][0]['settingpost']['post_category'][0]['categorytitle']['title'] ?? ''}}</span>
                @foreach ($setting['settingmappersession']['middle_right'] as $middle_setting)

                <div class="cards d-2 pl-30">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/Vector (3).png" alt="">
                        </div>
                        <div class="right-aside right w-1">
                            <h3 class="label label-3">
                                {{$middle_setting['settingpost']['post_title']}}
                            </h3>
                        </div>
                    </div>
                </div>

            @endforeach

                <div class="cards d-2">
                    <div class="inner mt-30">

                                <span class="button d-1 left fw" style="margin-top: 5px;">More News</span>

                    </div>
                </div>
                @endif
            </div>
        </section>

          <section class="reports-news mt-40">
            <div class="left-aside left">
                <img src="assets/images/New Project (39).png">
            </div>
            <div class="right-aside right">
                <img src="./assets/images/New Project (40).png" alt="">
            </div>
        </section>

        <section class="reports-news mt-40">
            <div class="left-aside left w-1">
                <span class="button d-2">DATABASE & DIRECTORY</span>
            </div>
        </section>

        <h2 class="h-4 mt-20 mb-20">Overview of IFN Investor Fund Database</h2>

           <!-------Funds / Sectors News Section-->
           <div class="counter" >
            <article class="main mt-30 pall-70">
                <h2 class="mb-20 mt-40">TOTAL FUNDS</h2>
                <h3 class="mb-20">1,437</h3>
            </article>

            <article class="center mt-30 pall-70">
                <h2 class="mb-20 mt-40">TOTAL AUM</h2>
                <h3 class="mb-20">US$ 1,986,987</h3>
            </article>

            <article class="side mt-30 pall-70">
                <h2 class="mb-20 mt-40">TOTAL COMPANIES</h2>
                <h3 class="mb-20">736</h3>
            </article>
            </div>

               <!-------Funds / Sectors News Section-->
               <div class="funds">
                <article class="main mt-30">
                    <h2 class="h-3 mb-20">Total Funds By Sector / Asset Class</h2>
                      <img src="assets/images/data.png" class="left">
                    <span class="button d-1 fw">Go To Fund Database</span>
                </article>

                <article class="side mt-30">
                    <h2 class="h-3 mb-20">Total Funds By Region</h2>
                    <img src="assets/images/fundsbyregion.png" class="left">

                    <span class="button d-1 fw">Go To Fund Directory</span>

                </article>
                </div>

        <section class="reports-news mt-40">
            <div class="left-aside left">
                <img src="assets/images/New Project (43).png">
            </div>
            <div class="right-aside right">
                <img src="./assets/images/New Project (42).png" alt="">
            </div>
        </section>


        <section class="reports-news mt-40" style="display: none">
            <div class="left-aside left w-1">
                <span class="button d-2">FEATURES</span>
            </div>

            <div class="left-aside left">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/Somalian.png" alt="">
                        </div>
                        <div class="right-aside right w-3">
                            <h3 class="label label-2">
                                New Somalian Microfinance Company To Implement Islamic Banking System
                            </h3>
                            <p class="label para-2">
                                After having shown in previous articles the virtues of Islamic finance concerning ecology, for example  ...
                            </p>

                        </div>
                    </div>
                </div>
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/innovtion.png" alt="">
                        </div>
                        <div class="right-aside right w-3">
                            <h3 class="label label-2">
                                Innovative approach to parametric Takaful: Closing the protection gap                                    </h3>
                            <p class="label para-2">
                                As the world faces increasing threats from climate change and seeks to bridge the protection gap ...                                    </p>

                        </div>
                    </div>
                </div>

                <!---Card-->

            </div>
            <div class="right-aside right">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/ESG.png" alt="">
                        </div>
                        <div class="right-aside right w-3">
                            <h3 class="label label-2">
                                Lack of ESG integration in Islamic banking and finance sustainability
                                in Central Asian countries                                    </h3>
                            <p class="label para-2">
                                Sustainable Islamic banking and finance has emerged as a global ...                                    </p>

                        </div>
                    </div>
                </div>

                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/based.png" alt="">
                        </div>
                        <div class="right-aside right w-3">
                            <h3 class="label label-2">
                                Value-based intermediation in current Malaysian economic growth
                            </h3>
                            <p class="label para-2">
                                Over the past four decades, Malaysia has created a progressive and sophisticated Islamic financial ...                                    </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="reports-news mt-40">
                <span class="button d-1 right fw">More Features</span>
        </section>

        <section class="reports-news mt-40">
            <div class="left-aside left">
                <img src="assets/images/New Project (44).png">
            </div>
            <div class="right-aside right">
                <img src="./assets/images/New Project (45).png" alt="">
            </div>
        </section>

        <section class="reports-news mt-40">
            @if(!empty($setting['settingmappersession']['correspondents']))
            <div class="left-aside left w-1">
                <span class="button d-2">IFN CORRESPONDENTS</span>
            </div>

            <div class="left-aside left">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/team1.png" alt="">
                        </div>
                        <div class="right-aside right w-3 mt-10">
                            <h3 class="label label-2">
                                Dr Mohammed Kroessin: Microfinance as a carbon credit?                                    </h3>
                            <p class="label para-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ...                                    </p>

                        </div>
                    </div>
                </div>
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/team2.png" alt="">
                        </div>
                        <div class="right-aside right w-3 mt-10">
                            <h3 class="label label-2">
                                Siew Suet Ming: Stable outlook on Malaysian insurance and Takaful industry in 2023 despite headwinds                             </h3>
                            <p class="label para-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do ...                                </p>

                        </div>
                    </div>
                </div>

                <!---Card-->

            </div>
            <div class="right-aside right">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/team3.png" alt="">
                        </div>
                        <div class="right-aside right w-3 mt-10">
                            <h3 class="label label-2">
                                Dr Dalal Aassouli: New Somalian Microfinance Company To Implement Islamic Banking System                                  </h3>
                            <p class="label para-2">
                                Sustainable Islamic banking and finance has emerged as a global ...                                  </p>

                        </div>
                    </div>
                </div>

                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/team4.png" alt="">
                        </div>
                        <div class="right-aside right w-3 mt-10">
                            <h3 class="label label-2">
                                Dr Jasmin Omercic: Islamic finance is a gateway for sustainable business in Bosnia and Herzegovina
                            </h3>
                            <p class="label para-2">
                                With exponential growth due to outstanding expertise and distinct ...                                </p>

                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>

        <section class="reports-news mt-40">
                <span class="button d-1 right fw">More Correspondent Reports</span>
        </section>

        <section class="reports-news mt-40">
            <div class="left-aside left">
                <span class="button d-2">IFN WEEKLY ROUNDUPS</span>
            </div>
            <div class="right-aside right">
                <span class="button d-2">PODCASTS</span>
            </div>
            <div class="left-aside left">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img src="./assets/images/IFN WEEKLY ROUNDUPS.png" alt="">
                        </div>
                        <div class="right-aside right pr-30">
                            <h3 class="label label-2">
                                21 - 26 August, 2023                                    </h3>
                            <p class="label para-2">
                                The Saudi Central Bank hosted the IFSB’s annual meetings this year, while the Pearl Initiative partnered with the IsDB’s private arm to support fintech companies and start-ups in the Kingdom and the GCC region ...                                    </p>
                            <div class="bottom mt-20">

                                <span class="button d-1 left img-1 mt-20">More Roundups</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="right-aside right">

                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img src="./assets/images/podcasts2.png" alt="">
                        </div>
                        <div class="right-aside right pr-30">
                            <h3 class="label label-2">
                                LISTEN NOW!        </h3>
                                <h3 class="label label-2 mt-10 f-s">
                                    Khaled Berjawi:
                                    ‘How ChatGPT Is Reshaping The Islamic Banking Industry’       </h3>
                                <p class="label para-2">
                                    Azentio Software's head of product management of banking and capital markets, shares how the technology is reshaping management of banking ...                                  <div class="bottom mt-20">

                                <span class="button d-1 left img-1">More IFN Podcasts</span>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </section>

        <section class="reports-news mt-40">
            <div class="left-aside left">
                <img src="assets/images/New Project (46).png">
            </div>
            <div class="right-aside right">
                <img src="./assets/images/New Project (47).png" alt="">
            </div>
        </section>

        <section class="reports-news mt-40">
            <div class="left-aside left">
                <span class="button d-2">IFN MONTHLY REVIEWS</span>
            </div>
            <div class="right-aside right">
                <span class="button d-2">VIDEOS</span>
            </div>
            <div class="left-aside left">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img src="./assets/images/monthlyreviews.png" alt="">
                        </div>
                        <div class="right-aside right pr-10">
                            <h3 class="label label-2">
                                5 August, 2023</h3>
                            <p class="label para-2 mt-20">
                                                                        At least three governments — Bangladesh, the Philippines and Kenya — are eyeing a sovereign Sukuk issuance as part of their respective funding strategies, while Algeria inches closer to a dedicated      </p>                         <div class="bottom mt-20">

                                <span class="button d-1 left img-1 mt-20">More Reviews</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="right-aside right">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <img src="./assets/images/videos.png" alt="">
                        <span class="button d-1 text-center img-1 mt-20" style="margin-top: 25px;">More IFN Podcasts</span>

                    </div>
                </div>
           </div>
        </section>


        <section class="reports-news mt-40 pb-250">
            <div class="left-aside left">
                <span class="button d-2">EVENTS</span>
            </div>

            <div class="right-aside right">
                <span class="button d-2">FULL ISSUE OF TH WEEK</span>
            </div>

            <div class="left-aside left">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/New Project (48).png" alt="">
                        </div>
                        <div class="right-aside right w-3">
                            <h3 class="label label-4 f-s pr-20">
                                2 October, 2023: IFN ASIA FORUM
@ EQ Kuala Lumpur
                            </h3>
                            <p class="label para-2 pr-20">
                                IFN’s most anticipated flagship event      on its 18th year - a ‘must attend’ for  Islamic finance professionals from  around the world ...                                    </p>

                        </div>
                    </div>
                </div>
                <div class="cards d-2">
                    <div class="inner mt-10">
                        <div class="left-aside left w-2">
                            <img src="./assets/images/New Project (49).png" alt="">
                        </div>
                        <div class="right-aside right w-3">
                            <h3 class="label label-4 f-s pr-20">
                                3 October, 2023: ISFI ASIA FORUM
                                @ Securities Commission Malaysia</h3>                                    <p class="label para-2 pr-20">
                                    Supported by the Capital Markets Malaysia and the region’s leading conference on Shariah finance ...</p>
                                    <div class="bottom mt-10">
                                        <span class="slide-arrrows left mt-10">
                                            <img src="assets/images/arrow.png" class="img-1">
                                        </span>
                                        <span class="button d-4 right pr-20">More IFN Events</span>
                                    </div>
                </div>
                    </div>
                </div>

                <!---Card-->

            </div>
            <div class="right-aside right">
                <div class="cards d-2">
                    <div class="inner mt-30">
                        <div class="left-aside left">
                            <img src="./assets/images/Screenshot 2023-09-25 at 12.26.01 PM 1 (1).png" alt="">
                        </div>
                        <div class="right-aside right pr-20">
                            <h3 class="label label-4">
                                Volume 20, Issue 35     </h3>

                                <p class="label para-2">
                                    29 August, 2023</p>
                               <p class="label para-2 mb-30" style="padding-right: 26px;">
                                At least three governments
                                — Bangladesh, the Philippines and Kenya — are eyeing a sovereign Sukuk issuance as part of their respective funding strategies, while Algeria inches closer to a dedicated Sukuk regulatory ...</p>
                                <span class="button d-1 text-center img-1" style="margin-top: 5px;">More Weekly Issues</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </main>
</div>
