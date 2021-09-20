<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 */
class CRM_Reports_Form_Member_DetailStateAbbr extends CRM_Report_Form_Member_Detail {

	/**
	 * Do AlterDisplay processing on Address Fields.
	 *  If there are multiple address field values then
	 *  on basis of provided separator the code values are translated into respective labels
	 *
	 * @param array $row
	 * @param array $rows
	 * @param int $rowNum
	 * @param string $baseUrl
	 * @param string $linkText
	 * @param string $separator
	 *
	 * @return bool
	 */
	public function alterDisplayAddressFields(&$row, &$rows, &$rowNum, $baseUrl, $linkText, $separator = ',') {
		$criteriaQueryParams = CRM_Report_Utils_Report::getPreviewCriteriaQueryParams($this->_defaults, $this->_params);
		$entryFound = FALSE;
		error_log( 'alterDisplayAddressFields::row: ' . print_r( $row, true ) );
		$columnMap = array(
			'civicrm_address_state_province_id' => 'stateProvinceAbbreviation',
			'civicrm_address_address_state_province_id' => 'stateProvinceAbbreviation',
		);
		foreach ( $columnMap as $fieldName => $fnName ) {
			if (array_key_exists($fieldName, $row)) {
				if ($values = $row[$fieldName]) {
					$values = (array) explode($separator, $values);
					$rows[$rowNum][$fieldName] = array();
					$addressField = $fnName == 'stateProvince' ? 'state' : $fnName;
					foreach ($values as $value) {
						$rows[$rowNum][$fieldName][] = CRM_Core_PseudoConstant::$fnName($value);
					}
					$rows[$rowNum][$fieldName] = implode($separator, $rows[$rowNum][$fieldName]);
					if ($baseUrl) {
						$url = CRM_Report_Utils_Report::getNextUrl($baseUrl,
							sprintf("reset=1&force=1&%s&%s_op=in&%s_value=%s",
								$criteriaQueryParams,
								str_replace('civicrm_address_', '', $fieldName),
								str_replace('civicrm_address_address_', '', $fieldName),
								implode(',', $values)
							), $this->_absoluteUrl, $this->_id
						);
						$rows[$rowNum]["{$fieldName}_link"] = $url;
						$rows[$rowNum]["{$fieldName}_hover"] = ts("%1 for this %2.", [1 => $linkText, 2 => $addressField]);
					}
				}
				$entryFound = TRUE;
			}
		}

		return $entryFound;
	}

	/**
	 * Get address columns to add to array.
	 *
	 * @param array $options
	 *  - prefix Prefix to add to table (in case of more than one instance of the table)
	 *  - prefix_label Label to give columns from this address table instance
	 *  - group_bys enable these fields for group by - default false
	 *  - order_bys enable these fields for order by
	 *  - filters enable these fields for filtering
	 *
	 * @return array address columns definition
	 */
	protected function getAddressColumns($options = array()) {
		$columns = parent::getAddressColumns( $options );
		unset( $columns['civicrm_address']['filters']['state_province_id']['alter_display'] );
		unset( $columns['civicrm_address']['metadata']['state_province_id']['alter_display'] );
		unset( $columns['civicrm_address']['fields']['state_province_id']['alter_display'] );

		unset( $columns['civicrm_address']['filters']['address_state_province_id']['alter_display'] );
		unset( $columns['civicrm_address']['metadata']['address_state_province_id']['alter_display'] );
		unset( $columns['civicrm_address']['fields']['address_state_province_id']['alter_display'] );
		return $columns;
	}
}