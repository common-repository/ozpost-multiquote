<?php

return array(
	'enabled' => array(
		'title' => __('Enable/Disable', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => __('Enable this shipping method', 'woocommerce-ozpost'),
		'default' => 'no',
	),
	
	'int_disabled' => array(
		'title' => __('Disable for Overseas', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => __('', 'woocommerce-ozpost'),
		'default' => 'no',
	),
	'origin_postcode' => array(
		'title' => __('Shipping From Postcode<br>(Always required)', 'woocommerce-ozpost'),
		'type' => 'text',
		'css' => 'width: 55px;',
		'default' => '0000',
	),
	
	'origin_suburb' => array(
		'title' => __('Shipping From Suburb', 'woocommerce-ozpost'),
		'type' => 'text',
		'css' => 'width: 200px;',
		'default' => '',
		'placeholder' => __('Based on the "From Postcode"', 'woocommerce-ozpost'),
	),
	
	'store_postcode' => array(
		'title' => __('Store PostCode<br>(Always required)', 'woocommerce-ozpost'),
		'type' => 'text',
		'css' => 'width: 55px;',
		'default' => '',
	),
	
	'subscriptions_email' => array(
		'title' => __('Subscription notifications to ', 'woocommerce-ozpost'),
		'type' => 'text',
		'css' => 'width: 350px;',
		'default' => get_option('admin_email'),
		'placeholder' => __(get_option('admin_email'), 'woocommerce-ozpost'),
	),
	
	'letter_methods' => array(
		'title' => __('Letters & parcels @letter rates', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => array('Aust Standard', 'Overseas Economy'),
		'options' => array(
			'Aust Standard' => "Aust Standard",
			'Aust Standard Insured' => "Aust Standard Insured",
			'Aust Priority' => "Aust Priority",
			'Aust Priority Insured' => "Aust Priority Insured",
			'Aust Registered' => "Aust Registered",
			'Aust Registered Insured' => "Aust Registered Insured",
			'Aust Express' => "Aust Express",
			'Aust Express +sig' => "Aust Express +sig",
			'Aust Express Insured +sig' => "Aust Express Insured +sig",
			'Aust Express Insured (no sig)' => "Aust Express Insured (no sig)",
			'Overseas Economy' => "Overseas Economy",
			'Overseas Economy Insured' => "Overseas Economy Insured",
			'Overseas Economy Prepaid' => "Overseas Economy Prepaid",
			'Overseas Economy Prepaid Insured' => "Overseas Economy Prepaid Insured",
			'Overseas Registered Prepaid Envelope' => "Overseas Registered Prepaid Envelope",
			'Overseas Express Letter (inc sig)' => "Overseas Express Letter (inc sig)",
			'Overseas Express Letter Insured (inc sig)' => "Overseas Express Letter Insured (inc sig)",
			'Overseas Prepaid Express Letter (inc sig)' => "Overseas Prepaid Express Letter (inc sig)",
			'Overseas Prepaid Express Letter Insured (inc sig)' => "Overseas Prepaid Express Letter Insured (inc sig)",
			'Overseas Courier Letter' => "Overseas Courier Letter",
			'Overseas Courier Letter Insured' => "Overseas Courier Letter Insured",
			'Overseas Prepaid Satchel' => "Overseas Prepaid Satchel",
			'Overseas Prepaid Satchel Insured' => "Overseas Prepaid Satchel Insured",
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'letter_handling' => array(
		'title' => __('Handling Fee for letters', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.50'
	),
	
	'satchel_methods' => array(
		'title' => __('Australia Post Satchels', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => array('PPS5', 'PPS3', 'PPS5K'),
		'options' => array(
			'PPS5' => "500g",
			'PPS5r' => "500g +Sig",
			'PPS5io' => "500g Insured",
			'PPS5i' => "500g Insured +Sig",
			
			'PPS1' => "1Kg",
			'PPS1r' => "1kg +Sig",
			'PPS1io' => "1kg Insured",
			'PPS1i' => "1kg Insured +Sig",
			
			'PPS3' => "3Kg",
			'PPS3r' => "3Kg +Sig",
			'PPS3io' => "3kg Insured",
			'PPS3i' => "3kg Insured +Sig",
			
			'PPS5K' => "5kg",
			'PPS5Kr' => "5kg +Sig",
			'PPS5Kio' => "5kg Insured",
			'PPS5Ki' => "5kg Insured +Sig",
			
			'PPSE5' => "500g Express",
			'PPSP5' => "500g Express +Sig",
			'PPSP5io' => "500g Insured Express",
			'PPSP5i' => "500g Insured Express +Sig",
			//'PPSESMALL' => "If it packs, it posts - S Express",
			//'PPSESMALLr' => "If it packs, it posts - S +Sig Express",
			//'PPSESMALLio' => "If it packs, it posts - S Insured Express",
			//'PPSESMALLsi' => "If it packs, it posts - S Insured +Sig Express",
			
			'PPSE1' => "1Kg Express",
			'PPSP1' => "1kg Express +Sig",
			'PPSP1io' => "1kg Insured Express",
			'PPSP1i' => "1kg Insured Express +Sig",
			//'PPSEMEDIUM' => "If it packs, it posts - M Express",
			//'PPSEMEDIUMr' => "If it packs, it posts - M +Sig Express",
			//'PPSEMEDIUMio' => "If it packs, it posts - M Insured Express",
			//'PPSEMEDIUMLsi' => "If it packs, it posts - M Insured +Sig Express",
			
			'PPSE3' => "3Kg Express",
			'PPSP3' => "3kg Express +Sig",
			'PPSP3io' => "3kg Insured Express",
			'PPSP3i' => "3kg Insured Express +Sig",
			//'PPSELARGE' => "If it packs, it posts - L Express",
			//'PPSELARGEr' => "If it packs, it posts - L +Sig Express",
			//'PPSELARGEio' => "If it packs, it posts - L Insured Express",
			//'PPSELARGEsi' => "If it packs, it posts - L Insured +Sig Express",
			
			'PPSE5K' => "5Kg Express",
			'PPSP5K' => "5kg Express +Sig",
			'PPSP5Kio' => "5kg Insured Express",
			'PPSP5Ki' => "5kg Insured Express +Sig",
			//'PPSEEXTRALARGE' => "If it packs, it posts - XL Express",
			//'PPSEEXTRALARGEr' => "If it packs, it posts - XL +Sig Express",
			//'PPSEEXTRALARGEio' => "If it packs, it posts - XL Insured Express",
			//'PPSEEXTRALARGEsi' => "If it packs, it posts - XL Insured +Sig Express",
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'pps_handling' => array(
		'title' => __('Handling Fee Satchels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '1.00'
	),
	'ppse_handling' => array(
		'title' => __('Handling Fee Express Satchels ', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '1.50'
	),
	'ppsi_handling' => array(
		'title' => __('Handling Fee Insured Express Satchels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '2.00'
	),
	'ap_discount_1r' => array(
		'title' => __('Use Discount rate for Regular 500g Satchels?', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 80px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'No',
		'options' => array(
			'No' => __('No', 'woocommerce-ozpost'),
			'5' => __('5%', 'woocommerce-ozpost'),
			'12.5' => __('12.5%')
		),
	),
	'ap_discount_2r' => array(
		'title' => __('Use Discount rate for Regular 3kg Satchels?', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 80px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'No',
		'options' => array(
			'No' => __('No', 'woocommerce-ozpost'),
			'5' => __('5%', 'woocommerce-ozpost'),
			'12.5' => __('12.5%')
		),
	),
	'ap_discount_3r' => array(
		'title' => __('Use Discount rate for Regular 5kg Satchels?', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 80px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'No',
		'options' => array(
			'No' => __('No', 'woocommerce-ozpost'),
			'5' => __('5%', 'woocommerce-ozpost'),
			'12.5' => __('12.5%')
		),
	),
	'ap_discount_1e' => array(
		'title' => __('Use Discount rate for Express 500g Satchels?', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 80px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'No',
		'options' => array(
			'No' => __('No', 'woocommerce-ozpost'),
			'5' => __('5%', 'woocommerce-ozpost'),
			'12.5' => __('12.5%')
		),
	),
	'ap_discount_2e' => array(
		'title' => __('Use Discount rate for Express 3kg Satchels?', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 80px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'No',
		'options' => array(
			'No' => __('No', 'woocommerce-ozpost'),
			'5' => __('5%', 'woocommerce-ozpost'),
			'12.5' => __('12.5%')
		),
	),
	'ap_discount_3e' => array(
		'title' => __('Use Discount rate for Express 5kg Satchels?', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 80px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'No',
		'options' => array(
			'No' => __('No', 'woocommerce-ozpost'),
			'5' => __('5%', 'woocommerce-ozpost'),
			'12.5' => __('12.5%')
		),
	),
	
	'parcel_methods' => array(
		'title' => __('Australia Post Parcels', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => array('RPP', 'RPPi'),
		'options' => array(
			'RPP' => "Regular",
			'REG' => "Regular +sig",
			'RPPio' => "Insured",
			'RPPi' => "Insured  +sig",
			'EXP' => "Express",
			'PLT' => "Express + Signature",
			'PLTio' => "Insured Express",
			'PLTi' => "Insured Express +sig",
			'COD' => "Cash on Delivery",
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'rpp_handling' => array(
		'title' => __('Handling Fee for parcels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '1.00'
	),
	'exp_handling' => array(
		'title' => __('Handling Fee for Express parcels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '1.50'
	),
	'cod_handling' => array(
		'title' => __('Handling Fee for COD parceld', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	
	'overseas_parcel_methods' => array(
		'title' => __('Australia Post Overseas Parcels', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => array('IPec', 'IPeci', 'IPS', 'IPSi'),
		'options' => array(
			'IPec' => "Economy Air",
			'IPecs' => "Economy Air +sig",
			'IPeci' => "Economy Air Insured",
			'IPecsi' => "Economy Air Insured +sig",
			'IPS' => "Standard Air",
			'IPSs' => "Standard Air +sig",
			'IPSi' => "Standard Air Insured",
			'IPSsi' => "Standard Air Insured +sig",
			'IPS500' => "Standard Air 500g Satchel",
			'IPS500gs' => "Standard Air 500g Satchel +sig",
			'IPS500gi' => "Standard Air 500g Satchel Insured",
			'IPS500gsi' => "Standard Air 500g Satchel Insured +sig",
			'IPS1k' => " Standard Air 1kg Satchel",
			'IPS1ks' => "Standard Air 1kg Satchel +sig",
			'IPS1ki' => "Standard Air 1kg Satchel Insured",
			'IPS1ksi' => "Standard Air 1kg Satchel Insured +sig",
			'IPS2k' => "Standard Air 2kg Satchel",
			'IPS2ks' => "Standard Air 2kg Satchel +sig",
			'IPS2ki' => "Standard Air 2kg Satchel Insured",
			'IPS2ksi' => " Standard Air 2kg Satchel Insured +sig",
			'IPS5k' => "Standard Air 5kg Box",
			'IPS5ks' => "Standard Air 5kg Box +sig",
			'IPS5ki' => "Standard Air 5kg Box Insured",
			'IPS5ksi' => "Standard Air 5kg Box Insured +sig",
			'IPEs' => "Express Air (inc sig)",
			'IPEsi' => "Express Air Insured (inc sig)",
			'IPE500g' => "Express Air 500g Satchel",
			'IPE500gi' => "Express Air 500g Satchel Insured",
			'IPE1k' => "Express Air 1kg Satchel",
			'IPE1ki' => " Express Air 1kg Satchel Insured",
			'IPE2k' => " Express Air 2kg Satchel",
			'IPE2ki' => " Express Air 2kg Satchel Insured",
			'IPE5k' => "Express Air 5kg Box",
			'IPE5ki' => " Express Air 5kg Box Insured",
			'IPC' => " Courier Air (inc sig)",
			'IPCi' => " Courier Air Insured (inc sig)",
			'IPC500g' => " Courier Air 500g Satchel",
			'IPC500gi' => "  Courier Air 500g Satchel Insured",
			'IPC1k' => " Courier Air 1kg Satchel",
			'IPC1ki' => " Courier Air 1kg Satchel Insured",
			'SEA' => "Sea",
			'SEAi' => "Insured Sea",
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'overseas_handling' => array(
		'title' => __('Handling Fee Overseas Parcels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	
	'cpl_methods' => array(
		'title' => __('Couriers Please Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'CPL5g' => "500g Satchel",
			'CPL1' => "1kg Satchel",
			'CPL3' => "3kg Satchel",
			'CPL5' => "5kg Satchel",
			'CPLlab' => "EzySend",
			'CPLrre' => "Road Express - Signature required ",
			'CPLrra' => "Road Express - Authority to leave ",
//            'CPLsda' => "Same day - Authority to leave",
//            'CPLsds' => "Same day - signature required",
//            'CPLona' => "Overnight - Authority to leave",
//            'CPLons' => "Overnight - signature required",
			'CPLdpa' => "Domestic Priority - Authority to leave",
			'CPLdps' => "Domestic Priority - Signature required",
			'CPLdsa' => "Domestic saver- Authority to leave",
			'CPLdss' => "Domestic saver - Signature required",
			'CPLexp' => "International Express",
			'CPLsav' => "International Saver"
		),
		
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'cpl_account' => array(
		'title' => __('Couriers Please Account number', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('Leave blank for card rates ', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('Account', 'woocommerce-ozpost')
	),
	'cpl_key' => array(
		'title' => __('Couriers Please API key', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('API Key must be requested from Couriers Please', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('Customer', 'woocommerce-ozpost')
	),
	
	'cpl_handling' => array(
		'title' => __('Handling Fee Couriers Please Parcels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'description' => __('', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	'cpl_satchel_handling' => array(
		'title' => __('Handling Fee Couriers Please Satchels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'description' => __('', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	
	'cpl_international_handling' => array(
		'title' => __('Handling Fee Couriers Please International', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'description' => __('', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '10.00'
	),
	
	'cpl_metro_labels' => array(
		'title' => __('Couriers Please Metro labels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	
	'cpl_ezy_labels' => array(
		'title' => __('Couriers Please EZY link labels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	
	'cpl_500g_satchel' => array(
		'title' => __('Couriers Please 500g satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	
	'cpl_1kg_satchel' => array(
		'title' => __('Couriers Please 1kg satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	
	'cpl_3kg_satchel' => array(
		'title' => __('Couriers Please 3kg satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	
	'cpl_5kg_satchel' => array(
		'title' => __('Couriers Please 5kg satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	
	'ego_methods' => array(
		'title' => __('E-Go.com.au Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'EGO' => "Parcels",
			'EGOi' => "Insured Parcels",
			'EGOdep2dep' => "Depot to Depot",
			'EGOdep2door' => "Depot to Door",
			'EGOdoor2dep' => "Door to Depot"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	''
	. 'ego_handling' => array(
		'title' => __('Handling Fee E-Go ', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'description' => __('', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	
	'ego_user' => array(
		'title' => __('E-Go Platinum user (optional)', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 250px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('EG-Go user', 'woocommerce-ozpost')
	),
	'ego_password' => array(
		'title' => __('E-Go Platinum Password (optional)', 'woocommerce-ozpost'),
		'type' => 'password',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('********', 'woocommerce-ozpost')
	),
	
	'fastway_methods' => array(
		'title' => __('Fastway Courier Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => 'No account needed for quotes',
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'FWLred' => "Red Label",
			'FWLorange' => "Orange Label",
			'FWLgreen' => "Green Label",
			'FWLwhite' => "White Label",
			'FWLgrey' => "Grey Label",
			'FWLbrown' => "Brown Label",
			'FWLblack' => "Black Label",
			'FWLblue' => "Blue Label",
			'FWLyellow' => "Yellow Label",
			'FWLlime' => "Lime Label",
			'FWLpink' => "Pink Label",
			'FWS0' => "A5 Satchel (500g)",
			'FWS1' => "A4 Satchel (1Kg)",
			'FWS3l' => "A3 Satchel (3Kg local)",
			'FWS3' => "A3 Satchel (3Kg)",
			'FWS5' => "A2 Satchel (5Kg)",
			'FWB1' => "Small Box",
			'FWB2' => "Medium Box",
			'FWB3' => "Large Box",
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'fastway_city' => array(
		'title' => __('Fastway Distributor', 'woocommerce-ozpost'),
		'type' => 'select',
		'class' => 'wc-enhanced-select',
		'css' => 'width: 150px;',
		'default' => '',
		'options' => array(
			'DIS' => __("Disabled"),
			'ADL' => __("Adelaide"),
			'ALB' => __("Albury"),
			'BEN' => __("Bendigo"),
			'BRI' => __("Brisbane"),
			'CNS' => __("Cairns"),
			'CBR' => __("Canberra"),
			'CAP' => __("Capricorn Coast"),
			'CCT' => __("Central Coast"),
			'CFS' => __("Coffs Harbour"),
			'GEE' => __("Geelong"),
			'GLD' => __("Gold Coast"),
			'TAS' => __("Hobart"),
			'LAU' => __("Launceston"),
			'MKY' => __("Mackay"),
			'MEL' => __("Melbourne"),
			'NEW' => __("Newcastle"),
			'NTH' => __("Northern Rivers"),
			'PER' => __("Perth"),
			'PQQ' => __("Port Macquarie"),
			'SUN' => __("Sunshine Coast"),
			'SYD' => __("Sydney"),
			'TOO' => __("Toowoomba"),
			'TVL' => __("Townsville"),
			'BDB' => __("Wide Bay"),
			'WOL' => __("Wollongong"),
			'custom_attributes' => array(
				'data-placeholder' => __('Select City', 'woocommerce-ozpost')
			)
		),
	),
	'fastway_frequentUser' => array(
		'title' => __('Fastway frequent user rates', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => 'Frequent users have lower rates, but requires a minimum monthly spend.',
		'default' => 'no'
	),
	'fastway_labels_handling' => array(
		'title' => __('Handling Fee Fastway Labels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '2.00'
	),
	'fastway_satchels_handling' => array(
		'title' => __('Handling Fee Fastway Satchels', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '1.00'
	),
	'fastway_boxes_handling' => array(
		'title' => __('Handling Fee Fastway Boxes', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '1.00'
	),
	'fastway_special_baseweight' => array(
		'title' => __('Special user Base weight (kg)', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __('If you don\'t know what this is for leave it blank', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'css' => 'width: 50px;',
		'placeholder' => 'Weight in Kgs',
		'default' => '0'
	),
	'fastway_fwA5blue' => array(
		'title' => __('A5 Satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwA4blue' => array(
		'title' => __('A4 Satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwA3blue' => array(
		'title' => __('A3 Satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwA3orange' => array(
		'title' => __('A3 local Satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwA2blue' => array(
		'title' => __('A2 Satchel price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwBox1' => array(
		'title' => __('Small Box price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwBox2' => array(
		'title' => __('Medium Box price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'fastway_fwBox3' => array(
		'title' => __('Large Box price', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'hx_methods' => array(
		'title' => __('Hunter Express Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __(
			'Using the placeholder values will enable a demo account (Not suitable for a live store)',
			'woocommerce-ozpost'
		),
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array('HXRF' => "Road Freight", 'HXAF' => "Air Freight", 'HXHDP' => "Home Direct Plus"),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'hx_user' => array(
		'title' => __('Hunter Express Username', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('Demo', 'woocommerce-ozpost')
	),
	'hx_cust' => array(
		'title' => __('Hunter Express Customer ID', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('DUMMY', 'woocommerce-ozpost')
	),
	'hx_pass' => array(
		'title' => __('Hunter Express Password', 'woocommerce-ozpost'),
		'type' => 'password',
		'css' => 'width: 170px;',
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('', 'woocommerce-ozpost')
	),
	'hx_handling' => array(
		'title' => __('Handling Fee Hunter Express', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'description' => __('', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	'hx_fuellevy' => array(
		'title' => __('Hunter Express Fuel levy (percent)', 'woocommerce-ozpost'),
		'description' => __(
			'Hunter Express charge a fuel levy that is not included in their quotes. Apparently the amount charged is customer specific and based on a percentage of the GST inclusive shipping cost. Please enter your rate here',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'description' => __('', 'woocommerce-ozpost'),
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'sendle_methods' => array(
		'title' => __('Sendle', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 140px;',
		'class' => 'wc-enhanced-select',
		'default' => '',
		'options' => array(
			'Disabled' => "Disabled",
			'Easy' => "Easy",
			'Premium' => "Premium",
			'Pro' => "Pro"
		)
	),
	'sendle_handling' => array(
		'title' => __('Handling Fee Sendle', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '0.00'
	),
	'skp_methods' => array(
		'title' => __('Skippy Post (Overseas only)', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __('Account not needed for quotes', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'SKP' => "Air",
			'SKPp' => "Air +Proof of postage",
			'SKPt' => "Air with Tracking",
			'SKPti' => "Air with Tracking and Insurance",
			'SKPtip' => "Air with Tracking +Insurance +Proof of post",
			'SKPtp' => "Air with Tracking +Proof of postage"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'skp_customerId' => array(
		'title' => __('Skippy Post Customer Identifier', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('Optional: Cheaper rates if supplied', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => true,
		'placeholder' => __('CustomerID', 'woocommerce-ozpost')
	),
	'skp_handling' => array(
		'title' => __('Handling Fee SkippyPost', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	'sms_methods' => array(
		'title' => __('SmartSend Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __(
			'A SmartSend Customer email address is required for VALID quotes. These quotes can take a while to be returned. This is due to the SmartSend Servers, not the ozpost servers. ',
			'woocommerce-ozpost'
		), //'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'SMSCPR' => "Couriers Please Road",
			'SMSCPRr' => "Couriers Please Road (receipted)",
			'SMSCPRi' => "Couriers Please Road (insured)",
			'SMSCPRri' => "Couriers Please Road (receipted + insured)",
			'SMSAAE1K' => "AAE : 1kg Prepaid Satchel",
			'SMSAAE1Kr' => "AAE : 1kg Prepaid Satchel (receipted)",
			'SMSAAE1Ki' => "AAE : 1kg Prepaid Satchel (insured)",
			'SMSAAE1Kri' => "AAE : 1kg Prepaid Satchel (receipted + insured)",
			'SMSAAE3K' => "AAE : 3kg Prepaid Satchel",
			'SMSAAE3Kr' => "AAE : 3kg Prepaid Satchel (receipted",
			'SMSAAE3Ki' => "AAE : 3kg Prepaid Satchel (insured)",
			'SMSAAE3Kri' => "AAE : 3kg Prepaid Satchel (receipted + insured)",
			'SMSAAE5K' => "AAE : 5kg Prepaid Satchel",
			'SMSAAE5Kr' => "AAE : 5kg Prepaid Satchel (receipted)",
			'SMSAAE5Ki' => "AAE : 5kg Prepaid Satchel (insured)",
			'SMSAAE5Kri' => "AAE : 5kg Prepaid Satchel (receipted + insured)",
			'SMSAAER' => "AAE : Road",
			'SMSAAERr' => "AAE : Road (receipted)",
			'SMSAAERi' => "AAE : Road (insured)",
			'SMSAAERri' => "AAE : Road (receipted + insured)",
			'SMSAAEP' => "AAE : Express Premium",
			'SMSAAEPr' => "AAE : Express Premium (receipted)",
			'SMSAAEPi' => "AAE : Express Premium (insured)",
			'SMSAAEPri' => "AAE : Express Premium (receipted + insured)",
			'SMSAAES' => "AAE : Express Saver",
			'SMSAAESr' => "AAE : Express Saver (receipted)",
			'SMSAAESi' => "AAE : Express Saver (insured)",
			'SMSAAESri' => "AAE : Express Saver (receipted + insured)",
			'SMSFW' => "Fastway : National Road",
			'SMSFWr' => "Fastway : National Road (receipted)",
			'SMSFWi' => "Fastway : National Road (insured)",
			'SMSFWri' => "Fastway : National Road (receipted + insured)",
			'SMSFWL' => "Fastway : Local",
			'SMSFWLr' => "Fastway : Local (receipted)",
			'SMSFWLi' => "Fastway : Local (insured)",
			'SMSFWLri' => "Fastway : Local (receipted + insured)",
			'SMSFWSr' => "Fastway : Satchels (receipted)",
			'SMSFWSi' => "Fastway : Satchels (insured)",
			'SMSFWSri' => "Fastway : Satchels (receipted + insured)",
			'SMSTNT9' => "TNT : Overnight by 9am",
			'SMSTNT9r' => "TNT : Overnight by 9am (receipted)",
			'SMSTNT9i' => "TNT : Overnight by 9am (insured)",
			'SMSTNT9ri' => "TNT : Overnight by 9am (receipted + insured)",
			'SMSTNT12' => "TNT : Overnight by 12pm",
			'SMSTNT12r' => "TNT : Overnight by 12pm (receipted)",
			'SMSTNT12i' => "TNT : Overnight by 12pm (insured)",
			'SMSTNT12ri' => "TNT : Overnight by 12pm (receipted + insured)",
			'SMSTNT5' => "TNT : Overnight by 5pm",
			'SMSTNT5r' => "TNT : Overnight by 5pm (receipted)",
			'SMSTNT5i' => "TNT : Overnight by 5pm (insured)",
			'SMSTNT5ri' => "TNT : Overnight by 5pm (receipted + insured)",
			'SMSTNTR' => "TNT : Road",
			'SMSTNTRr' => "TNT : Road (receipted)",
			'SMSTNTRi' => "TNT : Road (insured)",
			'SMSTNTRri' => "TNT : Road (receipted + insured)"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'sms_email' => array(
		'title' => __('Email Address', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 250px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('Acct Email Address. hint: Try \'Demo\'', 'woocommerce-ozpost')
	),
	'sms_password' => array(
		'title' => __('Password', 'woocommerce-ozpost'),
		'type' => 'password',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		//  'placeholder' => __('********', 'woocommerce-ozpost')
	),
	'sms_customer_type' => array(
		'title' => __('Customer Type', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 130px;',
		'description' => __('Your Choice.', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'VIP',
		'options' => array(
			'VIP' => __('VIP', 'woocommerce-ozpost'),
			'CASUAL' => __('CASUAL', 'woocommerce-ozpost'),
			'EBAY' => __('EBAY', 'woocommerce-ozpost'),
			'CORPORATE' => __('CORPORATE', 'woocommerce-ozpost'),
			'PROMOTION' => __('PROMOTION', 'woocommerce-ozpost'),
			'REFERRAL' => __('REFERRAL', 'woocommerce-ozpost')
		),
	),
	'sms_handling' => array(
		'title' => __('Handling Fee SmartSend', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	'sta_methods' => array(
		'title' => __('StarTrack Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __(
			'A StarTrack Account is required for these quotes.  These quotes can take a while to be returned. This is due to the StarTrack Servers, not the ozpost servers.',
			'woocommerce-ozpost'
		),
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'STA1k' => "1kg Satchel",
			'STA3k' => "3kg Satchel",
			'STA5k' => "5kg Satchel",
			'STAexp' => "Road Express",
			'STAexpi' => "Road Express Insured",
			'STAprm' => "Air Express",
			'STAprmi' => "Air Express Insured"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'sta_account' => array(
		'title' => __('StarTrack Account', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('Account', 'woocommerce-ozpost')
	),
	'sta_username' => array(
		'title' => __('StarTrack UserName', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('UserName.  hint: Try \'Demo\'', 'woocommerce-ozpost')
	),
	'sta_password' => array(
		'title' => __('StarTrack Password', 'woocommerce-ozpost'),
		'type' => 'password',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		//      'placeholder' => __('Password', 'woocommerce-ozpost')
	),
	'sta_key' => array(
		'title' => __('StarTrack Key', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('', 'woocommerce-ozpost')
	),
	'sta_handling' => array(
		'title' => __('Handling Fee StarTrack', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	'tnt_methods' => array(
		'title' => __('TNT Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __(
			'You need a valid TNT account. You *must* also contact them to activate the \'RTT\' service for the account. Sign up at: https://www.tntexpress.com.au/',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'TNT76' => "Road Express",
			'TNT76i' => "Insured Road Express",
			'TNT75' => "Overnight Express by 5pm",
			'TNT75i' => "Insured Overnight Express by 5pm",
			'TNTEX12' => "Overnight Express by Midday",
			'TNTEX12i' => "Insured Overnight Express by Midday",
			'TNTEX10' => "Overnight Express by 10:00am",
			'TNTEX10i' => "Insured Overnight Express by 10:00am",
			'TNT712' => "Overnight Express by 9:00am",
			'TNT712i' => "Insured Overnight Express by 9:00am",
			'TNT717B' => "Technology Express - Sensitive Express",
			'TNT717Bi' => "Insured Technology Express - Sensitive Express",
			'TNT73' => "ONFC Satchel",
			'TNT73i' => "Insured ONFC Satchel"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'tnt_account' => array(
		'title' => __('TNT Account', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('Must be a valid Account number. NOT your email address', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => true,
		'placeholder' => __('12345678', 'woocommerce-ozpost')
	),
	'tnt_login' => array(
		'title' => __('TNT Login', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('Must be a valid CIT number. NOT your email address', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => true,
		'placeholder' => __('CIT00000000000000000', 'woocommerce-ozpost')
	),
	'tnt_password' => array(
		'title' => __('TNT Password', 'woocommerce-ozpost'),
		'type' => 'password',
		'css' => 'width: 170px;',
		'description' => __('', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => true,
		//    'placeholder' => __('********', 'woocommerce-ozpost')
	),
	'tnt_handling' => array(
		'title' => __('Handling Fee TNT', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	'trd_methods' => array(
		'title' => __('Transdirect Methods', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __('Account not needed for quotes', 'woocommerce-ozpost'),
		'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'css' => 'width: 450px;',
		'default' => '',
		'options' => array(
			'TRDae' => "Allied Express",
			'TRDaei' => "Allied Express Insured",
			'TRDcp' => "Couriers Please (Authority to leave)",
			'TRDcpi' => "Couriers Please (Authority to leave) Insured",
			'TRDcpsr' => "Couriers Please (Signature Required)",
			'TRDcpsri' => "Couriers Please (Signature Required) Insured",
			'TRDfw' => "Fastway",
			'TRDfwi' => "Fastway Insured",
			'TRDti' => "Toll/Ipec",
			'TRDtii' => "Toll/Ipec Insured",
			'TRDtp' => "Toll Priority Overnight",
			'TRDtpi' => "Toll Priority Overnight Insured",
			'TRDts' => "Toll Priority Same Day",
			'TRDtsi' => "Toll Priority Same Day Insured",
			'TRDnl' => "Northline",
			'TRDnli' => "Northline Insured",
			'TRDmf' => "Mainfreight",
			'TRDmfi' => "Mainfreight Insured",
			'TRDtntr' => "TNT Road",
			'TRDtntri' => "TNT Road Insured",
			'TRDtnt5' => "TNT Overnight Express by 5pm",
			'TRDtnt5i' => "TNT Overnight Express by 5pm Insured",
			'TRDtnt9' => "TNT Overnight Express by 9am",
			'TRDtnt9i' => "TNT Overnight Express by 9am Insured",
			'TRDtnt10' => "TNT Overnight Express by 10am",
			'TRDtnt10i' => "TNT Overnight Express by 10am Insured",
			'TRDtnt12' => "TNT Overnight Express by 12pm",
			'TRDtnt12i' => "TNT Overnight Express by 12pm Insured",
			'TRDtntIntEE' => "TNT International Express",
			'TRDtntIntEEi' => "TNT International Express Insured",
			'TRDtntIntDE' => "TNT International Document Express",
			'TRDtntIntDEi' => "TNT International Document Express Insured",
			'TRDtntIntEco' => "TNT International Economy Express",
			'TRDtntIntEcoi' => "TNT International Economy Express Insured",
			'TRDtollIntP' => "Toll International Priority",
			'TRDtollIntPi' => "Toll International Priority Insured",
			'TRDtollIntD' => "Toll International Priority Document",
			'TRDtollIntDi' => "Toll International Priority Document Insured"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
		)
	),
	'trd_email' => array(
		'title' => __('TransDirect Email', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 170px;',
		'description' => __('Transdirect username (optional - account holders get better rates)', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => true,
		'placeholder' => __('UserName', 'woocommerce-ozpost')
	),
	'trd_password' => array(
		'title' => __('Transdirect Password', 'woocommerce-ozpost'),
		'type' => 'password',
		'css' => 'width: 170px;',
		'description' => __('Password required if username is set.', 'woocommerce-ozpost'),
		'default' => '',
		'desc_tip' => true,
	
	),
	
	'trd_handling' => array(
		'title' => __('Handling Fee TransDirect (Aust)', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	
	'trd_international_handling' => array(
		'title' => __('Handling Fee TransDirect International', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '10.00'
	),
	
	'trd_type' => array(
		'title' => __('Type', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 140px;',
		'class' => 'wc-enhanced-select',
		'default' => 'Biz2Res',
		'options' => array(
			'Biz2Biz' => "Business to Business",
			'Biz2Res' => "Business to Residential",
			'Res2Res' => "Residential to Residential",
			'Res2Biz' => "Residential to Business"
		)
	),
	
	'hide_parcel_if_domestic_letter' => array(
		'title' => __('Hide parcels if letter sized (domestic)', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => 'If the items can be sent as a Domestic Letter would you like to hide the parcel rates? Note: Has no effect if debug is enabled',
		'default' => 'no',
	),
	'hide_parcel_if_international_letter' => array(
		'title' => __('Hide parcels if letter sized (Overseas)', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => 'If the items can be sent as an International Letter would you like to hide the parcel rates? Note: Has no effect if debug is enabled',
		//  'desc_tip' => true,
		'default' => 'no',
	),
	
	'hide_parcel_if_satchel' => array(
		'title' => __('Hide parcels if Satchel sized', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => 'If the items will fit into a satchel would you like to hide the parcel rates?',
		'default' => 'no',
	),
	'hide_courier_if_ap_can_handle' => array(
		'title' => __('Hide Couriers if Australia Post can handle it?', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => 'If the items can be sent via Australia Post would you like to hide the Courier rates?  Note: Has no effect if debug is enabled',
		'default' => 'no',
	),
	'ri_handling' => array(
		'title' => __(
			'Handling Fee Registered or Insured items (This is in ADDITION to other handling fees.)',
			'woocommerce-ozpost'
		),
		'type' => 'price',
		'css' => 'width: 50px;color: blue;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '5.00'
	),
	
	'hp_surcharge' => array(
		'title' => __('Surcharge for Heavy Parcels (pallet fee).)', 'woocommerce-ozpost'),
		'type' => 'price',
		'css' => 'width: 50px;color: green;',
		'placeholder' => wc_format_localized_price(0),
		'default' => '20.00'
	),
	
	'hp_weight' => array(
		'title' => __('How heavy is a \'heavy\' parcel (kg)', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 50px; ',
		'placeholder' => '35',
		'default' => '35'
	),
	
	'cost_on_error_method' => array(
		'title' => __('Action on Error', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 240px;',
		'description' => __(
			'Action to be taken if no \'live\' quotes are available for some reason. eg: server offline, network glitches, no suitable methods avialable, etc.',
			'woocommerce-ozpost'
		),
		'desc_tip' => false,
		'class' => 'wc-enhanced-select',
		'default' => 'TBA',
		'options' => array(
			'DIS' => __('Do nothing', 'woocommerce-ozpost'),
			'TBA' => __('Display TBA Message', 'woocommerce-ozpost'),
			'CPP' => __('Quote based on Cost Per Parcel', 'woocommerce-ozpost'),
			'CPI' => __('Quote based on Cost Per Item', 'woocommerce-ozpost'),
			'CPK' => __('Quote based on Cost Per Kg', 'woocommerce-ozpost'),
			'TBL' => __('Use Table Rates', 'woocommerce-ozpost')
		),
	),
	
	'static_rates' => array(
		'title' => __('Static Rates', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 100px;color: blue;',
		'description' => __(
			'Two comma separated values. The 1st is the cost for Australian Deliveries, the 2nd for Overseas. Used in conjuction with the \'Action on Error\'. These amounts will be used in conjuction with the \'Quote based on....\' settings above.',
			'woocommerce-ozpost'
		),
		'default' => '15.00, 30.00',
		'desc_tip' => false,
		'placeholder' => __('Example: 15.00, 30.00', 'woocommerce-ozpost')
	),
	
	
	'table_rates' => array(
		'title' => __('Table Rates ', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 800px;;color: blue;',
		'description' => __(
			'These table rates are used if \'Action on Error\' = "Use Table Rates". '
			. 'They are only shown when no other methods are available, eg: server offline, network glitches, etc.  '
			. 'Two SPACE separated SETS. The 1st SET is the cost for Australia, the 2nd SET is for overseas. Each SET consists of a number of comma separated pairs. '
			. 'Each pair consists of \'value:price\' where \'value\' equals a weight, price or item count to be compared with (from the cart contents). If the \'value\' is less than '
			. 'less than cart content amount the \'price\' is used. If the content amount is greater, then the next \'value:price\' pair is checked. '
			. 'This process repeats until a price is set or the end of the SET is reached.'
			. ' In the example given, using \'Weight\' for Austrlaian delivery, <500gm = $6.35, 500gm-3kg = $7.50 , 3.001kg-5kg = $9.90, 5.001kg-10kg = $10.50, 10.001kg-15kg+ = $15.00  '
			. '',
			'woocommerce-ozpost'
		),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __(
			'Example: 0.5:6.35,3:7.50,5:9.90,10:10.50,15:15.00 <space> 0.5:20.00,3:25.00,5:30.00,10:40.00,15:50.00',
			'woocommerce-ozpost'
		)
	),
	'table_type' => array(
		'title' => __('Table Rate Method', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 140px;',
		'description' => __(
			'The table rates can be based on Price, Weight or per Item. Your choice.',
			'woocommerce-ozpost'
		), // 'desc_tip' => true,
		'class' => 'wc-enhanced-select',
		'default' => 'WGT',
		'options' => array(
			'PRC' => __('Price', 'woocommerce-ozpost'),
			'WGT' => __('Weight', 'woocommerce-ozpost'),
			'ITM' => __('Item', 'woocommerce-ozpost')
		),
	),
	'tba_text' => array(
		'title' => __('To Be Advised Message', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Displayed to customer if no shipping methods are available and \'Action on Error\' is set to TBA.',
			'woocommerce-ozpost'
		),
		'default' => 'Please contact us for shipping costs.',
		'desc_tip' => false,
		'placeholder' => __('Please contact us for shipping costs.', 'woocommerce-ozpost')
	),
	'default_weight' => array(
		'title' => __('Default Weight', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 100px;',
		'description' => __(
			'Used if individual products don\'t have their own weight assigned. Use the same weight unit that you have set in the WooCommerce->Products-Weight Unit.',
			'woocommerce-ozpost'
		),
		'default' => '',
		'desc_tip' => false,
		'placeholder' => __('Ex: 250 ', 'woocommerce-ozpost')
	),
	'default_dimensions' => array(
		'title' => __('Default Dimensions', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'These dimensions are used for products with no dimensions defined (format: L,W,H). Use the same dimension unit that you have set in the WooCommerce->Products-Dimensions Unit. The example/defaults assume CM',
			'woocommerce-ozpost'
		),
		'default' => '29,24,2.5',
		'css' => 'width: 120px;',
		'desc_tip' => false,
		'placeholder' => __('Ex:29,24,2.5', 'woocommerce-ozpost')
	),
	'tare_weight' => array(
		'title' => __('Tare Weight', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 120px;',
		'description' => __(
			'All packaging has a weight. 10% works well in most cases (format: xx% or +gm) ',
			'woocommerce-ozpost'
		),
		'default' => '10%',
		'desc_tip' => false,
		'placeholder' => __('Ex: 10% or +500 ', 'woocommerce-ozpost')
	),
	'tare_dimensions' => array(
		'title' => __('Tare Dimensions', 'woocommerce-ozpost'),
		'type' => 'input',
		'css' => 'width: 100px;',
		'description' => __(
			'These dimensions are added to the total parcel size (format: L,W,H measured in mm)',
			'woocommerce-ozpost'
		),
		'default' => '2,2,2',
		'desc_tip' => false,
		'placeholder' => __('Ex: 2,2,2', 'woocommerce-ozpost')
	),
	'restrain_dimensions' => array(
		'title' => __('Restrain dimensions', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'description' => __(
			'Selecting this will limit the parcel dimensions to the maximum allowable by Australia Post. Quotes will effectively be based on weight alone. ENABLE WITH CAUTION as you may end up quoting for parcel too large to mail.'
		),
		'default' => 'no',
	),
	'mail_days' => array(
		'title' => __('What days do you mail?', 'woocommerce-ozpost'),
		'type' => 'multiselect',
		'description' => __(
			'This is used to provide best delivery date estimates. Enabling for SUN is the same as 1st opening of next business day. (Consider the situation of posting prepaid envelopes/satchels into local mailbox, to be cleared next business day)',
			'woocommerce-ozpost'
		),
		'class' => 'wc-enhanced-select',
		'default' => array('MON', 'WED', 'FRI'),
		'options' => array(
			'MON' => "MON",
			'TUE' => "TUE",
			'WED' => "WED",
			'THU' => "THU",
			'FRI' => "FRI",
			'SAT' => "SAT",
			'SUN' => "SUN"
		),
		'custom_attributes' => array(
			'data-placeholder' => __('Select the Days you do mailings', 'woocommerce-ozpost')
		)
	),
	'lead_time' => array(
		'title' => __('Lead time', 'woocommerce-ozpost'),
		'type' => 'text',
		'css' => 'width: 45px;',
		'description' => __(
			'Set this is you need time to order products in, or need to manufacture before you can post. If your products are in stock this is best left at zero. You should probably be using the \'mail days\' for your postage delay instead.',
			'woocommerce-ozpost'
		),
		'default' => '0',
	),
	'deadline' => array(
		'title' => __('Deadline for same day postage', 'woocommerce-ozpost'),
		'type' => 'text',
		'css' => 'width: 45px;',
		'description' => 'Hour 1 - 24. Uses the store localtime',
		'woocommerce-ozpost',
		'default' => '10',
	),
	
	'show_carrier_name' => array(
		'title' => __('Show Carrier Names', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => ' tick to show carrier names',
		'default' => 'yes',
	),
	'show_handling_fee' => array(
		'title' => __('Show Handling Fees', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => ' tick to show handling fees along with the quotes.',
		'description' => 'For display purposes only. These are always included in the quote price',
		'desc_tip' => true,
		'default' => 'yes',
	),
	
	'show_insurance_cost' => array(
		'title' => __('Show the Insurance cost', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => ' tick to show insurance cost along with the quotes',
		'description' => 'For display purposes only. These are always included in the quote price',
		'desc_tip' => true,
		'default' => 'yes',
	),
	
	'show_otherfee' => array(
		'title' => __('Show cost of any other fees', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => ' tick to show any other fees that make up the quotes (eg: Registration and COD charges) ',
		'description' => 'For display purposes only.These are always included in the quote price',
		'desc_tip' => true,
		'default' => 'yes',
	),
	
	'estimated_delivery_format' => array(
		'title' => __('Estimated Days Format', 'woocommerce-ozpost'),
		'type' => 'select',
		'css' => 'width: 280px;',
		'label' => __('Your Choice.', 'woocommerce-ozpost'),
		'class' => 'wc-enhanced-select',
		'default' => 'Date',
		'options' => array(
			'Date' => __('Show the estimated Date', 'woocommerce-ozpost'),
			'Days' => __('Show the estimated number of Days', 'woocommerce-ozpost'),
			'None' => __('Show Nothing', 'woocommerce-ozpost')
		),
	),
	
	'handling_text_pre' => array(
		'title' => __('Text to be displayed BEFORE the handling fee', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'default' => '&nbsp;Includes $',
		'placeholder' => __(' Includes $', 'woocommerce-ozpost')
	),
	
	'handling_text_post' => array(
		'title' => __('Text to be displayed AFTER the handling fee', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'default' => '&nbsp;Packaging & Handling.',
		'placeholder' => __('&nbsp;Packaging & Handling.', 'woocommerce-ozpost')
	),
	
	'insurancefee_text_pre' => array(
		'title' => __('Text to be displayed BEFORE the INSURANCE cost', 'woocommerce-ozpost'),
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'type' => 'input',
		'default' => '&nbsp;Includes $',
		'placeholder' => __('&nbsp;Includes $', 'woocommerce-ozpost'),
		'desc_tip' => true
	),
	
	'insurancefee_text_post' => array(
		'title' => __('Text to be displayed AFTER the INSURANCE cost', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'default' => '&nbsp;Fee',
		'placeholder' => __(' Fee', 'woocommerce-ozpost')
	),
	
	'otherfee_text_pre' => array(
		'title' => __('Text to be displayed BEFORE the OTHER fee cost', 'woocommerce-ozpost'),
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'type' => 'input',
		'default' => '&nbsp;Includes $',
		'placeholder' => __('&nbsp;Includes $', 'woocommerce-ozpost'),
		'desc_tip' => true
	),
	
	'otherfee_text_post' => array(
		'title' => __('Text to be displayed AFTER the OTHER fee cost', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'default' => '&nbsp;Fee',
		'placeholder' => __(' Fee', 'woocommerce-ozpost')
	),
	
	'estimation_text_date' => array(
		'title' => __('Text to be displayed BEFORE the estimated DATE', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'default' => 'Est Delivery Date :',
		'placeholder' => __('Est Delivery Date : ', 'woocommerce-ozpost')
	),
	
	'estimation_text_days' => array(
		'title' => __('Text to be displayed AFTER the estimated delivery DAYS', 'woocommerce-ozpost'),
		'type' => 'input',
		'description' => __(
			'Hint: To enter a leading or trailing space, enter a html non=breaking space',
			'woocommerce-ozpost'
		),
		'desc_tip' => true,
		'default' => '&nbsp;Days Estimated Delivery',
		'placeholder' => __('&nbsp;Days Estimated Delivery', 'woocommerce-ozpost')
	),
	
	'show_errors' => array(
		'title' => __('Show Error Messages', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => __(
			'Enabling this will show \'friendly\' error messages, such as oversize parcels, invalid destinations, etc, etc',
			'woocommerce-ozpost'
		),
		'default' => 'yes',
	),
	
	'show_parcel' => array(
		'title' => __('Show Parcel build', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'label' => __('Enabling this will display the parcel "created" by multiple items', 'woocommerce-ozpost'),
		'default' => 'yes',
	),
	
	'enable_debug' => array(
		'title' => __('Enable DEBUG Output', 'woocommerce-ozpost'),
		'type' => 'checkbox',
		'desc_tip' => true,
		'description' => __(
			'The output may not be pretty, but it will provide some detailed information about what is going on \'behind the scenes\'.',
			'woocommerce-ozpost'
		),
		'default' => 'no',
		'label' => __(
			'If the quotes are not what is expected then enabling this may help provide a clue why.',
			'woocommerce-ozpost'
		)
	),
);  //   End formfields array