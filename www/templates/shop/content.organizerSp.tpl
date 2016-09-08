<style>
    .main-container .main-content.organizer-sp {
        font-family: "CenturyGothic";
    }
    .main-content .organizer-sp-body .organizer-sp-image img{
        margin-left: -15px;
        margin-top: 6px;
    }
    .main-content .organizer-sp-name, .main-content .organizer-sp-body .organizer-sp-registr .name{
        font-size: 20px;
        border: 2px solid #4fa4b3;
        text-align: center;
        padding: 10px 15px;
        margin: 5px 10px;
        font-weight: 600;
        color: #666;
        line-height: 25px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc{
        margin: 26px 0px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc2{
        margin: 26px 30px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc p{
        font-size: 17px;
        line-height: 24px;
        font-family: "CenturyGothic";
        color: #333333;
        text-indent: 29px;
        letter-spacing: -.2px
    }

    .main-content .organizer-sp-body .organizer-sp-desc2 .name{
        color: #4fa4b3;
        font-size: 19px;
        font-weight: 900;
        padding-bottom: 20px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc2 ul{
        margin-left: 45px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc2 ul li{
        padding: 6px 0px;
        font-size: 18px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc2 ul li .rhombus {
        width: 8px;
        height: 8px;
        background: #4fa4b3;
        float: left;
        transform: rotate(45deg);
        margin-top: 6px;
        margin-right: 10px;
    }
  /*  .main-content .organizer-sp-body .organizer-sp-desc2 ul li .rhombus {
        width: 0;
        height: 0;
        border: 5px solid transparent;
        border-bottom-color: #4fa4b3;
        position: relative;
        top: 0px;
        float: left;
        margin-right: 10px;
    }
    .main-content .organizer-sp-body .organizer-sp-desc2 ul li .rhombus:after {
        content: '';
        position: absolute;
        left: -5px;
        top: 5px;
        width: 0;
        height: 0;
        border: 5px solid transparent;
        border-top-color: #4fa4b3;
    }*/

    .main-content .organizer-sp-body .slick-slider .slick-dots{
        bottom: -20px !important;
    }

    .main-content .organizer-sp-body .organizer-sp-registr{
        margin-bottom: 25px;
    }
    .main-content .organizer-sp-body .organizer-sp-registr .form-group{
        width: 95%;
        margin: 0px auto 15px;
    }
    .main-content .organizer-sp-body .organizer-sp-registr .but-sp{
        background: #5baeb9;
        border-color: #5baeb9;
        font-weight: bold;
        width: 600px;
        margin: 0px auto;
    }
    .main-content .organizer-sp-body .organizer-sp-registr #organizerSpGRecaptcha{
        width: 100%;
    }
    .main-content .organizer-sp-body .organizer-sp-registr #organizerSpGRecaptcha #recaptcha2{
        margin: 0px auto 25px;
        width: 304px;
    }
    .main-content .organizer-sp-body .slick-list.draggable .slick-track{
        width: 4880px !important;
    }
    .main-content .organizer-sp-body .slick-slide.slick-cloned{
        width: 1213px !important;
    }
    @media screen and (max-width: 400px) {
        .main-container .main-content .articles-container .articles-content {
            padding: 0;
        }
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.slide-sp').slick({
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 7000
        });
    });
</script>
<!--main-container-->
<div class="main-container">
    <!--main-content-->
    <div class="main-content row main-width organizer-sp">
        <div class="col-md-12 col-sm-12 col-xs-12 organizer-sp-body">
            <div class="organizer-sp-image" >
                <img id="sp-3" src="http://makewear-images.azureedge.net/images/sp-3.jpg" />
            </div>
            <div class="organizer-sp-name" >
                Компания MakeWear ориентирована на продуктивное сотрудничество с Организаторами Совместных<br/>Покупок, для которых предусмотрены специальные условия и ряд функциональных возможностей сайт
            </div>
            <div class="organizer-sp-desc">
                <p>
                    Качественная продукция отечественных и зарубежных брендов, популярных на территории СНГ отобрана в единый каталог, с которым легко и удобно работать.</p>
                <p>
                    Наценка отсутсвует, ведь цены установлены непосредственно производителем и просто не могут быть ниже.</p>
                <p>
                    Эти преимущества, а также возможность приобретать товары по оптовым ценам делает MakeWear полезным для Организаторов СП, однако это ещё не всё.
                </p>
            </div>
            <div class="organizer-sp-desc2">
                <div class="name">Специальные условия для Организаторов СП приятно удивят Вас:</div>
                <ul>
                    <li><div class="rhombus"></div>Минимальный оптовый заказ - 3 единицы товара разных брендов;</li>
                    <li><div class="rhombus"></div>Выгрузка товарной базы в любом удобном формате, а также архив фото всех товаров;</li>
                    <li><div class="rhombus"></div>Парсинг товаров на любой сайт либо аккаунт в социальной сети;</li>
                    <li><div class="rhombus"></div>Расширеный личный кабинет Организатора с дополнительными функциональными возможностями;</li>
                    <li><div class="rhombus"></div>Бесплатная доставка по территории Украины и России.</li>
                </ul>
            </div>
            <div class="organizer-sp-desc">
                <p>
                    Для наиболее результативных партнёров, MakeWear предоставляет индивидуальные условия сотрудничества, подстраиваясь под особенности работы и пожелания Организатора. Также, предоставляются дополнительные скидки, бонусы более выгодные условия опта и доставки.
                </p>
            </div>

            <div class="organizer-sp-image slide-sp" >
                <div>
                    <img id="sp-2" src="http://makewear-images.azureedge.net/images/sp-2.jpg" style="width: 1210px;" />
                </div>
                <div>
                    <img id="sp-1" src="http://makewear-images.azureedge.net/images/sp-1.jpg" style="width: 1210px;" />
                </div>
            </div>

            <div class="organizer-sp-registr">
                <div class="name">
                    Для того, чтобы получить специальные условия, заполните заявку и мы свяжемся с Вами
                </div>
                <div class="input-area">
                    <div class="radio clearfix">
                        <div class="form-group has-success">
                            <input type="text" class="form-control" id="organizer-sp-firstname" value="" maxlength="20" placeholder="Имя *" >
                        </div>
                        <div class="form-group has-success">
                            <input type="text" class="form-control" id="organizer-sp-curname" value="" maxlength="50" placeholder="Фамилия *">
                        </div>
                        <div class="form-group has-success">
                            <input type="text" class="form-control" id="organizer-sp-email" value="" name="email" placeholder="Email *">
                        </div>
                        <div class="form-group has-success">
                            <input type="text" class="form-control" id="organizer-sp-site-sp" value="" maxlength="50" placeholder="Сайт СП *">
                        </div>
                        <div class="form-group has-success">
                            <input type="text" class="form-control" id="organizer-sp-nik-sp" value="" maxlength="50" placeholder="Ник на сайте СП *">
                        </div>
                        <div class="form-group has-success">
                            <input type="password" class="form-control" id="organizer-sp-passwd" value="" maxlength="50" placeholder="Пароль *">
                        </div>
                        <div class="form-group has-success">
                            <input type="password" class="form-control" id="organizer-sp-addpasswd" value="" maxlength="50" placeholder="Повторите пароль *">
                        </div>
                    </div>
                    <div id="organizerSpGRecaptcha"><div id="recaptcha2" data-callback="verifyCallback"></div></div>
                    <div class="submit clearfix">
                        <button class="btn btn-lg btn-block btn-primary but-sp" value="">ОТПРАВИТЬ ЗАЯВКУ</button>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>  
