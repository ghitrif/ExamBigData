
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
<title>Sales page</title>
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
    <div class="sign_up_modal modal fade" id="videoSettings" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
                <div style="padding:40px">
                    <div class="form-group">
                        <label for="usr">Youtube Video ID:</label>
                        <input type="text" class="form-control" id="usr" v-model="settings.video.url">
                    </div>
                    <hr>
                    <div class="row mt40">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-primary float-right" data-dismiss="modal"><i class="fa fa-save float-left mr-2 mt-1"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sign_up_modal modal fade" id="RefundSettings" tabindex="-1" role="dialog" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      	</div>
                <div style="padding:40px">
                    <div class="form-group">
                        <label for="usr">Title</label>
                        <input type="text" class="form-control" id="usr" v-model="settings.refund.title">
                    </div>
                    
                    <div class="form-group">
                        <label for="usr">Description</label>
                        <textarea class="form-control" id="usr" v-model="settings.refund.description"></textarea>
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
    <div class="sign_up_modal modal fade" id="IncludesSettings" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <li style="height: 40px;" v-for="(include , i) in settings.includes.items" :key="i">
                            <input style="width: calc(100% - 38px); float: left;" type="text" class="form-control" id="usr" v-model="include">
                            <i @click="trash_item(settings.includes.items , i)" style="font-size: 22px; padding: 7px; cursor:pointer" class="fa fa-trash-o float-right" aria-hidden="true"></i>
                        </li>
                        <li style="height: 40px;" class="mt-4">
                            <span style="float: right;" class="btn btn__" @click="add_item(settings.includes.items)"><i class="fa fa-plus" aria-hidden="true"></i> Add New Item </span>

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
		            <img class="nav_logo_img img-fluid float-left mt20" src="/theme/images/header-logo.png" alt="header-logo.png">
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

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb csv3" :style="{backgroundImage:'url('+settings.topbar.backgrounImage+')'}">
		<div class="container" :style="{height: '100%',
    margin: '0px',
    width: '100%',
    maxWidth: '100%',
    background: 'rgba('+ settings.topbar.backgrounColor +', 0.28)' }">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb_content">
						<div class="cs_row_one csv3">
							<div class="cs_ins_container text-center">		
                            <quill-editor v-model="settings.title" 
                                    ref="quillEditor"
                                    :options="{theme: 'bubble'}"/>		
							</div>
						</div>
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

	<!-- Our Team Members -->
	<section class="our-team pb40">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-lg-12">
							<div class="courses_single_container">
								<div class="cs_row_one">
									<div class="cs_ins_container">
										<div class="courses_big_thumb">
											<div class="thumb" style="position:relative">
                                                <div class="mask">
                                                    <span class="btn btn-primary" data-toggle="modal" data-target="#videoSettings" ><i class="fa fa-cogs " aria-hidden="true"></i> Video Settings</button>
                                                </div>
                                                <iframe class="iframe_video" :src="'https://www.youtube.com/embed/'+ settings.video.url" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
										</div>
									</div>
								</div>
								<div class="cs_row_two">
									<div class="cs_overview b0p0">
                                    <quill-editor v-model="settings.overview" 
                                    ref="quillEditor"
                                    :options="{theme: 'bubble'}"/>
										<h4 class="title">Overview</h4>
										<h4 class="subtitle">Course Description</h4>
										<p class="mb30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
										<p class="mb20">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
										<h4 class="subtitle">What you'll learn</h4>
										<ul class="cs_course_syslebus">
											<li><i class="fa fa-check"></i><p>Become a UX designer.</p></li>
											<li><i class="fa fa-check"></i><p>You will be able to add UX designer to your CV</p></li>
											<li><i class="fa fa-check"></i><p>Become a UI designer.</p></li>
											<li><i class="fa fa-check"></i><p>Build & test a full website design.</p></li>
											<li><i class="fa fa-check"></i><p>Build & test a full mobile app.</p></li>
										</ul>
										<ul class="cs_course_syslebus2">
											<li><i class="fa fa-check"></i><p>Learn to design websites & mobile phone apps.</p></li>
											<li><i class="fa fa-check"></i><p>You'll learn how to choose colors.</p></li>
											<li><i class="fa fa-check"></i><p>Prototype your designs with interactions.</p></li>
											<li><i class="fa fa-check"></i><p>Export production ready assets.</p></li>
											<li><i class="fa fa-check"></i><p>All the techniques used by UX professionals</p></li>
										</ul>
										<h4 class="subtitle">Requirements</h4>
										<ul class="list_requiremetn">
											<li><i class="fa fa-circle"></i><p>You will need a copy of Adobe XD 2019 or above. A free trial can be downloaded from Adobe.</p></li>
											<li><i class="fa fa-circle"></i><p>No previous design experience is needed.</p></li>
											<li><i class="fa fa-circle"></i><p>No previous Adobe XD skills are needed.</p></li>
										</ul>
									</div>
								</div>
								<div class="cs_row_three mb-3" style="border: 1px dashed #83f183;">
									<div class="course_content b0p0">
										<div class="cc_headers">
											<h4 class="title">Course Content</h4>
											
										</div>
										<br>
										<?php foreach($course->Sections as $section): ?>
										<div class="details">
										  	<div id="accordion" class="panel-group cc_tab">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyCourseStart" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><?= $section->title ?></a>
												        </h4>
											      	</div>
												    <div id="panelBodyCourseStart" class="panel-collapse collapse show">
												        <div class="panel-body">
												        	<ul class="cs_list mb0">
												        		<?php foreach($section->Lessons as $course): ?>
												        		<li>
												        			<a href="#">
												        				<span class="flaticon-play-button-1 icon"></span>
												        				<?= $course->name ?>
												        			</a></li>
												        		<?php endforeach ?>
												        	</ul>
												        </div>
												    </div>
											    </div>
											</div>
										</div>
									<?php endforeach; ?>

									</div>
								</div>
								<div class="cs_row_four" >
									
                                <quill-editor v-model="settings.instructor" 
                                    ref="quillEditor"
                                    :options="{theme: 'bubble'}"/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xl-3">
					<div class="instructor_pricing_widget" style="border: 1px dashed #83f183;">
						<div class="price"><span>Price</span> {{course.price}}{{course.currency}} <!-- <small>$69.00</small> --></div>
						<a href="#" class="cart_btnss_white">Buy Now</a>
                        <hr>
						<h4 class="mt15 text-center">{{settings.refund.title}}</h4>
						<p>{{settings.refund.description}}</p>
                        <div class="mt-3 text-center">
                            <span class="btn btn__" data-toggle="modal" data-target="#RefundSettings"><i class="fa fa-plus" aria-hidden="true"></i> customize</span>
                        </div>
					</div>
                    
					<div class="instructor_pricing_widget"  style="border: 1px dashed #83f183;">
						
                        <h5 class="subtitle text-left">{{settings.includes.title}} </h5>
                        <ul class="price_quere_list text-left">
                            <li v-for="(include , i) in settings.includes.items" :key="i">
                                <i class="fa fa-check"></i> {{include}}
                            </li>
                           
                            <div class="mt-3 text-center">
                                <span class="btn btn__" data-toggle="modal" data-target="#IncludesSettings"><i class="fa fa-plus" aria-hidden="true"></i> customize</span>
                            </div>
                        </ul>
					</div>
					<div class="blog_tag_widget"  style="border: 1px dashed #83f183;">
						<h4 class="title">{{settings.tags.title}}</h4>
						<ul class="tag_list">
							<li class="list-inline-item" v-for="(tag , i) in settings.tags.items">
                                {{tag}}
                            </li>                           
                            <div class="mt-3 text-center">
                                <span class="btn btn__" data-toggle="modal" data-target="#TagsSettings"><i class="fa fa-plus" aria-hidden="true"></i> customize</span>
                            </div>
						</ul>
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

        
        <!-- <div class="editorRight">
            <h4>{{title}}</h4>
        </div> -->
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
/* .editorRight{    
    min-height: 100vh;
    background: #fff;
    float: left;
    width: calc(300px);
    overflow:auto;    
    position: fixed;
    right: 0px;
    top: 0px;
} */

/* width */
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