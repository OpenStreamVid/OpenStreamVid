<?php
	include "modal/connection-modal.html";
?>	
	<div class="fixed">	
		<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large"> 
			<ul class="title-area"> 
				<li class="name"> <h1><a href="<?php echo WEBROOT ?>index"><img src="<?php echo WEBROOT .'img/site/logo2.png'; ?> " class="logo-header"></a></h1> </li> <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone --> 
			</ul> 

			<section class="top-bar-section"> 
				<!-- Left Nav Section --> 
				<ul> 		
					<li class="has-form">
					  	<div class="row collapse search-section">
					    	<div class="small-4 large-11 columns">
					      		<input type="text" id="search" name="search" placeholder="Find Video">
 					    	</div>
					   		 <div class="small-2 large-1 columns">
					      		<a id="search-button" class="button"><p class="fi-magnifying-glass"></p></a>
					    	</div>	    	
					  	</div>
					</li>
				</ul> 	

				<!-- Right Nav Section --> 
				<ul class="right"> 

					<!-- ici Connexion Déco -->
	<?php if( (!isset($_SESSION['id']) && empty($_SESSION['id'])) || (!isset($_SESSION['nickname']) && empty($_SESSION['nickname'])) ){ ?>				
					<li class="active">
						<a href="#" id="connect-button" data-reveal-id="connectionModal">
							<b id="connection">CONNECTION</b>
						</a>
					</li>
	<?php }
			else{ ?>
					 <li class="has-dropdown">
						<a><img src="<?php echo WEBROOT .'img/user/'. $_SESSION['nickname'] .'/profile.jpg'; ?>" class='profile_icon'>Your Account</a> 
						<ul class="dropdown"> 
							<li><a href="<?php echo WEBROOT ?>user">Your personal page</a></li> 
							<li><a href="<?php echo WEBROOT ?>favorites">Videos you liked</a></li> 
							<li class="active"><a id="logout">Log out</a></li> 
						</ul> 
					</li>
				<?php } ?>					
				</ul>
			</section> 
		</nav>

		<div id="results-text">
			<!-- Show Results -->
			<div id="result-search">

			</div>
		</div>
	</div>

<div class="content-wrap">