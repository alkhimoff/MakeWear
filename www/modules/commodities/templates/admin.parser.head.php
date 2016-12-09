<?php
$all_head = '
    <div id="interface-conteiner">
    <form action="/parser/vir_interface_selected.php" target="_blank" method="post">
        <p><input type="radio" name="visibl" value="1" checked>Опубликованные товары
        <input type="radio" name="visibl" value="0">НЕопубликованные товары
        <p><input type="checkbox" name="img" value="true" class="comProp"> Перезалить фото
        <input type="checkbox" name="cod" value="true" class="comProp" checked> Перезалить код товара
        <input type="checkbox" name="name" value="true" class="comProp" checked> Перезалить имя товара
        <input type="checkbox" name="desc" value="true" class="comProp" checked> Перезалить описание товара
        <input type="checkbox" name="del" value="true" class="comProp"> Скрыть(опубликовю.) или удалить(неопуб.)
        <p>
            <input type="text" name="add_price" value="1" class="comProp" style="width: 40px;">Повысить розничную цену
        </p>
        <div id="deleteCh">Выделить все</div>
        <p>Бренды для проверки:</p>
        <br>
        <input type="checkbox" name="fu"   value="1"  > Fashion up 
        <input type="checkbox" name="sbs"  value="4" style="display: none;" ><!--SwirlBySwirl-->
        <input type="checkbox" name="car"  value="5"  > Cardo &nbsp; 
        <input type="checkbox" name="gl"   value="6"  > Glem &nbsp;
        <input type="checkbox" name="len"  value="7"  > Lenida &nbsp;
        <input type="checkbox" name="sel"  value="9"  > Sellin &nbsp;
        <input type="checkbox" name="meg"  value="10" > Meggi &nbsp;
        <input type="checkbox" name="alva" value="11" > Alva &nbsp;
        <input type="checkbox" name="flf"  value="13" > Flfashion &nbsp;
        <input type="checkbox" name="skh"  value="14" > SK House
        <input type="checkbox" name="sev"  value="16" > Seventeen       
        <input type="checkbox" name="sl"   value="17" > S&L &nbsp;
        <input type="checkbox" name="ols"  value="19" > OlisStyle &nbsp;
        <input type="checkbox" name="nec"  value="20" > Nelli-Co &nbsp;
        <input type="checkbox" name="fst"  value="21" style="display: none;" ><!-- FStyle -->
        <input type="checkbox" name="arm"  value="23" style="display: none;" ><!--  Art Millano -->
        <input type="checkbox" name="b1"   value="24" > B1-ArtMillano
        <input type="checkbox" name="maj"  value="25" style="display: none;" ><!-- Majaly -->
        <input type="checkbox" name="crs"  value="29" style="display: none;" ><!-- Crisma -->
        <input type="checkbox" name="vit"  value="30" > Vitality
        <br><br>
        <input type="checkbox" name="vik"  value="31" > Vitality KIDS &nbsp;
        <input type="checkbox" name="hel"  value="32" > Helen Laven
        <input type="checkbox" name="daj"  value="33" > Dajs &nbsp;
        <input type="checkbox" name="dem"  value="34" style="display: none;" ><!--Dembo House -->
        <input type="checkbox" name="jhi"  value="35" > Jhiva &nbsp;
        <input type="checkbox" name="zds"  value="36" > Zdes       
        <input type="checkbox" name="vid"  value="38" > Vidoli &nbsp;
        <input type="checkbox" name="laf"  value="39" > Lavana Fashion
        <input type="checkbox" name="ref"  value="40" > Reform &nbsp;
        <input type="checkbox" name="ttt"  value="41" > Tali Ttet &nbsp;
        <input type="checkbox" name="gha"  value="43" > Ghazel
        <input type="checkbox" name="flook"  value="44" > Fashion Look
        <input type="checkbox" name="vision" value="46" > Vision FS &nbsp;
        <input type="checkbox" name="jadone" value="47" > Jadone Fashion
        <br><br>
        <input type="checkbox" name="daminika"   value="48" > Daminika &nbsp;
        <input type="checkbox" name="shaarm"     value="50" > Shaarm &nbsp;
        <input type="checkbox" name="dolcedonna" value="51" checked> Dolcedonna
        
        <p><input type="submit" value="Запустить Проверщик" id="goVir"></p>
    </form>
</div>
<tr>
	<th style="width:40px;">#</th>
	<th>Имя бренда</th>
        <th>ID категории</th>
	<th>Дата</th>
	<th style="width:150px;">Ссылки категорий для паука</th>
	<th>Селектор: ссылки на товары</th>
	<th>Список ссылок на товары</th>
        <th>Наличии</th>
	<th>Цена</th>
	<th>Цена ОПТ</th>
	<th>Цвет|Размер</th>
	<th>Заголовок</th>
        <th>Код</th>
	<th>Описание</th>
        <th>Главная картинка</th>
	<th>Доп. фото</th>
	<th>Наценка</th>
	<th class="acty">Запустить парсер</th>
	<th class="acty">Импорт URL</th>
	<th class="acty">Редакт.</th>
	<th class="acty">Удалить</th>
</tr>
';
