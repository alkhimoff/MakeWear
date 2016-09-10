<style>
    .main-container .main-content #share-conteiner #share-block--3 {
        margin-bottom: 10px;
        margin-top: 5px;
    }
    .main-container .main-content #share-conteiner a.thumbnail.active,
    .main-container .main-content #share-conteiner a.thumbnail:focus,
    .main-container .main-content #share-conteiner a.thumbnail:hover {
        border-color: #4895a3;
    }
    .main-container .main-content #share-conteiner a.thumbnail {
        margin-right: 10px;
    }
    .main-container .main-content #share-conteiner img {
        height: 100%;
        width: 100%;
    }
    .main-container .main-content .share-left,
    .main-container .main-content .share-right {
        padding: 5px 5px 5px 10px;
    }
    .main-container .main-content #share-block--1 .share-right,
    .main-container .main-content #share-block--1 .share-left {
        padding: 5px;
    }
    .main-container .main-content #share-block--3 .share-left,
    .main-container .main-content #share-block--3 .share-right {
        padding: 0;
    }
    .main-container .main-content .block-lg-left {
        width: 48%;
        margin-top: 1px;
    }
    .main-container .main-content .block-lg-right {
        width: 48% !important;
        margin: 0px 9px;
        margin-top: 2px;
    }
    .main-container .main-content .block-sm {
        margin-right: 10px;
    }
    .main-container .main-content .block-sm:first-of-type {
        margin-bottom: 13px;
    }
    .main-container .main-content .shares-block,
    .main-container .main-content .shares-block__actions {
        position: relative;
        width: 100%; /* для IE 6 */
    }
    .main-container .main-content .shares-block__actions {
        border: 1px solid #f0f0f0;
    }
    .main-container .main-content .shares-block:hover .text-block {
        background-color: #4895a3;
    }
    .main-container .main-content .shares-block__actions:hover {
        -moz-box-shadow: 0 2px 9px rgba(19,111,202,0.49);
        -webkit-box-shadow: 0 2px 9px rgba(19,111,202,0.49);
        box-shadow: 0 2px 9px rgba(19,111,202,0.49);
    }
    .main-container .main-content .shares-block__actions:hover .name {
        color: #34A7E5;
    }
    .main-container .main-content #share-block--3 .shares-block  {
        margin-left: 10px;
        width: 593px !important;
    }
    .main-container .main-content .text-block {
        position: absolute;
        bottom: 23px;
        left: 0;
        z-index: 2;
        width: 100%;
        background: rgba(0, 0, 0, 0.52);
        opacity: 0.7;
        padding: 12px;
        text-align: left;
    }
    .main-container .main-content .text-block__actions {
        position: absolute;
        bottom: 0;
        left: 25.4%;
        z-index: 2;
        width: 74.6%;
        background: #fff;
        padding: 5px 12px;
        text-align: left;
    }
    .main-container .main-content .text-block span,
    .main-container .main-content .text-block__actions span {
        font-family: "CenturyGothic";
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        line-height: 19px;
    }
    .main-container .main-content .text-block__actions span {
        color: #000;
        line-height: 23px;
    }
    .main-container .main-content .text-block__actions span:last-of-type {
        color: gray;
        font-size: 13px;
    }
    .main-container .main-content .text-block__actions span:last-of-type:before {
        content: " ";
        position: absolute;
        background: url(/templates/shop/image/sprite.png) no-repeat -284px -522px;
        width: 15px;
        height: 15px;
        bottom: 10px;
        left: 10px;
    }
    .main-container .main-content .text-block span.name,
    .main-container .main-content .text-block__actions span.name {
        text-transform: uppercase;
        line-height: 27px;
        font-size: 20px;
    }
    .main-container .main-content .text-block__actions span.name {
        text-decoration: underline;
        color: #3764A5;
    }

    .main-container .main-content #commodity-name{
        background: #806890;
        text-align: left;
        color: white;
        font-size: 43px;
        padding: 18px 30px;
        margin-left: -12px;
        width: 102%;
    }

    @media screen and (max-width: 991px) {
        .main-container .main-content .block-sm:first-of-type {
            margin-bottom: 9px;
        }
        .main-container .main-content .text-block span {
            font-size: 14px;
        }
        .main-container .main-content .text-block__actions {
            padding: 5px;
        }
        .main-container .main-content .text-block__actions span {
            font-size: 12px;
            line-height: 20px;
        }
        .main-container .main-content .text-block__actions span:last-of-type:before {
            left: 4px;
        }
    }
    @media screen and (max-width: 767px) {
        .main-container .main-content .block-sm:not(:first-of-type) {
            margin-top: 14px;
        }
        .main-container .main-content .text-block span,
        .main-container .main-content .text-block__actions span {
            font-size: 16px;
        }
        .main-container .main-content .text-block__actions span {
            line-height: 25px;
        }
        .main-container .main-content .text-block__actions {
            padding: 7px 12px;
        }
        .main-container .main-content .text-block__actions span:last-of-type:before {
            bottom: 13px;
            left: 9px;
        }
    }
    @media screen and (max-width: 600px) {
        .main-container .main-content .text-block__actions {
            padding: 5px;
        }
        .main-container .main-content .text-block__actions span {
            font-size: 12px;
            line-height: 20px;
        }
        .main-container .main-content .text-block__actions span:last-of-type:before {
            left: 4px;
        }
    }
    @media screen and (max-width: 480px) {
        .main-container .main-content .text-block {
            padding: 10px;
        }
        .main-container .main-content .text-block__actions {
            padding: 5px 10px;
        }
        .main-container .main-content .text-block__actions span:last-of-type:before {
            bottom: 6px;
        }
        .main-container .main-content .brand-block {
            font-size: 14px;
        }
        .main-container .main-content .text-block span,
        .main-container .main-content .text-block__actions span {
            font-size: 13px;
            line-height: 15px;
        }
    }
    @media screen and (max-width: 520px) {
        .main-container .main-content .block-sm:not(:first-of-type) {
            margin-top: 10px;
        }
    }
</style>

<!--<div class="row" id="share-block--1">
    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl12}">
        <div class="shares-block__actions">
            <a href="{$blockLink12}">
                <img src="{$photoDomain}banners/action-a1.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName12}</span>
                    <span>{$blockTitle12}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay12}  {$blockHour12}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl14}">
        <div class="shares-block__actions">
            <a href="{$blockLink14}">
                <img src="{$photoDomain}banners/actions5.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName14}</span>
                    <span>{$blockTitle14}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay14}  {$blockHour14}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl10}">
        <div class="shares-block__actions">
            <a href="{$blockLink10}">
                <img src="{$photoDomain}banners/action-t.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName10}</span>
                    <span>{$blockTitle10}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay10}  {$blockHour10}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl17}">
        <div class="shares-block__actions">
            <a href="{$blockLink17}">
                <img src="{$photoDomain}banners/action-ol.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName17}</span>
                    <span>{$blockTitle17}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay17}  {$blockHour17}</span>
                </div>
            </a>
        </div>
    </div>

    <!--  <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl11}">
        <div class="shares-block__actions">
            <a href="{$blockLink11}">
                <img src="{$photoDomain}banners/actions10.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName11}</span>
                    <span>{$blockTitle11}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay11}  {$blockHour11}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl15}">
        <div class="shares-block__actions">
            <a href="{$blockLink15}">
                <img src="{$photoDomain}banners/actions6.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName15}</span>
                    <span>{$blockTitle15}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay15}  {$blockHour15}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl15}">
        <div class="shares-block__actions">
            <a href="{$blockLink15}">
                <img src="{$photoDomain}banners/actions6.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName15}</span>
                    <span>{$blockTitle15}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay15}  {$blockHour15}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-left {$visibl13}">
        <div class="shares-block__actions">
            <a href="{$blockLink13}">
                <img src="{$photoDomain}banners/action-v1.jpg" alt="" class="img-responsive">
                <div class="text-block__actions">
                    <span class="name">{$blockName13}</span>
                    <span>{$blockTitle13}</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;Осталось: {$blockDay13}  {$blockHour13}</span>
                </div>
            </a>
        </div>
    </div>


</div>-->

<div class="col-md-12 col-sm-12 col-xs-12" id="gift-slider" dir='rtl'>
    <div>
        <img src="{$photoDomain}banners/shock-2.jpg" alt="shock">
    </div>
    <!--<div><img src="{$photoDomain}banners/base3.jpg" alt="main-page-banner-3"></div>-->
    <div>
        <a href="/akcionnie-predlojeniya/#150gr/">
            <img src="{$photoDomain}banners/base4-c.jpg" alt="main-page-banner-4">
        </a>
        <button type="submit" id="click-regestration" class="btn btn-lg btn-block btn-primary">Оформить заказ</button>
    </div>
    <div>
        <a href="/akcionnie-predlojeniya/#discount/">
            <img src="{$photoDomain}banners/base1-c1.jpg" alt="main-page-banner-1">
        </a>
    </div>
    <div>
        <a href="/akcionnie-predlojeniya/">
            <img src="{$photoDomain}banners/base2-c.jpg" alt="main-page-banner-2">
        </a>
        <button type="submit" id="click-podarok" class="btn btn-lg btn-block btn-primary">Оформить заказ</button>
    </div>
    <!--<div><img src="{$photoDomain}banners/base5.jpg" alt="main-page-banner-5"></div>-->
</div>

<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0 0px;">
    <a href="/organizer-sp/">
        <img style="width: 100%;" src="http://makewear-images.azureedge.net/assets/sp-special.jpg">
    </a>
</div>

<!--
<div class="row" id="share-block--2">
    <div class="col-md-6 col-sm-6 col-xs-12 share-left">
        <div class="shares-block">
            <a href="{$blockLink1}">
                <img src="{$photoDomain}banners/new-block-1.png" alt="" class="img-responsive">
                <div class="text-block">
                    <span class="name">{$blockName1}</span><br/>
                    <span>{$blockTitle1}</span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 share-right">
        <div class="block-lg-left pull-left">
            <div class="block-sm shares-block">
                <a href="{$blockLink4}">
                    <img src="{$photoDomain}banners/new-block-2.png" alt="" class="img-responsive">
                    <div class="text-block">
                        <span class="name">{$blockName4}</span><br/>
                        <span>{$blockTitle4}</span>
                    </div>
                </a>
            </div>
            <div class="block-lg-left shares-block">
                <a href="{$blockLink3}">
                    <img src="{$photoDomain}banners/new-block-4.png" alt="" class="img-responsive">
                    <div class="text-block">
                        <span class="name">{$blockName3}</span><br/>
                        <span>{$blockTitle3}</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="block-lg-right shares-block pull-right">
            <div class="block-sm shares-block">
                <a href="{$blockLink8}">
                    <img src="{$photoDomain}banners/new-block-3.png" alt="" class="img-responsive">
                    <div class="text-block">
                        <span class="name">{$blockName8}</span><br/>
                        <span>{$blockTitle8}</span>
                    </div>
                </a>
            </div>
            <div class="block-sm shares-block">
                <a href="{$blockLink5}">
                    <img src="{$photoDomain}banners/new-block-5.png" alt="" class="img-responsive">
                    <div class="text-block">
                        <span class="name">{$blockName5}</span><br/>
                        <span>{$blockTitle5}</span>
                    </div>
                </a>
            </div> 
        </div>
    </div>
</div>
-->
<!--
<div class="row" id="share-block--3">
    <div class="col-md-6 col-sm-6 col-xs-12 share-left">

-->
        <!--<div class="block-lg-right shares-block pull-left">
            <a href="{$blockLink5}">
                <img src="{$photoDomain}banners/block-5.jpg" alt="" class="img-responsive">
                <div class="text-block">
                    <span class="name">{$blockName5}</span><br/>
                    <span>{$blockTitle5}</span>
                </div>
            </a>
        </div>-->
<!--
        <div class="block-lg-right shares-block pull-left" style="width: 47% !important;    margin: 2px 0px 0px 11px;">
            <a href="{$blockLink6}">
                <img src="{$photoDomain}banners/new-block-6.png" alt="" class="img-responsive">
                <div class="text-block">
                    <span class="name">{$blockName6}</span><br/>
                    <span>{$blockTitle6}</span>
                </div>
            </a>
        </div>
        <div class="block-lg-right shares-block pull-left" style="width:48% !important;    margin: 1px 0px 0px 15px;">
            <a href="{$blockLink7}">
                <img src="{$photoDomain}banners/new-block-7.png" alt="" class="img-responsive">
                <div class="text-block">
                    <span class="name">{$blockName7}</span><br/>
                    <span>{$blockTitle7}</span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12 share-right">
        <div class="block-lg-right shares-block pull-left">
            <a href="{$blockLink2}">
                <img src="{$photoDomain}banners/new-block-8.png" alt="" class="img-responsive">
                <div class="text-block">
                    <span class="name">{$blockName2}</span><br/>
                    <span>{$blockTitle2}</span>
                </div>
            </a>
        </div>
    </div>
</div> 

-->
 

        <div class="clear"></div>
        <div class="tabs-wrap-category tabs-wrap-category_home">
            <ul class="top">
                <li class="my-inset active" data-inset="wear">
                    <span class="tab-title">ОДЕЖДА</span>
                </li>
                <li class="my-inset" data-inset="shoes">
                    <span class="tab-title">ОБУВЬ</span>
                </li>
                <li class="my-inset" data-inset="accessories">
                    <span class="tab-title">АКСЕССУАРЫ</span>
                </li>
                <li class="my-inset" data-inset="brands-all">
                    <span class="tab-title">БРЕНДЫ</span>
                </li>
            </ul>
            <ul class="side">
                <li class="my-inset" data-inset="children">
                    <span class="tab-title">ДЕТИ</span>
                </li>
                <li class="my-inset" data-inset="men">
                    <span class="tab-title">МУЖЧИНЫ</span>
                </li>
                <li class="my-inset active" data-inset="women">
                    <span class="tab-title">ЖЕНЩИНы</span>
                </li>
            </ul>
            <div class="insets-wrap">
                <div class="wear-women all-insets active-inset" style="display: flex;">
                                <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue8">
                    <a href="/c8-platya/" style="visibility: visible;"></a>
                </div>
                <h2>Платья</h2>
                <a class="link-categoties" data-id="8" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue9">
                    <a href="/c9-yubki/" style="visibility: visible;"></a>
                </div>
                <h2>Юбки</h2>
                <a class="link-categoties" data-id="9" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue22">
                    <a href="/c22-rubashki/" style="visibility: visible;"></a>
                </div>
                <h2>Рубашки</h2>
                <a class="link-categoties" data-id="22" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue24">
                    <a href="/c24-bluzy/" style="visibility: visible;"></a>
                </div>
                <h2>Блузы</h2>
                <a class="link-categoties" data-id="24" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue25">
                    <a href="/c25-svitshoty/" style="visibility: visible;"></a>
                </div>
                <h2>Свитшоты</h2>
                <a class="link-categoties" data-id="25" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue26">
                    <a href="/c26-bolshie_razmery/" style="visibility: visible;"></a>
                </div>
                <h2>Большие размеры</h2>
                <a class="link-categoties" data-id="26" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue27">
                    <a href="/c27-dlya_beremennyh/" style="visibility: visible;"></a>
                </div>
                <h2>Для беременных</h2>
                <a class="link-categoties" data-id="27" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue28">
                    <a href="/c28-pidjaki/" style="visibility: visible;"></a>
                </div>
                <h2>Пиджаки</h2>
                <a class="link-categoties" data-id="28" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue29">
                    <a href="/c29-sportivnye_kostyumy/" style="visibility: visible;"></a>
                </div>
                <h2>Спортивные костюмы</h2>
                <a class="link-categoties" data-id="29" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue30">
                    <a href="/c30-kurtki/" style="visibility: visible;"></a>
                </div>
                <h2>Куртки</h2>
                <a class="link-categoties" data-id="30" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue31">
                    <a href="/c31-palto/" style="visibility: visible;"></a>
                </div>
                <h2>Пальто</h2>
                <a class="link-categoties" data-id="31" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue32">
                    <a href="/c32-futbolki/" style="visibility: visible;"></a>
                </div>
                <h2>Футболки</h2>
                <a class="link-categoties" data-id="32" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue33">
                    <a href="/c33-kofty/" style="visibility: visible;"></a>
                </div>
                <h2>Кофты</h2>
                <a class="link-categoties" data-id="33" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue35">
                    <a href="/c35-kardigany/" style="visibility: visible;"></a>
                </div>
                <h2>Кардиганы</h2>
                <a class="link-categoties" data-id="35" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue36">
                    <a href="/c36-kostyumy/" style="visibility: visible;"></a>
                </div>
                <h2>Костюмы</h2>
                <a class="link-categoties" data-id="36" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue37">
                    <a href="/c37-kombinezony/" style="visibility: visible;"></a>
                </div>
                <h2>Комбинезоны</h2>
                <a class="link-categoties" data-id="37" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue38">
                    <a href="/c38-bryuki/" style="visibility: visible;"></a>
                </div>
                <h2>Брюки</h2>
                <a class="link-categoties" data-id="38" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue39">
                    <a href="/c39-legginsy/" style="visibility: visible;"></a>
                </div>
                <h2>Леггинсы</h2>
                <a class="link-categoties" data-id="39" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue41">
                    <a href="/c41-shorty/" style="visibility: visible;"></a>
                </div>
                <h2>Шорты</h2>
                <a class="link-categoties" data-id="41" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue50">
                    <a href="/c50-jilety/" style="visibility: visible;"></a>
                </div>
                <h2>Жилеты</h2>
                <a class="link-categoties" data-id="50" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue51">
                    <a href="/c51-tuniki/" style="visibility: visible;"></a>
                </div>
                <h2>Туники</h2>
                <a class="link-categoties" data-id="51" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue52">
                    <a href="/c52-bolero/" style="visibility: visible;"></a>
                </div>
                <h2>Болеро</h2>
                <a class="link-categoties" data-id="52" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue53">
                    <a href="/c53-djinsy/" style="visibility: visible;"></a>
                </div>
                <h2>Джинсы</h2>
                <a class="link-categoties" data-id="53" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue54">
                    <a href="/c54-sarafany/" style="visibility: visible;"></a>
                </div>
                <h2>Сарафаны</h2>
                <a class="link-categoties" data-id="54" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue55">
                    <a href="/c55-kupalniki/" style="visibility: visible;"></a>
                </div>
                <h2>Купальники</h2>
                <a class="link-categoties" data-id="55" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue59">
                    <a href="/c59-mayki/" style="visibility: visible;"></a>
                </div>
                <h2>Майки</h2>
                <a class="link-categoties" data-id="59" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue208">
                    <a href="/c208-plaschi/" style="visibility: visible;"></a>
                </div>
                <h2>Плащи</h2>
                <a class="link-categoties" data-id="208" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue216">
                    <a href="/c216-bridji/" style="visibility: visible;"></a>
                </div>
                <h2>Бриджи</h2>
                <a class="link-categoties" data-id="216" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue220">
                    <a href="/c220-shuby/" style="visibility: visible;"></a>
                </div>
                <h2>Шубы</h2>
                <a class="link-categoties" data-id="220" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue274">
                    <a href="/c274-golf/" style="visibility: visible;"></a>
                </div>
                <h2>Гольф</h2>
                <a class="link-categoties" data-id="274" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue280">
                    <a href="/c280-djempery/" style="visibility: visible;"></a>
                </div>
                <h2>Джемперы</h2>
                <a class="link-categoties" data-id="280" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue292">
                    <a href="/c292-svitera/" style="visibility: visible;"></a>
                </div>
                <h2>Свитера</h2>
                <a class="link-categoties" data-id="292" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue297">
                    <a href="/c297-nijnee_bele/" style="visibility: visible;"></a>
                </div>
                <h2>Нижнее белье</h2>
                <a class="link-categoties" data-id="297" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="shoes-women all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue90">
                    <a href="/c90-tufli/" style="visibility: visible;"></a>
                </div>
                <h2>Туфли</h2>
                <a class="link-categoties" data-id="90" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue91">
                    <a href="/c91-botinki/" style="visibility: visible;"></a>
                </div>
                <h2>Ботинки</h2>
                <a class="link-categoties" data-id="91" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue92">
                    <a href="/c92-sapogi/" style="visibility: visible;"></a>
                </div>
                <h2>Сапоги</h2>
                <a class="link-categoties" data-id="92" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue95">
                    <a href="/c95-botilony/" style="visibility: visible;"></a>
                </div>
                <h2>Ботильоны</h2>
                <a class="link-categoties" data-id="95" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue318">
                    <a href="/c318-кросс/" style="visibility: visible;"></a>
                </div>
                <h2>Кроссовки</h2>
                <a class="link-categoties" data-id="318" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="accessories-women all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue56">
                    <a href="/c56-shapki/" style="visibility: visible;"></a>
                </div>
                <h2>Шапки</h2>
                <a class="link-categoties" data-id="56" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue75">
                    <a href="/c75-bijuteriya/" style="visibility: visible;"></a>
                </div>
                <h2>Бижутерия</h2>
                <a class="link-categoties" data-id="75" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue76">
                    <a href="/c76-sumki/" style="visibility: visible;"></a>
                </div>
                <h2>Сумки</h2>
                <a class="link-categoties" data-id="76" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue79">
                    <a href="/c79-ochki/" style="visibility: visible;"></a>
                </div>
                <h2>Очки</h2>
                <a class="link-categoties" data-id="79" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue82">
                    <a href="/c82-koshelki/" style="visibility: visible;"></a>
                </div>
                <h2>Кошельки</h2>
                <a class="link-categoties" data-id="82" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue83">
                    <a href="/c83-sharfy/" style="visibility: visible;"></a>
                </div>
                <h2>Шарфы</h2>
                <a class="link-categoties" data-id="83" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue269">
                    <a href="/c269-remni/" style="visibility: visible;"></a>
                </div>
                <h2>Ремни</h2>
                <a class="link-categoties" data-id="269" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue291">
                    <a href="/c291-perchatki/" style="visibility: visible;"></a>
                </div>
                <h2>Перчатки</h2>
                <a class="link-categoties" data-id="291" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue298">
                    <a href="/c298-portupei/" style="visibility: visible;"></a>
                </div>
                <h2>Портупеи</h2>
                <a class="link-categoties" data-id="298" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue313">
                    <a href="/c313-шляпы/" style="visibility: visible;"></a>
                </div>
                <h2>Шляпы</h2>
                <a class="link-categoties" data-id="313" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="wear-men all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue270">
                    <a href="/c270-futbolki/" style="visibility: visible;"></a>
                </div>
                <h2>Футболки</h2>
                <a class="link-categoties" data-id="270" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue272">
                    <a href="/c272-tolstovki/" style="visibility: visible;"></a>
                </div>
                <h2>Толстовки</h2>
                <a class="link-categoties" data-id="272" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue276">
                    <a href="/c276-svitshoty/" style="visibility: visible;"></a>
                </div>
                <h2>Свитшоты</h2>
                <a class="link-categoties" data-id="276" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue277">
                    <a href="/c277-mayki/" style="visibility: visible;"></a>
                </div>
                <h2>Майки</h2>
                <a class="link-categoties" data-id="277" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue296">
                    <a href="/c296-svitera/" style="visibility: visible;"></a>
                </div>
                <h2>Свитера</h2>
                <a class="link-categoties" data-id="296" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue319">
                    <a href="/c319-шорты/" style="visibility: visible;"></a>
                </div>
                <h2>Шорты</h2>
                <a class="link-categoties" data-id="319" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue320">
                    <a href="/c320-брюки/" style="visibility: visible;"></a>
                </div>
                <h2>Брюки</h2>
                <a class="link-categoties" data-id="320" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="shoes-men all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue304">
                    <a href="/c304-кроссовки/" style="visibility: visible;"></a>
                </div>
                <h2>Кроссовки</h2>
                <a class="link-categoties" data-id="304" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="accessories-men all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue273">
                    <a href="/c273-sumki/" style="visibility: visible;"></a>
                </div>
                <h2>Сумки</h2>
                <a class="link-categoties" data-id="273" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue278">
                    <a href="/c278-panamy/" style="visibility: visible;"></a>
                </div>
                <h2>Панамы</h2>
                <a class="link-categoties" data-id="278" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue279">
                    <a href="/c279-bafy/" style="visibility: visible;"></a>
                </div>
                <h2>Бафы</h2>
                <a class="link-categoties" data-id="279" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue282">
                    <a href="/c282-shapki/" style="visibility: visible;"></a>
                </div>
                <h2>Шапки</h2>
                <a class="link-categoties" data-id="282" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue314">
                    <a href="/c314-шл/" style="visibility: visible;"></a>
                </div>
                <h2>Шляпы</h2>
                <a class="link-categoties" data-id="314" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue315">
                    <a href="/c315-очки/" style="visibility: visible;"></a>
                </div>
                <h2>Очки</h2>
                <a class="link-categoties" data-id="315" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="wear-children all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue214">
                    <a href="/c214-futbolki/" style="visibility: visible;"></a>
                </div>
                <h2>Футболки</h2>
                <a class="link-categoties" data-id="214" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue222">
                    <a href="/c222-futbolki/" style="visibility: visible;"></a>
                </div>
                <h2>Футболки</h2>
                <a class="link-categoties" data-id="222" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue223">
                    <a href="/c223-yubki/" style="visibility: visible;"></a>
                </div>
                <h2>Юбки</h2>
                <a class="link-categoties" data-id="223" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue224">
                    <a href="/c224-sarafany/" style="visibility: visible;"></a>
                </div>
                <h2>Сарафаны</h2>
                <a class="link-categoties" data-id="224" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue225">
                    <a href="/c225-mayki/" style="visibility: visible;"></a>
                </div>
                <h2>Майки</h2>
                <a class="link-categoties" data-id="225" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue226">
                    <a href="/c226-kombinezony/" style="visibility: visible;"></a>
                </div>
                <h2>Комбинезоны</h2>
                <a class="link-categoties" data-id="226" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue227">
                    <a href="/c227-tuniki/" style="visibility: visible;"></a>
                </div>
                <h2>Туники</h2>
                <a class="link-categoties" data-id="227" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue228">
                    <a href="/c228-shorty/" style="visibility: visible;"></a>
                </div>
                <h2>Шорты</h2>
                <a class="link-categoties" data-id="228" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue229">
                    <a href="/c229-platya/" style="visibility: visible;"></a>
                </div>
                <h2>Платья</h2>
                <a class="link-categoties" data-id="229" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue230">
                    <a href="/c230-pijamy/" style="visibility: visible;"></a>
                </div>
                <h2>Пижамы</h2>
                <a class="link-categoties" data-id="230" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue231">
                    <a href="/c231-pijamy/" style="visibility: visible;"></a>
                </div>
                <h2>Пижамы</h2>
                <a class="link-categoties" data-id="231" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue232">
                    <a href="/c232-mayki/" style="visibility: visible;"></a>
                </div>
                <h2>Майки</h2>
                <a class="link-categoties" data-id="232" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue233">
                    <a href="/c233-losiny/" style="visibility: visible;"></a>
                </div>
                <h2>Лосины</h2>
                <a class="link-categoties" data-id="233" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue234">
                    <a href="/c234-komplekty/" style="visibility: visible;"></a>
                </div>
                <h2>Комплекты</h2>
                <a class="link-categoties" data-id="234" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue235">
                    <a href="/c235-komplekty/" style="visibility: visible;"></a>
                </div>
                <h2>Комплекты</h2>
                <a class="link-categoties" data-id="235" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue236">
                    <a href="/c236-rubashki/" style="visibility: visible;"></a>
                </div>
                <h2>Рубашки</h2>
                <a class="link-categoties" data-id="236" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue237">
                    <a href="/c237-sportivnye_kostyumy/" style="visibility: visible;"></a>
                </div>
                <h2>Спортивные костюмы</h2>
                <a class="link-categoties" data-id="237" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue238">
                    <a href="/c238-sportivnye_kostyumy/" style="visibility: visible;"></a>
                </div>
                <h2>Спортивные костюмы</h2>
                <a class="link-categoties" data-id="238" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue243">
                    <a href="/c243-bryuki/" style="visibility: visible;"></a>
                </div>
                <h2>Брюки</h2>
                <a class="link-categoties" data-id="243" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue244">
                    <a href="/c244-pidjaki/" style="visibility: visible;"></a>
                </div>
                <h2>Пиджаки</h2>
                <a class="link-categoties" data-id="244" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue245">
                    <a href="/c245-svitshoty/" style="visibility: visible;"></a>
                </div>
                <h2>Свитшоты</h2>
                <a class="link-categoties" data-id="245" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue246">
                    <a href="/c246-reglan/" style="visibility: visible;"></a>
                </div>
                <h2>Реглан</h2>
                <a class="link-categoties" data-id="246" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue247">
                    <a href="/c247-djempery/" style="visibility: visible;"></a>
                </div>
                <h2>Джемперы</h2>
                <a class="link-categoties" data-id="247" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue248">
                    <a href="/c248-bolero/" style="visibility: visible;"></a>
                </div>
                <h2>Болеро</h2>
                <a class="link-categoties" data-id="248" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue249">
                    <a href="/c249-bryuki/" style="visibility: visible;"></a>
                </div>
                <h2>Брюки</h2>
                <a class="link-categoties" data-id="249" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue250">
                    <a href="/c250-golfy/" style="visibility: visible;"></a>
                </div>
                <h2>Гольфы</h2>
                <a class="link-categoties" data-id="250" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue251">
                    <a href="/c251-golfy/" style="visibility: visible;"></a>
                </div>
                <h2>Гольфы</h2>
                <a class="link-categoties" data-id="251" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue252">
                    <a href="/c252-jakety/" style="visibility: visible;"></a>
                </div>
                <h2>Жакеты</h2>
                <a class="link-categoties" data-id="252" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue253">
                    <a href="/c253-jakety/" style="visibility: visible;"></a>
                </div>
                <h2>Жакеты</h2>
                <a class="link-categoties" data-id="253" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue254">
                    <a href="/c254-djempery/" style="visibility: visible;"></a>
                </div>
                <h2>Джемперы</h2>
                <a class="link-categoties" data-id="254" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue255">
                    <a href="/c255-kurtki/" style="visibility: visible;"></a>
                </div>
                <h2>Куртки</h2>
                <a class="link-categoties" data-id="255" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue256">
                    <a href="/c256-kurtki/" style="visibility: visible;"></a>
                </div>
                <h2>Куртки</h2>
                <a class="link-categoties" data-id="256" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue257">
                    <a href="/c257-jilety/" style="visibility: visible;"></a>
                </div>
                <h2>Жилеты</h2>
                <a class="link-categoties" data-id="257" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue258">
                    <a href="/c258-jilety/" style="visibility: visible;"></a>
                </div>
                <h2>Жилеты</h2>
                <a class="link-categoties" data-id="258" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue262">
                    <a href="/c262-shorty/" style="visibility: visible;"></a>
                </div>
                <h2>Шорты</h2>
                <a class="link-categoties" data-id="262" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue275">
                    <a href="/c275-kolgotki/" style="visibility: visible;"></a>
                </div>
                <h2>Колготки</h2>
                <a class="link-categoties" data-id="275" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue281">
                    <a href="/c281-kombinezony/" style="visibility: visible;"></a>
                </div>
                <h2>Комбинезоны</h2>
                <a class="link-categoties" data-id="281" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue286">
                    <a href="/c286-reglan/" style="visibility: visible;"></a>
                </div>
                <h2>Реглан</h2>
                <a class="link-categoties" data-id="286" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue287">
                    <a href="/c287-kardigany/" style="visibility: visible;"></a>
                </div>
                <h2>Кардиганы</h2>
                <a class="link-categoties" data-id="287" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue288">
                    <a href="/c288-kolgotki/" style="visibility: visible;"></a>
                </div>
                <h2>Колготки</h2>
                <a class="link-categoties" data-id="288" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue294">
                    <a href="/c294-kofty/" style="visibility: visible;"></a>
                </div>
                <h2>Кофты</h2>
                <a class="link-categoties" data-id="294" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-medium">
                <div class="catalog_image" id="catalogue295">
                    <a href="/c295-rubashki/" style="visibility: visible;"></a>
                </div>
                <h2>Рубашки</h2>
                <a class="link-categoties" data-id="295" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="shoes-children all-insets" style="display: none;">
                    
                </div>
                <div class="accessories-children all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue259">
                    <a href="/c259-shapki/" style="visibility: visible;"></a>
                </div>
                <h2>Шапки</h2>
                <a class="link-categoties" data-id="259" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue283">
                    <a href="/c283-nabory/" style="visibility: visible;"></a>
                </div>
                <h2>Наборы</h2>
                <a class="link-categoties" data-id="283" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue284">
                    <a href="/c284-sumki/" style="visibility: visible;"></a>
                </div>
                <h2>Сумки</h2>
                <a class="link-categoties" data-id="284" style="visibility: visible;">Выбрать бренды</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue289">
                    <a href="/c289-perchatki/" style="visibility: visible;"></a>
                </div>
                <h2>Перчатки</h2>
                <a class="link-categoties" data-id="289" style="visibility: visible;">Выбрать бренды</a>
            </div>
                </div>
                <div class="brands-all all-insets" style="display: none;">
                                <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue1">
                    <a href="/c1-cardo/" style="visibility: visible;"></a>
                </div>
                <h2>Cardo</h2>
                <a class="link-categoties" data-id="1" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue2">
                    <a href="/c2-fashion_up/" style="visibility: visible;"></a>
                </div>
                <h2>Fashion Up</h2>
                <a class="link-categoties" data-id="2" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue15">
                    <a href="/c15-glem/" style="visibility: visible;"></a>
                </div>
                <h2>Glem</h2>
                <a class="link-categoties" data-id="15" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue16">
                    <a href="/c16-lenida/" style="visibility: visible;"></a>
                </div>
                <h2>Lenida</h2>
                <a class="link-categoties" data-id="16" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue23">
                    <a href="/c23-sellin/" style="visibility: visible;"></a>
                </div>
                <h2>Sellin</h2>
                <a class="link-categoties" data-id="23" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue42">
                    <a href="/c42-meggi/" style="visibility: visible;"></a>
                </div>
                <h2>Meggi</h2>
                <a class="link-categoties" data-id="42" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue43">
                    <a href="/c43-alva/" style="visibility: visible;"></a>
                </div>
                <h2>Alva</h2>
                <a class="link-categoties" data-id="43" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue46">
                    <a href="/c46-fl-fashion/" style="visibility: visible;"></a>
                </div>
                <h2>FL-Fashion</h2>
                <a class="link-categoties" data-id="46" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue47">
                    <a href="/c47-seventeen/" style="visibility: visible;"></a>
                </div>
                <h2>Seventeen</h2>
                <a class="link-categoties" data-id="47" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue48">
                    <a href="/c48-sl/" style="visibility: visible;"></a>
                </div>
                <h2>S&amp;L</h2>
                <a class="link-categoties" data-id="48" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue49">
                    <a href="/c49-sk_house/" style="visibility: visible;"></a>
                </div>
                <h2>SK House</h2>
                <a class="link-categoties" data-id="49" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue58">
                    <a href="/c58-olis-style/" style="visibility: visible;"></a>
                </div>
                <h2>Olis-style</h2>
                <a class="link-categoties" data-id="58" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue62">
                    <a href="/c62-nelli-co/" style="visibility: visible;"></a>
                </div>
                <h2>Nelli-co</h2>
                <a class="link-categoties" data-id="62" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue64">
                    <a href="/c64-b1/" style="visibility: visible;"></a>
                </div>
                <h2>B1</h2>
                <a class="link-categoties" data-id="64" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue66">
                    <a href="/c66-art_millano/" style="visibility: visible;"></a>
                </div>
                <h2>Art Millano</h2>
                <a class="link-categoties" data-id="66" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-normal">
                <div class="catalog_image" id="catalogue88">
                    <a href="/c88-vitality/" style="visibility: visible;"></a>
                </div>
                <h2>Vitality</h2>
                <a class="link-categoties" data-id="88" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue205">
                    <a href="/c205-vitality_kids/" style="visibility: visible;"></a>
                </div>
                <h2>Vitality KIDS</h2>
                <a class="link-categoties" data-id="205" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue215">
                    <a href="/c215-dajs/" style="visibility: visible;"></a>
                </div>
                <h2>Dajs</h2>
                <a class="link-categoties" data-id="215" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue217">
                    <a href="/c217-helen_laven/" style="visibility: visible;"></a>
                </div>
                <h2>Helen Laven</h2>
                <a class="link-categoties" data-id="217" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue219">
                    <a href="/c219-jhiva/" style="visibility: visible;"></a>
                </div>
                <h2>Jhiva</h2>
                <a class="link-categoties" data-id="219" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-largest">
                <div class="catalog_image" id="catalogue239">
                    <a href="/c239-zdes/" style="visibility: visible;"></a>
                </div>
                <h2>Zdes</h2>
                <a class="link-categoties" data-id="239" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue241">
                    <a href="/c241-vidoli/" style="visibility: visible;"></a>
                </div>
                <h2>Vidoli</h2>
                <a class="link-categoties" data-id="241" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue293">
                    <a href="/c293-lavana_fashion/" style="visibility: visible;"></a>
                </div>
                <h2>Lavana Fashion</h2>
                <a class="link-categoties" data-id="293" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue299">
                    <a href="/c299-reform/" style="visibility: visible;"></a>
                </div>
                <h2>Reform</h2>
                <a class="link-categoties" data-id="299" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue300">
                    <a href="/c300-tali-ttes/" style="visibility: visible;"></a>
                </div>
                <h2>Tali Ttes</h2>
                <a class="link-categoties" data-id="300" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue311">
                    <a href="/c311-ghazel/" style="visibility: visible;"></a>
                </div>
                <h2>Ghazel</h2>
                <a class="link-categoties" data-id="311" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue312">
                    <a href="/c312-fashion-look/" style="visibility: visible;"></a>
                </div>
                <h2>Fashion Look</h2>
                <a class="link-categoties" data-id="312" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-large">
                <div class="catalog_image" id="catalogue316">
                    <a href="/c316-adidas/" style="visibility: visible;"></a>
                </div>
                <h2>Adidas</h2>
                <a class="link-categoties" data-id="316" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item category-name-font-little">
                <div class="catalog_image" id="catalogue317">
                    <a href="/c317-vision-fs/" style="visibility: visible;"></a>
                </div>
                <h2>Vision FS</h2>
                <a class="link-categoties" data-id="317" style="visibility: visible;">Выбрать категории</a>
            </div>            <div class="catalog_item">
                <div class="catalog_image" id="catalogue321">
                    <a href="/c321-jadone-fashion/" style="visibility: visible;"></a>
                </div>
                <h2>Jadone Fashion</h2>
                <a class="link-categoties" data-id="321" style="visibility: visible;">Выбрать категории</a>
            </div>
                </div>
            </div>
        </div>

 
