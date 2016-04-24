<?php defined('_JEXEC') or die;

   /**
    * File       index.php
    * Created    4/19/16 10:40 AM
    * Author     Tech Ninja
    * Website    http://tech-ninja.ca
    * Email      info@tech-ninja.ca
    * Copyright  Copyright (C) 2014 Tech Ninja | Web &amp IT All Rights Reserved.
    * License    GNU GPL v3 or later
    */
   
   // Load core Bootstrap CSS and Bootstrap bugfixes using class loader method. See http://docs.joomla.org/JHtml::_/11.1
   
   $app = JFactory::getApplication();
   $doc = JFactory::getDocument();
   $path = JURI::base(true).'/templates/'.$app->getTemplate().'/';
   $page = str_replace( " ", "-", strtolower( $this->title ) ) . "-page";
   
   // Primary Styles
   $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/bootstrap.min.css', $type = 'text/css', $media = 'screen,projection');
   $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/style.css', $type = 'text/css', $media = 'screen,projection');
   // Font Awesome
   // $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/font-awesome.css', $type = 'text/css', $media = 'screen,projection');
   
   // jQuery
   $doc->addScript($this->baseurl . 'templates/' . $this->template . '/js/jquery-2.1.0.min.js', 'text/javascript');
   // BootStrap JS
   $doc->addScript($this->baseurl . 'templates/' . $this->template . '/js/bootstrap.min.js', 'text/javascript');
   // jQuery
   $doc->addScript($this->baseurl . 'templates/' . $this->template . '/js/scripts.js', 'text/javascript');

?>
<!DOCTYPE html>
<html>
<!--
  //  DOCUMENT HEAD
-->

<head>
   <!--
     //  META MARKUP
   -->
   <jdoc:include type="head" />
   <meta name="viewport" content="width=device-width" />
   <!--Font Awesome CDN Fix-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
   <!-- Custom Tech Ninja Script -->
</head>
<!--
  //  DOCUMENT BODY
-->

<body class="<?php echo $page; ?>">
  
   <div class="alert-bar">
      <jdoc:include type="message" />
      <div class="toastr"></div>
   </div>
   <div class="menu-overlay"></div>
   <nav class="primary-navigation fixed flex-container">
      <?php if ($this->countModules('brand')) : ?>
      <div class="header inner">
         
         <a href="./" class="brand-link">
            <jdoc:include type="modules" name="brand" style="none" />
         </a>
         <?php if ($this->countModules('mainmenu_above')) : ?>
        
         <jdoc:include type="modules" name="mainmenu_above" style="none" />
         <?php endif; ?>
         <?php if ($this->countModules('mainmenu_links')) : ?>
         <hr class="hr_divide">
         <jdoc:include type="modules" name="mainmenu_links" style="none" />
         <?php endif; ?>
      </div>
      <?php endif; ?>
   </nav>
   <div class="page-container">
      <?php if ($this->countModules('slider')) : ?>
     
      <jdoc:include type="modules" name="slider" style="none" />
      <?php if ($this->countModules('slider_message')) : ?>
      <div class="slider-message absolute inner flex-container">
        
         <jdoc:include type="modules" name="slider_message" style="none" />
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('features')) : ?>
     
      <div class="features-container">
         <jdoc:include type="modules" name="features" style="none" />
      </div>
      <?php endif; ?>
      <?php endif; ?>
      <?php if ($this->countModules('main_message')) : ?>
      
      <div class="main-message">
         <jdoc:include type="modules" name="main_message" style="none" />
         <img class="bg" src="http://amma-techninja.c9users.io/images/amma/assets/construction-male-banner.jpg" alt="">
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('service_module')) : ?>
      
      <div class="services-module-container">
         <jdoc:include type="modules" name="service_module" style="none" />
      </div>
      <?php endif; ?>
      <div class="content inner">
         
         <jdoc:include type="component" />
      </div>
      <?php if ($this->countModules('recent_projects')) : ?>
      <div class="recent-projects-container">
       
         <div class="wrapper inner">
            <jdoc:include type="modules" name="recent_projects" style="none" />
            <?php if ($this->countModules('recent_projects_menu')) : ?>
            
            <div class="recent-projects-nav">
               <jdoc:include type="modules" name="recent_projects_menu" style="none" />
            </div>
            <?php endif; ?>
         </div>
      </div>
      <?php endif; ?>

      <?php if ($this->countModules('recent_listings')) : ?>
        <div class="recent-listings-container">
           <jdoc:include type="modules" name="recent_listings" style="none" />
        </div>
      <?php endif; ?>
     <div class="footer">
         <div class="footer-wrapper inner">
            <?php if ($this->countModules('footer_a')) : ?>
           
            <jdoc:include type="modules" name="footer_a" style="none" />
            <?php endif; ?>
            <?php if ($this->countModules('footer_b')) : ?>
           
            <jdoc:include type="modules" name="footer_b" style="none" />
            <?php endif; ?>
            <?php if ($this->countModules('footer_c')) : ?>
           
            <jdoc:include type="modules" name="footer_c" style="none" />
            <?php endif; ?>
            <?php if ($this->countModules('footer_d')) : ?>
            
            <jdoc:include type="modules" name="footer_d" style="none" />
            <?php endif; ?>
            <?php if ($this->countModules('copyright')) : ?>
           
            <jdoc:include type="modules" name="copyright" style="none" />
            <?php endif; ?>
         </div>
      </div>
      <?php if ($this->countModules('dev_tag')) : ?>
         <div class="dev-tag-wrapper">
            <jdoc:include type="modules" name="dev_tag" style="none" />
            <a href="#" class="dev-link">
               <i class="dev-chevron fa fa-lg fa-chevron-up"></i>
            </a>
         </div>
      <?php endif; ?>
   </div>
   <div class="debugger-messages">
 
      <jdoc:include type="modules" name="debug" style="none" />
   </div>
   
   <script class="menu-overlay-script">
       /////////////////////////////////////////////////////////////////////////////
       //  Menu Overlay
       /////////////////////////////////////////////////////////////////////////////
       var pageClasses = Array.prototype.slice.call(document.body.classList);
       var isHome = pageClasses.indexOf('home-page') >= 0 ? true : false;
   
       document.addEventListener('scroll', function(e) {
           var screenOffset = document.body.offsetHeight,
               yPos = window.scrollY,
               winHeight = window.innerHeight,
               overlay = document.querySelector('.menu-overlay'),
               dev_tag = document.querySelector('.dev-tag-wrapper');
   
           // Menu Overlay
           if (isHome) menuOverlay(yPos, overlay);
           // Branding
           DevBrand(yPos, dev_tag, screenOffset, winHeight);
       });
   
       function menuOverlay(yPos, overlay) {
           // Reactive Menu
           if (yPos > 100) setVisibility(overlay, 'visible');
           if (yPos < 100) setVisibility(overlay, 'hidden');
       }
   
       function DevBrand(yPos, dev_tag, screenOffset, win) {
           // Reactive Dev Tag
           var factor = .98;
   
           // console.log(["Eval", (yPos + win) > screenOffset * factor, "start val", (yPos + win), "greater than", screenOffset * factor, "Win", win]);
           if ((yPos + win) > screenOffset * factor) setVisibility(dev_tag, 'visible');
           if ((yPos + win) < screenOffset * factor) setVisibility(dev_tag, 'hidden');
       }
   
       function setVisibility(el, visibility) {
           return el.style.visibility = visibility;
       }
   </script>
</body>

</html>