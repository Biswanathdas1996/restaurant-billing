<div class="banner">
		<div class="container">
			<!--header-->
			<div class="header">
				<div class="logo">
					<h1 class="wow zoomIn animated" data-wow-delay=".5s"><a href="index.html">Tasty Food</a></h1>
				</div>
				<div class="top-nav">
					<span class="menu"><img src="images/menu.png" alt=""/></span>
					<ul>
						<li class="wow slideInDown animated" data-wow-delay=".5s"><a class="active" href="index.html">Home</a></li>
						<li class="wow slideInDown" data-wow-delay=".6s"><a href="about.html">About</a></li>					
						<li class="wow slideInDown" data-wow-delay=".7s"><a href="gallery.html">Gallery</a></li>
						<li class="wow slideInDown" data-wow-delay=".7s"><a href="codes.html">Codes</a></li>
						<li class="wow slideInDown" data-wow-delay=".8s"><a href="blog.html">Blog</a></li>
						<li class="wow slideInDown" data-wow-delay=".9s"><a href="contact.html">Contact</a></li>
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
					<ul class="slides">
						<li>
							<h2 class="bnr-title">Traditional baking of food</h2>
							<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecat officia deserunt mollitia laborum et dolorum fuga.</p>								
						</li>
						<li>								
							<h3 class="bnr-title">We have a lot of foodstuffs</h3>
							<p>Vero eos at et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecat officia deserunt mollitia laborum et dolorum fuga.</p>
						</li>
						<li>
							<h3 class="bnr-title">Delicious food recipes & Soups</h3>
							<p>Dignissimos at vero eos et accusamus et iusto odio ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecat officia deserunt mollitia laborum et dolorum fuga.</p>
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
				<a href="about.html" class="more more-right">More About</a>
				<a href="single.html" class="more more-left">Learn More</a>
			</div>
		</div>	
	</div>	
	<!--//banner--> 