<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Адрес магазина SvetSadPark.ru » м. Румянцево (Москва)");
$APPLICATION->SetPageProperty('description', 'Салон SvetSadPark.ru расположен по адресу: г.Москва, Киевское шоссе (500 метров за МКАД), БП Румянцево, корпус Г, второй этаж, павильон Г207 ');
$APPLICATION->SetPageProperty('keywords', 'адрес SvetSadPark.ru, адрес магазина садовых светильников, адрес магазина уличных светильников, адрес магазина парковых светильников, адрес магазина светодиодных светильников');
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "personal",
    array(
        "COMPONENT_TEMPLATE" => "personal",
        "ROOT_MENU_TYPE" => "left",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
    false
);?>
<div class="inside_page_content">

<div itemscope itemtype="http://schema.org/Organization">
    <span itemprop="name">Яндекс</span>
    <p>В нашем салоне Вы можете познакомиться с нашей продукцией вживую, выбрать понравившейся Вам товар, получить консультации опытных менеджеров, оформить и оплатить заказ, заказать доставку. </p>
    <p>При оформлении заказа в салоне </p>
    <p><b style="font-size: 18px;">назовите кодовое слово «САДОВЫЕ ФОНАРИ» и получите дополнительную скидку 10%</b> </p>
    <p>При расчете возможна оплата наличными или банковской картой. </p>
    <p>Режим работы салона: <b style="font-size: 18px;">с 10.00 до 19.00 без выходных </b></p>
    <p>В салоне Вы можете заказать доставку как по г. Москве и Московской области, так и в любой регион России. Доставка до транспортной компании в этом случае производится бесплатно. </p>
    <p>Телефоны салона: </p>

    <p><b itemprop="telephone" class="phone_alloka">8-800-775-12-05</b></p>
<!--    <p><b itemprop="telephone">8-499-550-15-29</b></p>-->

    <p>Наш салон расположен по адресу:</p>
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <p>
            <b style="font-size: 18px;" itemprop="streetAddress">г.Москва, Киевское шоссе (500 метров за МКАД), Бизнес парк Румянцево корпус Г, 2 этаж офис 208.<br /></b>
        </p>
    </div>
</div>



<div style="height: 450px;">
    <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=rjh2op8vRIXLG6xzT76zCJxzlC2uR107&width=860&height=450"></script>
</div>
 
<script>
    $(function () {
        $(".fancybox2").fancybox({});
    })
</script>
 
  <div class="wrap_imgmap"> <a href="/upload/images/imgmap1.jpg" class="fancybox2" > <img src="/upload/images/imgmap1.jpg"  /> </a> <a href="/upload/images/imgmap2.jpg" class="fancybox2" > <img src="/upload/images/imgmap2.jpg"  /> </a> </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>