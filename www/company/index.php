    <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О магазине");
?><h1>О магазине</h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personal", 
	array(
		"COMPONENT_TEMPLATE" => "personal",
		"ROOT_MENU_TYPE" => "about",
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
<div class="global-block-container">
	<div class="global-content-block">
		<div class="bx_page">
            <p>Интернет-магазин <b>SvetSadPark</b> является официальным эксклюзивным представителем торговых марок UME и LUTEC в России, также интернет-магазин Svetsadpark является официальным владельцем торговой марки O.L. </p>

            <p>Обращаем Ваше внимание, что все другие интернет-магазины, представляющие данные торговые марки, являются нашими партнерами.</p>

            <p><b>Адрес офиса и выставочного зала интернет-магазина SvetSadPark: </b></p>

            <p>город Москва, Киевское шоссе дом 1, Бизнес парк Румянцево корпус Г, 2 этаж офис 208.</p>

                   <div class="wrap_sectif">
                    <b>Телефон:</b>
                  <div>  <p class="phone_alloka"><a style="color:inherit;" href="tel:"8-800-775-12-05">8-800-775-12-05</a></p></div>
  <div>  <b>Сертификаты:</b></div>
                <div class="items_sectif">
                
                    <a href="/upload/images/1.jpg" id="sertif">
                        <img src="/upload/images/1.jpg"/>
                    </a>
                    <a href="/upload/images/2.jpg"  id="sertif2">
                        <img src="/upload/images/2.jpg"/>
                    </a>
                </div>
            </div>
            <p><b>Реквизиты:</b>
                <br />
            </p>

            <table width="800" cellspacing="1" cellpadding="5" border="1" height="466" style="border-collapse: collapse;">
                <tbody>
                <tr><td>Полное название    </td><td>Индивидуальный предприниматель Воронкина Агафия Борисовна</td></tr>

                <tr><td>ОГРНИП</td><td>309774632701214</td></tr>

                <tr><td>Дата Гос.регистрации</td><td>23.11.2009г.</td></tr>

                <tr><td>ИНН</td><td>772365216503</td></tr>

                <tr><td>Адрес юридический</td><td>РФ,109451, г. Москва, ул. Братиславская, д.13, кор. 1. кв. 231</td></tr>

                <tr><td>Расчетный счет</td><td>40802810102010000097</td></tr>

                <tr><td>Открыт расчетный счёт</td><td>14.03.2016г.</td></tr>

                <tr><td>Банк</td><td>ДО «Румянцево» АО «Альфа-Банк»</td></tr>

                <tr><td>Кор. счет</td><td>30101810200000000593</td></tr>

                <tr><td>БИК    </td><td>044525593</td></tr>

                <tr><td>Основной вид деятельности</td><td>52.1- Розничная торговля в неспециализированных магазинах</td></tr>

                <tr><td>ОКПО</td><td>0116969393
                        <br />
                    </td></tr>

                <tr><td colspan="1">Назначение платежа</td><td colspan="1">За светильники Без НДС</td></tr>

                <tr><td colspan="1">Телефон</td><td colspan="1">8-915-474-31-37</td></tr>

                <tr><td colspan="1">Е-mail</td><td colspan="1">agata-v@rambler.ru</td></tr>
                </tbody>
            </table>

            <br />
		</div>
	</div>
	<div class="global-information-block">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include", 
			".default", 
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"AREA_FILE_SHOW" => "sect",
				"AREA_FILE_SUFFIX" => "information_block",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => ""
			),
			false
		);?>
	</div>
</div>
се<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>