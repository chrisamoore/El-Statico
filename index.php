<?php
/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


                                                                                       
@project    El-Statico
@author   	Andres Hermosilla <andres@ahermosilla.com>
@version		1.1
@file 			functions.php
@info       Contains the core functions and settings for the static load
  					

= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =  

		Global Config Settings  v1.0
		* Configuration settins for site
		
		@usage   : $site['property']; // URL, domain, {custom}
		@bugs    : No bugs
		@future  : 
		
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

	// Core settings
	$site = array();
	$site['URL'] = "http://localhost/resources/final/index.php/";
	$site['domain'] = str_replace('index.php/','',$site['URL']);
	$site['default'] = 'default.php';

	// Add site specific settings
	$site['live'] = false;

/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
		
		General Init Functions  v1.0
		* Core functions for handling requests and routines
		* Captures page request
		* Setups page canonical for SEO
		
		@usage  : $page['property']; // properties : current, body_id,  canonical, subpages, {custom}
		@bugs   : No bugs
		@future : 
		
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

	// Get current request and split
	$uri = preg_split('[/]', $_SERVER['REQUEST_URI']);
 
	$page = array();
	// Process current page by grabbing end of URI
	$page['current'] = end($uri);
	
	// Create a body#id for page
	$page['body_id'] = 'page-'.$page['current'];

	// Generate page canonical for SEO
	if(isset($_SERVER['PATH_INFO'])){
		$path = $_SERVER['PATH_INFO'];
	} else {
		$path ='';
	}
	$page['canonical'] = substr($site['URL'], 0, -1).$path ;
	
	// Empty string for current page subpages
	$page['subpages'] = '';
	
	// Default starting breadcrumb, you can set your own
	$page['breadcrumbs'] = "<a href=\"{$site['domain']}\">Home</a>";
	



/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
		
		Create Pages  v1.1
		* Up to 3 level navigation array
		* Supports direct resource links for domain instead of heirarchal 
		
		@usage   : new_menu($menu);
		@bugs    : No bugs
		@future  : Custom classes for items, outside link support
		
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
function new_menu($menu){
	global $page;
	global $site;
	

	
	// default class for current item
	$hilite = 'current-menu-item';

	// string that holds navigation output
	$full ='';
	
	foreach($menu as $num => $primary){
			
			$level = array(
								 array('class'=>"nav-".($num+1)." level-1"),
								 array('class'=>''),
								 array('class'=>'')
			);
			$topmenu = '';
			$submenu = '';
			$thirdmenu = '';
			$toplnk = '';
			$thirdcrumb = '';
		
		if($primary[1] == $page['current']){
				$level[0]['class'] .= " $hilite";
		}
		
		// Check if primary page is anchor, if so pass on different link for children
		// $toplnk gets passed to children for heirarchy
		if($primary[1] == '#'){
			// stripping out any special characters
			$toplnk = strip_tags($primary[0]);
			$toplnk = strtolower($toplnk );
			$toplnk =  str_replace(" ", "-", $toplnk);
			$toplnk =  preg_replace("/&#?[a-z0-9]+;/i","",$toplnk);
			// This will pass to primary nav link
			$topanch = '#';
		} else {
			$toplnk = $primary[1];
			// This will pass to primary nav link
			$topanch = $site['URL'].$primary[1];
		}
		// Boolean to determine if page is current to save the current subpage group
		$hascursub = false;
		$hascursubsub = false;
		
		// Checks if there is a submenu or direct link
		if(isset($primary[2])){
			
			// If it's an array then it has a submenu
			if(is_array($primary[2])){
				$submenu = "\n<ul class=\"sub-menu\">\n";
				// = = = = = = loop through secondary items
				foreach($primary[2] as $secondary){
					$level[1]['class'] = 'level-2';
					$thirdmenu = '';
					$hascursubsub = false;
					
					// add classes for current page
					if($secondary[1] === $page['current']){
						$level[0]['class'] .= " $hilite";
						$level[1]['class'] .= " sub-current";
						// List subpages
						$hascursub = true;
					  
					}
					
					// create item link
					$sublnk = "{$site['URL']}{$toplnk}/{$secondary[1]}";
						// check if item has additional setting (direct or submenu)
						if(isset($secondary[2])){
								
								// has sub sub menu
								if(is_array($secondary[2])){
									//third pages
									
									$thirdmenu .= "\n\t<ul class=\"sub-sub-menu\">\n";
									// = = = = = = loop through tertiary items
									 foreach($secondary[2] as $tertiary){
										 	$level[2]['class'] = 'level-3';
										 		if($tertiary[1] == $page['current']){
														$level[0]['class'] .= " $hilite has-sub-sub-current";
														$level[1]['class'] .= " has-sub-current";
														$level[2]['class'] .= " $hilite sub-sub-current";
														// List subpages
														$hascursub = true;
														$hascursubsub = true;
														
												}
												// Creating sub sub menu links
												$thirdmenu  .= "\t\t<li class=\"{$level[2]['class']}\">";
												$thirdmenu  .= "<a href=\"{$site['URL']}{$toplnk}/{$secondary[1]}/{$tertiary[1]}\">$tertiary[0]</a></li>\n";
									 }
									 // = = = = = = end loop through tertiary items ^ ^ ^ ^ ^
									// end third
									$thirdmenu .= "\t</ul>\n";
								} else {
									// for direct lionk add class and change item link
									$level[1]['class'] .= ' direct';
									$sublnk = $site['domain'].$secondary[1];
								}
						} 
						
						// Creating sub menu links
						$submenu .= "\t<li class=\"{$level[1]['class']}\">";
						$submenu .= "<a href=\"{$sublnk}\">$secondary[0]</a>$thirdmenu</li>\n";
						
						if($hascursubsub){
							$thirdcrumb = "<a href=\"{$sublnk}\">$secondary[0]</a> > ";
						}
						
				}
				$submenu .= '</ul>';
				
				// = = = = = = end secondary items loop ^ ^ ^ ^ ^
				
			} 
			// If a submenu item was current pass in entire submenu for page	
			if($hascursub){
				 	$page['subpages'] = $submenu;		
					$page['breadcrumbs'] .= " &raquo; <a href=\"{$topanch}\">$primary[0]</a>";
					if($thirdcrumb !== ''){
						$page['breadcrumbs'] .= " &raquo; $thirdcrumb";
					}
					
			}
		
			
		} 
		
		// Creating top level menu links
			$topmenu .= "<li class=\"{$level[0]['class']}\">";
			$topmenu .= "<a href=\"{$topanch}\"><span>$primary[0]</span></a>$submenu";
			$topmenu .= "</li>\n";
		// Add to navigation output	
		$full .= $topmenu;
	}
 		return $full;
}



/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
		
		Menu Array  v1.1
		* Up to 3 level navigation array
		* Supports direct resource links for domain instead of heirarchal 
		
		@usage   : $menu
		@bugs    : No bugs
		@future  : Custom classes for items, outside link support
		
		
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
// New in 1.1 menu settings array
$menu = 
		array(
			
			// Home Link
			array('Usage', 'home'),
			
			// Primary Nav 1 Section Links
			array('Example Nav 1', '#' ,
				// submenu	
				array(
					array('Subnav 1','sub-nav-1'),
				 	array('Subnav 2','sub-nav-2'),
					array('Subnav 3','sub-nav-3'),
				 	array('Subnav 4','sub-nav-4'),
			)),
			// ^ ^ End Primary Nav 1 Section Links
			
			
			// Another Nav 2 Section Links
			array('Example Nav 2', '#' ,
				// submenu	
				array(
					// has sub submenu
					array('Plus 1','plus-1' , 
								array(
										// sub submenu	
										array('Subplus 1','Subplus-1'),	
										array('Subplus 2','Subplus-2')
					)),
					array('Plus 2','Plus+2')
			)),
			// ^ ^ End Another Nav 2 Section Links
			
			// Almost Nav 3 Section Links
			array('Example Nav 3', '#' ,
				// submenu	
				array(
				
				 	array('All 1','all-1'),
					array('All 2','all-2'),
					array('All Direct','cheet-sheet.pdf','direct') // Add direct for root links
			)),
			// ^ ^ End Almost Nav 3 Section Links
			
			// Last Nav 4 Link
			array('Last Example 4', 'last-nav')
		);

$page['menu'] = new_menu($menu);

/* = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
		
		Request Handler  v1.1
		* Loads page current 
		* Checks if page is default php, if not loads direct resource
		* Loads site default page if page doesn't exists
		
		@usage   : new_menu($menu);
		@bugs    : No bugs
		@future  : Custom classes for items, outside link support
		
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

	// Check if file has an extension, if so load the resource else load the page .php
	if(preg_match("/\.([^\.]+)$/", $page['current'])){
		include($page['current']);
	} else {
		// Check if file exists, if so load, else load default
		$file = (file_exists ($page['current'].'.php') ? $page['current'].'.php' : $site['default']); // returns true
		include($file);
	}


?>
