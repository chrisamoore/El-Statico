<?php

/* - - - - - - - - - - -- - - - - - - - - - - - - - - 
		Page Specific Includes  
- - - - - - - - - - - - - - - - - - - - - - - - - - */	
		$page['title'] = 'Home';
		include('inc/header.php');
	

?>
<h1><?php echo $page['title']; ?> </h1>	
	<!-- START MAINCONTENT -->
  	<h2>Site Wide Variables</h2>
    <pre><code>$site['domain']
$site['default']
$site[%custom%]*</code></pre>
<span class="explain">* define $site[%custom%] = ''; settings in index.php config</span>
    <h2>Page Specific Variables</h2>
  <pre><code>$page['menu']
$page['canonical']
$page['breadcrumbs']
$page['subpages']
$page['current']
$page['body_id']
$page[%custom%]*</code></pre>
<span class="explain">* define $page[%custom%] = ''; in page each specific page</span>
	<!-- END MAINCONTENT -->
<?php include('inc/footer.php'); ?>