<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="utf-8" />
    <title>
        @yield('title', 'Hindi News, Local हिन्दी न्यूज़ Live, Noida, Greater Noida West, NCR, Delhi हिंदी खबरें, ब्रेकिंग न्यूज़ - Tricitytoday')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta name="robots" content="max-image-preview:large" />
    <meta property="fb:pages" content="1068028059944262" />
    <meta name="description"
        content="टॉप न्यूज़, नोएडा, ग्रेटर नोएडा, यमुना सिटी, ग्रेटर नोएडा वेस्ट, दिल्ली - एनसीआर, गाजियाबाद, हापुड़, गुरुग्राम-गुड़गांव, फरीदाबाद, चंडीगढ़, उत्तर प्रदेश, जेवर एयरपोर्ट, फिल्म सिटी, ऑटो एक्सपो न्यूज़" />
    <meta name="keywords"
        content="ट्राई सिटीज टुडे: ट्राई सिटीज टुडे के Local ताज़ा समाचार From Delhi NCR, Noida, Greater Noida, Hapur, Ghaziabad, Faridabad, Gurugram, Yamuna City, Jewar Airport, हिंदी समाचार,  Authority In News, Crime, Legal, Civic News, Today Tricity News, ग्रेटर नोएडा, यमुना सिटी, ग्रेटर नोएडा वेस्ट, दिल्ली - एनसीआर, गाजियाबाद, हापुड़, गुरुग्राम-गुड़गांव, फरीदाबाद, चंडीगढ़, उत्तर प्रदेश, जेवर एयरपोर्ट Latest News" />
    <meta property="og:title"
        content="Hindi News, Local हिन्दी न्यूज़ Live, Noida, Greater Noida West, NCR, Delhi हिंदी खबरें, ब्रेकिंग न्यूज़ : Tricitytoday" />
    <meta property="og:site_name" content="https://tricitytoday.com" />
    <meta property="og:description"
        content="टॉप न्यूज़, नोएडा, ग्रेटर नोएडा, यमुना सिटी, ग्रेटर नोएडा वेस्ट, दिल्ली - एनसीआर, गाजियाबाद, हापुड़, गुरुग्राम-गुड़गांव, फरीदाबाद, चंडीगढ़, उत्तर प्रदेश, जेवर एयरपोर्ट, फिल्म सिटी, ऑटो एक्सपो न्यूज़" />
    <meta property="og:url" content="https://tricitytoday.com/" />
    <meta property="og:image" content="https://static.tricitytoday.com/images/og_share_logo.jpeg" />

    <meta name="robots" content="noodp" />

    <meta name="robots" content="index, follow" />

    <meta name="tweetmeme-title"
        content="Hindi News, Local हिन्दी न्यूज़ Live, Noida, Greater Noida West, NCR, Delhi हिंदी खबरें, ब्रेकिंग न्यूज़ : Tricitytoday" />
    @section('style')
        @include('website.layout.style')
        <style type="text/css">
            .padleft {
                padding-left: 20px;
                color: #6E6E6E;
                font-size: 15px;
            }
        </style>
    @show

</head>

<body class="body">

    @include('website.layout.navbar')

    <!-- Begin page -->
    <div class="container">
        @include('website.layout.adds')

        <div class="middleContainer">
            @yield('content')
        </div>

    </div>
    <!-- END wrapper -->

    @section('script')
        @include('website.layout.script')
    @show

</body>

</html>
