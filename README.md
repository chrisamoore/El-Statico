  <h2>Overview</h2>
  <p>Sometimes you need a quick easy static site - client isn't paying much or you only have a couple pages and don't need a database connection or if you do, you only need it on one page. The problem is you may need to setup a menu on each page and if you change it on one page then you have to go into the others and change it. Then you also have to highlight whether the page is current or not, which can get annoying. With El-statico many of the headaches of simple/static sites are removed. Menu's can be automatically generated based on your settings as well as heirarchal URLs. It also generates a couple items that are commonly used on each page.</p>
  <h2 id="install">Installation</h2>
  <p><strong>STEP 1::</strong> Set the index.php to the root of the website you want to install on.</p>
  <p><strong>STEP 2::</strong> Set site configuration</p>
  <pre><code>$site['URL'] = "http://yourdomain.com/index.php/";  </code></pre>
  <p>If you have your <strong>.htaccess</strong> set you can remove the .php from the $site['URL']</p>
   <pre><code><IfModule mod_rewrite.c>RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule></code></pre>

<p><strong>STEP 3::</strong> Create the menu array in the index.php</p>
<pre><code>// array(%Page Name%, %Filename%, %Submenu Array% || %direct%) 
// Omit extension in filename, unless filetype isn't .php

$menu = array(
// Standard Link
array('Home', 'home'),
  
// Link with Submenu
array('Example Nav 1', '#' ,
	array(
	// Submenu
	array('Subnav 1','sub-nav-1'),
	array('Subnav 2','sub-nav-2'),
	array('Subnav 3','sub-nav-3', 
		array(
		// Sub Submenu
		array('Subplus 1','Subplus-1'),
		array('Subplus 2','Subplus 2')
		)),
	))
);</code></pre>

<h2 id="vars-site">Site Wide Variables</h2>
    <pre><code>$site['domain']
$site['default']
$site[%custom%]*</code></pre>
<span class="explain">* define $site[%custom%] = ''; settings in index.php config</span>
    <h2 id="vars-page">Page Specific Variables</h2>
  <pre><code>$page['menu']
$page['canonical']
$page['breadcrumbs']
$page['subpages']
$page['current']
$page['body_id']
$page[%custom%]*</code></pre>
<span class="explain">* define $page[%custom%] = ''; in page each specific page</span>

<h2 id="structure-site">Example Site Structure</h2>
<pre><code>.htaccess
index.php
your-page.php
your-about.php
js/
css/
inc/
inc/footer.php
inc/header.php</code></pre>

<h2 id="structure-page">Example Page Structure</h2>
<p><strong>header.php</strong></p>
<pre><code>&lt;!doctype html&gt;
&lt;!--[if lt IE 7 ]&gt; &lt;html lang=&quot;en&quot; class=&quot;no-js ie ie6&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 7 ]&gt;    &lt;html lang=&quot;en&quot; class=&quot;no-js ie ie7&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 8 ]&gt;    &lt;html lang=&quot;en&quot; class=&quot;no-js ie ie8&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 9 ]&gt;    &lt;html lang=&quot;en&quot; class=&quot;no-js ie ie9&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if (gt IE 9)|!(IE)]&gt;&lt;!--&gt; &lt;html lang=&quot;en&quot; class=&quot;no-js no-ie&quot;&gt; &lt;!--&lt;![endif]--&gt;
&lt;head&gt;
 	&lt;meta charset=&quot;utf-8&quot;&gt;
 	&lt;!--[if IE]&gt;&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;IE=edge;chrome=1&quot;&gt;&lt;![endif]--&gt;

	&lt;title&gt;&lt;?php echo $page['title']; ?&gt; | Elstatico&lt;/title&gt;
	&lt;link rel='canonical' href='&lt;?php echo $page['canonical']; ?&gt;' /&gt;
	&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width; initial-scale=1.0; maximum-scale=1.0;&quot;&gt;
	&lt;link rel=&quot;stylesheet&quot; href=&quot;&lt;?php echo $site['domain']; ?&gt;css/normalize.css&quot; /&gt;
	&lt;link rel=&quot;stylesheet&quot; href=&quot;&lt;?php echo $site['domain']; ?&gt;css/style.css&quot; /&gt;
	&lt;script src=&quot;&lt;?php echo $site['domain']; ?&gt;js/modernizr-1.6.min.js&quot;&gt;&lt;/script&gt;

&lt;/head&gt;

&lt;body id=&quot;page-&lt;?php echo $page['body_id'];?&gt;&quot;&gt;
	&lt;div id=&quot;sitewrap&quot;&gt;
	&lt;section id=&quot;breadcrumbs&quot;&gt;
	&lt;?php echo $page['breadcrumbs'];?&gt;
	&lt;/section&gt;

	&lt;nav id=&quot;main-menu&quot;&gt;
    	&lt;ul&gt;&lt;?php echo $page['menu']; ?&gt;&lt;/ul&gt;
	&lt;/nav&gt;
	&lt;aside id=&quot;sidebar&quot;&gt;
	&lt;?php echo $page['subpages']; ?&gt;
	&lt;/aside&gt;

	&lt;section id=&quot;content&quot;&gt;
</code></pre>
<p><strong>page.php</strong></p>
<pre><code>&lt;?php

// Page Specific Includes
$page['title'] = 'Home';
include('inc/header.php');
	
?&gt;

&lt;h1&gt;&lt;?php echo $page['title']; ?&gt;&lt;/h1&gt;	
&lt;p&gt;Content can go here &lt;/p&gt;
&lt;?php include('inc/footer.php'); ?&gt;
</code></pre>

<p><strong>footer.php</strong></p>
<pre><code>&lt;/section&gt;
&lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;
&lt;footer id=&quot;footer&quot;&gt; &lt;/footer&gt;

&lt;/div&gt;
&lt;script src=&quot;//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js&quot;&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;

</code></pre>