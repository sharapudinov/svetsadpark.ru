<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/settings.php"); // site settings?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
	<head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-MP2N2NH');</script>
        <!-- End Google Tag Manager -->



        <meta charset="<?=SITE_CHARSET?>">
		<META NAME="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon.ico" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/roboto/roboto.css");?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/themes/".$TEMPLATE_THEME_NAME."/style.css");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-1.11.0.min.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.easing.1.3.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/rangeSlider.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/system.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/topMenu.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/topSearch.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/dwCarousel.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/dwSlider.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/colorSwitcher.js");?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/dwZoomer.js");?>
		<?$APPLICATION->ShowHead();?>
		<?CJSCore::Init(array("fx"));?>
		<title><?$APPLICATION->ShowTitle();?></title>
        <script>
            $(function(){
                console.log("TITLE -> " + $("title").text())
                console.log("KEYWORDS -> " + $("meta[name=keywords]").attr("content"))
                console.log("DESCRIPTION -> " + $("meta[name=description]").attr("content"))
                console.log("canonical -> " + $("link[rel=canonical]").attr("href"))
            })
        </script>
        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=NtBwcVMWVd1U6Ikw7nczdJs*8Jd4rANarcmPgGnIsWs9XKpS2xu84YPvjxUgsc5QFYBiNWduWAAKb1iPqHKmWkKKwQ5SXFE*7PvjYELVreUJe/JW/Z2RRQyGY8fMNUEtzt1gVxtnXFUWZhoqmUxC0TezD8uXwRek/6BSHGZu3b8-&pixel_id=1000017681';</script>
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='<a href="https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f)">https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f)</a>;})(window,document,'script','dataLayer','GTM-MP2N2NH'
        </script>
        <!-- End Google Tag Manager -->
        <? include($_SERVER["DOCUMENT_ROOT"]. "/bitrix/templates/dresscodeV2/include/metric.php");?>
	</head>
<body class="loading <?if (INDEX_PAGE == "Y"):?>index<?endif;?><?if(!empty($TEMPLATE_PANELS_COLOR) && $TEMPLATE_PANELS_COLOR != "default"):?> panels_<?=$TEMPLATE_PANELS_COLOR?><?endif;?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MP2N2NH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MP2N2NH"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="panel">
		<?$APPLICATION->ShowPanel();?>
	</div>
	<div id="foundation"<?if(!empty($TEMPLATE_SLIDER_HEIGHT) && $TEMPLATE_SLIDER_HEIGHT != "default"):?> class="slider_<?=$TEMPLATE_SLIDER_HEIGHT?>"<?endif;?>>
		<?require_once($_SERVER["DOCUMENT_ROOT"]."/".SITE_TEMPLATE_PATH."/headers/".$TEMPLATE_HEADER."/template.php");?>
		<div id="main"<?if($TEMPLATE_BACKGROUND_NAME != ""):?> class="color_<?=$TEMPLATE_BACKGROUND_NAME?>"<?endif;?>>
			<?if (INDEX_PAGE != "Y"):?><div class="limiter"><?endif;?>

						<?if (INDEX_PAGE != "Y" && ERROR_404 != "Y"):?>
							<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
								"START_FROM" => "0",
									"PATH" => "",
									"SITE_ID" => "-",
								),
								false
							);?>
						<?endif;?>