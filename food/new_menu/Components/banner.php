	<!--banner-->
	<div class="banner" style="background: url(../control/pages/editor/customize_menu_img/<?php echo $editor[0]['img'];?>) no-repeat 0px 1px;background-size: cover;height: 100%;">
		<div class="container">
			<!--header-->
			<div class="header">
				<div class="logo">
					<h1 class="wow zoomIn animated" data-wow-delay=".5s"><a href="index.php" style="color:#E88010"><?php echo $editor[0]['official_name'];?></a></h1>
				</div>
				<div class="top-nav">
					<span class="menu"><img src="../../control/pages/editor/customize_menu_img/1.jpg" alt=""/></span>
					<ul>
						<!--<li class="wow slideInDown animated" data-wow-delay=".5s"><a class="active" href="index.php">Home</a></li>-->
						<!--<li class="wow slideInDown" data-wow-delay=".6s"><a href="about.html">About</a></li>					-->
						<!--<li class="wow slideInDown" data-wow-delay=".7s"><a href="gallery.html">Gallery</a></li>-->
					
						<!--<li class="wow slideInDown" data-wow-delay=".8s"><a href="blog.html">Blog</a></li>-->
						<!--<li class="wow slideInDown" data-wow-delay=".9s"><a href="contact.html">Contact</a></li>-->
					</ul>
					<!-- script-for-menu -->
					<script>					
						$("span.menu").click(function(){
							$(".top-nav ul").slideToggle("slow" , function(){
							});
						});
					</script>
					<!-- script-for-menu -->
				</div>
				<div class="clearfix"> </div>
			</div>	
			<!--//header-->
			<div class="bnr-text wow slideInUp animated" data-wow-delay=".5s">
				<div class="flexslider">
					<ul class="slides banner_text_custom" style="transition-duration: 0.6s; transform: translate3d(-712px, 0px, 0px); background-color: rgba(151, 32, 32, 0.34); padding: 13px;">
						<li>
							<h2 class="bnr-title">
							    <?php echo $editor[0]['slider_text_1'];?></h2>
							<p>
							    
    							<?php echo $editor[0]['slider_text_1_description'];?>
							
							</p>								
						</li>
						<li>								
							<h3 class="bnr-title"><?php echo $editor[0]['slider_text_2'];?></h3>
							<p>
							    <?php echo $editor[0]['slider_text_2_description'];?>
							</p>
						</li>
						<li>
							<h3 class="bnr-title"><?php echo $editor[0]['slider_text_3'];?></h3>
							<p>
							    <?php echo $editor[0]['slider_text_3_description'];?>
							</p>
						</li>
					</ul>
					<div class="clearfix"></div>
					<!--FlexSlider-->
					<script defer src="js/jquery.flexslider.js"></script>
					<script type="text/javascript">
						$(window).load(function(){
						  $('.flexslider').flexslider({
							animation: "slide",
							start: function(slider){
							  $('body').removeClass('loading');
							}
						  });
						});
					</script>
					<!--End-slider-script-->
				</div>
			
			</div>
		</div>	
	</div>	
	<!--//banner--> 