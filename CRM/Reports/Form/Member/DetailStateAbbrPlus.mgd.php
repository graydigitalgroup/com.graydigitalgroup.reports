<?php
// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed


if ( class_exists('CRM_Reportplus_Form_Member_Detail') ) {
	return array(
		array(
			'name'   => 'CRM_Reports_Form_Member_DetailStateAbbrPlus',
			'entity' => 'ReportTemplate',
			'params' => array(
				'version'     => 3,
				'label'       => 'Member Detail Plus (State Abbr)',
				'description' => 'Membership detailed reporting with the State/Providence abbreviated. Extends ReportPlus to allow for custom ordering of columns.',
				'class_name'  => 'CRM_Reports_Form_Member_DetailStateAbbrPlus',
				'report_url' => 'com.graydigitalgroup.reports/detailstateabbrplus',
				'component'   => 'CiviMember',
			),
		),
	);
} else {
	return array();
}
