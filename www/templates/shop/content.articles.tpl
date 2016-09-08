<style>
    .main-container .main-content.articles {
        font-family: "CenturyGothic";
    }
    .main-container .body-articles{
        display: table;
    }
    .main-container .main-content .articles-container .articles-content {
        padding: 20px;
        padding-right: 3px;
        display: table-cell;
    }
    .main-container .main-content .articles-container .articles-content p {
        font-size: 16px;    
        margin: 20px 0;
        line-height: 25px;
        text-indent: 20px;
        text-align: justify;
    }
    .main-container .main-content .articles-container .articles-content img {
        float:left; /* Выравнивание по левому краю */
        margin: 7px 7px 7px 0; /* Отступы вокруг картинки */
    }
    .main-container .headTags{
        margin: 14px 0px;
    }
    .main-container .headTags #firstTags{
        color: #00455c;
        font-weight: bold;
    }
    .main-container .headTags .lineTags{
        background: #D8D8D8;
        padding: 1px 10px;
        margin: 0px 5px;
    }
    .main-container .event-articles{
        display: table-cell;
        width: 345px;
        padding: 25px 0px 0px 10px;
    }
    .main-container .event-articles h2{
        color: #2c7e91;
        font-weight: bold;
    }
    .main-container .event-articles .line-evenet{
        margin: 10px 0px;
    }
    .main-container .event-articles .line-evenet .content{
        font-size: 15px;
        font-weight: bold;
    }
    .main-container .event-articles .line-evenet .content a{
        color: black;
    }
    .main-container .event-articles .line-evenet .content a:hover{
        color: #337ab7;
    }
    .main-container .event-articles .line-evenet .date{
        text-align: right;
        font-size: 14px;
        color: #9A9A9A;
        padding: 2px 0px;
    }
    .main-container .event-articles .line-evenet .fa-comments{
        margin-left: 12px;
    }
    .main-container .event-articles .line-evenet .comment{
        margin-right: 7px;
    }
   .main-container .line-border-left{
        height: 100px;
        width: 3px;
        background: rgba(128, 128, 128, 0.33);
        margin-left: 12px;
    }
    .main-container .line-border-top{
        height: 3px;
        width: 92%;
        background: rgba(128, 128, 128, 0.33);
        margin-left: 12px;
    }
    .main-container .read-comment .line-client-comment{
        border-top: 1px solid #A2A2A2;
        margin: 12px 0px;
        padding-top: 8px;
        font-size: 16px;
    }
    .main-container .read-comment .line-client-comment .name{
        color: #EC0B0B;
        font-weight: bold;
    }
    .main-container .read-comment .line-client-comment .date{
        color: #989898;
        font-size: 14px;
        padding-left: 5px;
    }
    @media screen and (max-width: 400px) {
        .main-container .main-content .articles-container .articles-content {
            padding: 0;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(".btn-coments-form").click(function(){
            var rel=$(this).attr("rel-id");

            var comment=$(".comment").val();
            var name=$("#comment-user-name").val();
            var email=$("#comment-user-email").val();
            var check=$("#comment-user-checkbox").prop("checked");
            var addComment="";
           // alert(rel+","+comment+","+name+","+email+","+check);

            $.ajax({
                type:'post',
                url:'/modules/content/ajax/articles_comment.php',
                data:{rel:rel, name:name, email:email, check:check, comment:comment}
            })
            .done(function(data){
                $(".comment").val("");

                addComment+="<div class='line-client-comment'>";
                addComment+="<span class='name'>"+name+"</span> <span class='date'>- "+data+"</span> ";
                addComment+=" <br/>";
                addComment+=comment;
                addComment+="</div>";
                $(".read-comment").prepend(addComment);
            });
        });
    });
</script>
<!--main-container-->
<div class="main-container">
    <!--main-content-->
    <div class="main-content row main-width articles">
        <div class="col-md-12 col-sm-12 col-xs-12 articles-container">
            <div class="articles-content clearfix">
                <h1 style="text-align: center;font-size: 22px;">{$name}</h1>
                <p>
                    {$desc}
                </p>
                <script type="text/javascript">(function() {
                    if (window.pluso)if (typeof window.pluso.start == "function") return;
                        if (window.ifpluso==undefined) { window.ifpluso = 1;
                            var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                            s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                            var h=d[g]('body')[0];
                            h.appendChild(s);
                    }})();
                </script>
                <div class="pluso" data-background="none;" data-options="medium,square,line,horizontal,counter,sepcounter=1,theme=14" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print" data-user="48453928"></div>

                <!-- Tags -->
                <div class="headTags">{$tags}</div>
                <!-- Write Comment -->
                <div class="write-comment">
                    <textarea name="coment" class="form-control comment-field comment-necessary comment" maxlength="500" placeholder="Комментарий *" style="height: 150px;"></textarea>
                    <div style="display: table;width: 700px;">
                            <div style="display: table-cell;vertical-align: top;padding: 10px 0px;">
                                <div class="form-group has-success">
                                    <input type="text" class="form-control comment-field comment-necessary" id="comment-user-name" value="admin" maxlength="20" placeholder="Имя *">
                                </div>
                                <div class="form-group has-success">
                                    <input type="text" class="form-control comment-field comment-necessary" id="comment-user-email" value="info@makewear.com.ua" name="email" placeholder="Email *">
                                </div>
                            </div>
                            <div style="display: table-cell;width: 250px;padding: 10px 10px;">
                                <button class="btn btn-lg btn-block btn-primary btn-coments-form" value="" rel-id="{$id}">Оставить отзыв</button>
                                <input type="checkbox" id="comment-user-checkbox">
                                <span style="font-size: 12px;color: gray;">Уведомить об ответах по e-mail</span>
                            </div>
                    </div>
                </div>
                <!--Read Comment -->
                <div class="read-comment">{$comment}</div>
            </div>
        </div>
    </div>
</div>  
