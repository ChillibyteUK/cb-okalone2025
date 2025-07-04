<?php

/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- <link rel='stylesheet' id='font-awesome-css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' media='all' /> -->
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Bold.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Bold.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Regular.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Light.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Light.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <?php
    if (get_field('gtm_property', 'options')) {
    ?>
        <!-- Google Tag Manager -->
        <script>
            <?php
            if (is_singular('guides') || is_post_type_archive('guides')) {
            ?>
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'event': 'userdata',
                    'guide_viewed': 'true',
                });
            <?php
            }
            if (is_singular('news') || is_post_type_archive('news')) {
            ?>
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'event': 'userdata',
                    'news_viewed': 'true',
                });
            <?php
            }
            if (is_singular('post') || is_home()) {
            ?>
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'event': 'userdata',
                    'blog_viewed': 'true',
                });
            <?php
            }
            ?>
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', '<?= get_field('gtm_property', 'options') ?>');
        </script>
        <!-- End Google Tag Manager -->
    <?php
    }
    if (get_field('ga_property', 'options')) {
    ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= get_field('ga_property', 'options') ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?= get_field('ga_property', 'options') ?>');
        </script>
    <?php
    }
    if (get_field('google_site_verification', 'options')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
    }
    if (get_field('bing_site_verification', 'options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
    }
    if (is_front_page() || is_page('contact-us')) {
    ?>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Organization",
                "url": "https://www.okaloneworker.com/",
                "name": "OK Alone",
                "description": "Try our lone worker app &amp; safety monitoring system with man down. Meet work alone regulations. Get started in minutes with Ok Alone&#039;s smartphone solution.",
                "logo": "https://www.okaloneworker.com/wp-content/themes/cb-okalone2025/img/oka-logo.svg",
                "sameAs": [
                    "https://www.facebook.com/okalone",
                    "https://x.com/OkAloneWorker",
                    "https://www.linkedin.com/company/ok-alone",
                    "https://www.youtube.com/channel/UCRVo8W0hCpR13jL7gkjrOjQ"
                ],
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+44-1372-664-357",
                    "contactType": "Customer service"
                }
            }
        </script>
    <?php
    }
    ?>
    <?php wp_head(); ?>
    <script type="text/javascript" async src="//l.getsitecontrol.com/v7n3e214.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7R39LXLMJQ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-7R39LXLMJQ');
    </script>    
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" /> 
</head>

<body <?php body_class(); ?>>
    <?php
    do_action('wp_body_open');

    if (get_field('gtm_property', 'options')) {
        if (!is_user_logged_in()) {
    ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe
                    src="https://www.googletagmanager.com/ns.html?id=<?= get_field('gtm_property', 'options') ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
    <?php
        }
    }
    ?>
    <div class="site" id="page">
        <header>
            <nav>
                <div class="container-xl">
                    <div class="navbar">
                        <div class="burger-menu" id="burger-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <a href="/" class="logo"><img src="<?= get_stylesheet_directory_uri() ?>/img/oka-logo.svg"></a>
                        <div class="navItems" id="navItems">
                            <a class="toggle" aria-controls="dropdownSolutions" data-href="/solutions/">Solutions</a>
                            <a class="toggle" aria-controls="dropdownSectors" data-href="/sectors/">Sectors</a>
                            <a class="navLink" href="/pricing/">Pricing</a>
                            <a class="toggle" aria-controls="dropdownAbout" data-href="/about/">About</a>
                            <a class="toggle" aria-controls="dropdownKnowledge" data-href="/resources/">Knowledge Hub</a>
                            <a class="toggle" aria-controls="dropdownSupport" data-href="/support/">Support</a>
                            <div class="navbar__extras me-xl-2">
                                <a href="https://my.okalone.net/" target="_blank">Login</a>
                                <a href="/pricing/" class="button button-yellow mb-2"><span>Get a quote</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="navMenus" id="navMenus">
                        <div id="dropdownSolutions" class="dropdownMenu">
                            <ul class="left">
                                <li class="active" aria-controls="loneWorkerApp">Lone Worker App</li>
                                <li class="" aria-controls="features">Features</li>
                                <li class="" aria-controls="platform">Platform</li>
                                <li class="" aria-controls="integrations">Integrations</li>
                            </ul>
                            <div class="right right--products active" id="loneWorkerApp">
                                <div class="h3">Lone Worker App</div>
                                <div>We provide a range of safety products including devices and apps to ensure the most appropriate solution for your organisation.</div>
                                <div class="items">
                                    <a class="item" href="/solutions/lone-worker-app/">
                                        <img class="item__image" src="/wp-content/uploads/2025/02/lone-worker-app-mobile-150x150.png">
                                        <div class="item__inner">
                                            <div class="item__title">Lone Worker App</div>
                                            <div class="item__desc">Transform your smartphone into a comprehensive lone worker safety device with the OK Alone app.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/solutions/lone-worker-desktop-app/">
                                        <img class="item__image" src="/wp-content/uploads/2025/06/app.png'">
                                        <div class="item__inner">
                                            <div class="item__title">Lone Worker Desktop App</div>
                                            <div class="item__desc">Turn any computer into a discreet safety tool for front-of-house staff.</div>
                                        </div>
                                    </a>

                                    <?php
                                    /* LEFT AS AN EXAMPLE
                        <a class="item" href="/products/cat-phones/">
                            <img class="item__image" src="<?=get_stylesheet_directory_uri()?>/img/products/CatPhone.png">
                            <div class="item__inner">
                                <div class="item__title">Cat Phones</div>
                                <div class="item__desc">Protect workers even in the harshest environments</div>
                            </div>
                        </a>
                        */
                                    ?>
                                </div>
                            </div>
                            <div class="right right--products" id="features">
                                <div class="h3">Features</div>
                                <div>We provide a range of safety products including devices and apps to ensure the most appropriate solution for your organisation.</div>
                                <div class="items">
                                    <a class="item" href="/solutions/man-down/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-fall-detection.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Man Down</div>
                                            <div class="item__desc">Automatically raise an alarm when a worker falls and becomes unresponsive.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/solutions/timed-activity/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-timed-activity.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Timed Activity</div>
                                            <div class="item__desc">Get automatic alerts if a worker fails to end a high-risk activity on time.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/solutions/mass-notifications/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-mass-notification.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Mass Notification</div>
                                            <div class="item__desc">Warn and inform your dispersed workforce through mass notification system embedded in our lone worker app.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/solutions/connectivity-and-coverage-solutions/">
                                        <img class="item__image" src="https://www.okaloneworker.com/wp-content/uploads/2025/06/connectivity.png">
                                        <div class="item__inner">
                                            <div class="item__title">Connectivity and Coverage Solutions</div>
                                            <div class="item__desc">Keep your lone workers safe and connected no matter where they are.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/solutions/panic-button/">
                                        <img class="item__image" src="https://www.okaloneworker.com/wp-content/uploads/2025/06/panic.png">
                                        <div class="item__inner">
                                            <div class="item__title">Panic Button</div>
                                            <div class="item__desc">Built-in panic button that allows workers to immediately send an emergency alert.</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="right right--products" id="platform">
                                <div class="h3">Platform</div>
                                <div>We provide a range of safety products including devices and apps to ensure the most appropriate solution for your organisation.</div>
                                <div class="items">
                                    <a class="item" href="/solutions/safety-dashboard/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-safety-dashboard.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Safety Dashboard</div>
                                            <div class="item__desc">Report and manage your lone worker service easily through our simple, cloud-based dashboard.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/solutions/24-7-safety-monitoring-center/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-safety-monitoring-centre.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Safety Monitoring Center</div>
                                            <div class="item__desc">Get 24/7 emergency help where you are through our professional Safety Monitoring Center.</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/safety-awards/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-safety-awards.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Safety Awards &amp; Training</div>
                                            <div class="item__desc">Embed and drive usage of your lone worker service by engaging your teams with our dedicated Safety Awards & dedicated training.</div>
                                        </div>
                                    </a>
								</div>
                            </div>
                            <div class="right right--products" id="integrations">
                                <div class="h3">Integrations</div>
                                <div>We provide a range of safety products including devices and apps to ensure the most appropriate solution for your organisation.</div>
                                <div class="items">
									<a class="item" href="/solutions/geotab/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-geotab.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">Geotab</div>
                                            <div class="item__desc">Protect your drivers in and out the vehicle with our fully-embedded Geotab integration.</div>
                                        </div>
                                    </a>
									<a class="item" href="/solutions/zoleo/">
                                        <img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-zoleo.png' ); ?>">
                                        <div class="item__inner">
                                            <div class="item__title">ZOLEO Satellite Phones</div>
                                            <div class="item__desc">Protect your remote workers through ZOLEO's satellite network, connected directly to our lone worker app.</div>
                                        </div>
                                    </a>
									<a class="item" href="/solutions/lone-worker-api/">
										<img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-api.png' ); ?>">
                                        <div class="item__inner">
											<div class="item__title">API</div>
                                            <div class="item__desc">Automate the data management of workers and scheduling of alerts by connecting our service to your HR or Workforce Management services.</div>
                                        </div>
                                    </a>
									<a class="item" href="/solutions/spot-lone-worker/">
										<img class="item__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icons/icon-spot.png' ); ?>">
										<div class="item__inner">
											<div class="item__title">SPOT Satellite Phones</div>
											<div class="item__desc">Get help to remote workers through our direct integration to the SPOT satellite network.</div>
										</div>
									</a>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="dropdownSectors" class="dropdownMenu">
                            <div class="items">
                                <div class="h3">By Sector</div>
                                <div class="mb-2">Whatever the risks your staff face at work, our fully accredited service will support them in an emergency.</div>
                                <ul class="cols-md-2">
                                    <li><a href="/sectors/agriculture/">Agriculture</a></li>
                                    <li><a href="/sectors/care/">Care</a></li>
                                    <li><a href="/sectors/construction/">Construction</a></li>
                                    <li><a href="/sectors/education/">Education</a></li>
                                    <li><a href="/sectors/electricians-and-hvac-technicians/">Electricians &amp; HVAC Employees</a></li>
                                    <li><a href="/sectors/logistics-and-drivers/">Logistics and Drivers</a></li>
                                    <li><a href="/sectors/municipal-government/">Municipal/Government</a></li>
                                    <li><a href="/sectors/office-and-retail-staff/">Office and Retail Staff</a></li>
                                    <li><a href="/sectors/security-companies/">Security Companies</a></li>
                                    <li><a href="/sectors/utilities/">Utilities</a></li>
                                    <li><a href="/sectors/">All Sectors</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="dropdownAbout" class="dropdownMenu">
							<ul>
								<li><a href="/about/">About Us</a></li>
								<li><a href="/about/#leadership">Leadership Team</a></li>
								<li><a href="/data-security/">Data Security</a></li>
								<li><a href="/contact-us/">Contact Us</a></li>
							</ul>

						</div>
                        <div id="dropdownKnowledge" class="dropdownMenu">
                            <div class="items mb-3">
                                <a class="item" href="/article-type/blog/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/icons/blog.png">
                                    <div class="item__inner">
                                        <div class="item__title">Blogs</div>
                                        <div class="item__desc">Tips &amp; content for safety at work</div>
                                    </div>
                                </a>
								<a class="item" href="/legislation/">
									<img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/icons/whitepapers.png">
									<div class="item__inner">
										<div class="item__title">Legislation</div>
										<div class="item__desc">Regional Lone Worker legislation</div>
									</div>
								</a>
                                <!-- a class="item" href="/news/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/icons/news.png">
                                    <div class="item__inner">
                                        <div class="item__title">News</div>
                                        <div class="item__desc">The very latest developments</div>
                                    </div>
                                </a -->
                                <a class="item" href="/resources/case-studies/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/icons/case-studies.png">
                                    <div class="item__inner">
                                        <div class="item__title">Case Studies</div>
                                        <div class="item__desc">Hear direct from our customers</div>
                                    </div>
                                </a>
                                <a class="item" href="/resources/job-roles/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/icons/whitepapers.png">
                                    <div class="item__inner">
                                        <div class="item__title">Job Roles</div>
                                        <div class="item__desc">Read how we protect different types of workers</div>
                                    </div>
                                </a>
                                <a class="item" href="/article-type/video/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/icons/videos.png">
                                    <div class="item__inner">
                                        <div class="item__title">Videos</div>
                                        <div class="item__desc">See how our lone worker tech works</div>
                                    </div>
                                </a>
                            </div>
                            <div class="w-50 ms-auto">
                                <a href="/resources/" class="knowledge-link"><span>View all Knowledge Hub</span><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
						<div id="dropdownSupport" class="dropdownMenu">
                            <ul>
                                <li><a href="https://okalone.zendesk.com/hc/en-gb" target="_blank">Help Center</a></li>
                                <li><a href="/training/">Training</a></li>
                                <li><a href="/article-type/how-to/">How To</a></li>
                                <li><a href="/contact-us/">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>