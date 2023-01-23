
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="academy, college, coursera, courses, education, elearning, kindergarten, lms, lynda, online course, online education, school, training, udemy, university">
<meta name="description" content="Edumy - LMS Online Education Course & School HTML Template">
<meta name="CreativeLayers" content="ATFN">

    <meta name="csrf-token" content="<?= csrf_token() ?>">
<!-- css file -->
<link rel="stylesheet" href="/theme/css/bootstrap.min.css">
<link rel="stylesheet" href="/theme/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.core.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.snow.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.bubble.css">

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.6/dist/vue-quill-editor.js"></script>


<!-- Responsive stylesheet -->
<link rel="stylesheet" href="/theme/css/responsive.css">
<!-- Title -->
<title>Checkout</title>
<!-- Favicon -->
<link href="<?= $course->favicon->path ?>" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="<?= $course->favicon->path ?>" sizes="128x128" rel="shortcut icon" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    	var course = <?php echo ($course) ?>;
    	var settings =  <?php echo ($page) ?> ;
    </script>
</head>
<body style="
    padding: 0px;
    margin: 0px;
">
    <div class="row" style="margin:0px; padding:0px;width: 100vw;" id="app">
    	<div class="topBarActions">
    		<li class="float-left">
    			<img class="logo_" src="<?= $course->brandingLogo->path ?>">
    		</li>
    		<li class="float-right">
    			<span @click="save" style="margin: 3px 10px;padding: 5px 25px;" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</span>
    		</li>
    	</div>
        <div class="editorLeft" style="padding-top: 45px;">

<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <img class="nav_logo_img img-fluid" src="/theme/images/header-logo.png" alt="header-logo.png">
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="#" class="navbar_brand float-left dn-smd">
		            <img style="max-height:50px" class="logo1 img-fluid" src="<?= $course->brandingLogo->path ?>" alt="header-logo.png">
		            <img style="max-height:50px" class="logo2 img-fluid" src="<?= $course->brandingLogo->path ?>" alt="header-logo2.png">
		        </a>
		        <!-- Responsive Menu Structure-->
		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
		        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">		          
		            
		        </ul>
		        <ul class="sign_up_btn pull-right dn-smd mt20">
	                <li class="list-inline-item list_s"><a href="#" class="btn " data-toggle="modal" > <span class="dn-lg">About</span></a></li>
	                <li class="list-inline-item list_s"><a href="#" class="btn flaticon-user" data-toggle="modal" data-target="#exampleModalCenter"> <span class="dn-lg" > Login</span></a></li>
	              
	            </ul><!-- Button trigger modal -->
		    </nav>
		</div>
	</header>
	<!-- Modal -->
	<div class="sign_up_modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="login_form">
							<form action="#">
								<div class="heading">
									<h3 class="text-center">Login to your account</h3>
								</div>
								 <div class="form-group">
							    	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
								</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck1">
									<label class="custom-control-label" for="exampleCheck1">Remember me</label>
									<a class="tdu btn-fpswd float-right" href="#">Forgot Password?</a>
								</div>
								<button type="submit" class="btn btn-log btn-block btn-thm2">Login</button>
								<hr>
							</form>
						</div>
				  	</div>
				  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="sign_up_form">
							<div class="heading">
								<h3 class="text-center">Create New Account</h3>
								<p class="text-center">Have an account? <a class="text-thm" href="#">Login</a></p>
							</div>
							<form action="#">
								<div class="form-group">
							    	<input type="text" class="form-control" id="exampleInputName1" placeholder="Username">
								</div>
								 <div class="form-group">
							    	<input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email Address">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
								</div>
								<div class="form-group">
							    	<input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password">
								</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck2">
									<label class="custom-control-label" for="exampleCheck2">Want to become an instructor?</label>
								</div>
								<button type="submit" class="btn btn-log btn-block btn-thm2">Register</button>
								<hr>
								<div class="row mt40">
									<div class="col-lg">
										<button type="submit" class="btn btn-block color-white bgc-fb"><i class="fa fa-facebook float-left mt5"></i> Facebook</button>
									</div>
									<div class="col-lg">
										<button type="submit" class="btn btn-block color-white bgc-gogle"><i class="fa fa-google float-left mt5"></i> Google</button>
									</div>
								</div>
							</form>
						</div>
				  	</div>
				</div>
	    	</div>
	  	</div>
	</div>
	<!-- Modal Search Button Bacground Overlay -->
    <div class="search_overlay dn-992">
		<div class="mk-fullscreen-search-overlay" id="mk-search-overlay">
		    <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button"><i class="fa fa-times"></i></a>
		    <div id="mk-fullscreen-search-wrapper">
		      <form method="get" id="mk-fullscreen-searchform">
		        <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input">
		        <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
		      </form>
		    </div>
		</div>
	</div>

	<!-- Main Header Nav For Mobile -->
	<div id="page" class="stylehome1 h0">
		<div class="mobile-menu">
			<div class="header stylehome1">
				<div class="main_logo_home2">
		            <img class="nav_logo_img img-fluid float-left mt20" src="images/header-logo.png" alt="header-logo.png">
		            <span>edumy</span>
				</div>
				<ul class="menu_bar_home2">
					<li class="list-inline-item">
	                	<div class="search_overlay">
						  <a id="search-button-listener2" class="mk-search-trigger mk-fullscreen-trigger" href="#">
						    <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
						  </a>
							<div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
							    <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i class="fa fa-times"></i></a>
							    <div id="mk-fullscreen-search-wrapper2">
							      <form method="get" id="mk-fullscreen-searchform2">
							        <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input2">
							        <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
							      </form>
							    </div>
							</div>
						</div>
					</li>
					<li class="list-inline-item"><a href="#menu"><span></span></a></li>
				</ul>
			</div>
		</div><!-- /.mobile-menu -->
		<nav id="menu" class="stylehome1">
			<ul>
				<li><span>Home</span>
	                <ul>
	                    <li><a href="index.html">Home 1</a></li>
	                    <li><a href="index2.html">Home 2</a></li>
	                    <li><a href="index3.html">Home 3</a></li>
	                    <li><a href="index4.html">Home 4</a></li>
	                    <li><a href="index5.html">Home 5</a></li>
	                    <li><a href="index6.html">Home - University</a></li>
	                    <li><a href="index7.html">Home College</a></li>
	                    <li><a href="index8.html">Home Kindergarten</a></li>
	                </ul>
				</li>
				<li><span>Courses</span>
					<ul>
						<li><span>Courses List</span>
							<ul>
	                            <li><a href="page-course-v1.html">Courses v1</a></li>
	                            <li><a href="page-course-v2.html">Courses v2</a></li>
	                            <li><a href="page-course-v3.html">Courses v3</a></li>
							</ul>
						</li>
						<li><span>Courses Single</span>
							<ul>
	                            <li><a href="page-course-single-v1.html">Single V1</a></li>
	                            <li><a href="page-course-single-v2.html">Single V2</a></li>
	                            <li><a href="page-course-single-v3.html">Single V3</a></li>
							</ul>
						</li>
                        <li><a href="page-instructors.html">Instructors</a></li>
		                <li><a href="page-instructors-single.html">Instructor Single</a></li>
					</ul>
				</li>
				<li><span>Events</span>
					<ul>
						<li><a href="page-event.html">Event List</a></li>
						<li><a href="page-event-single.html">Event Single</a></li>
					</ul>
				</li>
				<li><span>Pages</span>
					<ul>
						<li><span>Shop Pages</span>
							<ul>
			                    <li><a href="page-shop.html">Shop</a></li>
			                    <li><a href="page-shop-single.html">Shop Single</a></li>
			                    <li><a href="page-shop-cart.html">Cart</a></li>
			                    <li><a href="page-shop-checkout.html">Checkout</a></li>
			                    <li><a href="page-shop-order.html">Order</a></li>
							</ul>
						</li>
						<li><span>User Admin</span>
							<ul>
								<li><a href="page-dashboard.html">Dashboard</a></li>
								<li><a href="page-my-courses.html">My Courses</a></li>
								<li><a href="page-my-order.html">My Order</a></li>
								<li><a href="page-my-message.html">My Message</a></li>
								<li><a href="page-my-review.html">My Review</a></li>
								<li><a href="page-my-bookmarks.html">My Bookmarks</a></li>
								<li><a href="page-my-listing.html">My Listing</a></li>
								<li><a href="page-my-setting.html">My Setting</a></li>
		                    </ul>
						</li>
		                <li><a href="page-about.html">About Us</a></li>
						<li><a href="page-gallery.html">Gallery</a></li>
						<li><a href="page-faq.html">Faq</a></li>
						<li><a href="page-login.html">LogIn</a></li>
						<li><a href="page-register.html">Register</a></li>
						<li><a href="page-pricing.html">Membership</a></li>
						<li><a href="page-error.html">404 Page</a></li>
						<li><a href="page-terms.html">Terms and Conditions</a></li>
						<li><a href="page-become-instructor.html">Become an Instructor</a></li>
						<li><a href="page-ui-element.html">UI Elements</a></li>
					</ul>
				</li>
				<li><span>Blog</span>
					<ul>
	                    <li><a href="page-blog-v1.html">Blog List 1</a></li>
	                    <li><a href="page-blog-grid.html">Blog List 2</a></li>
	                    <li><a href="page-blog-list.html">Blog List 3</a></li>
	                    <li><a href="page-blog-single.html">Single Post</a></li>
					</ul>
				</li>
				<li><a href="page-contact.html">Contact</a></li>
				<li><a href="page-login.html"><span class="flaticon-user"></span> Login</a></li>
				<li><a href="page-register.html"><span class="flaticon-edit"></span> Register</a></li>
			</ul>
		</nav>
	</div>
	</div>
    <div class="sign_up_modal modal fade" id="TagsSettings" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
                <div style="padding:40px">
                    <div class="form-group">
                        <label for="usr">Section Title</label>
                        <input type="text" class="form-control" id="usr" v-model="settings.video.url">
                    </div>
                    
                    <hr>
                    <ul class="price_quere_list text-left">
                        <li style="height: 40px;" v-for="(tag , i) in settings.tags.items" :key="i">
                            <input style="width: calc(100% - 38px); float: left;" type="text" class="form-control" id="usr" v-model="tag">
                            <i @click="trash_item(settings.tags.items , i)" style="font-size: 22px; padding: 7px; cursor:pointer" class="fa fa-trash-o float-right" aria-hidden="true"></i>
                        </li>
                        <li style="height: 40px;" class="mt-4">
                            <span style="float: right;" class="btn btn__" @click="add_item(settings.tags.items)"><i class="fa fa-plus" aria-hidden="true"></i> Add New Item </span>

                        </li>
                    </ul>
                    <hr>
                    <div class="row mt40">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-primary float-right" data-dismiss="modal"><i class="fa fa-save float-left mr-2 mt-1"></i> Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sign_up_modal modal fade" id="TopBarSettings" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
                <div style="padding:40px">
                    <div class="form-group">
                        <label for="usr">Background Image</label>
                        <input @change='upload_image($event)' type="file" ref="image" style="display:none">
                        <div style="position:relative">
                            <span style="position: absolute;
    background: var(--primary);
    color:#fff;
    right: 7px;
    top: 7px;" class="btn btn__" @click="$refs.image.click()">Browse image</span>
                            <img style="border-radius: 7px;" :src="settings.topbar.backgrounImage" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usr">Background Color</label>
                        <input type="text" class="form-control" id="usr" v-model="settings.topbar.backgrounColor">
                    </div>
                    <hr>
                    <div class="row mt40">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-primary float-right" data-dismiss="modal"><i class="fa fa-save float-left mr-2 mt-1"></i> Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb" :style="{backgroundImage:'url('+settings.topbar.backgrounImage+')'}">
		<div class="container" :style="{height: '100%',
    margin: '0px',
    width: '100%',
    maxWidth: '100%',
    background: 'rgba('+ settings.topbar.backgrounColor +', 0.28)' }">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">
                            <quill-editor v-model="settings.checkout.topBarTitle" 
                                    ref="quillEditor"
                                    :options="{theme: 'bubble'}"/>	</h4>
					</div>
				</div>
			</div>
		</div>
		<span style="position: absolute;
    right: 22px;
    bottom: 10px;
    background: var(--primary);
    color: #fff;
    padding: 1px 21px;" class="btn btn__" data-toggle="modal" data-target="#TopBarSettings"><i class="fa fa-plus" aria-hidden="true"></i> customize</span>
	</section>

	<!-- Shop Checkouts Content -->
	<section class="shop-checkouts">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8 col-xl-8">
					<div class="checkout_form">

						<div class="checkout_coupon ui_kit_button">
							
						    <h4 class="mb15">Billing Details</h4>
				            <form class="form2" id="coupon_form" name="contact_form" action="#" method="post" novalidate="novalidate">
								<div class="row">
					                <div class="col-sm-6">
					                    <div class="form-group">
					                    	<label for="exampleInputName">First name *</label>
											<input id="form_name" name="form_name" class="form-control" required="required" type="text">
										</div>
					                </div>
					                <div class="col-sm-6">
					                    <div class="form-group">
					                    	<label for="exampleInputName2">Last name *</label>
											<input id="form_name2" name="form_name2" class="form-control" required="required" type="text">
										</div>
					                </div>
					                <div class="col-sm-12">
					                    <div class="form-group">
					                    	<label for="exampleInputName3">Street address *</label>
											<input id="form_name4" name="form_name4" class="form-control mb10" placeholder="House number and street name" required="required" type="text">
											<input id="form_name5" name="form_name5" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" required="required" type="text">
										</div>
					                </div>
					                <div class="col-sm-6">
					                    <div class="form-group">
					                    	<label for="exampleInputName4">Postcode / ZIP *</label>
											<input id="form_name6" name="form_name6" class="form-control" required="required" type="number">
										</div>
					                </div>
					                <div class="col-sm-6">
					                    <div class="form-group">
					                    	<label for="exampleInputPhone">Phone</label>
											<input id="form_phone" name="form_phone" class="form-control" required="required" type="text">
										</div>
					                </div>
					                <div class="col-sm-12">
					                    <div class="form-group">
					                    	<label for="exampleInputEmail">Your Email</label>
					                    	<input id="form_email" name="form_email" class="form-control required email" required="required" type="email">
					                    </div>
					                </div>
					                <div class="col-sm-12">
			                            <div class="form-group mb0">
			                            	<label class="ai_title" for="exampleInputTextArea">Additional Information</label>
			                            	<p>Order notes (optional)</p>
			                                <textarea id="form_message" name="form_message" class="form-control required" rows="7" placeholder="Notes about your order, e.g. special notes for delivery." required="required"></textarea>
			                            </div>
					                </div>
				                </div>
				            </form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xl-4">
					<div class="order_sidebar_widget mb30">
						<h4 class="title">Your Order</h4>
						<ul>
							<li class="subtitle"><p>Product <span class="float-right">Total</span></p></li>
							<li><p>Academic English × 4 <span class="float-right">$590.00</span></p></li>
							<li class="subtitle"><p>Total <span class="float-right totals color-orose">$3,589.00</span></p></li>
						</ul>
					</div>
					<!-- <div class="order_sidebar_widget mb30">
						<div class="heading text-center">
							<p>Have a coupon?</p>
							<form class="form-inline form1">
								<div class="col-12">
									<input class="form-control " type="search" placeholder="Coupon Code" aria-label="Search">
								</div>

								<div class="col-12 text-center mt-3">
						    		<button type="button" class="btn btn-primary">Apply Coupon</button>
						    	</div>
						    </form>
						</div>
					</div> -->
					<div class="ui_kit_button payment_widget_btn">
						<button type="button" class="btn dbxshad btn-lg btn-thm3 circle btn-block">Checkout Now</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Footer Bottom Area -->
	<section class="footer_bottom_area pt25 pb25">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="copyright-widget text-center">
                    <quill-editor v-model="settings.copyright" 
                                    ref="quillEditor"
                                    class="text-center"
                                    :options="{theme: 'bubble'}"/>
					</div>
				</div>
			</div>
		</div>
	</section>
<a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>
            
        </div>

        
        
    </div>

    <script type="text/javascript" src="/theme/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/theme/js/jquery-migrate-3.0.0.min.js"></script>
<script type="text/javascript" src="/theme/js/popper.min.js"></script>
<script type="text/javascript" src="/theme/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/theme/js/jquery.mmenu.all.js"></script>
<script type="text/javascript" src="/theme/js/ace-responsive-menu.js"></script>
<script type="text/javascript" src="/theme/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/theme/js/snackbar.min.js"></script>
<script type="text/javascript" src="/theme/js/simplebar.js"></script>
<script type="text/javascript" src="/theme/js/parallax.js"></script>
<script type="text/javascript" src="/theme/js/scrollto.js"></script>
<script type="text/javascript" src="/theme/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="/theme/js/jquery.counterup.js"></script>
<script type="text/javascript" src="/theme/js/wow.min.js"></script>
<script type="text/javascript" src="/theme/js/progressbar.js"></script>
<script type="text/javascript" src="/theme/js/slider.js"></script>
<script type="text/javascript" src="/theme/js/timepicker.js"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="/theme/js/script.js"></script>
<script type="text/javascript" src="/theme/js/script2.js"></script>



</body>
</html>

<style>
.editorLeft{
    height: 100vh;
    /* float: left; */
    /* width: calc(100vw - 300px); */
    width: calc(100vw);
    /* margin-right:300px; */
    /* overflow:auto */
}

::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>