<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true)
	die ();
use Bitrix\Main\Loader;
use Bitrix\Main\Server;
use Sotbit\Seometa\SeometaUrlTable;
use Sotbit\Seometa\SeometaStatisticsTable;

class CSeoMetaEvents
{
	protected static $lAdmin;
	private static $i = 1;
	function OnInit()
	{
		return array (
				"TABSET" => "seometa",
				"GetTabs" => array (
						"CSeoMetaEvents",
						"GetTabs" 
				),
				"ShowTab" => array (
						"CSeoMetaEvents",
						"ShowTab" 
				),
				"Action" => array (
						"CSeoMetaEvents",
						"Action" 
				),
				"Check" => array (
						"CSeoMetaEvents",
						"Check" 
				) 
		);
	}
	function Action($arArgs)
	{
		return true;
	}
	function Check($arArgs)
	{
		return true;
	}
	function GetTabs($arArgs)
	{
		$arTabs = array (
				array (
						"DIV" => "url-mode",
						"TAB" => GetMessage ( 'seometa_title' ),
						"ICON" => "sale",
						"TITLE" => GetMessage ( 'seometa_list' ),
						"SORT" => 5 
				) 
		);
		return $arTabs;
	}
	function ShowTab($divName, $arArgs, $bVarsFromForm)
	{
		if ($divName == "url-mode")
		{
			define ( 'B_ADMIN_SUBCONDITIONS', 1 );
			define ( 'B_ADMIN_SUBCONDITIONS_LIST', false );
			?><tr id="tr_COUPONS">
	<td colspan="2"><?
			require ($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/sotbit.seometa/admin/templates/sub_list.php');
			?></td>
</tr><?
		}
	}
	
	function PageStart()
	{	
		global $APPLICATION, $PAGEN_1;
		$context = Bitrix\Main\Context::getCurrent ();
		
		if($context->getRequest()->isAjaxRequest() && \Bitrix\Main\Config\Option::get("sotbit.seometa",'RETURN_AJAX_'.SITE_ID)=='Y') 
			return;
		
		$server = $context->getServer ();
		$server_array = $server->toArray ();								  
		$url_parts  = explode("?", $context->getRequest()->getRequestUri ());	   
		$str = \Bitrix\Main\Config\Option::get("sotbit.seometa",'PAGENAV_'.SITE_ID);				 
		if($str!=''){		
			$preg = str_replace('/','\/',$str); 
			$preg = '/'.str_replace('%N%','\d',$preg).'/';   
			preg_match($preg,$url_parts[0],$matches);	  
			if($matches) {
				$exploted_pagen = explode('%N%',$str);
				$n = str_replace($exploted_pagen[0],'',$matches[0]);
				$n = str_replace($exploted_pagen[1],'',$n);	  
				$_REQUEST['PAGEN_1'] = (int)$n;
				$url_parts[0] = str_replace($matches[0],'',$url_parts[0]);
			}										  
			if(isset($_REQUEST['PAGEN_1'])){	  
				$n = $_REQUEST['PAGEN_1'];												 
				$pagen = str_replace('%N%',$n,$str);
				$r = explode('&',$url_parts[1]);   
				unset($_REQUEST['PAGEN_1']); 
				$url_parts[1] = '';			 
				$r=array();
				  
				unset($_GET['PAGEN_1']); 
				foreach($_GET as $i=>$p){
					$r[] = $i.'='.$p;
				}						  
				$url_parts[1] = implode('&',$r);	  
				$PAGEN_1 = $n;							  
			}   
		}	  
		if (! ($instance = Sotbit\Seometa\SeometaUrlTable::getByNewUrl ( $url_parts[0] ))&& !($instance = Sotbit\Seometa\SeometaUrlTable::getByNewUrl ($context->getRequest()->getRequestUri ())))
		{							  
			$instance = Sotbit\Seometa\SeometaUrlTable::getByRealUrl ( $url_parts[0] );  
			if(!$instance) $instance = Sotbit\Seometa\SeometaUrlTable::getByRealUrl ( $context->getRequest()->getRequestUri () );						
			if ($instance && CSeoMetaEvents::$i)
			{																		  
				CSeoMetaEvents::$i = 0;			   
				if(isset($pagen)){
					$instance['NEW_URL'] = '/'.trim($instance['NEW_URL'],'/') .$pagen; 
					$url_parts[1]='';																   
				}
				LocalRedirect ( $instance['NEW_URL'].($url_parts[1]!=''?"?".$url_parts[1]:''), false, '301 Moved Permanently' );
			}
		} 
						
		if ($instance && ($instance['NEW_URL'] != $instance['REAL_URL'])){   
				
			$url_parts  = explode("?", $instance['REAL_URL']);  
			$url_parts = explode("&", $url_parts[1]);	 
			$get = array();
			foreach($url_parts as $item){
				$items = explode('=',$item);		
				$_GET[$items[0]] = $items[1];  
			}   
																			  
			if(!isset($pagen)){															   
				$_SERVER['REQUEST_URI'] = $instance['REAL_URL'];
				$server_array['REQUEST_URI'] = $_SERVER['REQUEST_URI'];	 
				$server->set( $server_array );	
																 
				$context->initialize ( new Bitrix\Main\HttpRequest( $server, $_GET, array(), array(), $_COOKIE), $context->getResponse(), $server ); 
				$APPLICATION->reinitPath();			   
				CSeoMetaEvents::$i = 0;																													   
			} else { 
				$url_parts[0] .= $pagen;																
				$_SERVER['REQUEST_URI'] = $instance['REAL_URL'];
				$server_array['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
				$server->set( $server_array );		   
				$context->initialize ( new Bitrix\Main\HttpRequest( $server, $_GET, array(), array(), $_COOKIE), $context->getResponse(), $server ); 
				$APPLICATION->reinitPath();					   
				$APPLICATION->SetCurPage($url_parts[0]);			
				CSeoMetaEvents::$i = 0;  
			}  
		}  
	}
	
	/* 
	* It is necessary to include processing of outdated events in settings of an e-commerce shop
	*/
	function OrderAdd($ID, $arFields){   
		global $APPLICATION;											
		$cookie = $APPLICATION->get_cookie("sotbit_seometa_statistic");											
		echo $cookie; 
		if(!empty($cookie) && $cookie==bitrix_sessid()&&SeometaStatisticsTable::getBySessId($cookie)){  
			$stat = SeometaStatisticsTable::getBySessId($cookie); 
			$stat['ORDER_ID'] = intval($ID);
			SeometaStatisticsTable::update($stat['ID'],$stat);
		}
	}

	public function OnReindexHandler($NS, $oCallback, $callback_method)
	{
		$rsData = \Sotbit\Seometa\ConditionTable::getList(array('filter' => array('ACTIVE' => 'Y','SEARCH' => 'Y')));
		while($condition = $rsData->fetch())
		{
			$meta = unserialize($condition['META']);
			if(!$meta['ELEMENT_TITLE'])
			{
				continue;
			}
			if ($condition['FILTER_TYPE'] == 'bitrix_chpu')
			{
				$MASK = "#SECTION_URL#filter/#FILTER_PARAMS#apply/";
			}
			elseif ($condition['FILTER_TYPE'] == 'bitrix_not_chpu')
			{
				$MASK = "#SECTION_URL#?set_filter=y#FILTER_PARAMS#";
			}
			elseif ($condition['FILTER_TYPE'] == 'misshop_chpu')
			{
				$MASK = "#SECTION_URL#filter/#FILTER_PARAMS#apply/";
			}
			elseif ($condition['FILTER_TYPE']== 'combox_chpu')
			{
				$MASK = "#SECTION_URL#filter/#FILTER_PARAMS#";
			}
			elseif ($condition['FILTER_TYPE']== 'combox_not_chpu')
			{
				$MASK = "#SECTION_URL#?#FILTER_PARAMS#";
			}
			$OffersInfoblocks = array ();
			
			$condition['SECTIONS'] = unserialize($condition['SECTIONS']);
			
			if (!is_array($condition['SECTIONS']) || !$condition['SECTIONS'])
			{
				$result = \Bitrix\Iblock\SectionTable::getList( array (
						'select' => array (
								'ID'
						),
						'filter' => array (
								'IBLOCK_ID' => $condition['INFOBLOCK']
						)
				) );
				while ( $Section = $result->fetch() )
				{
					$condition['SECTIONS'][] = $Section['ID'];
				}
			}
			
			if ($MASK && $condition['SECTIONS'])
			{
				$Rule = unserialize( $condition['RULE'] );
				
				\CSeoMetaSitemap::$isGenerateChpu = true;
				
				$Pages = \CSeoMetaSitemap::ParseArray( $Rule, $condition['SECTIONS'] );
				
				\CSeoMetaSitemap::SetListOfProps( $condition['FILTER_TYPE'] );
				
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
				
				
				foreach ( $condition['SECTIONS'] as $Section )
				{
					$SectionUrl = "";
					$nav = \CIBlockSection::GetNavChain( $condition['INFOBLOCK'], $Section );
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
										"IBLOCK_ID" => $condition['INFOBLOCK'],
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
								if ($condition['FILTER_TYPE'] == 'misshop_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'bitrix_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'bitrix_not_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'combox_chpu')
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
								if ($condition['FILTER_TYPE'] == 'misshop_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'bitrix_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'bitrix_not_chpu')
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
							}
							else
							{
								$k = 1;
								if ($condition['FILTER_TYPE'] == 'misshop_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'bitrix_chpu')
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
								elseif ($condition['FILTER_TYPE'] == 'bitrix_not_chpu')
								{
									$values = array ();
									foreach ( $CondValProps['BITRIX'][0] as $PropVal )
									{
										$FilterParams .= '&arrFilter_' . $CondValProps['PROPERTY_ID'] . '_' . strtolower( $PropVal ) . '=Y';
										$values[] = $PropVal;
									}
									$cond_properties[$CondValProps['PROPERTY_ID']] = $values;
								}
								elseif ($condition['FILTER_TYPE'] == 'combox_not_chpu')
								{
									$values = array ();
									foreach ( $CondValProps['MISSSHOP'][1] as $PropVal )
									{
										if($PropVal==='' && isset( $CondValProps['VALUE'] ) && ! is_null( $CondValProps['VALUE'] ))
											$PropVal = $CondValProps['VALUE'];
											$FilterParams .= '&'.strtolower($CondValProps['CODE']) . '=' . strtolower( $PropVal );
											$values[] = $PropVal;
									}
									$values = implode( $template_prop[1], $values );
									$prop_url = str_replace( '#PROPERTY_VALUE#', $values, $prop_url );
								}
								elseif ($condition['FILTER_TYPE'] == 'combox_chpu')
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
						
						
						$Title = \Bitrix\Iblock\Template\Engine::process( $sku, $meta['ELEMENT_TITLE']);
						
						$body = trim($meta['ELEMENT_TOP_DESC'].' '.$meta['ELEMENT_BOTTOM_DESC'].' '.$meta['ELEMENT_ADD_DESC']);
						
						$sites = unserialize($condition['SITES']);
						if(is_array($sites))
						{
							$Result = array (
									"ID" => 'seometa_' . $condition["ID"],
									"DATE_CHANGE" => $condition["DATE_CHANGE"],
									"PERMISSIONS" => array (
											2
									),
									"BODY" =>  $body,
									'TITLE' => trim($Title),
									'SITE_ID' => $sites,
									'URL' => trim( $LOC ),
									'PARAM1' => $condition['TYPE_OF_INFOBLOCK'],
									'PARAM2' => $condition['INFOBLOCK']
							);
							$index_res = call_user_func( array (
									$oCallback,
									$callback_method
							), $Result );
							if (! $index_res)
								return $Result["ID"];
						}
						
						unset( $arFilter );
					}
				}
			}
		}
		return false;
	}
	public function OnAfterIndexAddHandler($ID, $arFields)
	{
		if($arFields['MODULE_ID'] == 'sotbit.seometa')
		{
			$connection = \Bitrix\Main\Application::getConnection() ;
			$connection->query('UPDATE `b_search_content` SET `MODULE_ID` = "iblock" WHERE `MODULE_ID` = "sotbit.seometa"');
		}
	}
}