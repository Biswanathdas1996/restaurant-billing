<!--reservation-->
<div class="reservation">
		<div class="container">
			<h3 class="title w3agile wow fadeInDown animated" data-wow-delay=".5s" style="margin-top:20px">Make a Reservation</h3>
			<div class="book-info">
				
				<!--<div class="col-md-7 book-right agileinfo wow fadeInRight animated" data-wow-delay=".5s">-->
					<!--<form>-->
					<!--	<label class="wow fadeInDown animated" data-wow-delay=".5s">Date :</label>-->
					<!--	<input class="wow fadeInDown animated" data-wow-delay=".5s"type="date">-->
					<!--	<div class="form-left wow fadeInDown animated" data-wow-delay=".7s">-->
					<!--		<label>No.of People :</label>-->
					<!--		<select class="form-control">-->
					<!--			<option>1 Person</option>-->
					<!--			<option>2 People</option>-->
					<!--			<option>3 People</option>-->
					<!--			<option>4 People</option>-->
					<!--			<option>5 People</option>-->
					<!--			<option>More</option>-->
					<!--		</select>-->
					<!--	</div>-->
					<!--	<div class="form-right wow fadeInDown animated" data-wow-delay=".7s">-->
					<!--		<label>Time :</label>-->
					<!--		<input type="time">-->
					<!--	</div>-->
					<!--	<div class="clearfix"> </div>-->
					<!--	<label class="wow fadeInDown animated" data-wow-delay=".9s">Contact Info :</label>-->
					<!--	<input class="wow fadeInDown animated" data-wow-delay=".9s" type="text" value="Contact Info" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Contact';}" required="">-->
					<!--	<input type="submit" value="Book a Table">-->
					<!--</form>-->
                <!--</div>-->
                <div class="col-md-12 book-left wow fadeInLeft animated" data-wow-delay=".5s">
					<h4 class="wow fadeInDown animated" data-wow-delay=".5s">Working Hours:</h4>
					<h5 class="wow fadeInDown animated" data-wow-delay=".6s"><?php echo $editor[0]['working_hours'];?><br>
						<?php echo $editor[0]['special_working_hours'];?><br>
						<span class="glyphicon glyphicon-earphone"></span> <?php echo $editor[0]['contact_no'];?></h5>
					<span class="burger wow zoomIn animated" data-wow-delay=".7s"> </span>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>	
	<!--//reservation-->