<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/applicants_and_tenants.php');
	include_once(__DIR__ . '/applicants_and_tenants_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('applicants_and_tenants');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'applicants_and_tenants';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`applicants_and_tenants`.`id`" => "id",
		"`applicants_and_tenants`.`last_name`" => "last_name",
		"`applicants_and_tenants`.`first_name`" => "first_name",
		"`applicants_and_tenants`.`email`" => "email",
		"CONCAT_WS('-', LEFT(`applicants_and_tenants`.`phone`,3), MID(`applicants_and_tenants`.`phone`,4,3), RIGHT(`applicants_and_tenants`.`phone`,4))" => "phone",
		"if(`applicants_and_tenants`.`birth_date`,date_format(`applicants_and_tenants`.`birth_date`,'%m/%d/%Y'),'')" => "birth_date",
		"`applicants_and_tenants`.`driver_license_number`" => "driver_license_number",
		"`applicants_and_tenants`.`driver_license_state`" => "driver_license_state",
		"`applicants_and_tenants`.`requested_lease_term`" => "requested_lease_term",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`monthly_gross_pay`, 2))" => "monthly_gross_pay",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`additional_income`, 2))" => "additional_income",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`assets`, 2))" => "assets",
		"`applicants_and_tenants`.`status`" => "status",
		"`applicants_and_tenants`.`notes`" => "notes",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`applicants_and_tenants`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => '`applicants_and_tenants`.`birth_date`',
		7 => 7,
		8 => 8,
		9 => 9,
		10 => '`applicants_and_tenants`.`monthly_gross_pay`',
		11 => '`applicants_and_tenants`.`additional_income`',
		12 => '`applicants_and_tenants`.`assets`',
		13 => 13,
		14 => 14,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`applicants_and_tenants`.`id`" => "id",
		"`applicants_and_tenants`.`last_name`" => "last_name",
		"`applicants_and_tenants`.`first_name`" => "first_name",
		"`applicants_and_tenants`.`email`" => "email",
		"CONCAT_WS('-', LEFT(`applicants_and_tenants`.`phone`,3), MID(`applicants_and_tenants`.`phone`,4,3), RIGHT(`applicants_and_tenants`.`phone`,4))" => "phone",
		"if(`applicants_and_tenants`.`birth_date`,date_format(`applicants_and_tenants`.`birth_date`,'%m/%d/%Y'),'')" => "birth_date",
		"`applicants_and_tenants`.`driver_license_number`" => "driver_license_number",
		"`applicants_and_tenants`.`driver_license_state`" => "driver_license_state",
		"`applicants_and_tenants`.`requested_lease_term`" => "requested_lease_term",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`monthly_gross_pay`, 2))" => "monthly_gross_pay",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`additional_income`, 2))" => "additional_income",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`assets`, 2))" => "assets",
		"`applicants_and_tenants`.`status`" => "status",
		"`applicants_and_tenants`.`notes`" => "notes",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`applicants_and_tenants`.`id`" => "ID",
		"`applicants_and_tenants`.`last_name`" => "Last name",
		"`applicants_and_tenants`.`first_name`" => "First name",
		"`applicants_and_tenants`.`email`" => "Email",
		"`applicants_and_tenants`.`phone`" => "Phone",
		"`applicants_and_tenants`.`birth_date`" => "Birth date",
		"`applicants_and_tenants`.`driver_license_number`" => "Driver license number",
		"`applicants_and_tenants`.`driver_license_state`" => "Driver license state",
		"`applicants_and_tenants`.`requested_lease_term`" => "Requested lease term",
		"`applicants_and_tenants`.`monthly_gross_pay`" => "Monthly gross pay",
		"`applicants_and_tenants`.`additional_income`" => "Additional income",
		"`applicants_and_tenants`.`assets`" => "Assets",
		"`applicants_and_tenants`.`status`" => "Status",
		"`applicants_and_tenants`.`notes`" => "Notes",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`applicants_and_tenants`.`id`" => "id",
		"`applicants_and_tenants`.`last_name`" => "last_name",
		"`applicants_and_tenants`.`first_name`" => "first_name",
		"`applicants_and_tenants`.`email`" => "email",
		"CONCAT_WS('-', LEFT(`applicants_and_tenants`.`phone`,3), MID(`applicants_and_tenants`.`phone`,4,3), RIGHT(`applicants_and_tenants`.`phone`,4))" => "phone",
		"if(`applicants_and_tenants`.`birth_date`,date_format(`applicants_and_tenants`.`birth_date`,'%m/%d/%Y'),'')" => "birth_date",
		"`applicants_and_tenants`.`driver_license_number`" => "driver_license_number",
		"`applicants_and_tenants`.`driver_license_state`" => "driver_license_state",
		"`applicants_and_tenants`.`requested_lease_term`" => "requested_lease_term",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`monthly_gross_pay`, 2))" => "monthly_gross_pay",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`additional_income`, 2))" => "additional_income",
		"CONCAT('$', FORMAT(`applicants_and_tenants`.`assets`, 2))" => "assets",
		"`applicants_and_tenants`.`status`" => "status",
		"`applicants_and_tenants`.`notes`" => "notes",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`applicants_and_tenants` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->AllowAdminShowSQL = 0;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'applicants_and_tenants_view.php';
	$x->RedirectAfterInsert = 'applicants_and_tenants_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Applicants and tenants';
	$x->TableIcon = 'resources/table_icons/account_balances.png';
	$x->PrimaryKey = '`applicants_and_tenants`.`id`';
	$x->DefaultSortField = '2';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [100, 100, 100, 100, 100, 100, 80, 80, 80, 100, 100, 100, 100, 100, 100, ];
	$x->ColCaption = ['Last name', 'First name', 'Email', 'Phone', 'Birth date', 'Driver license number', 'Monthly gross pay', 'Additional income', 'Assets', 'Status', 'Notes', 'Applications/Leases', 'Residence and rental history', 'Employment and income history', 'References', ];
	$x->ColFieldName = ['last_name', 'first_name', 'email', 'phone', 'birth_date', 'driver_license_number', 'monthly_gross_pay', 'additional_income', 'assets', 'status', 'notes', '%applications_leases.tenants%', '%residence_and_rental_history.tenant%', '%employment_and_income_history.tenant%', '%references.tenant%', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 10, 11, 12, 13, 14, -1, -1, -1, -1, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/applicants_and_tenants_templateTV.html';
	$x->SelectedTemplate = 'templates/applicants_and_tenants_templateTVS.html';
	$x->TemplateDV = 'templates/applicants_and_tenants_templateDV.html';
	$x->TemplateDVP = 'templates/applicants_and_tenants_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: applicants_and_tenants_init
	$render = true;
	if(function_exists('applicants_and_tenants_init')) {
		$args = [];
		$render = applicants_and_tenants_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: applicants_and_tenants_header
	$headerCode = '';
	if(function_exists('applicants_and_tenants_header')) {
		$args = [];
		$headerCode = applicants_and_tenants_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: applicants_and_tenants_footer
	$footerCode = '';
	if(function_exists('applicants_and_tenants_footer')) {
		$args = [];
		$footerCode = applicants_and_tenants_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
