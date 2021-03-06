<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!function_exists('__GCE_GetGroup'))
{
	function __GCEGetGroup(&$group_id, &$arGroupProperties = array(), &$arGroupTmp = array(), $tab = false)
	{
		if (!CModule::IncludeModule("socialnetwork"))
		{
			$group_id = 0;
			return;
		}

		$arGroup = CSocNetGroup::GetByID($group_id);

		if ($arGroup &&
			(
				($tab == "edit" && ($arGroup["OWNER_ID"] == $GLOBALS["USER"]->GetID() || CSocNetUser::IsCurrentUserModuleAdmin()))
				|| ($tab == "invite" && (CSocNetUser::IsCurrentUserModuleAdmin() || CSocNetGroup::CanUserInitiate($GLOBALS["USER"]->GetID(), $group_id)))
			)
		)
		{
			$arGroupTmp["NAME"] = $arGroup["NAME"];
			$arGroupTmp["DESCRIPTION"] = $arGroup["DESCRIPTION"];
			$arGroupTmp["IMAGE_ID_DEL"] = "N";
			$arGroupTmp["SUBJECT_ID"] = $arGroup["SUBJECT_ID"];
			$arGroupTmp["VISIBLE"] = $arGroup["VISIBLE"];
			$arGroupTmp["OPENED"] = $arGroup["OPENED"];
			$arGroupTmp["CLOSED"] = $arGroup["CLOSED"];
			$arGroupTmp["KEYWORDS"] = $arGroup["KEYWORDS"];
			$arGroupTmp["OWNER_ID"] = $arGroup["OWNER_ID"];
			$arGroupTmp["INITIATE_PERMS"] = $arGroup["INITIATE_PERMS"];
			$arGroupTmp["SPAM_PERMS"] = $arGroup["SPAM_PERMS"];
			$arGroupTmp["IMAGE_ID"] = $arGroup["IMAGE_ID"];
			$arGroupTmp["IMAGE_ID_FILE"] = CFile::GetFileArray($arGroup["IMAGE_ID"]);
			$arGroupTmp["IMAGE_ID_IMG"] = '<img src="'.($arGroupTmp["IMAGE_ID_FILE"] != false ? $arGroupTmp["IMAGE_ID_FILE"]["SRC"] : "/bitrix/images/1.gif").'" height="60" class="sonet-group-create-popup-image" id="sonet_group_create_popup_image" border="0">';

			foreach($arGroupProperties as $field => $arUserField)
			{
				if (array_key_exists($field, $arGroup))
				{
					$arGroupProperties[$field]["VALUE"] = $arGroup["~".$field];
					$arGroupProperties[$field]["ENTITY_VALUE_ID"] = $arGroup["ID"];
				}
			}

			$arGroupTmp["IS_EXTRANET_GROUP"] = (
				CModule::IncludeModule("extranet")
				&& CExtranet::IsExtranetSocNetGroup($group_id)
					? "Y"
					: "N"
			);
		}
		else
		{
			$arGroupTmp["VISIBLE"] = "Y";
			$arGroupTmp["IS_EXTRANET_GROUP"] = "N";
			$group_id = 0;
		}
	}
}

if (!function_exists('__GCE_GetFeatures'))
{
	function __GCE_GetFeatures($group_id, &$arFeatures)
	{
		if (!CModule::IncludeModule("socialnetwork"))
		{
			return;
		}

		$arFeaturesTmp = array();

		if (intval($group_id) > 0)
		{
			$dbResultTmp = CSocNetFeatures::GetList(
				array(),
				array("ENTITY_ID" => $group_id, "ENTITY_TYPE" => SONET_ENTITY_GROUP)
			);
			while ($arResultTmp = $dbResultTmp->GetNext())
			{
				$arFeaturesTmp[$arResultTmp["FEATURE"]] = $arResultTmp;
			}
		}

		$arSocNetFeaturesSettings = CSocNetAllowed::GetAllowedFeatures();

		foreach ($arSocNetFeaturesSettings as $feature => $arFeature)
		{
			if (
				!is_array($arFeature["allowed"]) 
				|| !in_array(SONET_ENTITY_GROUP, $arFeature["allowed"])
			)
			{
				continue;
			}

			if (intval($group_id) == 0)
			{
				$arFeaturesTmp[$feature]["ACTIVE"] = (
					$feature == "chat"
						? \CUserOptions::getOption("socialnetwork", "default_chat_create_default", "Y")
						: COption::getOptionString("socialnetwork", "default_".$feature."_create_default", "Y", SITE_ID)
				);
			}

			$arFeatures[$feature] = array(
				"FeatureName" => (!empty($arFeaturesTmp) ? $arFeaturesTmp[$feature]["FEATURE_NAME"] : false),
				"Active" => (
					!empty($arFeaturesTmp)
					&& array_key_exists($feature, $arFeaturesTmp)
						? ($arFeaturesTmp[$feature]["ACTIVE"] == "Y") // saved
						: true
				)
			);
		}
	}
}
?>