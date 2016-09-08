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
      /*  line-height: 25px;
        text-indent: 20px;*/
        text-align: justify;
    }
    .main-container .main-content .articles-container .articles-content img {
        float:left; /* Выравнивание по левому краю */
        margin: 7px 7px 7px 0; /* Отступы вокруг картинки */
    }
    .main-container .main-content .head-article-pages{
        display: table;
        margin: 8px 50px;
        background: #ECECEC;
    }
    .main-container .main-content .href-article{
        color: black;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }
    .main-container .main-content .href-article:hover{
        color: #337ab7;
    }
    .main-container .main-content .read-articles{
        padding: 15px 18px;
        display: table-cell;
        vertical-align: top;
        position: relative;
    }
    .main-container .main-content .read-way{
        font-size: 14px;
        text-decoration: underline;
    }
    .main-container .main-content .info-eyes-comments{
        position: absolute;
        right: 12px;
        bottom: 7px;
        color: gray;
    }
    .main-container .main-content .info-eyes-comments span{
        padding: 0px 5px;
    }

    /*Resize image*/
    .main-container .main-content .thumbnail2 {
      position: relative;
      width: 200px;
      height: 200px;
      overflow: hidden;
    }
    .main-container .main-content .thumbnail2 img {
      position: absolute;
      left: 50%;
      top: 47%;
      height: 100%;
      width: auto;
      -webkit-transform: translate(-50%,-50%);
          -ms-transform: translate(-50%,-50%);
              transform: translate(-50%,-50%);
    }
    .main-container .main-content .thumbnail2 img.portrait {
      width: 100%;
      height: auto;
      top: 70%;
    }
    @media screen and (max-width: 400px) {
        .main-container .main-content .articles-container .articles-content {
            padding: 0;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(".thumbnail2 img").each(function(){
            var w=$(this).width();
            var h=$(this).height();
            if(w<h){
                $(this).addClass("portrait");
            }
        });
    });
</script>
<!--main-container-->
<div class="main-container">
    <!--main-content-->
    <div class="main-content row main-width articles">
        <div class="col-md-12 col-sm-12 col-xs-12 articles-container">
            <div class="articles-content clearfix">
                {$articlePages}
            </div>
        </div>
    </div>
</div>  
