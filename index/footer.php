
<!-- footer17 -->
<section class="footer-17">
  <div class="footer17_sur py-5">
    <!-- <div class="container py-lg-5 py-md-4">
      <div class="footer17-top">
        <div class="footer17-top-left1_sur">
          <h6>Contact Us</h6>
          <ul>
            <li><a href="mailto:support@createPro.com">support@createPro.com</a></li>
            <li><a href="tel:+(21) 255 999 8888">+(21) 255 999 8888</a></li>
          </ul>
          <ul class="footers-17_social">
            <li><a href="#url" class="twitter"><span class="fa fa-twitter"></span></a></li>
            <li><a href="#url" class="facebook"><span class="fa fa-facebook"></span></a></li>
            <li><a href="#url" class="linkedin"><span class="fa fa-linkedin"></span></a></li>
            <li><a href="#url" class="instagram"><span class="fa fa-instagram"></span></a></li>
          </ul>
        </div>
        <div class="footer17-top-left2_sur">
          <h6>Products</h6>
          <ul>
            <li><a href="#features">Features</a></li>
            <li><a href="#pricing">Pricing Plans</a></li>
            <li><a href="#blog">Latest News</a></li>
            <li><a href="#help">Help desk</a></li>
            <li><a href="#support">Support</a></li>
          </ul>
        </div>
        <div class="footer17-top-left3_sur">
          <h6>Company</h6>
          <ul>
            <li><a href="about.html">About Us</a></li>
            <li><a href="#team">Join our team</a></li>
            <li><a href="contact.html">Contact us</a></li>
            <li><a href="#press">Press release</a></li>
            <li><a href="#careers">Careers</a></li>
          </ul>
        </div>
        <div class="footer17-top-left4_sur">
          <h6>Services</h6>
          <ul>
            <li><a href="#services">Digital Marketing</a></li>
            <li><a href="#seo">SEO for Business</a></li>
            <li><a href="#writing">Content writing</a></li>
            <li><a href="#design">UI Design</a></li>
          </ul>
        </div>
        <div class="footer17-top-left5_sur">
          <h6>Legal </h6>
          <ul>
            <li><a href="#url">Privacy policy</a></li>
            <li><a href="#url">Terms of use</a></li>
            <li><a href="#url">Return Policy</a></li>
          </ul>
        </div>
      </div>
    </div> -->
    <div class="copyright text-center">
      <div class="container">
        <p class="copy-footer-29">© 2020 CreatePro. All rights reserved | Designed by <a href="https://w3layouts.com"
            target="_blank">W3layouts</a></p>
      </div>
    </div>
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
      &#10548;
    </button>
    <script>
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function () {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("movetop").style.display = "block";
        } else {
          document.getElementById("movetop").style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <!-- /move top -->
  </div>
</section>
<!-- //footer17 -->

<!-- Template JavaScript -->
<script src="assets/js/jquery-3.3.1.min.js"></script>

<script src="assets/js/theme-change.js"></script><!-- theme switch js (light and dark)-->

<!-- pricing tabs js -->
<script src="assets/js/tabs.js"></script>

<!-- owlcarousel -->
<script src="assets/js/owl.carousel.js"></script>

<!-- script for tesimonials carousel slider -->
<script>
  $(document).ready(function () {
    $("#owl-demo1").owlCarousel({
      loop: true,
      nav: false,
      margin: 50,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        736: {
          items: 2,
          nav: false
        }
      }
    })
  })
</script>
<!-- //script for tesimonials carousel slider -->

<!-- script for tesimonials agency carousel slider -->
<script>
  $(document).ready(function () {
    $("#owl-agency").owlCarousel({
      loop: true,
      nav: false,
      margin: 50,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        736: {
          items: 1,
          nav: false
        }
      }
    })
  })
</script>
<!-- //script for tesimonials agency carousel slider -->

<!-- magnific popup -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script>
  $(document).ready(function () {
    $('.popup-with-zoom-anim').magnificPopup({
      type: 'inline',

      fixedContentPos: false,
      fixedBgPos: true,

      overflowY: 'auto',

      closeBtnInside: true,
      preloader: false,

      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-zoom-in'
    });

    $('.popup-with-move-anim').magnificPopup({
      type: 'inline',

      fixedContentPos: false,
      fixedBgPos: true,

      overflowY: 'auto',

      closeBtnInside: true,
      preloader: false,

      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-slide-bottom'
    });
  });
</script>
<!-- //magnific popup -->

<!-- disable body scroll which navbar is in active -->
<script>
  $(function () {
    $('.navbar-toggler').click(function () {
      $('body').toggleClass('noscroll');
    })
  });
</script>
<!-- disable body scroll which navbar is in active -->

<!--/MENU-JS-->
<script>
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 80) {
      $("#site-header").addClass("nav-fixed");
    } else {
      $("#site-header").removeClass("nav-fixed");
    }
  });

  //Main navigation Active Class Add Remove
  $(".navbar-toggler").on("click", function () {
    $("header").toggleClass("active");
  });
  $(document).on("ready", function () {
    if ($(window).width() > 991) {
      $("header").removeClass("active");
    }
    $(window).on("resize", function () {
      if ($(window).width() > 991) {
        $("header").removeClass("active");
      }
    });
  });
</script>
<!--//MENU-JS-->

<script src="assets/js/bootstrap.min.js"></script>

</body>

</html>