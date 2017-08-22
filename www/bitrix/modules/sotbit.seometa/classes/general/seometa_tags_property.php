<?
class CSeoMetaTagsProperty extends CSeoMetaTags
{
	public function calculate($parameters)
	{
		$return = array();
		$Property = $parameters;
		$codes = array();
		
		if( is_array( $Property ) )
		{
			foreach( parent::$FilterResult['ITEMS'] as $key => $elements )
			{
				foreach( $Property as $prop )
				{
					if( $prop == $elements['CODE'] && !isset( $codes[$elements['CODE']] ) )
					{
						$codes[$elements['CODE']] = "Y";
						foreach( $elements['VALUES'] as $key_element => $element )
						{
							if( $element['CHECKED'] == 1 )
							{
								if($elements['PROPERTY_TYPE'] == 'S' && $elements['USER_TYPE'] == 'directory' && $element['VALUE']) //hak for HL because isset LIST_TYPE = ID
								{
									$return[] = $element['VALUE'];
								}
								else 
								{
									if( isset( $element['LIST_VALUE'] ) )
									{
										$return[] = $element['LIST_VALUE'];
									}
									else
									{
										$return[] = $element['VALUE'];
									}
								}
							}
						}
					}
				}
			}
		}
		else
		{
			foreach( parent::$FilterResult['ITEMS'] as $key => $elements )
			{
				if( $Property == $elements['CODE'] && !isset( $codes[$elements['CODE']] ) )
				{
					$codes[$elements['CODE']] = "Y";
					foreach( $elements['VALUES'] as $key_element => $element )
					{
						if( $element['CHECKED'] == 1 )
						{
							if( isset( $element['LIST_VALUE'] ) )
							{
								$return[] = $element['LIST_VALUE'];
							}
							else
							{
								$return[] = $element['VALUE'];
							}
						}
					}
				}
			}
		}
		return $return;
	}
}
?>