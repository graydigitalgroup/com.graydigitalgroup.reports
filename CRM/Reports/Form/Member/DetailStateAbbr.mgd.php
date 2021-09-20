<?php
// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
return array(
	array(
		'name'   => 'CRM_Reports_Form_Member_DetailStateAbbr',
		'entity' => 'ReportTemplate',
		'params' => array(
			'version'     => 3,
			'label'       => 'Member Detail (State Abbr)',
			'description' => 'Membership detailed reporting with the State/Providence abbreviated.',
			'class_name'  => 'CRM_Reports_Form_Member_DetailStateAbbr',
			'report_url'  => 'com.graydigitalgroup.reports/detailstateabbr',
			'component'   => 'CiviMember',
		),
	),
);
