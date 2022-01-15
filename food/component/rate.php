<style>
    
    .rating {
  display: inline-block;
  position: relative;
  height: 50px;
  line-height: 50px;
  font-size: 50px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.rating:not(:hover) label input:checked ~ .icon,
.rating:hover label:hover input ~ .icon {
  color:  #f39c12 ;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #09f;
}
</style>

<div class="row">
    <div class="col-md-12">
<center>

 <img id="1s" class="img-responsive sts" src="asact/img/chinesefontdesign.com_2017-05-09_09-22-05.gif" alt="1 Star" style="height: 70px; display:none;"> 
 <img id="2s" class="img-responsive sts" src="asact/img/sad.gif" alt="2 star" style="height: 70px; display:none;">
 <img id="3s" class="img-responsive sts" src="asact/img/chinesefontdesign.com_2017-05-09_09-22-09.gif" alt="3 star" style="height: 70px; display:none;"> 
 <img id="4s" class="img-responsive sts" src="asact/img/chinesefontdesign.com_2017-05-09_09-22-18-1.gif" alt="4 star" style="height: 70px; display:none;"> 
 <img id="5s" class="img-responsive sts" src="asact/img/chinesefontdesign.com_2017-05-09_09-22-11.gif" alt="5 star" style="height: 70px; display:none;">
 
 <img id="0s" class="img-responsive sts" src="asact/img/chinesefontdesign.com_2017-05-09_09-22-15.gif" alt="0" style="height: 70px;"> 



<h4>
<div class="rating">
  <label>
    <input type="radio" name="rate" value="1" />
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="rate" value="2" />
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="rate" value="3" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>   
  </label>
  <label>
    <input type="radio" name="rate" value="4" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="rate" value="5" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
</div>
</h4>
</center>
</div>
</div>
<script>
    
    $(':radio').change(function() {
        $("#0s").hide();
        $(".sts").hide();
        $("#"+this.value+"s").show();
  console.log('New star rating: ' + this.value);
});
    
</script>