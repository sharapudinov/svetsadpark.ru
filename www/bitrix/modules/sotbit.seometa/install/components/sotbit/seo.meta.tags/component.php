<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;
if(!Loader::includeModule('sotbit.seometa') || !Loader::includeModule('iblock'))
{
	return false;
}
global $SeoMetaWorkingConditions;
if(!$arParams['CACHE_TIME'])
{
	$arParams['CACHE_TIME'] = '36000000';
}
if(!$arParams['SORT'])
{
	$arParams['SORT'] = 'NAME';
}
$cacheTime = $arParams['CACHE_TIME'];
$cache_id = serialize(array($arParams, $SeoMetaWorkingConditions,($arParams['CACHE_GROUPS']==='N'? false: $USER->GetGroups())));
$cacheDir = '/sotbit.seometa.tags/';
$cache = \Bitrix\Main\Data\Cache::createInstance();
$Tags = array();

if ($cache->initCache($cacheTime, $cache_id, $cacheDir))
{
	$Tags = $cache->getVars();
}
elseif ($cache->startDataCache()) 
{
	$Conditions = array();
	$sections = \Sotbit\Seometa\Tags::findNeedSections($arParams['SECTION_ID'], $arParams['INCLUDE_SUBSECTIONS']);
	$SectionConditions = \Sotbit\Seometa\ConditionTable::GetConditionsBySections($sections);

	if($SeoMetaWorkingConditions)
	{
		foreach($SeoMetaWorkingConditions as $SeoMetaWorkingCondition)
		{
			$wasSections = false;
			if($SectionConditions[$SeoMetaWorkingCondition])
			{
				if(sizeof($SectionConditions[$SeoMetaWorkingCondition]['SECTIONS']) > 0)
				{
					$wasSections = true;
				}
				unset($SectionConditions[$SeoMetaWorkingCondition]['SECTIONS'][array_search($arParams['SECTION_ID'],$SectionConditions[$SeoMetaWorkingCondition]['SECTIONS'])]);
				if(sizeof($SectionConditions[$SeoMetaWorkingCondition]['SECTIONS']) == 0 && $wasSections)
				{
					unset($SectionConditions[$SeoMetaWorkingCondition]);
				}
			}
		}
	}
	$WorkingConditions = \Sotbit\Seometa\ConditionTable::GetConditionsFromWorkingConditions($SeoMetaWorkingConditions);
	
	if(is_array($SectionConditions) && is_array($WorkingConditions))
	{
		$Conditions = $SectionConditions;
		foreach($WorkingConditions as $key => $WorkingCondition)
		{
			$Conditions[$key] = $WorkingCondition;
		}
	}
	elseif(is_array($SectionConditions))
	{
		$Conditions = $SectionConditions;
	}
	elseif(is_array($WorkingConditions))
	{
		$Conditions = $WorkingConditions;
	}
	$TagsObject = new \Sotbit\Seometa\Tags();
	$Tags = $TagsObject->GenerateTags($Conditions, $SeoMetaWorkingConditions);
	$Tags = $TagsObject->SortTags($Tags, $arParams['SORT'], $arParams['SORT_ORDER']);
	$Tags = $TagsObject->CutTags($Tags, $arParams['CNT_TAGS']);
	$Tags = $TagsObject->ReplaceChpuUrls( $Tags );
	unset($Conditions);
	$cache->endDataCache($Tags);
}
$arResult['ITEMS'] = $Tags;
unset($Tags);
$this->IncludeComponentTemplate();
?>