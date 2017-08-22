<?

namespace Sotbit\Seometa;

class Tags
{
	public function GenerateTags($Conditions = array(), $WorkingConditions = array())
	{
		$return = array ();
		foreach ( $Conditions as  $Condition )
		{
			if ($Condition['FILTER_TYPE'] == 'bitrix_chpu')
			{
				$MASK = "#SECTION_URL#filter/#FILTER_PARAMS#apply/";
			}
			elseif ($Condition['FILTER_TYPE'] == 'bitrix_not_chpu')
			{
				$MASK = "#SECTION_URL#?set_filter=y#FILTER_PARAMS#";
			}
			elseif ($Condition['FILTER_TYPE'] == 'misshop_chpu')
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
			$OffersInfoblocks = array ();
			
			if (! $Condition['SECTIONS'])
			{
				$result = \Bitrix\Iblock\SectionTable::getList( array (
						'select' => array (
								'ID' 
						),
						'filter' => array (
								'IBLOCK_ID' => $Condition['INFOBLOCK'] 
						) 
				) );
				while ( $Section = $result->fetch() )
				{
					$Condition['SECTIONS'][] = $Section['ID'];
				}
			}
			
			if ($MASK && $Condition['SECTIONS'])
			{
				$Rule = unserialize( $Condition['RULE'] );
				
				\CSeoMetaSitemap::$isGenerateChpu = true;								   
				
				$Pages = \CSeoMetaSitemap::ParseArray( $Rule, $Condition['SECTIONS'] );
				
				\CSeoMetaSitemap::SetListOfProps( $Condition['FILTER_TYPE'] );
				
				$NeedContinue = false;

				if (isset( $Rule['CHILDREN']['DATA']['value'] ) && empty( $Rule['CHILDREN']['DATA']['value'] ) && ($property['PROPERTY_TYPE'] == 'E' || $property['PROPERTY_TYPE'] == 'L') || (isset( $Rule['CHILDREN'][0]['DATA']['value'] ) && empty( $Rule['CHILDREN'][0]['DATA']['value'] ) && ($property['PROPERTY_TYPE'] == 'E' || $property['PROPERTY_TYPE'] == 'L')))
				{
					$NeedContinue = true;
				}
				if ($NeedContinue)
				{
					continue;
				}					  
				$Pages = \CSeoMetaSitemap::SortPagesCodes( $Pages );
				
				foreach ( $Condition['SECTIONS'] as $Section )
				{
					$SectionUrl = "";
					$nav = \CIBlockSection::GetNavChain( $Condition['INFOBLOCK'], $Section );
					while ( $arSectionPath = $nav->GetNext() )
					{
						$SectionUrl = $arSectionPath['SECTION_PAGE_URL'];
					}
					
					foreach ( $Pages as $Page )
					{
						$name = $sectname;
						foreach ( $Page as $CondKey => $CondValProps )
						{
							
							if (isset( $CondValProps['CODE'] ) && ! is_null( $CondValProps['CODE'] ))
							{
								$prop = \CIBlockProperty::GetList( array (
										"SORT" => "ASC",
										'ID' => 'ASC' 
								), array (
										"IBLOCK_ID" => $Condition['INFOBLOCK'],
										"CODE" => $CondValProps['CODE'],
										"ACTIVE" => "Y" 
								) )->fetch();
								if (isset( $CondValProps['VALUE'] ) && ! is_null( $CondValProps['VALUE'] ))
								{										  
									$prop_string_values[$prop['ID']][] = $CondValProps['VALUE'];
								}
								$CondValProps['PROPERTY_ID'] = $prop['ID'];
							}
							$prop_url = '';
							if ($CondKey == "PRICES")	   
							{
								$prices = '';
								if ($Condition['FILTER_TYPE'] == 'misshop_chpu')
								{
									foreach ( $CondValProps as $PriceCode => $PriceProps )
									{
										$ValMin = "";
										$ValMax = "";
										foreach ( $PriceProps['TYPE'] as $j => $Type )
										{
											if ($Type == 'MIN')
											{
												$ValMin = "-from-" . $PriceProps['VALUE'][$j];
											}
											if ($Type == 'MAX')
											{
												$ValMax = "-to-" . $PriceProps['VALUE'][$j];
											}
										}
										$cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
										$cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
										$FilterParams .= "price" . $PriceProps['ID'][0] . $ValMin . $ValMax .= "/";
									}
								}
								elseif ($Condition['FILTER_TYPE'] == 'bitrix_chpu')
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
										$FilterParams .= "price-" . strtolower( $PriceCode ) . $ValMin . $ValMax .= "/";
										$cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
										$cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
									}
								}
								elseif ($Condition['FILTER_TYPE'] == 'bitrix_not_chpu')
								{
									foreach ( $CondValProps as $PriceCode => $PriceProps )
									{
										$ValMin = "";
										$ValMax = "";
										foreach ( $PriceProps['TYPE'] as $j => $Type )
										{
											if ($Type == 'MIN')
											{
												$ValMin = "_MIN=" . $PriceProps['VALUE'][$j];
											}
											if ($Type == 'MAX')
											{
												$ValMax = "_MAX=" . $PriceProps['VALUE'][$j];
											}
										}
										if (isset( $ValMin ) && $ValMin != "")
										{
											$FilterParams .= "&arrFilter_P" . $PriceProps['ID'][0] . $ValMin;
										}
										if (isset( $ValMax ) && $ValMax != "")
										{
											$FilterParams .= "&arrFilter_P" . $PriceProps['ID'][0] . $ValMax;
										}
										$cond_properties['PRICE'][$PriceCode]['FROM'] = $ValMin;
										$cond_properties['PRICE'][$PriceCode]['TO'] = $ValMax;
									}
								}
								elseif ($Condition['FILTER_TYPE'] == 'combox_chpu')
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
							}
							elseif($CondKey == "FILTER")
							{   
								$filter = '';
								if ($Condition['FILTER_TYPE'] == 'misshop_chpu')
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
								elseif ($Condition['FILTER_TYPE'] == 'bitrix_chpu')
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
								elseif ($Condition['FILTER_TYPE'] == 'bitrix_not_chpu')
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
							} else 
							{
								$k = 1;
								if ($Condition['FILTER_TYPE'] == 'misshop_chpu')
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
									sort( $CondValProps['MISSSHOP'][1] );
									foreach ( $CondValProps['MISSSHOP'][1] as $PropVal )
									{
										if (is_array( $PropVal ))
										{
											foreach ( $PropVal as $PV )
											{
												$values[] = $PV;
											}
										}
										else
										{
											$values[] = $PropVal;
										}
										if ($k == $CntCondValProps)
										{
											$FilterParams .= $PropVal;
										}
										else
										{
											$FilterParams .= $PropVal . '-or-';
										}
										++ $k;
									}
									
									$cond_properties[$key] = $values;
									$FilterParams .= '/';
								}
								elseif ($Condition['FILTER_TYPE'] == 'bitrix_chpu')
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
									$CntCondValProps = count( $CondValProps['BITRIX'][1] );
									$values = array ();
									foreach ( $CondValProps['BITRIX'][1] as $PropVal )
									{
										if ($k == $CntCondValProps)
										{
											$FilterParams .= strtolower( $PropVal );
											$values[] = $PropVal;
										}
										else
										{
											$FilterParams .= $PropVal . '-or-';
											$values[] = $PropVal;
										}
										++ $k;
									}
									$cond_properties[$key] = $values;
									$FilterParams .= '/';
								}
								elseif ($Condition['FILTER_TYPE'] == 'bitrix_not_chpu')
								{
									$values = array ();
									foreach ( $CondValProps['BITRIX'][0] as $PropVal )
									{
										$FilterParams .= '&arrFilter_' . $CondValProps['PROPERTY_ID'] . '_' . strtolower( $PropVal ) . '=Y';
										$values[] = $PropVal;
									}
									$cond_properties[$CondValProps['PROPERTY_ID']] = $values;
								}
								elseif ($Condition['FILTER_TYPE'] == 'combox_not_chpu')
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
								elseif ($Condition['FILTER_TYPE'] == 'combox_chpu')
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
							
						}
						
						$LOC = str_replace( '#SECTION_URL#', $SectionUrl, $MASK );
						
						$LOC = str_replace( '#FILTER_PARAMS#', $FilterParams, $LOC );
						
						unset( $FilterParams );
						$LOC = $SiteUrl . $LOC;
						
						if (substr( $LOC, 0, 4 ) != 'http')
						{
							$LOC = $SiteUrl . $LOC;
						}
						
						$filter = array (
								'ITEMS' => array () 
						);
						unset( $cond_properties );						   
						\CSeoMeta::SetFilterResult( $filter, $Section );  
						$sku = new \Bitrix\Iblock\Template\Entity\Section( $Section );

						
						
						if(in_array($Condition['ID'], $WorkingConditions) && $Condition['CONDITION_TAG'])
						{
							$Title = \Bitrix\Iblock\Template\Engine::process( $sku, $Condition['CONDITION_TAG'] );
						}
						else 
						{
							$Title = \Bitrix\Iblock\Template\Engine::process( $sku, $Condition['TAG'] );
						}

						$return[] = array (
								'URL' => trim( $LOC ),
								'TITLE' => trim( $Title ) 
						);
						
						unset( $arFilter );
					}
				}
			}
		}
		return $return;
	}
	/**
	 * sort tags with need sort
	 * 
	 * @param array $Tags			
	 * @param string $Sort			
	 * @param string $Order			
	 * @return array
	 */
	public function SortTags($Tags = array(), $Sort = 'NAME', $Order = 'asc')
	{
		$return = array ();
		if ($Sort == 'NAME')
		{
			$tmpTags = array ();
			foreach ( $Tags as $i => $Tag )
			{
				$tmpTags[$i] = $Tag['TITLE'];
			}
			if($Order == 'asc')
			{
				asort( $tmpTags );
			}
			else
			{
				arsort( $tmpTags );
			}
			foreach ( $tmpTags as $i => $Name )
			{
				$return[] = $Tags[$i];
			}
		}
		elseif($Sort == 'RANDOM')
		{
			shuffle($Tags);
			$return = $Tags;
		}
		elseif($Sort == 'CONDITIONS')
		{
			if($Order == 'asc')
			{
				$return = $Tags;
			}
			else 
			{
				$return = array_reverse($Tags);
			}
		}
		unset($Order);
		unset($Sort);
		unset($tmpTags);
		unset($i);
		unset($Name);
		return $return;
	}
	/**
	 * replace real url with chpu in tags
	 * @param array $Tags
	 * @return array
	 */
	public function ReplaceChpuUrls($Tags = array())
	{
		$return = array ();
		$urls = array ();
		foreach ( $Tags as $i => $Tag )
		{
			if ($Tag['URL'])
			{
				$urls[$i] = $Tag['URL'];
			}
		}
		$rsUrsl = \Sotbit\Seometa\SeometaUrlTable::getList( array (
				'filter' => array (
						'REAL_URL' => $urls,
						'ACTIVE' => 'Y',
						'!NEW_URL' => false
				),
				'select' => array('NEW_URL','REAL_URL')
		) );
		while ( $arUrl = $rsUrsl->fetch() )
		{
			$key = array_search($arUrl['REAL_URL'],$urls);
			if($Tags[$key]['URL'] && $Tags[$key]['URL'] == $arUrl['REAL_URL'])
			{
				$Tags[$key]['URL'] = $arUrl['NEW_URL'];
			}
		}
		if($Tags)
		{
			$return = $Tags;
		}
		unset($Tags);
		unset($Tag);
		unset($key);
		unset($arUrl);
		unset($urls);
		unset($i);
		return $return;
	}
	/**
	 * set cnt tags to need
	 * @param array $Tags
	 * @param string $Cnt
	 * @return array
	 */
	public function CutTags($Tags = array(), $Cnt = '')
	{
		$return = array();
		if($Cnt && sizeof($Tags) > $Cnt)
		{
			$return = array_slice($Tags, 0, $Cnt);
		}
		else
		{
			$return = $Tags;
		}
		unset($Tags);
		unset($Cnt);
		return $return;
	}
	public static function findNeedSections($Sections = array(), $IncludeSubsections = 'Y')
	{
		if (! is_array( $Sections ))
		{
			$Sections = array (
					$Sections
			);
		}
		if ($IncludeSubsections == 'Y' || $IncludeSubsections == 'A')
		{
			$rsSections = \Bitrix\Iblock\SectionTable::getList( array (
					'select' => array (
							'LEFT_MARGIN',
							'RIGHT_MARGIN',
							'IBLOCK_ID',
							'DEPTH_LEVEL'
					),
					'filter' => array (
							'ID' => $Sections
					)
			) );
			while ( $arParentSection = $rsSections->fetch() )
			{
				$arFilter = array (
						'IBLOCK_ID' => $arParentSection['IBLOCK_ID'],
						'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
						'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
						'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
				);
				if($IncludeSubsections == 'A')
				{
					$arFilter['GLOBAL_ACTIVE'] = 'Y';
				}
				$rsChildSections = \Bitrix\Iblock\SectionTable::getList( array (
						'select' => array (
								'ID',
						),
						'filter' => $arFilter
				) );
				while ( $arChildSection = $rsChildSections->fetch() )
				{
					$Sections[] = $arChildSection['ID'];
				}
			}
		}
		$Sections = array_unique($Sections);
		return $Sections;
	}
}
?>