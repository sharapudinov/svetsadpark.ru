<?
    /*ALTER TABLE b_sotbit_seometa
MODIFY COLUMN SECTIONS TEXT;*/
namespace Sotbit\Seometa;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Main\Type;

Loc::loadMessages( __FILE__ );
require_once $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/sotbit.seometa/classes/general/seometa_sitemap.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/iblock/classes/general/iblocksection.php';
class ConditionTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}
	public static function getTableName()
	{
		return 'b_sotbit_seometa';
	}
	public static function getMap()
	{
		return array (
				new Entity\IntegerField( 'ID', array (
						'primary' => true,
						'autocomplete' => true 
				) ),
				new Entity\StringField( 'NAME', array (
						'required' => true,
						'title' => Loc::getMessage( 'SEOMETA_NAME' ) 
				) ),
				new Entity\BooleanField( 'ACTIVE', array (
						'values' => array (
								'N',
								'Y' 
						),
						'title' => Loc::getMessage( 'SEOMETA_ACTIVE' ) 
				) ),
				new Entity\BooleanField( 'SEARCH', array (
						'values' => array (
								'N',
								'Y' 
						),
						'title' => Loc::getMessage( 'SEOMETA_SEARCH' ) 
				) ),
				new Entity\IntegerField( 'SORT', array (
						'required' => true,
						'title' => Loc::getMessage( 'SEOMETA_SORT' ) 
				) ),
				new Entity\DatetimeField( 'DATE_CHANGE', array (
						'title' => Loc::getMessage( 'SEOMETA_DATE_CHANGE' ) 
				) ),
				new Entity\TextField( 'SITES', array (
						'title' => Loc::getMessage( 'SEOMETA_SITES' ) 
				) ),
				new Entity\StringField( 'TYPE_OF_CONDITION', array (
						'title' => Loc::getMessage( 'SEOMETA_TYPE_OF_CONDITION' ) 
				) ),
				new Entity\StringField( 'FILTER_TYPE', array (
						'title' => Loc::getMessage( 'SEOMETA_TYPE_OF_FILTER_TYPE' ) 
				) ),
				new Entity\StringField( 'TYPE_OF_INFOBLOCK', array (
						'title' => Loc::getMessage( 'SEOMETA_TYPE_OF_INFOBLOCK' ) 
				) ),
				new Entity\StringField( 'INFOBLOCK', array (
						'title' => Loc::getMessage( 'SEOMETA_INFOBLOCK' ) 
				) ),
				new Entity\TextField( 'SECTIONS', array (
						'title' => Loc::getMessage( 'SEOMETA_SECTIONS' ) 
				) ),
				new Entity\TextField( 'RULE', array (
						'title' => Loc::getMessage( 'SEOMETA_RULE' ) 
				) ),
				new Entity\StringField( 'META', array (
						'title' => Loc::getMessage( 'SEOMETA_META' ) 
				) ),
				new Entity\BooleanField( 'NO_INDEX', array (
						'values' => array (
								'N',
								'Y' 
						),
						'title' => Loc::getMessage( 'SEOMETA_NO_INDEX' ) 
				) ),
				new Entity\BooleanField( 'STRONG', array (
						'values' => array (
								'N',
								'Y' 
						),
						'title' => Loc::getMessage( 'SEOMETA_STRONG' ) 
				) ),
				new Entity\FloatField( 'PRIORITY', array (
						'title' => Loc::getMessage( 'SEOMETA_PRIORITY' ) 
				) ),
				new Entity\FloatField( 'CHANGEFREQ', array (
						'title' => Loc::getMessage( 'SEOMETA_CHANGEFREQ' ) 
				) ),
				new Entity\IntegerField( 'CATEGORY_ID', array (
						'required' => true,
						'title' => Loc::getMessage( 'SEOMETA_CATEGORY_ID' ) 
				) ),
				new Entity\TextField( 'TAG', array (
						'title' => Loc::getMessage( 'SEOMETA_TAG' ) 
				) ),
				new Entity\TextField( 'CONDITION_TAG', array (
						'title' => Loc::getMessage( 'CONDITION_SEOMETA_TAG' ) 
				) ),
		);
	}
	
	/**
	 * return conditions for sections
	 *
	 * @param array $Sections        	
	 * @return array
	 */
	public static function GetConditionsBySections($Sections= array())
	{
		$return = array ();

		$Conditions = ConditionTable::getList( array (
				'filter' => array (
						'ACTIVE' => 'Y' 
				),
				'order' => array('SORT' => 'asc'),
				'select' => array (
						'ID',
						'SITES',
						'SECTIONS',
						'RULE',
						'TAG',
						'FILTER_TYPE',
						'INFOBLOCK',
				) 
		) );
		while ( $Condition = $Conditions->fetch() )
		{
			$Sites = unserialize( $Condition['SITES'] );
			if (! in_array( SITE_ID, $Sites ))
			{
				continue;
			}
			
			if(!$Condition['TAG'])
			{
				continue;
			}
			
			$ConditionSections = unserialize( $Condition['SECTIONS'] );
			if(!$ConditionSections)
			{
				$NeedSection = $Sections;
			}
			else
			{
				$NeedSection = array_intersect( $Sections, $ConditionSections );
			}
			
			
			
			if ($NeedSection)
			{
				$Condition['SECTIONS'] = $NeedSection;
				$return[$Condition['ID']] = $Condition;
			}
		}
		unset( $NeedSection );
		unset( $Sites );
		unset( $Sections );
		unset( $Conditions );
		unset( $ConditionSections );
		unset( $Condition );
		return $return;
	}
	public static function generateUrlForCondition($id)
	{                      
        @set_time_limit(0);
		if ($id == 0)
			return array ();
		SeometaUrlTable::deleteByConditionId( $id );
		$arCondition = self::getById( $id )->fetch();
		$FilterType = $arCondition['FILTER_TYPE'];
		if ($FilterType == 'bitrix_chpu')
		{
			$MASK = "#SECTION_URL#filter/#FILTER_PARAMS#apply/";
		}
		elseif ($FilterType == 'bitrix_not_chpu')
		{
			$MASK = "#SECTION_URL#?set_filter=y#FILTER_PARAMS#";
		}
		elseif ($FilterType == 'misshop_chpu')
		{
			$MASK = "#SECTION_URL#filter/#FILTER_PARAMS#apply/";
		}
        elseif ($FilterType == 'combox_chpu')
        {
            $MASK = "#SECTION_URL#filter/#FILTER_PARAMS#";
        }
        elseif ($FilterType == 'combox_not_chpu')
        {
            $MASK = "#SECTION_URL#?#FILTER_PARAMS#";
        }
		$res = array ();
		Loader::includeModule( 'iblock' );

		$ConditionSections = unserialize( $arCondition['SECTIONS'] );
		if (! is_array( $ConditionSections ) || count( $ConditionSections ) < 1) // If dont check sections
		{
			$ConditionSections = array ();
			$rsSections = \CIBlockSection::GetList( array (
					'SORT' => 'ASC' 
			), array (
					'ACTIVE' => 'Y',
					'IBLOCK_ID' => $arCondition['INFOBLOCK'] 
			), false, array (
					'ID' 
			) );
			while ( $arSection = $rsSections->GetNext() )
			{
				$ConditionSections[] = $arSection['ID'];
			}
		}
		$Rule = unserialize( $arCondition['RULE'] );
		$template = unserialize( $arCondition['META'] );
		$template = $template['TEMPLATE_NEW_URL'];
		preg_match( "/{(.*?)}/", $template, $template_prop );
		$template = str_replace( $template_prop[0], '#PROPERTIES#', $template );
		$template1 = $template;
		$template_prop = trim( $template_prop[0], '{' );
		$template_prop = trim( $template_prop, '}' );
		$template_prop = explode( ':', $template_prop );
		
		$arCond = explode( ':', $arCondition["CLASS_ID"] );                          
		\CSeoMetaSitemap::$isGenerateChpu = true;
		$Pages = \CSeoMetaSitemap::ParseArray( $Rule, $ConditionSections );  
		// Get sections path
		$rsSections = \CIBlockSection::GetList( array (
				'ID' => 'ASC' 
		), array (
				'ACTIVE' => 'Y',
				'ID' => $ConditionSections ,
				'IBLOCK_ID' => $arCondition['INFOBLOCK']
		), false, array (
				'ID' 
		), false );
		$i = 0;
		while ( $arSection = $rsSections->Fetch() )
		{
			$CondVals['SECTION'][] = $arSection;
		}                      
		\CSeoMetaSitemap::SetListOfProps( $FilterType );  
		$CondVals['PAGES'] = \CSeoMetaSitemap::SortPagesCodes( $Pages );   
		\CSeoMetaSitemap::$isGenerateChpu = false;
		foreach ( $CondVals['SECTION'] as $Section )
		{
			$SectionUrl = "";
			$nav = \CIBlockSection::GetNavChain( false, $Section['ID'] );
			while ( $arSectionPath = $nav->GetNext() )
			{
				$SectionUrl = $arSectionPath['SECTION_PAGE_URL'];
			}
			
			$section = \CIBlockSection::getById( $Section['ID'] )->fetch();
			$sectname = $section['NAME'];
			$template = $template1;
			$template = str_replace( '#SECTION_ID#', $section['ID'], $template );
			$template = str_replace( '#SECTION_CODE#', $section['CODE'], $template );
			
			if (empty( $CondVals['PAGES'] ))
			{
				$MASK = "#SECTION_URL#";
				$arFilter = array (
						'ACTIVE' => 'Y',
						'INCLUDE_SUBSECTIONS' => 'Y',
						'IBLOCK_ID' => $arCondition['INFOBLOCK'],
						'SECTION_ID' => $section['ID'] 
				);
				$new_url_template = str_replace( '#PROPERTIES#', '', $template );
				$new_url_template = str_replace( '#PRICES#', '', $new_url_template );
				$FilterParams = '';
				$LOC = str_replace( '#SECTION_URL#', $SectionUrl, $MASK );
				$LOC = str_replace( '#FILTER_PARAMS#', $FilterParams, $LOC );
				$LOC = $SiteUrl . $LOC;
				
				if (substr( $LOC, 0, 4 ) != 'http')
				{
					$LOC = $SiteUrl . $LOC;
				}
				
				$count = \CIBlockElement::GetList( array (), $arFilter )->SelectedRowsCount();
				
				$res1['real_url'] = $LOC;
				$res1['new_url'] = strtolower( $new_url_template );
				$res1['section_id'] = $section['ID'];
				$res1['name'] = $name;
				$res1['properties'] = $cond_properties;
				$res1['product_count'] = $count;
				$res[] = $res1;
			}                                                       
			foreach ( $CondVals['PAGES'] as $Page )
			{
				$new_url_template = $template;
				
				$FilterParams = '';
				
				$name = $sectname;
				$props_templ = array ();
				$prop_string_values = array ();
				$cond_properties = array ();    
				foreach ( $Page as $CondKey => $CondValProps )
				{                                          
					$prop_url = '';
					if (isset( $CondValProps['CODE'] ) && ! is_null( $CondValProps['CODE'] ))
					{
						$prop = \CIBlockProperty::GetList( array (
								"SORT" => "ASC",
								'ID' => 'ASC' 
						), array (
								"IBLOCK_ID" => $arCondition['INFOBLOCK'],
								"CODE" => $CondValProps['CODE'],
								"ACTIVE" => "Y" 
						) )->fetch();
						if (isset( $CondValProps['VALUE'] ) && ! is_null( $CondValProps['VALUE'] ))
						{                                      
							$prop_string_values[$prop['ID']][] = $CondValProps['VALUE'];
						}
						$CondValProps['PROPERTY_ID'] = $prop['ID'];
						$name .= ' ' . strtolower( $prop['NAME'] );    
						$prop_url = str_replace( '#PROPERTY_CODE#', $prop['CODE'], $template_prop[0] );
                        $prop_url = str_replace( '#PROPERTY_ID#', $prop['ID'], $prop_url );        
					}                                        
					if ($CondKey == "PRICES")  
                    {
                        $prices = '';
                        if ($FilterType == 'misshop_chpu')
                        {
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN')
                                        $ValMin = "-from-" . $PriceProps['VALUE'][$j];
                                    if ($Type == 'MAX')
                                        $ValMax = "-to-" . $PriceProps['VALUE'][$j];
                                }
                                $cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
                                $cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
                                $prices .= "price" . $ValMin . $ValMax;
                                $FilterParams .= "price" . $PriceProps['ID'][0] . $ValMin . $ValMax .= "/";
                            }
                        }
                        elseif ($FilterType == 'combox_chpu')
                        {
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN'){
                                        $ValMin = "price-from-" . $PriceProps['VALUE'][$j];
                                        $FilterParams .= $ValMin."/";
                                    }
                                    if ($Type == 'MAX'){
                                        $ValMax = "price-to-" . $PriceProps['VALUE'][$j];
                                        $FilterParams .= $ValMax."/";
                                    }
                                }
                                $cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
                                $cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
                                $prices .= $ValMin .'/'. $ValMax;                                
                            }
                        }   
                        elseif ($FilterType == 'bitrix_chpu')
                        {
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN')
                                        $ValMin = "-from-" . $PriceProps['VALUE'][$j];
                                    if ($Type == 'MAX')
                                        $ValMax = "-to-" . $PriceProps['VALUE'][$j];
                                }
                                $cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
                                $cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
                                $prices .= "price" . $ValMin . $ValMax;
                                $FilterParams .= "price-" . strtolower( $PriceCode ) . $ValMin . $ValMax .= "/";
                            }
                        }
                        elseif ($FilterType == 'bitrix_not_chpu')
                        {
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN')
                                        $ValMin = "_MIN=" . $PriceProps['VALUE'][$j];
                                    if ($Type == 'MAX')
                                        $ValMax = "_MAX=" . $PriceProps['VALUE'][$j];
                                }
                                if (isset( $ValMin ) && $ValMin != "")
                                {
                                    $FilterParams .= "&arrFilter_P" . $PriceProps['ID'][0] . $ValMin;
                                }
                                if (isset( $ValMax ) && $ValMax != "")
                                {
                                    $FilterParams .= "&arrFilter_P" . $PriceProps['ID'][0] . $ValMax;
                                }
                                $prices .= "price" . $ValMin . $ValMax;
                                $cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
                                $cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
                            }
                        }
                    } 
                    elseif($CondKey == "FILTER")
                    {   
                        //$filter = '';
                        if ($FilterType == 'misshop_chpu')
                        {                                          
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN'){
                                        $cond_properties['FILTER'][$PriceCode]['FROM'] = $PriceProps['VALUE'][$j];
                                        $ValMin = "-from-" . $PriceProps['VALUE'][$j];
                                    } elseif ($Type == 'MAX'){
                                        $cond_properties['FILTER'][$PriceCode]['TO'] = $PriceProps['VALUE'][$j];
                                        $ValMax = "-to-" . $PriceProps['VALUE'][$j];
                                    }
                                }                                                            
                                $prop = \CIBlockProperty::GetByID(intval($PriceCode))->fetch();
                                $filter .= strtolower($prop['CODE']) . $ValMin . $ValMax;
                                $FilterParams .= strtolower($prop['CODE']) . $ValMin . $ValMax .= "/";
                            }
                        }         
                        elseif ($FilterType == 'bitrix_chpu')
                        {
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN'){
                                        $cond_properties['FILTER'][$PriceCode]['FROM'] = $PriceProps['VALUE'][$j];
                                        $ValMin = "-from-" . $PriceProps['VALUE'][$j];
                                    } elseif ($Type == 'MAX'){
                                        $cond_properties['FILTER'][$PriceCode]['TO'] = $PriceProps['VALUE'][$j];
                                        $ValMax = "-to-" . $PriceProps['VALUE'][$j];
                                    }
                                }                                                              
                                $prop = \CIBlockProperty::GetByID(intval($PriceCode))->fetch();
                                $filter .= strtolower($prop['CODE']) . $ValMin . $ValMax;
                                $FilterParams .= strtolower($prop['CODE']) . $ValMin . $ValMax .= "/";          
                            }
                        }
                        elseif ($FilterType == 'bitrix_not_chpu')
                        {
                            foreach ( $CondValProps as $PriceCode => $PriceProps )
                            {
                                $ValMin = "";
                                $ValMax = "";
                                foreach ( $PriceProps['TYPE'] as $j => $Type )
                                {
                                    if ($Type == 'MIN'){
                                        $cond_properties['FILTER'][$PriceCode]['FROM'] = $PriceProps['VALUE'][$j];
                                        $ValMin = "_MIN=" . $PriceProps['VALUE'][$j];
                                    } elseif ($Type == 'MAX'){
                                        $cond_properties['FILTER'][$PriceCode]['TO'] = $PriceProps['VALUE'][$j];
                                        $ValMax = "_MAX=" . $PriceProps['VALUE'][$j];
                                    }
                                }
                                if (isset( $ValMin ) && $ValMin != "")
                                {                                                               
                                    $FilterParams .= "&arrFilter_P" . $PriceProps['ID'][0] . $ValMin;
                                }
                                if (isset( $ValMax ) && $ValMax != "")        
                                {                                                               
                                    $FilterParams .= "&arrFilter_" . $PriceProps['ID'][0] . $ValMax;
                                }
                                $prop = \CIBlockProperty::GetByID(intval($PriceCode))->fetch();
                                $filter .= strtolower($prop['CODE']) . $ValMin . $ValMax;  
                            }
                        }                        
                    } else {
						$k = 1;            
						// collect prop values for filter
						if (isset( $CondValProps['CODE'] ) && ! is_null( $CondValProps['CODE'] ))
						{
							$key = $CondValProps['CODE'];
						}
						else
						{
							$key = $CondKey;
						}              
                        
						$CntCondValProps = count( $CondValProps['MISSSHOP'][1] );
						$values = array ();
						foreach ( $CondValProps['MISSSHOP'][1] as $PropVal )
						{
							if ($k == $CntCondValProps)
							{
								$values[] = $PropVal;
							}
							else
							{
								$values[] = $PropVal;
							}
							++ $k;
						}
						$cond_properties[$key] = $values;
						
						$k = 1;
						if ($FilterType == 'misshop_chpu')
						{
							if (isset( $CondValProps['CODE'] ) && ! is_null( $CondValProps['CODE'] ))
							{
								$key = $CondValProps['CODE'];
								$FilterParams .= strtolower( $CondValProps['CODE'] ) . '-';
							}
							else
							{
								$key = $CondKey;
								$FilterParams .= $CondKey . '-';
							}
							$CntCondValProps = count( $CondValProps['MISSSHOP'][1] );
							$values = array ();
							foreach ( $CondValProps['MISSSHOP'][1] as $PropVal )
							{
								if ($k == $CntCondValProps)
								{
									$FilterParams .= $PropVal;
									$values[] = $PropVal;
								}
								else
								{
									$FilterParams .= $PropVal . '-or-';
									$values[] = $PropVal;
								}
								++ $k;
							}                                      
							$values = implode( $template_prop[2], $values );
							$prop_url = str_replace( '#PROPERTY_VALUE#', $values, $prop_url );
							$FilterParams .= '/';
						}
						elseif ($FilterType == 'bitrix_chpu')
						{
							if (isset( $CondValProps['CODE'] ) && ! is_null( $CondValProps['CODE'] ))
							{
								$key = $CondValProps['CODE'];
								$FilterParams .= strtolower( $CondValProps['CODE'] ) . '-is-';
							}
							else
							{
								$key = $CondKey;
								$FilterParams .= $CondKey . '-is-';
							}
							$CntCondValProps = count( $CondValProps['MISSSHOP'][0] );
							$values = array ();
							foreach ( $CondValProps['BITRIX'][1] as $PropVal )
							{
								if ($k == $CntCondValProps)
								{
									//$FilterParams .= strtolower( $PropVal );
									//$values[] = $PropVal;

									if(isset($prop['PROPERTY_TYPE']) and $prop['PROPERTY_TYPE']=="S") {

										$FilterParams .= urlencode($PropVal);
										$values[] = \Cutil::translit(urldecode($PropVal),"ru",array("replace_space"=>"-","replace_other"=>"-"));

									} else {
										$FilterParams .= strtolower($PropVal);
										$values[] = $PropVal;
									}
								}
								else
								{
									$FilterParams .= $PropVal . '-or-';
									$values[] = $PropVal;
								}
								++ $k;
							}
							// $cond_properties[$key] = $values;
							$values = implode( $template_prop[2], $values );
							$prop_url = str_replace( '#PROPERTY_VALUE#', $values, $prop_url );
							$FilterParams .= '/';
						}
						elseif ($FilterType == 'bitrix_not_chpu')
						{
							$values = array ();
							foreach ( $CondValProps['BITRIX'][0] as $PropVal )
							{
								$FilterParams .= '&arrFilter_' . $CondValProps['PROPERTY_ID'] . '_' . strtolower( $PropVal ) . '=Y';
								$values[] = $PropVal;
							}
							// $cond_properties[$CondValProps['PROPERTY_ID']] = $values;
							$values = implode( $template_prop[1], $values );
							$prop_url = str_replace( '#PROPERTY_VALUE#', $values, $prop_url );
						} 
                        elseif ($FilterType == 'combox_not_chpu')
                        {
                            $values = array ();
                            foreach ( $CondValProps['MISSSHOP'][1] as $PropVal )
                            {
                                if($PropVal==='' && isset( $CondValProps['VALUE'] ) && ! is_null( $CondValProps['VALUE'] ))
                                    $PropVal = $CondValProps['VALUE'];    
                                $FilterParams .= '&'.strtolower($CondValProps['CODE']) . '=' . strtolower( $PropVal );
                                $values[] = $PropVal;
                            }
                            // $cond_properties[$CondValProps['PROPERTY_ID']] = $values;
                            $values = implode( $template_prop[1], $values );
                            $prop_url = str_replace( '#PROPERTY_VALUE#', $values, $prop_url );
                        }
                        elseif ($FilterType == 'combox_chpu')
                        {
                            if (isset( $CondValProps['CODE'] ) && ! is_null( $CondValProps['CODE'] ))
                            {
                                $key = $CondValProps['CODE'];
                                $FilterParams .= strtolower( $CondValProps['CODE'] ) . '-';
                            }
                            else
                            {
                                $key = $CondKey;
                                $FilterParams .= $CondKey . '-';
                            }
                            $CntCondValProps = count( $CondValProps['MISSSHOP'][1] );
                            $values = array ();
                            foreach ( $CondValProps['MISSSHOP'][1] as $PropVal )
                            {
                                if($PropVal==='' && isset( $CondValProps['VALUE'] ) && ! is_null( $CondValProps['VALUE'] ))
                                    $PropVal = $CondValProps['VALUE'];
                                    
                                if ($k == $CntCondValProps)
                                {
                                    $FilterParams .= $PropVal;
                                    $values[] = $PropVal;
                                }
                                else
                                {
                                    $FilterParams .= $PropVal . '-or-';
                                    $values[] = $PropVal;
                                }
                                ++ $k;
                            }
                            // $cond_properties[$key] = $values;
                            $values = implode( $template_prop[2], $values );
                            $prop_url = str_replace( '#PROPERTY_VALUE#', $values, $prop_url );
                            $FilterParams .= '/';
                        }
					}                    
					$props_templ[] = $prop_url;
				}
				$LOC = str_replace( '#SECTION_URL#', $SectionUrl, $MASK );
				
				$LOC = str_replace( '#FILTER_PARAMS#', $FilterParams, $LOC );
				
				$LOC = $SiteUrl . $LOC;
				
				if (substr( $LOC, 0, 4 ) != 'http')
				{
					$LOC = $SiteUrl . $LOC;
				}
				$prop_url = implode( $template_prop[1], $props_templ );
				$new_url_template = str_replace( '#PROPERTIES#', $prop_url, $new_url_template );
                $new_url_template = str_replace( '#PRICES#', $prices, $new_url_template );
				$new_url_template = str_replace( '#FILTER#', $filter, $new_url_template );
				$arFilter = array (
						'ACTIVE' => 'Y',
						'INCLUDE_SUBSECTIONS' => 'Y',
						'IBLOCK_ID' => $arCondition['INFOBLOCK'],
						'SECTION_ID' => $section['ID'] 
				);                    
				foreach ( $cond_properties as $code => $vals )
				{
					if ($code == 'PRICE')
                    {
                        foreach ( $vals as $price_code => $price )
                            if (isset( $price['FROM'] ) && $price['FROM'] !== '')
                                $arFilter['>=CATALOG_PRICE_' . $price_code] = $price['FROM'];
                        if (isset( $price['TO'] ) && $price['TO'] !== '')
                            $arFilter['<=CATALOG_PRICE_' . $price_code] = $price['TO'];
                    } elseif ($code == 'FILTER')
                    {
                        foreach ( $vals as $filter_code => $filter ){
                            if (isset( $filter['FROM'] ) && $filter['FROM'] !== ''){
                                $arFilter['>=PROPERTY_' . $filter_code . '_VALUE'] = $filter['FROM'];   
                            } elseif(isset( $filter['TO'] ) && $filter['TO'] !== ''){                                            
                                $arFilter['<=PROPERTY_' . $filter_code . '_VALUE'] = $filter['TO'];                                  
                            }   
                        }                                                          
                    } else
					{
						if (intval( $code ))
							$pr = \CIBlockProperty::GetList( array (), array (
									'ID' => $code ,
									'IBLOCK_ID' => $arCondition['INFOBLOCK'],
							) )->fetch();
						else
							$pr = \CIBlockProperty::GetList( array (), array (
									'CODE' => $code  ,
									'IBLOCK_ID' => $arCondition['INFOBLOCK'],
							) )->fetch();

						if($pr['PROPERTY_TYPE']=='S') {
							$arFilter['PROPERTY_'.$pr['ID']] = $prop_string_values[$pr['ID']]?:$vals;
						}
						elseif ($pr['PROPERTY_TYPE'] != 'L' && $pr['PROPERTY_TYPE'] != 'E')
						{
							$arFilter['PROPERTY_' . $pr['ID']] = $prop_string_values[$pr['ID']] ?: $vals;
						}
						else
							$arFilter['PROPERTY_' . $pr['ID'] . '_VALUE'] = $vals;
					}
					
				}                   
				$count = 0;
				$count = \CIBlockElement::GetList( array (), $arFilter )->SelectedRowsCount();
				
				$res1['real_url'] = $LOC;
				$res1['new_url'] = strtolower( $new_url_template );
				$res1['section_id'] = $section['ID'];
				$res1['name'] = $name;
				$res1['properties'] = $cond_properties;
				$res1['product_count'] = $count;
				$res[] = $res1;
			}
		}
		$result = array ();
		foreach ( $res as $url )
		{
			$chpu['CONDITION_ID'] = $id;
			$chpu['REAL_URL'] = $url['real_url'];
			$chpu['ACTIVE'] = 'N';
			$chpu['NAME'] = $url['name'];
			$chpu['NEW_URL'] = $url['new_url'];
			$chpu['CATEGORY_ID'] = 0;
			$chpu['DATE_CHANGE'] = new Type\DateTime( date( 'Y-m-d H:i:s' ), 'Y-m-d H:i:s' );
			$chpu['iblock_id'] = $arCondition['INFOBLOCK'];
			$chpu['section_id'] = $url['section_id'];
			$chpu['PROPERTIES'] = serialize( $url['properties'] );
			$chpu['PRODUCT_COUNT'] = $url['product_count'];
			$new_id = SeometaUrlTable::add( $chpu );
			if ($new_id->isSuccess())
			{
				$new_id = $new_id->getId();
				$result[$new_id] = $chpu;
			}
			else
			{
			}
		}
		return $result;
	}



	/**
	 * get linked conditions
	 * @param array $WorkingConditions
	 * @return array
	 */
	public static function GetConditionsFromWorkingConditions($WorkingConditions = array())
	{
		$return = array ();
		if($WorkingConditions)
		{
			$idConditions = array();
			$Conditions = ConditionTable::getList( array (
					'filter' => array (
							'ID' => $WorkingConditions
					),
					'order' => array('SORT' => 'asc'),
					'select' => array (
							'CONDITION_TAG'
					)
			) );
			while ( $Condition = $Conditions->fetch() )
			{
				if($Condition['CONDITION_TAG'])
				{
					$arCond = unserialize($Condition['CONDITION_TAG']);
					if(is_array($arCond))
					{
						$idConditions= array_merge($idConditions,$arCond);
					}
				}
			}
			if($idConditions)
			{
				$NeedSection = array();
				
				$Conditions = ConditionTable::getList( array (
						'filter' => array (
								'ID' => $idConditions
						),
						'order' => array('SORT' => 'asc'),
						'select' => array (
								'ID',
								'SITES',
								'SECTIONS',
								'RULE',
								'TAG',
								'FILTER_TYPE',
								'INFOBLOCK',
						)
				) );
				while ( $Condition = $Conditions->fetch() )
				{
					if(!$Condition['TAG'])
					{
						continue;
					}
					
					$Condition['SECTIONS'] = unserialize( $Condition['SECTIONS'] );
					$return[$Condition['ID']] = $Condition;
				}
			}
		}
		return $return;
	}
}
