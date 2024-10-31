=== WooCommerce-Ozpost ===
Contributors: Cronomic
Tags: woocommerce shipping, Australia Post, TNT Australia, SmartSend, Transdirect, Couriers Please, E-Go Couriers, Fastway Couriers, Hunter Express, StarTack, Skippy Post, Sendle
Requires at least: 4.0.0
Tested up to: 5.4.1
Stable tag: 2.2.7
License:GPLv2 or later
WC requires at least: 2.2
WC tested up to: 4.2.2
Provides real time shipping Quotes from Australia Post, Startrack, TNT, SmartSend and more..

== Description ==
This module provides real time shipping quotes from Australia Post, TNT Australia, SmartSend, Transdirect, Couriers Please, E-Go, Fastway, Hunter Express, StarTack, Skippy Post and Sendle

It Provides over ~280 different shipping methods in total. You select the carriers and methods you wish to allow, and enter any optional P&H fees, and the module will provide the customer with quotes that are possible for any given order.

== Installation ==
<strong>Using the WordPress Plugins Menu</strong>
<ul><li>Search for 'ozpost'</li>
<li>Navigate to the 'Upload' area</li>
<li>Click 'Install Now'</li>
<li>Activate the plugin in the Plugin dashboard</li>
</ul>

<strong>Uploading in WordPress Dashboard </strong>
<ul><li>Navigate to the 'Add New' in the plugins dashboard</li>
<li>Navigate to the 'Upload' area</li>
<li>Select woocommerce_ozpost_Vx.y.z.zip from your computer</li>
<li>Click 'Install Now'</li>
<li>Activate the plugin in the Plugin dashboard</li>
</ul>s
<strong>Using FTP</strong>
<ul>
<li>Download woocommerce_ozpost_Vx.y.z.zip from https://www.ozpost.net</li>
<li>Extract  woocommerce_ozpost_Vx.y.z.zip to your computer</li>
<li>Upload the ozpost-multiquote directory to the /wp-content/plugins/ directory</li>
<li>Activate the plugin in the Plugin dashboard</li>
</ul>

After installation you can configure the ozpost settings from the WooCommerce->Settings->Shipping menu.

Note: This module connects to a commercial/subscription service.  A 60 Day Free trial is *automatically* given from when the subscription is obtained.

== Upgrade Notice  ==
Update notes (placeholder)

== Screenshots ==
1. Example Cart Output
2. Example Settings
3. Example Settings
4. Example Settings
5. Example Settings

== Frequently Asked Questions ==
Q. How much does the ozpost module cost?

A. All of the ozpost client modules are released under the GPL licence. You are free to use and/or modify them as you wish, free of any fees or obligations.

Q. What is this I hear about a 'subscription' being needed?

A. Although the ozpost client modules are free, there is a small cost needed to access the ozpost servers.

Q. Do I need to register the ozpost module to use it?

A. Yes. The Subscription includes an automatic 60day free subscription starting from the registration day. If you are a new user and the module doesn't seem to be working for you please send us an email and we will be happy to work through the problem(s) with you, free of any charges or obligations. On the rare occasion that the problem ends up being a coding related issue we not only reset the subscription status back so that you get the full 60days trial, but we will often give you an even longer trial period to thank you for reporting the problem and helping us overcome it.

Q. Can you install and configure the ozpost module for me. I'm happy to pay.

A. No and no.
   We'd feel guilty about charging you to install it when it is such a simple process that is no different than any other Wordpress/WooCommerce module.

   We *can't* configure the module for you because it doesn't actually *need* configuring. Yes, it does have many *options*, but almost all of them are personal preferences. We would have no idea of knowing which carriers, couriers or methods you wish to support. We have no way of knowing how much, if anything, you wish to add for packaging & handling, and that is just about the extent of any configuration that is needed. As long as you have given your products *accurate* weights and dimensions and enabled at least one suitable method/carrier, it should just 'work'.

Q.  How reliable are the ozpost servers?

A.  Very reliable. The current system consists of three different servers. Those servers will move over different networks over time. The probability of all three failing at the same time is astronomically low.
    The most unreliable aspect of the ozpost system is that it depends on the various couriers own servers (except Australia Post) . If these servers are having issues it won't prevent the ozpost system from working but may slow the responses down somewhat and the quotes from the faulty couriers server won't be available. You will still get the quotes from the remaining carriers/couriers that You have enabled.

   We have found that most of the questions we receive seem to come from people that haven't even installed the module.  Trust us, on this, if you install the module first you almost certainly won't have any questions to ask. There is nothing nefarious to worry about. The code doesn't have any 'back doors', it doesn't modify or change any existing code, and its removal (should you decide it isn't for you), will leave your system just as it was before you installed it.

   The following Q&A's are mainly for those that have already installed the module and are a little more curious as to how it works, so.....

Q. How does the ozpost module work?

A. Whenever a quote request is made the module sends a list of the shippable cart contents to the ozpost servers. The products themselves are not identified, only the product weights, dimensions, quantities and $values are submitted (the latter is to enable the calculation of insurance costs).
   The ozpost servers use several algorithms to combine these items into a single 'package'. The final weight & dimensions are then sent to the various courier companies for quoting. These quotes are then relayed back to your store, where they are filtered according to the methods that you have enabled.
   The end customer will be shown only the methods that are both *possible* and *allowed*.

Q. If the ozpost servers act as an intermediate relay service what benefit does it give over standalone modules that also query the courier servers?

A. Providing shipping quotes is the easy part of any shipping module. The hard part is the way that multiple quantities of items of various weights and dimensions are quoted. The simplest method (also the most expensive for the customer) is to obtain a quote for each item, and tally up the figures for a final cost. Ozpost doesn't use this method, instead, it 'packs' all the cart items into a single 'parcel' for quoting. This provides the most economical shipping costs to your customers. Although it is possible for a 'standalone' module to use the same packing methods, it is very inefficient having to replicate and maintain the same code for each of the supported couriers. When you further consider that the ozpost system has been designed to support many different shopping carts, using a centralised server system means that we only need to maintain this code in one place, rather than ~50 different modules.

Q. Does the ozpost system support 'parcel splitting' -  IOW, if a parcel weighs 40kg can/will ozpost quote this as 2x20kg parcels?

A. No. We have spent 100's, if not 1000's of hours trying to implement this type of functionality, and although it can be quite effective (and quite simple) in some cases, we found that as more and more products of various weights an dimensions get added to the cart, the simple methods just aren't up to the task. Even in the simplest case of just two items you can tun into problems, for example, Aust Post have a weight limit of 22kgs, if you have two items in the cart, one weighing 21kg, the other weighting 23kg, giving a combined weight of 44kg, a 'simple' method will quote these as 2x parcels weighing 22kg each. The thing is, it is very unlikely that you will be able to physically take 1kg off of one product and add it to the other, as such you will be quoting for parcels that can't actually be delivered.
   Although there was a time where we got close to making a system like this work (eg, by excluding overweight items and quoting for them separately) we still found that similar 'impossible situations' could/would exist with much smaller/lighter products, and each added product compounded the problem (and the code to mitigate it). In the end we came to realise that even if we could solve this problem it introduced another, possibly more serious one, in that there is no way to provide the 'feedback' needed to inform the merchant *how* the products were 'packed' (which products go into which boxes).

Q. Why am I being quoted for a 5kg Satchel when the products weigh a lot less than this?

A. Just because a product is light enough to fit a given rated satchel doesn't mean that the product is actually *small* enough.  Unlike most shipping calculators that offer satchel rates, the ozpost system is aware of these physical constraints and will not provide a quote if it determines the product(s) won't fit. It will quote for the next largest size envelope, satchel, standard box, or parcel, as appropriate.

Q. WooCommerce has setting for 'shipping classes'. How do these relate to ozpost?

A.  They don't. Ozpost ignores *all* of these settings and makes its own determination as to the shipping requirements based on the weights and dimensions assigned to the individual products.

Q. WooCommerce has setting for 'shipping zones'. How do these relate to ozpost?

A. They don't.  Ozpost ignores these settings because for quote purposes only 2 zones are needed (Australia and Overseas) and this is determined by the customer. Australia bound deliveries include GST, overseas ones don't.
   However, the WooCommerce Zones settings can be used to limit the countries/zones that you wish to support. If you get an error message stating 'No shipping methods available' this is a WooCommerce Shipping Zones setting issue and not an ozpost issue.

Q. My products are of such a size and weight that I never need to worry about being charged based on 'cubing rules' (sometimes known as 'dimensional weight'). Do I still need to enter product dimensions.

A. Yes. The ozpost system is based on real world principles. All shippable products have a weight and dimensions. The ozpost system cannot/will not quote for these 'impossible' products.

Q. Most other shipping modules don't need product dimensions. Why does ozpost insist on them?

A. This is to help protect you, the merchant, from under quoting. Although originally designed for the cases where cubing rules apply (large but light items), the ozpost system mainly uses the dimensions to determine whether any given item/parcel can be classified as a small letter, large letter (2 sizes), a satchel (3 sizes) or a regular parcel.  An item weight under 100grams could be mailed using any of these methods and the ozpost servers will provide a quote for each of these *possible* methods. You, the merchant can elect to show the customer ALL of these possibilities, or just some of them. The larger suitable methods can be hidden or shown according to your own particular preference.

Q. Why are the ozpost quotes different from the quotes I get directly from the courier websites?

A. This should never be the case. In almost every case we've investigated the discrepancy has ended up being that what is actually being quoted for isn't what you think it is. Sometimes this is because the data of a single product in the store not being correctly defined, sometimes it is because you have neglected to include the Tare weight/dimensions when doing the comparisons. The ozpost module(s) have a DEBUG option that will allow you to see exactly the weight and size of the parcels being quoted. You should use this data for 'like for like' comparisons.
    The DEBUG output will also alert you to things such as items being quoted being oversize/overweight and all manner of other possible problems.

Q. How do I mark an item as being 'Dangerous Goods'?

A.  Navigate to the product of interest (in admin).
    Click the 'Attributes' button.
    Click the 'Add' button.
    Enter a name of 'dg'  (or 'DG') and give it a value of '1' or '2'.  (A value of 2 will cause Australia Post/Startrack to show, if suitable but ROAD ONLY. please see https://auspost.com.au/sending/check-sending-guidelines/dangerous-prohibited-items

Q. I've set the 'dg' to '2' but Australia Post quotes still don't show. What could be wrong?
A1. The parcel/item must be within the allowed size/weight limits.
    There must not be any items of another dg type in the cart

== Changelog ==
= 2.2.7 =
 * Cater for new services provided by the new Development team at Cronomic
 * Provide compatibility with the latest WP/WC versions
 * Provide compatibility with PHP 7.3
 * Bugfix: CSS overwrite
 * Bugfix: type casting in Heavy parcel surcharge
 * Corrected some typos

= 2.2.6 =
 * Bugfix: AustPost Insured parcels & Insured Express parcel weren't showing.
 * Added feedback for Ego depot location (based on suburb name when quote is requested)  

= 2.2.5 =
 * Updated Ego door2door, etc to llow concurrent quotes where suitable, :
 = 2.2.4 =
 * Added: Ego user login credentials

= 2.2.3 =
 * Added: Ego "door2door",  "depot2depot", "depot2door", "door2depot",        

= 2.2.2 =
  * Update - Minor tweaks and fixes. 

= 2.2.1 =
  * Update: Dangerous Goods update. Setting dg = 2 will show Australia Post (road only and within weight/size limits) if parcel contains dangerous goods 
  * Update: Removed/updated deprecated code
  * Update: misc tweaks  

= 2.2.0 =
  * Bugfix: Dangerous Goods info was showing product description rather than its name
  * Bugfix: Dangerous Goods flag wasn't being sent to servers 

= 2.1.9 =
  * Added: Couriers Please "Road" & "Road Express" (Lxx & Ixx servicecodes)  
  * Removed Couriers Please Overnight and Sameday servives (apparently obsoleted) 

= 2.1.8 =
  * Bugix: was showing International express post satchels of all sizes rather than most relevent one

= 2.1.7 =
  * New: Added missing support for dimensions in meters
  * New: Added examples for custom modifications to handling fees 
  * Updated: Tips have been updated based on customer feedback 
  * Updated: Subscription links and email reminders now include storname/postcode for more streamlined renewal (pending server update to support this new data)
  * Bugfix: Added missing subscription link if subscription had expired
.
= 2.1.6 =
   * bugfix: initialised sendle variable ($sdlvars)
   * bugfix: removed remnants of clicknsend variables 
 
= 2.1.5 =
    * New: Added AustPost 1kg regualar satchels (and options) 
    * Removed Click n Send options (obsolete service) 

= 2.1.4 =
  * New: Added Transdirects Couriers Please Signature Required method 

= 2.1.3 =
  * Bugfix: Transdirect International Non insured rates weren't being shown 
 
= 2.1.2 = 
  * Moved HX fuel levy calcs to serverside

= 2.1.1 =
  * Added support for Hunter Express Home Direct Plus 
  * Added support for Sendle Couriers

= 2.1.0 = 
  * Added option to set Transdirect type (Biz2Biz, Biz2Res, Res2Res & Res2Biz)

= 2.0.9 =
  * Added input field for Hunter Express fuel levy  
    
= 2.0.8 =
 * Bugfix:  Incorrect tax handling with static rates. 
 * BugFix:  Was attempting to display ETA even where there was none to display.

= 2.0.7 =
 * Bugfix: Downloadable products were being quoted for shipping. 
 * Updated some of the method descriptors in settings. 
 * Cleaned up some of the DEBUG output
 * Cleaned up some of the error reporting 
 * Fixed TBA message from appearing when TBA not set. 

= 2.0.6 =
 * New: Added Transdirect International (TNT & Toll).
 * Bugfix: Insurance handling charges weren't being applied to Transdirect quotes. 
 * New: Added examples for custom modifications to allow quoting from alternative locations (postcode) 
 * New: Added examples for custom modifications to change method descriptions.  

= 2.0.5 =
 * Added checks to ensure cURL and SimpleXML are installed.  

= 2.0.4 =
 * Update: All quote requests to all servers are now SSL encrypted 
 * Update: Improved/fixed error reporting for Couriers Please 
 * New: Added 'Australia only' option (requested by multiple users)   

= 2.0.3 =
 * Update: Compatibility fix for WC2.6.5. 

= 2.0.2 =
 * Bugfix: Fixed calc errors for fallback/static rates
 * New: Added Australia Post 1kg Express Satchels

= 2.0.1 =
 * Bugfix: Estimated days/date wasn't being displayed
 * Bugfix: Deadline setting was being ignored
 * Bugfix: Leadtime setting was being ignored
 * New: Added custom overrides/pricing for FastWay Boxes

= 2.0.0 =
 * Update: Now uses Couriers Please latest API (v1.01/v1.02)
 * New: Supports many new Couriers Please methods, including International deliveries
 * New: Added custom overrides/pricing for Couriers Please satchels
 * New: Added custom overrides/pricing for FastWay satchels
 
= 1.2.4 =
* Bugfix: Compatibilty fix that was preventing the checkout page from fully loading with some systems  

= 1.2.3 =
* Bugfixes: Initialised more variables
* Tweaks: For php7 
* Added a small section containing a few configuration tips   

= 1.2.2 =
* Bugfix: Initialised taxrate variable to prevent Division by zero warnings if/when taxes haven't yet been configured  .   

= 1.2.1 =
* Bugfix: Suppressed parcel build output on the checkout page as it was preventing the page from being fully loaded with some browsers.   

= 1.2.0 =
* Update: Updated menus and options to bring things in line with Australia Posts April 2016 changes       

= 1.1.2 =
* Bugfix: Couriers Please 500g satchel was missing from options list.      

= 1.1.1 =
* Bugfix: Fastway quote codes weren't matching the latest server codes     
 
= 1.1.0 =   
* Bugfix: Fastway and Click n Send satchels were getting 'confused' 
* Update: Add handling charge option for COD 
* Change: Now using new URI for quote requests
* Bugfix: Supressed $0 quotes if fallback methods failed
* Update: Added checks for valid XML data  
* Update: Added option to show how parcels are created with multiple items 

= 1.0.9 =   
* Update: Revamped letter handling
* Update: Updated some default settings

= 1.0.8 = 
* Update: Added support for TNT insurance (Class 'C') 
* Update: Replaced some deprecated QuoteID's with the newer counterparts.

= 1.0.7 =
* Update: Added function_exists('wc_add_notice') tests before calling (Not sure why this would be needed but apparently the function is missing on some installations?)
* Update: Added some default dimensions 
* Update: Added some more descriptive text to explain some settings.
* Bugfix: Fixed issue with fallback rates not being applied with some errors. 
* Update: More improvements to email subscription handling

= 1.0.6 =
* Update: Removed html formatting from outputs (wasn't always being correctly rendered)
* BugFix: Default dimensions weren't being applied
* Update: Renamed 'Other Settings' to 'Global Settings' 
* Update: Moved the 'hide' options into the Global settings section
* Update: Added option to hide the carrier/courier names
* Update: Removed the GST setting - Now relies on the 'Standard' Class tax rates to determine whether to adjust for GST 
* Update: Added support for Hunter Express

= 1.0.5 =
* Update: Set taxable status field (cosmetic change only) 
* Update: Minor code tweaks  

= 1.0.4 =
* Bugfix: Initialised 'skip' variable
* Update: Changed pointer type 
* Bugfix: Function permission error (generate_settings_html not public)
* Update: If no destination suburb given when called it will now use the store's suburb rather than generate an error response.
* Update: Replaced the use of $_SESSION data with the API for transient data  
* Update: Quote results now cached using the API for transient data  (performance increase)
 
= 1.0.3 =
* Removed: internal code for latest version test (not needed for Woo)
* Improved: output formatting
* Added: Error checking for missing input data 
* Bugfix: Storename being misset under certain conditions      

= 1.0.2 =
* Code cleanup

= 1.0.1 =
* Initial Public Release
