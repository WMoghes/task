<style>
    .side-bar {
        left: 10px;
    }
    .content {
        right: 10px;
    }
    .panel-body li {
        list-style-type: none;
        padding: 10px;
    }
    li:hover {
        background-color: #e1e1e1;
        color: #000;
    }
    .active {
        background-color: #e1e1e1;
        color: #000;
    }
    a:link {
        text-decoration: none;
    }
    hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border: 0;
        border-top: 1px solid #eee;
    }
    .panel-body {
        padding: 0px;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;
        border-bottom-color: transparent;
    }
    .nav>li>a:focus, .nav>li>a:hover {}

    .search-area {
        margin: 12px;
    }

    .pagination {
        margin: 5px;
    }
    .active-status {
        background-color: darkgreen;
        color: white;
    }
    .suspended {
        background-color: darkred;
        color: white;
    }
    .carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
        height: 320px;
    }
    .price-label {
        position: absolute;
        bottom: 160px;
        background-color: rgba(13, 13, 13, 0.86);
        color: aliceblue;
        font-size: larger;
        padding: 10px;
        left: 16px;
    }
    .search-side-bar {
        padding: 5px;
    }
</style>

{!! Html::style(url('assets/plugin/rangeSlider/ion.rangeSlider.css')) !!}
{!! Html::style(url('assets/plugin/rangeSlider/ion.rangeSlider.skinHTML5.css')) !!}