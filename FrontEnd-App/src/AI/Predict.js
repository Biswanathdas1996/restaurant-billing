$("#image-selector").change(function () {
	console.log("choose a picture");
	let reader = new FileReader();
	// console.log(reader);
	reader.onload = function () {
		let dataURL = reader.result;
		$("#selected-image").attr("src", dataURL);
		$("#prediction-list").empty();

	}
	let file = $("#image-selector").prop('files')[0];
	// console.log(file);
	reader.readAsDataURL(file);
	// $(".submit_btn").click();
});



let model;
$(document).ready(async function () {
	$('.progress-bar').show();
	console.log("Loading model...");
	model = await tf.loadGraphModel('model/model.json');
	//console.log(model);
	console.log("Model loaded.");
	$('.progress-bar').hide();
});




$("#predict-button").click(async function () {

	let image = $('#selected-image').get(0);
	// console.log(image);
	console.log("Get the Immage Data");
	// Pre-process the image
	console.log("Loading image...");
	let tensor = tf.browser.fromPixels(image, 3)
		.resizeNearestNeighbor([224, 224])
		.expandDims()
		.toFloat()
		.reverse(-1); // RGB -> BGR
	console.log("Processing image with TF...");
	console.log("Please Wait.......");


	// console.log(tensor);

	let predictions = await model.predict(tensor).data();
	//console.log(predictions);

	let top5 = Array.from(predictions)
		.map(function (p, i) {

			let temp_prob = {
				probability: p,
				className: TARGET_CLASSES[i]
			};
			//console.log(temp_prob);
			return temp_prob;

		}).sort(function (a, b) {
			let probs = null;
			let probability1 = a.probability;
			let probability2 = b.probability;

			// console.log("probability1"+probability1);
			// console.log("probability2"+probability2);

			probs = probability2 - probability1;
			//console.log(probs);
			return probs;
		}).slice(0, 3);

	// console.log(top5);

	$("#prediction-list").empty();

	top5.forEach(function (p) {
		var percrnt = (p.probability * 100);
		var result = p.className.split('-');
		// console.log(result[1])

		$("#prediction-list").append(`
		<div class="row" style="min-height: 40px;margin: 10px 0px;">
			<div class="col-lg-6 col-xs-6" style="width: 50%;">
				<h5 style="font-size: 19px;">${result[0]}: <b style="font-size:12px">Matching ${percrnt.toFixed(0)}%</b></h5>
			</div>
			<div class="col-lg-6 col-xs-6" style="width: 50%;">
				<a href="https://scartz.in/product.php?catagory=${result[1]}" target="_blank"> 
					<button type="button" class="btn btn-success" style="float: right;">Buy Now</button>
				</a>
			</div>
		</div>
	 	`);
	});
	$(".loader").hide();

	console.log("Thank you.....");


});
