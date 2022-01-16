import React from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Card from 'react-bootstrap/Card';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import { TARGET_CLASSES } from './TargetClasses';
import * as tf from '@tensorflow/tfjs';
import Webcam from "react-webcam";
import Button from 'react-bootstrap/Button';
import Spinner from 'react-bootstrap/Spinner';

const $ = require('jquery');


const MODEL_PATH = '/model/model.json';


const videoConstraints = {

    facingMode: "environment"
};

const WebcamCapture = ({ that }) => {



    const webcamRef = React.useRef(null);
    const [imgSrc, setImgSrc] = React.useState(null);
    const capture = React.useCallback(() => {
        const imageSrc = webcamRef.current.getScreenshot();
        setImgSrc(imageSrc);
        $("#selected-image").attr("src", imageSrc);
        $("#prediction-list").html("Please search to see the predction");
        // $("#cameraDiv").hide();
        that.setState({ openCamera: false, openUpload: false, showOptions: false, output: true });
    }, [webcamRef, setImgSrc]);

    return (
        <div>
            <Row>
                <Col lg={12}>
                    <Webcam
                        audio={false}
                        ref={webcamRef}
                        screenshotFormat="image/jpeg"
                        style={{ width: 385 }}
                        videoConstraints={videoConstraints}
                    />
                </Col>
                <Col lg={12}>
                    <Button size="lg" variant="info" onClick={capture}>Capture photo</Button>
                    <Button
                        size="lg"
                        style={{ marginLeft: 10 }}
                        variant="danger"
                        onClick={(event) => that.setState({ openCamera: false, openUpload: false, showOptions: true, output: false })}>Close</Button>
                </Col>
            </Row>


        </div>
    );
};






class Home extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            showOptions: true,
            openCamera: false,
            openUpload: false,
            output: false,
            loader: false
        }


    }




    async loadModel() {
        try {

            let model = await tf.loadGraphModel(MODEL_PATH);

            console.log(model);
            return model;
        }
        catch (error) {
            console.log('Not found in IndexedDB. Loading and saving...1');
            console.log(error);

        }
    }




    async componentDidMount() {

        $('.progress-bar').show();
        console.log("Loading model...");
        this.loadModel();

        console.log("Model loaded.");
        $('.progress-bar').hide();
    }

    loader(){
        this.setState({ loader: true});
    }

    onClicks(){
        this.loader()
        this.handleClick();
     }

    async handleClick() {
        
        
        let image = $('#selected-image').get(0);
        console.log(image);

        console.log("Get the Immage Data");
        // Pre-process the image
        console.log("Loading image...");

        let tensor = await tf.tidy(() => tf.browser.fromPixels(image))
            .resizeNearestNeighbor([224, 224])
            .expandDims()
            .toFloat()
            .reverse(-1); // RGB -> BGR
        console.log("Processing image with TF...");
        console.log("Please Wait.......");

        try {

            let models = await tf.loadGraphModel(MODEL_PATH);


            let predictions = await models.predict(tensor).data();
            console.log(predictions);

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
            console.log(top5);

            $("#prediction-list").empty();

            top5.forEach(function (p) {
                var percrnt = (p.probability * 100);
                var result = p.className.split('-');
                // console.log(result[1])

                $("#prediction-list").append(`
            <div class="row" style="min-height: 40px;margin: 10px 0px;">
                <div class="col-lg-6">
                    <h5 style="font-size: 18px">${result[0]}: <b style="font-size: 12px">Matching ${percrnt.toFixed(0)}%</b></h5>
                </div>
                <div class="col-lg-6" >
                    <a href="https://scartz.in/product.php?catagory=${result[1]}" target="_blank"> 
                    <button id="predict-button" type="button" class="btn btn-success btn-block btn-sm" style="float: right;">Buy Now</button>
                    </a>
                </div>
            </div>
             `);
            });






        }
        catch (error) {
            console.log('Not found in IndexedDB. Loading and saving...');
            console.log(error);

        }





        // $(".loader").hide();
        this.setState({ loader: false});
        console.log("Thank you.....");


    };





    handleChange(event) {


        console.log(event.target.value);
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


    }


    render() {

        let camera = "";
        let upload = "";

        if (this.state.openCamera) {
            camera = (
                <Row id="cameraDiv" style={{ marginTop: 20 }}>
                    <Col lg={3}></Col>
                    <Col lg={6}>
                        <Card >
                            <Card.Body style={{ padding: 10 }}>



                                <WebcamCapture id="openCameraDiv" that={this} />







                            </Card.Body>
                        </Card>
                    </Col>
                    <Col lg={3}></Col>
                </Row>

            )
        }




        let options = (
            <Row style={{ marginTop: 20 }}>
                <Col lg={4}></Col>
                <Col lg={4}>
                    <Card style={{ margin: "0px 17px" }}>
                        <Card.Header style={{ fontSize: 13 }}>Choose any options</Card.Header>
                        <Card.Body>
                            <Button variant="primary"
                                size="lg"
                                onClick={(event) => this.setState({ openCamera: true, openUpload: false, showOptions: false })}
                                block>
                                Open Camera
                        </Button>
                            <Button variant="secondary"
                                size="lg"
                                onClick={(event) => this.setState({ openCamera: false, openUpload: true, showOptions: false })}
                                block>
                                Use Photo / Video
                                </Button>

                        </Card.Body>
                    </Card>
                </Col>
                <Col lg={4}></Col>
            </Row>
        )

        if (!this.state.showOptions) {
            options = "";
        }


        let loader = "";
        if (this.state.loader) {
            loader = (
                <Spinner animation="border" role="status" style={{width: 100,height: 100}}>
                    <span className="sr-only">Loading...</span>
                </Spinner>
            )
        }

        return (
            <div style={{ minHeight: "85vh", overflowX: "hidden" }}>




                {options}
                {camera}

                <div
                    style={{ marginTop: 20, display: "grid", justifyContent: "center", alignContent: "center", display: this.state.openUpload ? 'block' : 'none' }}>
                    <Row >
                        <Col lg={4} xs={0}></Col>
                        <Col lg={4} xs={12}>
                            <Card style={{ margin: "15px 15px", minWidth: 384 }}>
                                <Card.Body>
                                    <input
                                        id="image-selector"
                                        className="form-control border-0"
                                        type="file"
                                        onChange={this.handleChange}
                                    />
                                    <br></br>
                                    <Button variant="info"
                                        size="lg"
                                        onClick={(event) => this.setState({ output: true, openUpload: false })}
                                        block>
                                        Use This
                                </Button>
                                </Card.Body>
                            </Card>
                        </Col>
                        <Col lg={4} xs={0}></Col>
                    </Row>
                </div >

                <Container
                    style={{ display: "grid", justifyContent: "center", alignContent: "center", minHeight: 300, visibility: this.state.output ? 'visible' : 'hidden' }} fluid>
                    <Row style={{ minWidth: 1000 }}>
                        <Col lg={4} >
                            <img id="selected-image" className="ml-0" width="250" alt="" style={{ marginTop: 10 }} />
                        </Col>
                        <Col lg={4} style={{ display: "grid", justifyContent: "center", alignContent: "center", minWidth: 300, marginTop: 10 }}>

                            <Button variant="primary"
                                id="predict-button"
                                size="lg"
                                // onClick={this.handleClick,this.loader}
                                onClick={this.onClicks.bind(this)}
                                block>
                                Search In Scartz
                                </Button>

                            <Button variant="danger"
                                size="lg"
                                onClick={(event) => this.setState({ showOptions: true, output: false })}
                                block>
                                Try Another
                                </Button>

                        </Col>
                        <Col lg={4} style={{ display: "grid", justifyContent: "center", alignContent: "center" }}>

                            <Card style={{ margin: "15px 15px" }}>
                                <Card.Body>


                                    {loader}

                                    <div id="prediction-list">
                                        Please search to see the predction
                                    </div>
                                </Card.Body>
                            </Card>
                        </Col>
                    </Row>
                </Container>








            </div>

        )
    }
}
export default Home;