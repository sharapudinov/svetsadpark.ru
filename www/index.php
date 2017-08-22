<?define("INDEX_PAGE", "Y");?>
<?define("MAIN_PAGE", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "садово-парковое освещение, садовое освещение, парковое освещение, купить садово-парковое освещение, купить садовое освещение, купить парковое освещение, цена на садово-парковое освещение");
$APPLICATION->SetPageProperty("description", "Купить садовые и парковые светильники от производителя. Светильники садово-паркового освещения по самым низким ценам. Лучший интернет-магазин садово-паркового освещения!");
$APPLICATION->SetTitle("Садово-парковое освещение » Интернет-магазин SvetSadPark.ru");?>

		<?$APPLICATION->IncludeComponent(
			"dresscode:slider", 
			"promoSlider", 
			array(
				"IBLOCK_TYPE" => "slider",
				"IBLOCK_ID" => "2",
				"CACHE_TYPE" => "Y",
				"CACHE_TIME" => "3600000",
				"PICTURE_WIDTH" => "1920",
				"PICTURE_HEIGHT" => "1080",
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		);?>

	
<?$APPLICATION->IncludeComponent(
	"dresscode:offers.product", 
	".default", 
	array(
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600000",
		"PROP_NAME" => "OFFERS",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "12",
		"PICTURE_WIDTH" => "220",
		"PICTURE_HEIGHT" => "200",
//		"PROP_VALUE" => array(0 => "9",1 => "10",2 => "11",3 => "12",4 => "13",),
        "PROP_VALUE" => array(0 => "53",1 => "54",2 => "55"),
		"ELEMENTS_COUNT" => "10",
		"SORT_PROPERTY_NAME" => "SORT",
		"SORT_VALUE" => "ASC",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>	
<?$APPLICATION->IncludeComponent(
	"dresscode:pop.section", 
	".default", 
	array(
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600000",
		"PROP_NAME" => "UF_POPULAR",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "12",
		"PICTURE_WIDTH" => "120",
		"PICTURE_HEIGHT" => "100",
		"PROP_VALUE" => "Y",
		"ELEMENTS_COUNT" => "10",
		"SORT_PROPERTY_NAME" => "7",
		"SORT_VALUE" => "DESC",
		"SELECT_FIELDS" => array(
			0 => "NAME",
			1 => "SECTION_PAGE_URL",
			2 => "DETAIL_PICTURE",
			3 => "UF_IMAGES",
			4 => "UF_MARKER",
			5 => "",
		),
		"POP_LAST_ELEMENT" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
<div class="" style="display:none;">
<?$APPLICATION->IncludeComponent(
	"dresscode:brands.list", 
	".default", 
	array(
		"IBLOCK_TYPE" => "info",
		"IBLOCK_ID" => "1",
		"SELECT_FIELDS" => array(
			0 => "",
			1 => "*",
			2 => "",
		),
		"PROP_NAME" => "",
		"PROP_VALUE" => "",
		"ELEMENTS_COUNT" => "15",
		"SORT_PROPERTY_NAME" => "7",
		"SORT_VALUE" => "ASC",
		"PICTURE_WIDTH" => "150",
		"PICTURE_HEIGHT" => "120",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>

<div id="infoTabsCaption">
	<div class="limiter">
		<div class="items">
			<?$APPLICATION->ShowViewContent("main_news_view_content_tab");?>
		</div>
	</div>
</div>
<div id="infoTabs">
	<div class="items">
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mainNews", 
	array(
		"IBLOCK_TYPE" => "info",
		"IBLOCK_ID" => "13",
		"NEWS_COUNT" => "6",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPONENT_TEMPLATE" => "mainNews",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"mainCollection", 
			array(
				"IBLOCK_TYPE" => "info",
				"IBLOCK_ID" => "5",
				"NEWS_COUNT" => "6",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(
					0 => "ID",
					1 => "CODE",
					2 => "XML_ID",
					3 => "NAME",
					4 => "TAGS",
					5 => "SORT",
					6 => "PREVIEW_TEXT",
					7 => "PREVIEW_PICTURE",
					8 => "DETAIL_TEXT",
					9 => "DETAIL_PICTURE",
					10 => "DATE_ACTIVE_FROM",
					11 => "ACTIVE_FROM",
					12 => "DATE_ACTIVE_TO",
					13 => "ACTIVE_TO",
					14 => "SHOW_COUNTER",
					15 => "SHOW_COUNTER_START",
					16 => "IBLOCK_TYPE_ID",
					17 => "IBLOCK_ID",
					18 => "IBLOCK_CODE",
					19 => "IBLOCK_NAME",
					20 => "IBLOCK_EXTERNAL_ID",
					21 => "DATE_CREATE",
					22 => "CREATED_BY",
					23 => "CREATED_USER_NAME",
					24 => "TIMESTAMP_X",
					25 => "MODIFIED_BY",
					26 => "USER_NAME",
					27 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "Коллекции",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SET_LAST_MODIFIED" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => ""
			),
			false
		);?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"mainService", 
			array(
				"IBLOCK_TYPE" => "info",
				"IBLOCK_ID" => "6",
				"NEWS_COUNT" => "6",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(
					0 => "ID",
					1 => "CODE",
					2 => "XML_ID",
					3 => "NAME",
					4 => "TAGS",
					5 => "SORT",
					6 => "PREVIEW_TEXT",
					7 => "PREVIEW_PICTURE",
					8 => "DETAIL_TEXT",
					9 => "DETAIL_PICTURE",
					10 => "DATE_ACTIVE_FROM",
					11 => "ACTIVE_FROM",
					12 => "DATE_ACTIVE_TO",
					13 => "ACTIVE_TO",
					14 => "SHOW_COUNTER",
					15 => "SHOW_COUNTER_START",
					16 => "IBLOCK_TYPE_ID",
					17 => "IBLOCK_ID",
					18 => "IBLOCK_CODE",
					19 => "IBLOCK_NAME",
					20 => "IBLOCK_EXTERNAL_ID",
					21 => "DATE_CREATE",
					22 => "CREATED_BY",
					23 => "CREATED_USER_NAME",
					24 => "TIMESTAMP_X",
					25 => "MODIFIED_BY",
					26 => "USER_NAME",
					27 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "Новости",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SET_LAST_MODIFIED" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => ""
			),
			false
		);?>

	</div>
</div>

<?$APPLICATION->IncludeComponent(
	"dresscode:slider", 
	"middle", 
	array(
		"IBLOCK_TYPE" => "slider",
		"IBLOCK_ID" => "3",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600000",
		"PICTURE_WIDTH" => "1480",
		"PICTURE_HEIGHT" => "200",
		"COMPONENT_TEMPLATE" => "middle"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "simplyText",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>