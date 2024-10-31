<?php

/*
  Plugin Name: WooCommerce-Ozpost
  Plugin URI: https://www.ozpost.net
  Description: Provides real time shipping quotes from Australia Post, TNT, TransDirect, SmartSend, StarTrack, Couriers Please and Others..
  Author: Cronomic
  Author URI: https://www.cronomic.com
  Version: 2.2.7
  Copyright: © 2020 Cronomic support@cronomic.com
  License: GNU General Public License v3.0
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
// Check if WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	//  Hook into woo
	add_action('woocommerce_shipping_init', 'ozpost_init'); // intialise me
	add_filter('woocommerce_shipping_methods', 'ozpost');   // Give it an ID
	
	function ozpost($methods)
	{
		$methods[] = 'WC_Shipping_Ozpost';
		return $methods;  // Send new methods array back to Woo (registered it)
	}
	
	// end Hook
	
	function ozpost_init()
	{
		class WC_Shipping_Ozpost extends WC_Shipping_Method
		{
			
			public function __construct()
			{
				$this->id = 'ozpost';
				$this->version = '2.2.7';
				$this->host = urlencode(
					preg_replace('/[^A-Za-z0-9\s\s+\.\'\"\-\&]/', '', get_option('blogname'))
				); // Settings->General->Site Title
				$this->method_title = __('Ozpost', 'woocommerce-ozpost');
				$this->title = __('Ozpost MultiQuote', 'woocommerce-ozpost');
				add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
				$this->init();
			}
			
			// end construct //
			
			public function init()
			{
				$this->form_fields = include('formfields.php');
				
				$options = array(
					'enabled',
					'int_disabled',
					'origin_postcode',
					'origin_suburb',
					'store_postcode',
					'subscriptions_email',
					'letter_methods',
					'letter_handling',
					'satchel_methods',
					'pps_handling',
					'ppse_handling',
					'ppsi_handling',
					'ap_discount_1r',
					'ap_discount_2r',
					'ap_discount_3r',
					'ap_discount_1e',
					'ap_discount_2e',
					'ap_discount_3e',
					'parcel_methods',
					'rpp_handling',
					'exp_handling',
					'cod_handling',
					'overseas_parcel_methods',
					'overseas_handling',
					'fastway_methods',
					'fastway_city',
					'fastway_frequentUser',
					'fastway_labels_handling',
					'fastway_satchels_handling',
					'fastway_boxes_handling',
					'fastway_special_baseweight',
					'fastway_fwA5blue',
					'fastway_fwA4blue',
					'fastway_fwA3blue',
					'fastway_fwA3orange',
					'fastway_fwA2blue',
					'fastway_fwBox1',
					'fastway_fwBox2',
					'fastway_fwBox3',
					'hx_methods',
					'hx_handling',
					'hx_user',
					'hx_cust',
					'hx_pass',
					'hx_fuellevy',
					'tnt_methods',
					'tnt_account',
					'tnt_login',
					'tnt_password',
					'tnt_handling',
					'trd_methods',
					'trd_email',
					'trd_password',
					'trd_handling',
					'trd_international_handling',
					'trd_type',
					'skp_methods',
					'skp_customerId',
					'skp_handling',
					'cpl_methods',
					'cpl_handling',
					'cpl_satchel_handling',
					'cpl_international_handling',
					'cpl_account',
					'cpl_key',
					'cpl_ezy_labels',
					'cpl_metro_labels',
					'cpl_500g_satchel',
					'cpl_1kg_satchel',
					'cpl_3kg_satchel',
					'cpl_5kg_satchel',
					'ego_methods',
					'ego_handling',
					'ego_user',
					'ego_password',
					'sta_methods',
					'sta_account',
					'sta_username',
					'sta_password',
					'sta_key',
					'sta_handling',
					'sms_methods',
					'sms_email',
					'sms_password',
					'sms_customer_type',
					'sms_handling',
					'sendle_handling',
					'sendle_methods',
					'hide_parcel_if_domestic_letter',
					'hide_parcel_if_international_letter',
					'hide_parcel_if_satchel',
					'hide_courier_if_ap_can_handle',
					'ri_handling',
					'hp_weight',
					'hp_surcharge',
					'static_rates',
					'cost_on_error_method',
					'table_rates',
					'table_type',
					'default_dimensions',
					'default_weight',
					'tare_weight',
					'tare_dimensions',
					'restrain_dimensions',
					'mail_days',
					'lead_time',
					'deadline',
					'estimated_delivery_format',
					'show_carrier_name',
					'show_handling_fee',
					'show_insurance_fee',
					'show_insurance_cost',
					'show_otherfee',
					'tba_text',
					'handling_text_pre',
					'handling_text_post',
					'insurancefee_text_pre',
					'insurancefee_text_post',
					'otherfee_text_pre',
					'otherfee_text_post',
					'estimation_text_date',
					'estimation_text_days',
					'tax_status',
					'enable_debug',
					'show_parcel',
					'show_errors',
					'test_servers'
				);
				
				foreach ($options as $option) {
					$this->$option = $this->get_option($option);
				}
				
				if (empty($this->subscriptions_email)) {
					$this->subscriptions_email = get_option('admin_email');
					// If the subscription email hasn't been set then use the admin email address //
				}
			}
			
			//  FUNCTION admin_options
			public function admin_options()
			{
				?>
				<style>
					.ozpostHeadings{ color: #fdfdfe ; background-color:#0073aa; border-radius: 3px;}
					.ozpostHeadings:hover{ color: #eeab2b; cursor: pointer; }
					p.ozpostHeadings { margin: 5px 0px; padding: 5px ;padding-left: 10px ;width: 205px ;}
					.form-table td { margin: 0; padding: 0; }
					th.titledesc { padding: 0px ; padding-top: 8px;}
					div.tips{ display: none;}
					span:hover + div.tips {display: block;}
				</style>
				<script type="text/javascript">
					<!--
					function toggle_visibility(id) {
						var e = document.getElementById(id);
					   if (e.style.display === 'block') {
					    e.style.display = 'none';
					   }
					   else {
						 e.style.display = 'block';
					   }
					   return true;
					 }
					 //-->
				   </script>
					 
                    <?php
                    delete_transient( 'ozpost_expires' ) ;
                    $err = 0;
                    
                    // test for cURL (We use this rather than the WP_Http class as cURL is more portable and this code gets ported to many different eCommerce systems //
                    if (!function_exists('curl_init')) {
                        _e('<p><strong>Error: cURL doesn\'t appear to be installed. Unable to continue.</strong>', 'woocommerce-ozpost');
                        exit;
                    }
                    // Test for SimpleXML
                    if (!function_exists('simplexml_load_string')) {
                        _e('<p><strong>Error: SimpleXML doesn\'t appear to be installed. Unable to continue.</strong>', 'woocommerce-ozpost');
                        exit;
                    }
                    
                    // Do Subscription expiration check.Disabling this prevents merchant feedback only. It has no effect on the actual subscription status
                    $storecode = (isset($this->store_postcode) && ($this->store_postcode !== "")) ? $this->store_postcode : $this->origin_postcode;
                    if (false === ($expires = get_transient('ozpost_expires') )) {
                        $expires = $this->get_from_ozpostnet("/quotefor.php?flags=expires&host=$this->host&storecode=" . $storecode);
                        if (is_numeric($expires)) {
                            set_transient('ozpost_expires', $expires, 12 * HOUR_IN_SECONDS);
                        } else {
                            $err = 1;
                        }
                    }
                    ?>
                    <h3><?php
					   if ($err !== 1) {
                         $subscriptionlink = "https://www.ozpost.net/my-account/";  // under dev - needs server update to function
                         
                         $expires = (int) $expires;
                         if ($expires > 0) {
                           _e('<a href=' . "$subscriptionlink " . 'target=_blank >Subscription</a> expires in ' . $expires . ' days', 'woocommerce-ozpost');
                           //$this->expiration_email_handler($expires, $subscriptionlink);
                         }
                         elseif ($expires < 0) {
                           _e('<a href=' . "$subscriptionlink " . 'target=_blank >Your ozpost subscription expired ' . abs($expires) . ' days ago (click to renew)</a> ', 'woocommerce-ozpost');
                           //$this->expiration_email_handler($expires, $subscriptionlink);
                         }
                         else {
                           _e('Subscription expires TODAY!!', 'woocommerce-ozpost');
                         }
					   }
					   elseif ($expires == 0) {
						 _e('Error retrieving Subscription data', 'woocommerce-ozpost');
					   }
					   ?></h3>
					 <span class="button" style="background: #0085ba; color:white;">Tips</span><div class="tips">
					 <?php
					   _e('<strong>Note#1:</strong> This is a self-contained module. You do NOT need to set up any shipping zones for it to function correctly. However zones may be used by Woo itself to limit the destinations that you wish to mail to.<br><br>', 'woocommerce-ozpost');
					   _e('<strong>Note#2:</strong> You do NOT need to set up any shipping classes. These are ignored by the ozpost module.<br><br>', 'woocommerce-ozpost');
					   _e('<strong>Note#3:</strong> For accurate quotes, your products must have accurate weights and dimensions. These are in fact the *only* settings that are important for accurate quotes from ozpost. It is the ozpost servers that will determine whether the contents of any given cart will be quoted as being suitable for Letters or Satchel rates, and it does this based on the entire cart contents rather than individual products, which is what the WooCommerce shipping classes do.<br><br>', 'woocommerce-ozpost');
					   _e('<strong>Note#4:</strong> Shipping Tax: These can get "messy" and can cause quote errors. Woocomerce keeps changing the way these are handled so you may need to experiment for correct results. At time of writing, accurate results require The "Shipping Class Tax" to be based on cart items  <br><br>', 'woocommerce-ozpost');
					   _e('<strong>Note#5:</strong> Other shipping modules. Some people have claimed that the ozpost module disables other shipping modules. This is NOT the case and I couldn\'t make it do that even if I wanted to, which I don\'t. The module plays nicely with all other shipping modules and methods that I\'ve tried. If you are having problems in this regard please check your shipping zones and shipping class settings. Although ozpost doesn\'t use these, the other modules might.<br><br>', 'woocommerce-ozpost');
					 ?>
					 </div
					 <?php
					 // Do ozpost server tests (if indicated)
					 if ((isset($_GET['testservers'])) && ($_GET['testservers'] === "1")) {
					   _e($this->ozpost_network_test(), 'woocommerce-ozpost');
					   $text = 'Refresh';
					   ?>
					   <!-- Do the clear button -->
					   <a class="button-primary" href="<?php echo esc_url($_SERVER['REQUEST_URI'] . "&testservers=0"); ?>"><?php _e('Clear', 'woocommerce-ozpost'); ?></a>
					   <?php
					 }
					 else {
					   $text = 'Test the ozpost servers';
					 }
					 ?>
					 <!--Do the test/refresh button -->
					 <a class="button-primary" href="<?php echo esc_url($_SERVER['REQUEST_URI'] . "&testservers=1"); ?>"><?php _e($text, 'woocommerce-ozpost'); ?></a>
					 <?php
					 $this->generate_settings_html($form_fields = array (), true);
				   }
			//  ! FUNCTION admin_options
			
			// FUNCTION calculate_shipping
			public function calculate_shipping($package = array())
			{
				$fromcode = $this->origin_postcode;
				
				/*
				  ###### Custom modification example: ######
				  The 'fromcode' can be changed 'on the fly' here - This can be used if (for example) you have a warehouse in multiple locatations
				  and wish to use the shipping warehouse closest to the customer:
				  
				  Example:  Assume two warehouses, one in Sydney, one in Adelaide. The following example will make it so that deliveries destined to postcodes
				  2000-2999 will be quoted as being shipped from Sydney, destinations from 5000-5999 will be quoted from Adelade.
				  All other destinations will be quoted from the shipping the postcode set in the admin of the store (ozpost settings)
				  
				  if (($package['destination']['postcode'] >= "2000") && ($package['destination']['postcode'] <= "2999")) { $fromcode = "2000" ; }
				  if (($package['destination']['postcode'] >= "5000") && ($package['destination']['postcode'] <= "5999")) { $fromcode = "5000" ; }
				  
				  PLEASE NOTE: Make a copy of your modifications as they will be lost and need to be re-applied whenever this module gets upangated.
				 */
				
				$topcode = ($package['destination']['postcode']) ? $package['destination']['postcode'] : $fromcode;
				$storecode = (isset($this->store_postcode) && ($this->store_postcode !== "")) ? $this->store_postcode : $this->origin_postcode;
				$dest_country = ($package['destination']['country']) ? $package['destination']['country'] : "AU";
				$dcode = ($dest_country == "AU") ? $topcode : $dest_country;
				$flags = $apflag = 0;
				$maildays = $deadline = $leadtime = $Osub = $Dsub = $fwvars = $tntvars = $transvars = $egovars = $stavars = $smsvars = $hxvars = $cplvars = $sdlvars = $skpvars = "";
				
				// Australia Post letters
				if (is_array($this->letter_methods)) {
					foreach ($this->letter_methods as $method) {
						if ($dest_country === "AU") {
							switch ($method) {
								case "Aust Standard";
									$allowed_methods[] = "SLET";
									$allowed_methods[] = "LL1";
									$allowed_methods[] = "LL2";
									$allowed_methods[] = "LL3";
									break;
								
								case "Aust Standard Insured";
									$allowed_methods[] = "SLETi";
									$allowed_methods[] = "LL1i";
									$allowed_methods[] = "LL2i";
									$allowed_methods[] = "LL3i";
									break;
								
								case 'Aust Priority';
									$allowed_methods[] = "SLETp";
									$allowed_methods[] = "LL1p";
									$allowed_methods[] = "LL2p";
									$allowed_methods[] = "LL3p";
									break;
								
								case 'Aust Priority Insured';
									$allowed_methods[] = "SLETpi";
									$allowed_methods[] = "LL1pi";
									$allowed_methods[] = "LL2pi";
									$allowed_methods[] = "LL3pi";
									break;
								
								case 'Aust Registered';
									$allowed_methods[] = "REGdl";
									$allowed_methods[] = "REGb4";
									break;
								
								case 'Aust Registered Insured';
									$allowed_methods[] = "REGdli";
									$allowed_methods[] = "REGb4i";
									break;
								
								case 'Aust Express';
									$allowed_methods[] = "EXLS";
									$allowed_methods[] = "EXLM";
									$allowed_methods[] = "EXLL";
									break;
								
								case 'Aust Express +sig';
									$allowed_methods[] = "EXLSs";
									$allowed_methods[] = "EXLMs";
									$allowed_methods[] = "EXLLs";
									break;
								
								case 'Aust Express Insured +sig';
									$allowed_methods[] = "EXLSsi";
									$allowed_methods[] = "EXLMsi";
									$allowed_methods[] = "EXLLsi";
									break;
								
								case 'Aust Express Insured (no sig)';
									$allowed_methods[] = "EXLSio";
									$allowed_methods[] = "EXLMio";
									$allowed_methods[] = "EXLLio";
									break;
							} // endswitch (AU)
						}  // not AU
						else {
							switch ($method) {
								case 'Overseas Economy';
									$allowed_methods[] = "IPLEs";
									$allowed_methods[] = "IPLEm";
									$allowed_methods[] = "IPLEl";
									break;
								
								case 'Overseas Economy Insured';
									$allowed_methods[] = "IPLEsi";
									$allowed_methods[] = "IPLEmi";
									$allowed_methods[] = "IPLEli";
									break;
								
								case 'Overseas Economy Prepaid';
									$allowed_methods[] = "IPLEppes";
									$allowed_methods[] = "IPLEppel";
									break;
								
								case 'Overseas Economy Prepaid Insured"';
									$allowed_methods[] = "IPLEppesi";
									$allowed_methods[] = "IPLEppeli";
									break;
								
								case 'Overseas Registered Prepaid Envelope"';
									$allowed_methods[] = "IPLRppes";
									$allowed_methods[] = "IPLRppel";
									break;
								
								case 'Overseas Express Letter (inc sig)';
									$allowed_methods[] = "IPLX";
									break;
								
								case 'Overseas Express Letter Insured (inc sig)';
									$allowed_methods[] = "IPLXi";
									break;
								
								case 'Overseas Prepaid Express Letter (inc sig)';
									$allowed_methods[] = "IPLXppe";
									break;
								
								case 'Overseas Prepaid Express Letter Insured (inc sig)';
									$allowed_methods[] = "IPLXppei";
									break;
								
								case 'Overseas Courier Letter';
									$allowed_methods[] = "IPLC";
									break;
								
								case 'Overseas Courier Letter Insured';
									$allowed_methods[] = "IPLCi";
									break;
								
								case 'Overseas Prepaid Satchel';
									$allowed_methods[] = "IPLCpps";
									break;
								
								case 'Overseas Prepaid Satchel Insured';
									$allowed_methods[] = "IPLCppsi";
									break;
							} // endswitch o/seas
						}  // end else
					}  // end foreach
					if (sizeof($allowed_methods) > 0) {
						$apflag = 1;
					}
				}// No letter methods set //
				
				if ($dest_country === "AU") {
					if (is_array($this->satchel_methods)) {
						foreach ($this->satchel_methods as $method) {
							$allowed_methods[] = $method;
						}
						$apflag = $apflag | 1;
					}
					if (is_array($this->parcel_methods)) {
						foreach ($this->parcel_methods as $method) {
							$allowed_methods[] = $method;
						}
						$apflag = $apflag | 1;
					}
					
					// create the Ego variables
					$type = 0;
					if (is_array($this->ego_methods)) {
						foreach ($this->ego_methods as $method) {
							$allowed_methods[] = $method;
							
							if ($method == "EGOdep2dep") {
								$type = $type | 1;
							}
							if ($method == "EGOdep2door") {
								$type = $type | 2;
							}
							if ($method == "EGOdoor2dep") {
								$type = $type | 4;
							}
						}
						$egovars = "&ego=1";
						$egovars .= "&EGObookingtype=" . $type;
					}
					if (($this->ego_user != "") && ($this->ego_password != "")) {
						$egovars .= "&EGOuser=$this->ego_user&EGOpassword=$this->ego_password";
					}
					
					// create the Fastway variables
					if ((is_array(
							$this->fastway_methods
						)) && ($this->fastway_city != "DIS") && ($this->fastway_city != "")) {
						foreach ($this->fastway_methods as $method) {
							$allowed_methods[] = $method;
						}
						$fwvars = "&FastWay=" . $this->fastway_city;
						if ($this->fastway_frequentUser === "yes") {
							$fwvars .= "f"; // 'f' = frequent user flag/trigger/id
						}
						if ((int)$this->fastway_special_baseweight > 0) {
							$fwvars .= "s" . $this->fastway_special_baseweight; // 's' = Special rates
						}
						if ($this->fastway_fwA5blue > 0) {
							$fwvars .= "&fwA5blue=" . $this->fastway_fwA5blue;
						}
						if ($this->fastway_fwA4blue > 0) {
							$fwvars .= "&fwA4blue=" . $this->fastway_fwA4blue;
						}
						if ($this->fastway_fwA3blue > 0) {
							$fwvars .= "&fwA3blue=" . $this->fastway_fwA3blue;
						}
						if ($this->fastway_fwA3orange > 0) {
							$fwvars .= "&fwA3orange=" . $this->fastway_fwA3orange;
						}
						if ($this->fastway_fwA2blue > 0) {
							$fwvars .= "&fwA2blue=" . $this->fastway_fwA2blue;
						}
						if ($this->fastway_fwBox1 > 0) {
							$fwvars .= "&fwBox1=" . $this->fastway_fwBox1;
						}
						if ($this->fastway_fwBox2 > 0) {
							$fwvars .= "&fwBox2=" . $this->fastway_fwBox2;
						}
						if ($this->fastway_fwBox3 > 0) {
							$fwvars .= "&fwBox3=" . $this->fastway_fwBox3;
						}
					}
					
					// create the TNT variables
					if ((is_array($this->tnt_methods)) && ($this->tnt_account != "")) {
						foreach ($this->tnt_methods as $method) {
							$allowed_methods[] = $method;
						}
						$tntvars = "&TNTaccount=" . $this->tnt_account . "&TNTusername=" . $this->tnt_login . "&TNTpassword=" . $this->tnt_password;
					}
					
					// create the StarTrack variables
					if ((is_array($this->sta_methods)) && ($this->sta_username != "")) {
						foreach ($this->sta_methods as $method) {
							$allowed_methods[] = $method;
						}
						$stavars = "&STAaccount=" . $this->sta_account . "&STAusername=" . $this->sta_username . "&STApassword=" . $this->sta_password . "&STAkey=" . $this->sta_key;
					}
					
					// create the SmartSend variables
					if ((is_array($this->sms_methods)) && ($this->sms_email != "")) {
						foreach ($this->sms_methods as $method) {
							$allowed_methods[] = $method;
						}
						$smsvars = "&SMSemail=" . $this->sms_email . "&SMStype=" . $this->sms_customer_type . "&SMSpassword=" . $this->sms_password;
					}
					
					// create the Hunter Express variables
					if ((is_array($this->hx_methods)) && ($this->hx_cust != "")) {
						foreach ($this->hx_methods as $method) {
							$allowed_methods[] = $method;
						}
						$hxvars = "&HXusername=" . $this->hx_user . "&HXpassword=" . $this->hx_pass . "&HXcustomer=" . $this->hx_cust . "&HXfuellevy=" . $this->hx_fuellevy;
					}
					
					/// create the sendle variable
					if ((($this->sendle_methods) !== "") && ($this->sendle_methods !== "Disabled")) {
						$allowed_methods[] = "SDL";
						$sdlvars = "&sendle=$this->sendle_methods";
					}
				} else {  //  Not Australia
					if ($this->int_disabled == 'yes') {
						return;
					} // No international global setting - clean exit - no errors. We aint even here.  admin setting
					
					if ($dest_country) { // do we even have a country?
						if (is_array($this->overseas_parcel_methods)) {
							foreach ($this->overseas_parcel_methods as $method) {
								$allowed_methods[] = $method;
							}
						}
						// create the Skippy Post variables //
						if (is_array($this->skp_methods)) { //  && ($this->skp_customerId != "")) {
							foreach ($this->skp_methods as $method) {
								$allowed_methods[] = $method;
							}
							$skpvars = "&skp=1";
							if ($this->skp_customerId != "") {
								$skpvars .= "&SKPcust=" . $this->skp_customerId;
							}
						}
					}
				}
				
				// create the Transdirect variables  -  Could be domestic or international //
				if (is_array($this->trd_methods)) {
					foreach ($this->trd_methods as $method) {
						$allowed_methods[] = $method;
					}
					$transvars = "&TransDirect=1";
					$transvars .= "&TRDtype=" . $this->trd_type;
					if ($this->trd_email) {
						$transvars .= "&TRDusername=" . $this->trd_email;
					}
					if ($this->trd_password) {
						$transvars .= "&TRDpassword=" . $this->trd_password;
					}
				}
				
				// create the Couriers Please variables -  Could be domestic or international
				if (is_array($this->cpl_methods)) {
					foreach ($this->cpl_methods as $method) {
						$allowed_methods[] = $method;
					}
					if (($this->cpl_account) && ($this->cpl_key)) {
						$cplvars = "&CPLacct=" . $this->cpl_account . "&CPLkey=" . $this->cpl_key;
					} else {
						$cplvars = "&CPLv3=1";
					}
					if ($this->cpl_metro_labels > 0) {
						$cplvars .= "&CPLml=" . $this->cpl_metro_labels;
					}
					if ($this->cpl_ezy_labels > 0) {
						$cplvars .= "&CPLel=" . $this->cpl_ezy_labels;
					}
					if ($this->cpl_500g_satchel > 0) {
						$cplvars .= "&CPLsat0=" . $this->cpl_500g_satchel;
					}
					if ($this->cpl_1kg_satchel > 0) {
						$cplvars .= "&CPLsat1=" . $this->cpl_1kg_satchel;
					}
					if ($this->cpl_3kg_satchel > 0) {
						$cplvars .= "&CPLsat2=" . $this->cpl_3kg_satchel;
					}
					if ($this->cpl_5kg_satchel > 0) {
						$cplvars .= "&CPLsat3=" . $this->cpl_5kg_satchel;
					}
				}
				
				if (sizeof($allowed_methods) == 0) {
					if (function_exists('wc_add_notice')) {
						wc_add_notice(
							__(
								'Error: Ozpost shipping is active but no methods have been enabled',
								'woocommerce-ozpost'
							),
							'error'
						);
					}
					return;
				}

//if($this->show_errors === "yes") $allowed_methods[] = "Error" ;
				// if (($this->enable_debug === "yes") && (!is_page('checkout'))) {
				if (($this->enable_debug === "yes")) {
					if (function_exists('wc_add_notice')) {
						wc_add_notice(
							__(
								"DEBUG (A): Allowed Methods<div><textarea rows=7 cols=100>" . print_r(
									$allowed_methods,
									true
								) . "</textarea></div>",
								'woocommerce-ozpost'
							),
							'notice'
						);
					}
				}
				
				$allowed_methods[] = "Error";
				
				if ($this->hide_parcel_if_satchel == "yes") {
					$flags = $flags | 2;
				}
				if ($this->hide_courier_if_ap_can_handle == "yes") {
					$flags = $flags | 4;
				}
				if ($this->hide_parcel_if_domestic_letter == "yes") {
					$flags = $flags | 8;
				}  //  hide all parcels if letter rates and domestic (supercedes flags=1)
				if ($this->hide_parcel_if_international_letter == "yes") {
					$flags = $flags | 16; //  hide all parcels if letter rates and overseas (supercedes flags=1)
				}
				
				$mail = 0;  //  Days we mail on. (bitmapped)
				if (is_array($this->mail_days)) {
					if (in_array("MON", $this->mail_days)) {
						$mail = $mail | 1;
					}
					if (in_array("TUE", $this->mail_days)) {
						$mail = $mail | 2;
					}
					if (in_array("WED", $this->mail_days)) {
						$mail = $mail | 4;
					}
					if (in_array("THU", $this->mail_days)) {
						$mail = $mail | 8;
					}
					if (in_array("FRI", $this->mail_days)) {
						$mail = $mail | 16;
					}
					if (in_array("SAT", $this->mail_days)) {
						$mail = $mail | 32;
					}
					if (in_array("SUN", $this->mail_days)) {
						$mail = $mail | 64;
					}
					$maildays = "&maildays=" . $mail;
				}
				
				$ef = ($this->estimated_delivery_format == "Date") ? "&ef=1" : "&ef=0";
				$deadline = ($this->deadline > 0) ? $deadline = "&deadline=" . $this->deadline : "&deadline=10"; // deadline for same day mailings
				$leadtime = ($this->lead_time > 0) ? $leadtime = "&leadtime=" . $this->lead_time : "&leadtime=0";  // leadtime for delayed mailings
				
				$vars = $cplvars . $smsvars . $stavars . $fwvars . $tntvars . $egovars . $hxvars . $transvars . $skpvars . $sdlvars;
				
				$AllSat = "&AllSat=1"; // if satchels are filtered here return all, else server only returns most suited.
				// Get and use Suburb names if available - (mainly for couriers due to the way their zones are organised)
				if (($this->origin_suburb != "") && ($this->origin_suburb != "Enter the NAME of the suburb you ship from")) {
					$Osub = "&Osub=" . urlencode($this->origin_suburb);
				}
				if ((isset($package['destination']['address_2'])) && (($package['destination']['address_2']) != "")) {
					$Dsub = "&Dsub=" . urlencode($package['destination']['address_2']);
				}
				
				if ($Dsub == "") {
					if ((isset($package['destination']['city'])) && (($package['destination']['city']) != "")) {
						$Dsub = "&Dsub=" . urlencode($package['destination']['city']);
					}
				}
////////////////// *************************************************************** /////////////////////////////////////
				global $parcelitems, $parcelweight, $parcelvalue, $wpdb, $shippingtaxrate;
				
				if ('yes' === get_option('woocommerce_shipping_cost_requires_address')) {
					if (!$Dsub) {
						if (function_exists('wc_add_notice')) {
							wc_add_notice(
								__('Accurate shipping costs require a Suburb name', 'woocommerce-ozpost'),
								'notice'
							);
						}
					} // return ;
				}
				
				// default dimensions //
				$defaultDimensions = array(0, 0, 0);
				if ($this->default_dimensions) {
					$defaultDimensions = explode(',', $this->default_dimensions);
				}
				
				$index = $dg = $shippingtaxrate = 0;
				$taxrate = 1;
				$items = array();
				//  get Aust Tax rate
				$taxQuery = $wpdb->get_results(
					"SELECT `tax_rate` FROM {$wpdb->prefix}woocommerce_tax_rates WHERE `tax_rate_country` = 'AU'"
				);
				if ($wpdb->num_rows > 0) {
					$taxrate = $taxQuery[0]->tax_rate;
					if ($taxrate <= 0) {
						$taxrate = 1;
					}  // prevent possible division by zero errors /
					else {
						$taxQuery = $wpdb->get_results(
							"SELECT `tax_rate` FROM {$wpdb->prefix}woocommerce_tax_rates WHERE `tax_rate_country` = 'AU' AND `tax_rate_shipping` = 1 "
						);
						if ($wpdb->num_rows > 0) {
							$shippingtaxrate = $taxQuery[0]->tax_rate;
						}
					}
				}
				if ($shippingtaxrate <= 0) {
					$shippingtaxrate = 1;
				} // prevent possible division by zero errors /
				if ($shippingtaxrate > 1) {
					$this->tax_status = "taxable";
				}
				
				$dimensionUnit = get_option('woocommerce_dimension_unit');
				$weightUnit = get_option('woocommerce_weight_unit');
				
				// loop through cart extracting contents //
				foreach ($package['contents'] as $item => $values) {
					if ($values['quantity'] > 0 && $values['data']->is_virtual() === false && $values['data']->is_downloadable() === false) {
						$item = $item;
						$product = wc_get_product($values['product_id']);  // Get the product
						$variants = (isset($values['data']->variation_id)) ? get_post_meta(
							$values['data']->get_parent_id()
						) : false; // and variants
						$product->weight = ($values['data']->get_weight()) ? $values['data']->get_weight() : $variants['_weight'][0];
						$product->length = ($values['data']->get_length()) ? $values['data']->get_length() : $variants['_length'][0];
						$product->width = ($values['data']->get_width()) ? $values['data']->get_width() : $variants['_width'][0];
						$product->height = ($values['data']->get_height()) ? $values['data']->get_height() : $variants['_height'][0];
						$product->price = ($values['data']->get_price()) ? $values['data']->get_price() : $variants['_price'][0];
						
						
						$weight = $product->weight;
						if ($weight == 0) {
							$weight = $this->default_weight;
						}
						
						switch ($weightUnit) { // convert to gms
							case "kg":
							case "Kilogram":
								$weight = $weight * 1000;
								break;
							case "oz":
							case "Ounce":
								$weight = $weight * 29.6;
								break;
							case "lb":
							case "Pound":
								$weight = $weight * 453.6;
								break;
						}
						
						if ($weight > 0) {
							$dgx = ($product->get_attribute('DG'));
							if ($dgx > 0) {
								wc_add_notice(
									__(
										'Info: Dangerous Goods ID:' . $product->get_id() . ' : ' . $product->get_name(),
										'woocommerce-ozpost'
									),
									'notice'
								);
								if (($dgx == 2) && ($dg != 1)) {
									$dg = 2;
								} else {
									$dg = 1;
								}
							}
							
							
							if ((float)$product->length == 0) {
								$product->length = $defaultDimensions[0];
							}
							if ((float)$product->width == 0) {
								$product->width = $defaultDimensions[1];
							}
							if ((float)$product->height == 0) {
								$product->height = $defaultDimensions[2];
							}
							
							switch ($dimensionUnit) { // convert to mm
								case "m":
								case "Meter":
									(int)$product->height = $product->height * 1000.0;
									(int)$product->width = $product->width * 1000.0;
									$product->length = $product->length * 1000.0;
									break;
								case "cm":
								case "Centimeter":
									(int)$product->height = $product->height * 10.0;
									(int)$product->width = $product->width * 10.0;
									$product->length = $product->length * 10.0;
									break;
								case "in":
								case "Inch":
									(int)$product->height = $product->height * 25.4;
									(int)$product->width = $product->width * 25.4;
									(int)$product->length = $product->length * 25.4;
									break;
							}
							
							$price = ((wc_tax_enabled() === false) || (get_option(
										'woocommerce_prices_include_tax'
									) === 'yes')) ? $product->price : (($product->price) + (($product->price) / $taxrate));
							$items[] = array(
								'Length' => $product->length,
								'Width' => $product->width,
								'Height' => $product->height,
								'Weight' => $weight,
								'Qty' => $values['quantity'],
								'Insurance' => $price
							);
							
							// Save these in case of error - We use them to calculate static rates //
							$parcelweight += $weight * $values['quantity'];
							$parcelitems += $values['quantity'];
							$parcelvalue += $price;
							
							$index++;
						}  // No weight = No shipping //
					}  //   Didn't need shipping //
				}  // next item
				
				if ($index == 0) { // No products to quote (all products are virtual or downloads)
					if ($this->show_errors === "yes") {
						if (function_exists('wc_add_notice')) {
							wc_add_notice(__('No shippable products (ozpost module)', 'woocommerce-ozpost'), 'notice');
						}
					}
					return;
				}
				if ($dg === 1) {
					$vars .= "&dg=1";
				}
				if ($dg === 2) {
					$vars .= "&dg=2";
				}
				
				$control_data = "&tare_weight=$this->tare_weight&restrain_dimensions=$this->restrain_dimensions&tare_dimensions=$this->tare_dimensions&enable_debug=$this->enable_debug";
				$control_data .= "&fromcode=$fromcode$Osub&destcode=$dcode$Dsub&flags=$flags&host=$this->host&storecode=$storecode&version=$this->version$vars$ef$deadline$maildays$leadtime$AllSat";
				
				$query = "/quotefor.php?host=$this->host" . "_" . "$storecode";
				$result = $this->get_from_ozpostnet($query, $items, $control_data);
				
				if (((substr($result, 0, 7)) != "<error>") && ($result)) {
					libxml_use_internal_errors(true);
					$xmlQuotes = simplexml_load_string("$result");
					
					if ($xmlQuotes !== false) {
						$sub = urldecode((string)($xmlQuotes->information[0]->fromsuburb));
						if ($this->origin_suburb != $sub) {
							$this->update_suburb($sub);
						}
						$days = intval($xmlQuotes->information[0]->expires);
						//       $days = 2 ;
						$this->expiration_email_handler(
							$days,
							"https://shop.ozpost.net/subscriptions?name=" . $host = $this->host . "&postcode=" . $storecode
						);
						
						if (($this->show_parcel === "yes") && $days >= 0 && (!is_page(
								'XcheckoutX'
							))) {  // Don't display on checkout page because it seems to prevent the page from completely loading.
							if (function_exists('wc_add_notice')) {
								if ($parcelitems > 1) {
									wc_add_notice(
										__(
											"Parcel Build<div><textarea rows=7 cols=100>" . $xmlQuotes->parcel_build . "</textarea></div>",
											'woocommerce-ozpost'
										),
										'notice'
									);
								} else {
									wc_add_notice(
										__(
											"Product data<div>" . $xmlQuotes->information[0]->calculated_parcel_weight_kg . "kg, Dims " . $xmlQuotes->information[0]->calculated_parcel_dims_cm . "</div>",
											'woocommerce-ozpost'
										),
										'notice'
									);
								}
							}
						}
						if (($this->enable_debug === "yes") && (!is_page('XcheckoutX'))) {
							if (function_exists('wc_add_notice')) {
								wc_add_notice(
									__(
										"DEBUG (B): Server returned<div><textarea rows=25 cols=250>" . print_r(
											$xmlQuotes,
											true
										) . "</textarea></div>",
										'woocommerce-ozpost'
									),
									'notice'
								);
							}
						}
						/////////////
						$displayed = 0; // flags to prevent superflious Satchels/Boxes being presented
						//bitmapped:
						// 1 Prepaid Satchels
						// 2 Express Satchel
						// 4 Express +Signature
						// 8  Standard Air Satchel
						// 16 Standard Air Satchel +sig
						// 32 FW Satchels
						// 64 Prepaid Satchels + sig
						// 128 CnS Satch
						// 256 Express Insured (inc Sign)  2/1
						// 512 Insured Satchel  (inc Sign)
						// 1024 STA  Sats  2/8
						// 2048 CPL Sats 2/32
						// 4096 Standard Air Satchel Insured +sig
						// 8192 Smart Send  AAE Satchels 2/128
						// 16384 unused
						// 32768 Smart Send  AAE Prepaid Satchel (receipted) 3/2
						// 65536 Smart Send  AAE Prepaid Satchel (insured) 3/2
						// 131072 Smart Send AE Satchel (receipted + insured) 3/4
						// 262144  FW Boxes
						// 524288 FW labels
						// 1048576 CnS Express
						// 2097152  Standard Air Satchel Insured
						// 4194304 Insured Satchel without signature
						// 8388608 Express Insured Satchel without signature
						// 16777216 Express Air Satchel
						// 33554432 Express Air Satchel Insured
						// 67108864 Courier Air Satchel
						// 134217728 Courier Air Satchel Insured
						//  loop through the quotes retrieved to get handling fees and filter according to the flags above
						foreach ($xmlQuotes->quote as $quote) {       // Quotes returned
							if (in_array($quote->id, $allowed_methods)) {  // Continue if an allowed method
								$handlingFee = null; // nullify handling fee - We test to ensure its set for a valid quote (unset means the result was filtered)
								
								switch ($quote->id) {    //  Set the handling fee and/or make custom cost adjustments. Also provides filtering //
									case "Error":
										if ($quote->cost == 0.05) {
											wc_add_notice(
												__(
													(string)$quote->carrier . " : " . (string)$quote->description,
													'woocommerce-ozpost'
												),
												'error'
											);
										} else {
											if ($this->show_errors === "yes") {
												if (((string)$quote->carrier === "Australia Post") && ($apflag !== 1)) {
													break;
												}   // Skip if its an Austrlalia Post error and we don't have any of their methods enabled
												
												wc_add_notice(
													__(
														"<div>Error: " . (string)$quote->carrier . ": " . (string)$quote->description . "</div>",
														'woocommerce-ozpost'
													),
													'error'
												);
											}
										}
										break;
									
									case "SLET":
									case "LL1":
									case "LL2":
									case "LL3":   // aust letter
									case "SLETp":
									case "LL1p":
									case "LL2p":
									case "LL3p":  // aust priority
									case "IPLEs":
									case "IPLEm":
									case "IPLEl":  // overseas economy letters
									case "IPLEppes":
									case "IPLEppel":  // overseas Economy Prepaid Envelope
										$handlingFee = $this->letter_handling;
										break;
									
									case "SLETi":
									case "LL1i":
									case "LL2i":
									case "LL3i": // aust insured letter
									case "SLETpi":
									case "LL1pi":
									case "LL2pi":
									case "LL3pi":  // aust  insured priority
									case "IPLEsi":
									case "IPLEmi":
									case "IPLEli":  // overseas economy Insured letters
									case "IPLEppesi":
									case "IPLEppeli":  // overseas Economy Prepaid Insured Envelope
									case "REGdl":
									case "REGb4":
									case "REGdli":
									case "REGb4i": // aust reg and reg/ins
									case "IPLRppes":
									case "IPLRppel":  // Overseas Registered Prepaid Envelope
										$handlingFee = $this->letter_handling + $this->ri_handling;
										break;
									
									
									case "EXLS":
									case "EXLM":
									case "EXLL":  // aust express letters
									case "IPLX":
									case "IPLXppe":   // Overseas express letters / prepaid express
									case "IPLC":
									case "IPLXpps":   // Overseas Courier letters / prepaid Courier
										$handlingFee = $this->letter_handling + $this->exp_handling;
										break;
									
									
									case "EXLSs":
									case "EXLMs":
									case "EXLLs":  // aust express letters +sig
									case "EXLSio":
									case "EXLMio":
									case "EXLLio":  // aust express letters insured (no sig)
									case "EXLSsi":
									case "EXLMsi":
									case "EXLLsi":  // aust express letters insured +sig
									case "IPLXi":
									case "IPLXppei":   // Overseas express letters Insured
									case "IPLCi":
									case "IPLXppsi":   // Overseas Courier letters Insured / prepaid Courier
										$handlingFee = $this->letter_handling + $this->exp_handling + $this->ri_handling;
										break;
									
									////////  satchels ////
									case "PPS5":
										if (!($displayed & 1)) {   //  no addons only one size per group
											$d = (float)($this->ap_discount_1r) / 100;
											$handlingFee = $this->pps_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 1;
										}
										break;
									
									case "PPS1":
										if (!($displayed & 1)) {   //  no addons  only one per group
											// $d = (float) ($this->ap_discount_2r) / 100;
											$handlingFee = $this->pps_handling;
											
											// (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
											$displayed = $displayed | 1;
										}
										break;
									
									case "PPS3":
										if (!($displayed & 1)) {   //  no addons  only one per group
											$d = (float)($this->ap_discount_2r) / 100;
											$handlingFee = $this->pps_handling;
											
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 1;
										}
										break;
									
									case "PPS5K":
										if (!($displayed & 1)) {   //   no addons only one per group
											$d = (float)($this->ap_discount_3r) / 100;
											$handlingFee = $this->pps_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 1;
										}
										break;
									
									case "PPS5r":
										if (!($displayed & 64)) {   //  +sig only one per group
											$d = (float)($this->ap_discount_1r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 64;
										}
										break;
									
									case "PPS1r":
										if (!($displayed & 64)) {   //  +sig only one per group
											//   $d = (float) ($this->ap_discount_1r) / 100;
											$handlingFee = $this->ppsi_handling;
											//   (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
											$displayed = $displayed | 64;
										}
										break;
									
									case "PPS3r":
										if (!($displayed & 64)) {   //  +sig  only one per group
											$d = (float)($this->ap_discount_2r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 64;
										}
										break;
									
									case "PPS5Kr":
										if (!($displayed & 64)) {   //  +sig  only one per group
											$d = (float)($this->ap_discount_3r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 64;
										}
										break;
									
									case "PPS5i":
										if (!($displayed & 512)) {   //  +insuranace  +sig only one per group
											$d = (float)($this->ap_discount_1r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 512;
										}
										break;
									
									case "PPS1i":
										if (!($displayed & 512)) {   //  +insuranace  +sig only one per group
											//   $d = (float) ($this->ap_discount_1r) / 100;
											$handlingFee = $this->ppsi_handling;
											//  (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
											$displayed = $displayed | 512;
										}
										break;
									
									case "PPS3i":
										if (!($displayed & 512)) {   //   +insuranace  +sig only one per group
											$d = (float)($this->ap_discount_2r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 512;
										}
										break;
									
									case "PPS5Ki":
										if (!($displayed & 512)) {   //  +insuranace +sig  only one per group
											$d = (float)($this->ap_discount_3r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 512;
										}
										break;
									
									case "PPS5io":
										if (!($displayed & 4194304)) {   //  +insuranace (no sig)  only one per group
											$d = (float)($this->ap_discount_1r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 4194304;
										}
										break;
									
									case "PPS1io":
										if (!($displayed & 4194304)) {   //  +insuranace (no sig)  only one per group
											//    $d = (float) ($this->ap_discount_1r) / 100;
											$handlingFee = $this->ppsi_handling;
											//  (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
											$displayed = $displayed | 4194304;
										}
										break;
									
									case "PPS3io":
										if (!($displayed & 4194304)) {   //   +insuranace (no sig) only one per group
											$d = (float)($this->ap_discount_2r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 4194304;
										}
										break;
									
									case "PPS5Kio":
										if (!($displayed & 4194304)) {   //  +insuranace(no sig) only one per group
											$d = (float)($this->ap_discount_3r) / 100;
											$handlingFee = $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 4194304;
										}
										break;
									
									/////////////////// Express satchels /////////////////////////////////////
									case "PPSE5":  //  basic
										if (!($displayed & 2)) {   //  only one per group
											$d = (float)($this->ap_discount_1e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 2;
										}
										break;
									
									case "PPSE1":
										if (!($displayed & 2)) {
											$handlingFee = $this->ppse_handling;
											$displayed = $displayed | 2;
										}
										break;
									
									case "PPSE3":
										if (!($displayed & 2)) {
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 2;
										}
										break;
									
									case "PPSE5K":
										if (!($displayed & 2)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 2;
										}
										break;
									
									case "PPSP5":  // +sig,
										if (!($displayed & 4)) {   //  only one per group
											$d = (float)($this->ap_discount_1e) / 100;
											$handlingFee = $this->ppse_handling + $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 4;
										}
										break;
									
									case "PPSP1": // +sig,
										if (!($displayed & 4)) {   //  only one per group
											$handlingFee = $this->ppse_handling;
											$displayed = $displayed | 4;
										}
										break;
									
									case "PPSP3": // +sig,
										if (!($displayed & 4)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 4;
										}
										break;
									
									case "PPSP5K": // +sig,
										if (!($displayed & 4)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 4;
										}
										break;
									
									case "PPSP5i": // +sig, +insurance
										if (!($displayed & 256)) {   //  only one per group
											$d = (float)($this->ap_discount_1e) / 100;
											$handlingFee = $this->ppse_handling + $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 256;
										}
										break;
									
									case "PPSP3i": // +sig, +insurance
										if (!($displayed & 256)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 256;
										}
										break;
									
									case "PPSP1i": // +sig, +insurance
										if (!($displayed & 256)) {   //  only one per group
											$handlingFee = $this->ppse_handling;
											$displayed = $displayed | 256;
										}
										break;
									
									case "PPSP5Ki": // +sig, +insurance
										if (!($displayed & 256)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 256;
										}
										break;
									
									case "PPSP5io": // +insurance only no sig (must be under $300 value)
										if (!($displayed & 8388608)) {   //  only one per group
											$d = (float)($this->ap_discount_1e) / 100;
											$handlingFee = $this->ppse_handling + $this->ppsi_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 8388608;
										}
										break;
									
									case "PPSP1io": // +insurance only no sig (must be under $300 value)
										if (!($displayed & 8388608)) {   //  only one per group
											$handlingFee = $this->ppse_handling;
											$displayed = $displayed | 8388608;
										}
										break;
									
									case "PPSP3io"; // +insurance only no sig (must be under $300 value)
										if (!($displayed & 8388608)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 8388608;
										}
										break;
									
									case "PPSP5Kio"; // +insurance only no sig (must be under $300 value)
										if (!($displayed & 8388608)) {   //  only one per group
											$d = (float)($this->ap_discount_2e) / 100;
											$handlingFee = $this->ppse_handling;
											(float)$quote->cost = (float)$quote->cost - ((float)$quote->cost * $d);
											$displayed = $displayed | 8388608;
										}
										break;
									
									///////////  parcels aust
									case "REG":
										$handlingFee = $this->rpp_handling + $this->ri_handling;
										break;
									case "RPP":
										$handlingFee = $this->rpp_handling;
										break;
									case "RPPi":
										$handlingFee = $this->rpp_handling + $this->ri_handling;
										break;
									case "RPPio":
										$handlingFee = $this->rpp_handling + $this->ri_handling;
										break;
									case "EXP":
										$handlingFee = $this->rpp_handling + $this->exp_handling;
										break;
									case "PLT":
										$handlingFee = $this->rpp_handling + $this->exp_handling + $this->ri_handling;
										break;
									case "PLTi":
										$handlingFee = $this->rpp_handling + $this->exp_handling + $this->ri_handling;
										break;
									case "PLTio":
										$handlingFee = $this->rpp_handling + $this->exp_handling + $this->ri_handling;
										break;
									case "COD":
										$handlingFee = $this->cod_handling + $this->ri_handling;
										break;
									
									
									// parcels international
									case "IPec":// International Post Economy Air
									case "SEA": // International Post Economy Sea
									case "IPS":   // International Post Standard Air
										$handlingFee = $this->overseas_handling;
										break;
									
									case "IPS500g":   // International Post Standard 500g Satchel
									case "IPS1k":   // International Post Standard 1kg Satchel
									case "IPS2k":   // International Post Standard 2kg Satchel
									case "IPS5k":   // International Post Standard 5kg Satchel
										if (!($displayed & 8)) {
											$handlingFee = $this->overseas_handling;
											$displayed = $displayed | 8;
										}
										break;
									
									case "IPecs":  // International Post Economy +sig
									case "IPSs":   // International Post Standard +sig
										$handlingFee = $this->overseas_handling + $this->ri_handling;
										break;
									
									case "IPS500gs":   // International Post Standard 500g Satchel +sig
									case "IPS1ks":   // International Post Standard 1kg Satchel +sig
									case "IPS2ks":   // International Post Standard 2kg Satchel +sig
									case "IPS5ks":   // International Post Standard 5kg Satchel +sig
										if (!($displayed & 16)) {
											$handlingFee = $this->overseas_handling + $this->ri_handling;
											$displayed = $displayed | 16;
										}
										break;
									
									case "IPeci":
									case "SEAi": // International Post Economy Insured
									case "IPSi":   // International Post Standard Insured
										$handlingFee = $this->overseas_handling + $this->ri_handling;
										break;
									
									case "IPS500gi":   // International Post Standard 500g Satchel Insured
									case "IPS1ki":   // International Post Standard 1kg Satchel Insured
									case "IPS2ki":   // International Post Standard 2kg Satchel Insured
									case "IPS5ki":   // International Post Standard 5kg Satchel Insured
										if (!($displayed & 2097152)) {
											$handlingFee = $this->overseas_handling + $this->ri_handling;
											$displayed = $displayed | 2097152;
										}
										break;
									
									case "IPecsi":  // International Post Economy Insured +sig
									case "IPSsi":   // International Post Standard Insured +sig
										$handlingFee = $this->overseas_handling + $this->ri_handling;
										break;
									
									case "IPS500si":  // International Post Standard 500g Satchel Insured  +sig
									case "IPS1ksi":   // International Post Standard 1kg Satchel Insured  +sig
									case "IPS2ksi":   // International Post Standard 2kg Satchel Insured  +sig
									case "IPS5ksi":   // International Post Standard 5kg Satchel Insured  +sig
										if (!($displayed & 4096)) {
											$handlingFee = $this->overseas_handling + $this->ri_handling;
											$displayed = $displayed | 4096;
										}
										break;
									
									case "IPEs":    // International Post Express (inc sig)
										
										$handlingFee = $this->overseas_handling + $this->exp_handling;
										break;
									
									case "IPE500g": // International Post Express 500g Satchel
									case "IPE1k": // International Post Express 1kg Satchel
									case "IPE2k": // International Post Express 2kg Satchel
										if (!($displayed & 16777216)) {
											$handlingFee = $this->overseas_handling + $this->ri_handling;
											$displayed = $displayed | 16777216;
										}
										break;
									
									case "IPC500g": // International Post Courier Satchel 500g
									case "IPC1k": // International Post Courier 1kg Satchel
										if (!($displayed & 67108864)) {
											$handlingFee = $this->overseas_handling + $this->exp_handling;
											$displayed = $displayed | 67108864;
										}
										break;
									
									case "IPEsi": // International Post Express Insured (inc sig)
										$handlingFee = $this->overseas_handling + $this->exp_handling + $this->ri_handling;
										break;
									
									case "IPE500gi": // International Post Express 500g Satchel Insured
									case "IPE1ki": // International Post Express 1kg Satchel Insured
									case "IPE2ki": // International Post Express 2kg Satchel Insured
										if (!($displayed & 33554432)) {
											$handlingFee = $this->overseas_handling + $this->exp_handling + $this->ri_handling;
											$displayed = $displayed | 33554432;
										}
										break;
									
									case "IPC500gi": // International Post Courier Satchel 500g Insured
									case "IPC1ki": // International Post Courier 1kg Satchel Insured
										if (!($displayed & 134217728)) {
											$handlingFee = $this->overseas_handling + $this->exp_handling + $this->ri_handling;
											$displayed = $displayed | 134217728;
										}
										break;
									
									////////////////////////////////////////
									//  TNT //
									case "TNT712": // 9am Express
									case "TNTEX10": // 10:00 am
									case "TNTEX12": // 12:00 pm
									case "TNT75":
									case "TNT76": // Road Express //
									case "TNT717B": //Technology Express - Sensitive Express"//
									case "TNT73":
										$handlingFee = $this->tnt_handling;
										break;
									//             case "TNT73": $handlingFee = (floatval($xmlQuotes->information[0]->insuredvalue)  * 0.1); break;   // Modification Example. Customer wants a handling fee of 10% of the ORDER VALUE for TNT non insured parcels (use this line instead of previous line)
									//  TNT Insured //
									case "TNT712i": // 9am Express
									case "TNTEX10i": // 10:00 am
									case "TNTEX12i": // 12:00 pm
									case "TNT75i":
									case "TNT76i": // Road Express //
									case "TNT717Bi": //Technology Express - Sensitive Express"//
									case "TNT73i":
										$handlingFee = $this->tnt_handling + $this->ri_handling;
										break;
									//              case "TNT73i": $handlingFee = ($quote->cost * 0.2); break;   // Modification Example. Customer wants a handling fee of 20% of the SHIPPING COST for TNT insured parcels  (use this line instead of previous line)
									///  SmartSend
									case "SMSCPR":
									case "SMSTNT9":
									case "SMSTNT12":
									case "SMSTNT5":
									case "SMSTNTR":
									case "SMSFW":
									case "SMSFWL":
									case "SMSFWS":
									case "SMSAAEP":
									case "SMSAAES":
									case "SMSAAER":
									case "SMSCPRr":
									case "SMSTNT9r":
									case "SMSTNT12r":
									case "SMSTNT5r":
									case "SMSTNTRr":
									case "SMSFWr":
									case "SMSFWLr":
									case "SMSFWSr":
									case "SMSAAEPr":
									case "SMSAAESr":
									case "SMSAAERr":
									case "SMSCPRi":
									case "SMSTNT9i":
									case "SMSTNT12i":
									case "SMSTNT5i":
									case "SMSTNTRi":
									case "SMSFWi":
									case "SMSFWLi":
									case "SMSFWSi":
									case "SMSAAEPi":
									case "SMSAAESi":
									case "SMSAAERi":
									case "SMSCPRri":
									case "SMSTNT9ri":
									case "SMSTNT12ri":
									case "SMSTNT5ri":
									case "SMSTNTRri":
									case "SMSFWri":
									case "SMSFWLri":
									case "SMSFWSri":
									case "SMSAAEPri":
									case "SMSAAESri":
									case "SMSAAERri":
										$handlingFee = $this->sms_handling;
										break;
									
									
									//  SmartSend AAE Satchels
									case "SMSAAE1K":
									case "SMSAAE3K":
									case "SMSAAE5K":
										if (!($displayed & 8192)) {
											$handlingFee = $this->sms_handling;
											$displayed = $displayed | 8192;
										}
										break;
									
									//   SmartSend Receipted Delivery ///
									case "SMSAAE1Kr":
									case "SMSAAE3Kr":
									case "SMSAAE5Kr":
										if (!($displayed & 32768)) {
											$handlingFee = $this->sms_handling;
											$displayed = $displayed | 32768;
										}
										break;
									
									//  SmartSend AAE insured Satchels
									case "SMSAAE1Ki":
									case "SMSAAE3Ki":
									case "SMSAAE5Ki":
										if (!($displayed & 65536)) {
											$handlingFee = $this->sms_handling;
											$displayed = $displayed | 65536;
										}
										break;
									
									//  SmartSend AAE Receipted & inssured Satchels
									case "SMSAAE1Kri":
									case "SMSAAE3Kri":
									case "SMSAAE5Kri":
										if (!($displayed & 131072)) {
											$handlingFee = $this->sms_handling;
											$displayed = $displayed | 131072;
										}
										break;
									
									/////////////////////////////////// Fastway
									//  Zones - cheapest first //
									case "FWLbrown":
									case "FWLyellow":
									case "FWLblack":
									case "FWLblue":
									case "FWLlime":
									case "FWLpink":
									case "FWLred":
									case "FWLorange":
									case "FWLgreen":
									case "FWLwhite":
									case "FWLgrey":
										if (!($displayed & 524288)) {   //  only one per group
											$handlingFee = $this->fastway_labels_handling;
											$displayed = $displayed | 524288;
										}
										break;
									
									case "FWB1":
									case "FWB2":
									case "FWB3":
										if (!($displayed & 262144)) {   //  only one per group
											$handlingFee = $this->fastway_boxes_handling;
											$displayed = $displayed | 262144;
										}
										break;
									
									case "FWS0":
									case "FWS1":
									case "FWS3":
									case "FWS3l":
									case "FWS5":
										if ((!($displayed & 32)) && ($quote->cost > 0)) {   //  only one per group
											$handlingFee = $this->fastway_satchels_handling;
											$displayed = $displayed | 32;
										}
										break;
									
									//////// Transdirect /////////////////
									// Aust
									case "TRDmf":
									case "TRDnl":
									case "TRDae":
									case "TRDcp":
									case "TRDcpsr":
									case "TRDfw":
									case "TRDtp":
									case "TRDts":
									case "TRDti":
									case "TRDtntr":
									case "TRDtnt5":
									case "TRDtnt9":
									case "TRDtnt10":
									case "TRDtnt12":
										$handlingFee = $this->trd_handling;
										break;
									
									// Aust insured
									case "TRDmfi":
									case "TRDnli":
									case "TRDaei":
									case "TRDcpi":
									case "TRDcpsri":
									case "TRDfwi":
									case "TRDtpi":
									case "TRDtsi":
									case "TRDtii":
									case "TRDtntri":
									case "TRDtnt5i":
									case "TRDtnt9i":
									case "TRDtnt10i":
									case "TRDtnt12i":
										$handlingFee = $this->trd_handling + $this->ri_handling;
										break;
									
									// international
									case "TRDtntIntEE":
									case "TRDtntIntDE":
									case "TRDtntIntEco":
									case "TRDtollIntP":
									case "TRDtollIntD":
										$handlingFee = $this->trd_international_handling;
										
										break;
									
									// international insured
									case "TRDtntIntEEi":
									case "TRDtntIntDEi":
									case "TRDtntIntEcoi":
									case "TRDtollIntPi":
									case "TRDtollIntDi":
										$handlingFee = $this->trd_international_handling + $this->ri_handling;
										break;
									
									//////////////  EGO ///////////////////////////////////////
									case "EGO":
									case "EGOdep2dep":
									case "EGOdep2door":
									case "EGOdoor2dep":
										$handlingFee = $this->ego_handling;
										break;
									case "EGOi":
										$handlingFee = $this->ego_handling + $this->ri_handling;
										break;
									
									
									////////////// Hunter Express ///////////////////////////////////////
									case "HXAF":
									case "HXRF":
									case "HXHDP":
										$handlingFee = $this->hx_handling;
										break;
									
									////   Sendle ////
									case "SDL":
										$handlingFee = $this->sendle_handling;
										break;
									
									
									//////////// Startrack ///////////////////////
									case "STAexp":
									case "STAprm":
										$handlingFee = $this->sta_handling;
										break;
									case "STAprm":
									case "STAprmi":
									case "STAexpi":
										$handlingFee = $this->sta_handling + $this->ri_handling;
										break;
									// (Satchels) //
									case "STA1k":
									case "STA3k":
									case "STA5k":
										if (!($displayed & 1024)) {   //  only one per group
											$handlingFee = $this->sta_handling;
											$displayed = $displayed | 1024;
										}
										break;
									
									//////////  Couriers Please labels & Domestic parcels //
									case "CPLlab":
									case "CPLdps":
									case "CPLdpa":
									case "CPLdss":
									case "CPLdsa":
									case "CPLrre":
									case "CPLrra":
										$handlingFee = $this->cpl_handling;
										break;
									
									//////////  Couriers Please International parcels //
									case "CPLexp":
									case "CPLsav":
										$handlingFee = $this->cpl_international_handling;
										break;
									
									// Courier please satchels
									case "CPL5g":
									case "CPL1":
									case "CPL3":
									case "CPL5":
										if (!($displayed & 2048)) {   //  only one per group
											$handlingFee = $this->cpl_satchel_handling;
											$displayed = $displayed | 2048;
										}
										break;
									
									// Skippy Post
									case "SKP":
									case "SKPt":
									case "SKPp":
										$handlingFee = $this->skp_handling;
										break;
									case "SKPti":
									case "SKPtp":
									case "SKPtip":
										$handlingFee = $this->skp_handling + $this->$this->ri_handling;
										break;
								} //  end switch //
								
								// Validity test //
								/*
								if (
										(
											(isset($handlingFee) && (((float)($quote->cost) > 0) && ((float)($quote->cost) !==  999.00)))
										) ||
										(
											($this->show_errors === "yes") && ((string)$quote->id ===  "Error")
										)
									) { // valid quote or showing errors
								*/
								if (isset($handlingFee) && (((float)($quote->cost) > 0))) { // || (($this->show_errors === "yes") && ((string)$quote->id ===  "Error"))) {  // valid quote or showing errors
									// Heavy Parcel surcharge
									if (intval($xmlQuotes->information[0]->calculated_parcel_weight_kg) >= intval($this->hp_weight)) {
										$handlingFee += (float)$this->hp_surcharge;
									} //  Heavy parcel surcharge //
									
									$cost = ((float)($quote->cost)) + $handlingFee;  // set the total cost
									
									if ($cost < 0) {
										$handlingFee = 0 - (float)($quote->cost);
										$cost = 0;
									} // Handling fees can be negative values, so we do this to ensure the final cost isn't negative
									
									if (($dest_country == "AU") && ($shippingtaxrate > 1)) {
										$cost = $cost - ($cost / ($shippingtaxrate + 1));
									}  //  Exclude GST if needed
									
									/*
									  ######   Custom modification example for method descriptions ######
									  If you wish to alter/change the method descriptions this is the place to do it.
									  You will need to identify the text you wish to change from the 'normal' screen output.
			  
									 * for example
									  To change 'Express parcel' to just 'Parcel, use this:
									  if ((string)$quote->description === "Express Parcel") { $quote->description = "Express" ; }
			  
									  To change 'Parcel Regular' to 'Standard' use this:
									  if ((string)$quote->description === "Parcel Regular") { $quote->description = "Standard" ; }
			  
									  In some cases (eg, where the description may change, such asCouriers Please Labels (X x Metro, Y x Ezylink) you will need to match
									  on a partial string, something like:
									  if (preg_match("/Couriers Please Labels/", (string)$quote->description)) {  $quote->description = "Couriers Please" ;}
			  
									  Another example:
									  if (preg_match("Parcel up to/", (string)$quote->description)) { $quote->description = "Regular Parcel" ;}
			  
									  Please note: Make a copy of your changes as they will be lost and need to be re-applied with each update to this module.
			  
									  ###### End of custom modification examples ######
									 */
									if ($this->show_carrier_name === 'yes') {
										$carrier = (string)$quote->carrier . " : " . (string)$quote->description . " ";
									} else {
										$carrier = (string)$quote->description . " ";
									}
									
									$estimateddays = null;
									if ($this->estimated_delivery_format !== "None") {
										if (((string)$quote->days != "") && ((string)$quote->days != "n/a")) {
											$estimateddays = (string)$quote->days;
											if ($this->estimated_delivery_format === "Days") {
												$estimateddays .= $this->estimation_text_days;
											} else {
												$estimateddays = $this->estimation_text_date . $estimateddays;
											}
										}
									}
									
									$details = null;
									if ($this->show_handling_fee === 'yes') {
										$details = ((float)$handlingFee > 0) ? $details .= $this->handling_text_pre . number_format(
												(float)$handlingFee,
												2
											) . $this->handling_text_post : $details;
									}
									if ($this->show_insurance_cost === 'yes') {
										$details = ((float)$quote->insuranceIncl > 0) ? $details .= $this->insurancefee_text_pre . number_format(
												(float)$quote->insuranceIncl,
												2
											) . " Insurance " . $this->insurancefee_text_post : $details;
									}
									if ($this->show_otherfee === 'yes') {
										$details = ((float)$quote->otherfeeIncl > 0) ? $details .= $this->otherfee_text_pre . number_format(
												(float)$quote->otherfeeIncl,
												2
											) . " " . $quote->otherfeeName . $this->otherfee_text_post : $details;
									}
									
									if ($estimateddays) {
										$details .= " (" . $estimateddays . ") ";
									}
									/////////////////////////////////////////
									// ***********   store it ************* //
									//////////////////////////////////////////
									
									$rate = array(
										'id' => "ozpost." . $quote->id,
										'label' => $carrier . $details,
										'cost' => $cost
									);
									$this->add_rate($rate); // $valid = 1 ;
								}   // end  if ((isset($handlingFee)) && ($quote->cost> 0))
							} //if (in_array($quote->id, $allowed_methods))  no match
						} // next method
						// debugging to show postcodes as a quote  //
						if ($this->enable_debug === "yes") {
							//$osub = preg_split("/=/", $Osub);
							$osub = (strpos($Osub, "=") !== false) ? explode("=", $Osub) : ['','No Suburb selected'];
							$dsub = (strpos($Dsub, "=") !== false) ? explode("=", $Dsub) : ['','No Suburb selected'];
							$rate = array(
								'id' => "ozpost.debug",
								'label' => "Ozpost Debug: From " . "$fromcode $osub[1]" . " to " . "$topcode $dsub[1]",
								'cost' => 0.00
							);
							$this->add_rate($rate);
						}
						/////////////
						//$aa = sizeof($rate) ;
						if (sizeof($rate) == 0) {
							$this->get_static_rates($dest_country);
						}
					} else {  //  XML Data error
						if ($this->enable_debug === "yes") {
							$errmsg = "XML Data Error : ";
							foreach (libxml_get_errors() as $error) {
								$errmsg .= $error->message;
							}
							_e($errmsg, 'woocommerce-ozpost');
						}
						$this->get_static_rates($dest_country);
					}
				} else {
					$this->get_static_rates($dest_country);
					if ($this->enable_debug === "yes") {
						_e("<br>Server Error <br>$result", 'woocommerce-ozpost');
					}
				} // Server error
			}   // ! FUNCTION calculate_shipping
			
			// FUNCTION get_static_rates
			private function get_static_rates($dest_country)
			{
				global $shippingtaxrate;
				$cost = "";
				switch ($this->cost_on_error_method) {
					case "TBA":
						$title = $this->tba_text;
						if (!$title) {
							$title = "Please contact us for shipping costs";
						}
						wc_add_notice(__($title, 'woocommerce-ozpost'), 'notice');
						break;
					case "TBL":
						$cost = $this->get_table_rate($dest_country);
						if ($cost[0] > 0) {
							if ($this->table_type === "PRC") {
								$type = "Price";
							}
							if ($this->table_type === "WGT") {
								$type = "Weight";
							}
							if ($this->table_type === "ITM") {
								$type = "#Items in cart";
							}
							$title = "Table Rate based on  $type";
						}
						break;
					
					case "CPI":
					case "CPK":
					case "CPP":
						$cost = $this->get_static_rate($dest_country);
						if ($cost[0] > 0) {
							if ($this->cost_on_error_method === "CPP") {
								$title = "Flat Rate ";
							} else {
								$type = ($this->cost_on_error_method === "CPK") ? " Per Kg " : " Per Item ";
								$title = " $" . $cost[1] . $type;
							}
						}
						break;
				}
				
				if ($cost[0] > 0) {
					if (($dest_country == "AU") && ($shippingtaxrate > 1)) {
						$cost[0] = $cost[0] - ($cost[0] / ($shippingtaxrate + 1));
					}  //  Exclude GST if needed
					$rate = array('id' => 'ozpost.static ', 'label' => "OzPost : " . $title, 'cost' => $cost[0]);
					$this->add_rate($rate);
				}
			}
			// ! FUNCTION get_static_rates
			
			// FUNCTION get_static_rate
			private function get_static_rate($dest_country)
			{
				global $parcelweight, $parcelitems;
				$x = explode(',', $this->static_rates);
				$rate = ($dest_country == "AU") ? $x[0] : $x[1];
				$cost = $rate;
				if ($this->cost_on_error_method == "CPK") {
					$cost = $rate * intval(($parcelweight / 1000) + 1);
				}
				if ($this->cost_on_error_method == "CPI") {
					$cost = $rate * $parcelitems;
				}
				
				return array($cost, $rate);
			}
			// ! FUNCTION get_static_rate
			
			// FUNCTION get_table_rate
			private function get_table_rate($dest_country)
			{
				global $parcelweight, $parcelitems, $parcelvalue;
				
				// Trim leading and trailing spaces //
				$table = trim($this->table_rates);
				// trim multiple spaces //
				$table = preg_replace('/\s+/', ' ', $table);
				// Replace comma-space with just a comma
				$table = preg_replace('/, /', ',', $table);
				
				// explode tables //
				$x = explode(' ', $table);
				
				switch ($this->table_type) {
					case ('PRC'):
						$calc = $parcelvalue;
						break;
					case ('WGT'):
						$calc = $parcelweight / 1000;
						break; //kgs
					case ('ITM'):
						$calc = $parcelitems;
						break;
				}
				$cost = 0;
				$rates = ($dest_country == "AU") ? $x[0] : $x[1];
				
				$table_cost = preg_split("/[:,]/", $rates);
				$size = sizeof($table_cost);
				
				for ($i = 0, $n = $size; $i < $n; $i += 2) {
					if (round($calc, 9) <= $table_cost[$i]) {
						if (strstr($table_cost[$i + 1], '%')) {
							$cost = ($table_cost[$i + 1] / 100) * $parcelvalue;
						} else {
							$cost = $table_cost[$i + 1];
						}
						break;
					}
				}
				return array($cost, $this->table_type);
			} // ! FUNCTION get_table_rate
			
			// FUNCTION get_from_ozpostnet
			private function get_from_ozpostnet($request, $items = "", $controls = "")
			{
				$domain = "ozpost.net";
				$error1 = $error2 = $error3 = $data = "";
				$hash = md5($request . $controls . addslashes(serialize($items)));
				//delete_transient( 'ozpost_'.$hash) ;
				if (false === ($data = get_transient('ozpost_' . $hash))) {
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_VERBOSE, 1);
					curl_setopt($ch, CURLOPT_HEADER, false);
					curl_setopt(
						$ch,
						CURLOPT_USERAGENT,
						"[WooCommerce v" . WC_VERSION . " : " . $this->id . " v" . $this->version . "] " . $_SERVER['SERVER_NAME']
					);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 45);
					curl_setopt($ch, CURLOPT_POST, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					//curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
					
					if (is_array($items)) {
						curl_setopt($ch, CURLOPT_POST, true);
						$vars = http_build_query(array('Items' => $items));
						$vars .= $controls;
						curl_setopt($ch, CURLOPT_POSTFIELDS, "$vars");
					}
					
					
					if (isset($_SERVER['REMOTE_HOST']) && $_SERVER['REMOTE_HOST'] === "localhost") { // Cronomic Local debugging (won't work for anyone else)
						curl_setopt($ch, CURLOPT_URL, "https://localhost/ozpost" . $request);
						$data = curl_exec($ch);
						$error1 = curl_error($ch);
						if (($error1 != "") || ($data == "")) {
							$data = '<error>' . $error1 . $data . '</error>';
						}
					} else {     // Live servers
						curl_setopt($ch, CURLOPT_URL, "https://svr1." . $domain . $request);
						$data = curl_exec($ch);
						$error1 = curl_error($ch);
						
						if (($error1 != "") || ($data == "")) {
							curl_setopt($ch, CURLOPT_URL, "https://svr2." . $domain . $request);
							$data = curl_exec($ch);
							$error2 = curl_error($ch);
						}
						
						if (($error2 != "") || ($data == "")) {
							curl_setopt($ch, CURLOPT_URL, "https://svr0." . $domain . $request);
							$data = curl_exec($ch);
							$error3 = curl_error($ch);
							if (($error3 != "") || ($data == "")) {
								if (function_exists('wc_add_notice')) {
									wc_add_notice(
										__(
											'Temporary Network Error. Please try again shortly<br>Server#1: ' . $error1 . '<br>Server#2 : ' . $error2 . ' <br>Server#3 : ' . $error3 . '',
											'woocommerce-ozpost'
										),
										'error'
									);
								}
								$data = '<error></error>';
							}
						}
					}
					//echo $data ;// die ;
					curl_close($ch);
					if ((substr($data, 0, 7)) != "<error>") {
						set_transient('ozpost_' . $hash, $data, 1 * HOUR_IN_SECONDS);
					}
				}
				return $data;
			}
			// ! FUNCTION get_from_ozpostnet
			
			// FUNCTION generate_settings_html
			function generate_settings_html($form_fields = array(), $echo = true)
			{
				?>
                <table class="form-table">
					<?php
					if (!$form_fields) {
						$form_fields = $this->get_form_fields();
					}
					$html = '';
					$t = 0;
					foreach ($form_fields as $k => $v) {
						$text2 = "";   // display handling //
						if ((strpos($k, "_methods")) || ($k == "hide_parcel_if_domestic_letter")) {
							$text = ($k != "hide_parcel_if_domestic_letter") ? $v['title'] : "Options & other settings";
							$text = preg_replace('/Methods/', '', $text);
							if ($t === 0) {
								$text2 = "<hr><em>Select Shipping Options</em>";
							}
							$html .= "</tr></td></table>$text2<p class=\"ozpostHeadings\" onclick=\"toggle_visibility('table$t')\">" . $text . "</p><table class=\"form-table\" style=\"display:none\" id=\"table" . $t . "\">";
							//$html .= "</tr></td></table>$text2<p class=\"ozpostHeadings button button-secondary\" onclick=\"toggle_visibility('table$t')\">" . $text . "</p><br /><table class=\"form-table\" style=\"display:none\" id=\"table" . $t . "\">";
							$t++;
						}
						// eof handling display //
						if (!isset($v['type']) || ($v['type'] == '')) {
							$v['type'] = 'text';
						}  // Default to "text" field type.
						$html .= (method_exists(
							$this,
							'generate_' . $v['type'] . '_html'
						)) ? $this->{'generate_' . $v['type'] . '_html'}($k, $v) : $this->{'generate_text_html'}(
							$k,
							$v
						);
					}
					
					if ($echo) {
						echo $html;
					} else {
						return $html;
					}
					?>
                </table>
				<?php
			}
			
			//   Expiration Email management \\
			private function expiration_email_handler($days, $subscriptionlink)
			{
				if (isset($this->settings['email_count'])) {
					$t = $this->settings['email_count'];
				} else {
					$t = 0;
					$this->update_email_counter($t);
				}
				$to = ($this->subscriptions_email) ? $this->subscriptions_email : get_option('admin_email');
				$headers = "Content-Type: text/html\r\n";
				
				$message = "Please be advised that your subscription to ozpost.net will expire in " . $days . " Days.<br>Subscriptions can be renewed at <a href=\"$subscriptionlink\">shop.ozpost.net/subscriptions</a><br>Your subscribed STORENAME is:" . urldecode(
						$this->host
					);
				$subject = "Ozpost $days day Subscription Reminder (" . $t . ")";
				if (($days <= 14) && ($days > 0) && ($t == 0)) {
					wc_mail($to, $subject, $message, $headers);
					$this->update_email_counter(1);
				} elseif (($days <= 10) && ($days > 0) && ($t < 2)) {
					wc_mail($to, $subject, $message, $headers);
					$this->update_email_counter(2);
				} elseif (($days <= 7) && ($days > 0) && ($t < 3)) {
					wc_mail($to, $subject, $message, $headers);
					$this->update_email_counter(3);
				} elseif (($days <= 3) && ($days > 0) && ($t < 4)) {
					wc_mail($to, $subject, $message, $headers);
					$this->update_email_counter(4);
				} elseif (($days <= 0) && ($t < 5) && ($t != 0)) {
					$message = "Your subscription to ozpost.net has EXPIRED..<br>Subscriptions can be renewed at <a href=<a href=\"$subscriptionlink\">shop.ozpost.net/subscriptions</a><br>Your subscribed STORENAME is:" . urldecode(
							$this->host
						);
					wc_mail($to, "Ozpost ALERT Subscription Expired", $message, $headers);
					$this->update_email_counter(5);
				}
				if (($days > 14) && ($t != 0)) {
					$this->update_email_counter(0);
				}// Reset flag for next time
				
				return null;
			}  //   !Expiration Email management \\
			
			private function update_suburb($suburb)
			{
				$this->settings['origin_suburb'] = $suburb;
				update_option($this->plugin_id . $this->id . "_settings", $this->settings);
				return null;
			}
			
			private function update_email_counter($count)
			{
				$this->settings['email_count'] = $count;
				update_option($this->plugin_id . $this->id . "_settings", $this->settings, "yes");
				return null;
			}
			
			private function ozpost_network_test()
			{
				error_reporting(E_ALL);
				$url[] = "svr0.ozpost.net";
				$url[] = "svr1.ozpost.net";
				$url[] = "svr2.ozpost.net";
				
				//$url[] = "svrX.ozpost.net"; //  used to test that error reports are correctly shown.
				//$url[] = "http://svrX.ozpost.net"; //  used to test that error reports are correctly shown.
				
				$data = "/quotefor.php?flags=get_latest_client_version_woo"; //  test string. We check for a valid return, not just any server response.
				$text = "<div><br>Ozpost server test results<br>";
				$i = 0;
				
				while ($i < sizeof($url)) {
					$ip = gethostbyname($url[$i]);
					$ip = ($ip === $url[$i]) ? "" : " (" . $ip;
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://" . $url[$i] . $data);
					curl_setopt($ch, CURLOPT_VERBOSE, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
					curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
					curl_setopt($ch, CURLOPT_TIMEOUT, 2);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
					curl_setopt(
						$ch,
						CURLOPT_USERAGENT,
						"[WooCommerce v" . WC_VERSION . " : " . $this->id . " v" . $this->version . "] " . $_SERVER['SERVER_NAME']
					);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					
					$edata = curl_exec($ch);
					$errtext = curl_error($ch);
					$errnum = curl_errno($ch);
					$commInfo = curl_getinfo($ch);
					
					if ($edata === "Access denied") {
						$errtext = "<strong>" . $edata . ".</strong> Please report this error to <strong>support@ozpost.net  ";
					}
					
					curl_close($ch);
					$text .= "<div style='color:black;display: inline-block;font-weight:bold;width:220px;'>" . $url[$i] . $ip . ")</div>";
					
					if (($commInfo['http_code'] == 200) && ($errnum == 0)) {
						$commInfo['connect_time'] = (($commInfo['connect_time'] * 1000) >= 1) ? intval(
							$commInfo['connect_time'] * 1000
						) : number_format(($commInfo['connect_time'] * 1000), 3);
						$commInfo['namelookup_time'] = (($commInfo['namelookup_time'] * 1000) >= 1) ? intval(
							$commInfo['namelookup_time'] * 1000
						) : number_format(($commInfo['namelookup_time'] * 1000), 3);
						$commInfo['total_time'] = (($commInfo['total_time'] * 1000) >= 1) ? intval(
							$commInfo['total_time'] * 1000
						) : number_format(($commInfo['total_time'] * 1000), 3);
						
						$text .= "<div style='color:blue;display: inline-block;white-space: nowrap;'>";
						$text .= " Connect Time : " . $commInfo['connect_time'] . "ms , ";
						if ($commInfo['connect_time'] < 100) {
							$text .= "&nbsp;";
						}
						
						$text .= " DNS lookup Time : " . $commInfo['namelookup_time'] . "ms , ";
						if ($commInfo['namelookup_time'] > 1) {
							$text .= "&nbsp;&nbsp;&nbsp;";
						}
						$text .= " Total Time : " . $commInfo['total_time'] . "ms , ";
						if ($commInfo['total_time'] < 100) {
							$text .= "&nbsp;";
						}
						$text .= "<div style='color:black;display: inline-block;font-weight:bold;'> ";
						
						if (($commInfo['total_time']) > 1000) {
							$text .= " Poor ";
						} elseif (($commInfo['total_time']) > 700) {
							$text .= " Sluggish ";
						} elseif (($commInfo['total_time']) < 300) {
							$text .= " Excellent ";
						} elseif (($commInfo['total_time']) <= 700) {
							$text .= " Good ";
						}
						
						$text .= "</div></div>";
					} else {
						$text .= "<div style='color:red;display:inline-block;white-space: nowrap;'>" . $errtext . " , FAIL </strong></div>";
					}
					$text .= "</br>";
					$i++;
				}
				$text .= "</div>";
				error_reporting(0);
				return $text;
			}
		} //  End Class
	} //  end ozpost_init
} // No WooCommerce found
