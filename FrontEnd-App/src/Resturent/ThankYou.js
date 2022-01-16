import React, { Fragment, PureComponent } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import { Button } from '@material-ui/core';
import axios from 'axios';
import './Assect/style.css';
import ThankYouPageDrawer from './Components/ThankYouPageDrawer';
import { connect } from 'react-redux';
import * as actions from '../store/actions/index';
import AddIcon from '@material-ui/icons/Add';
import { Link } from "react-router-dom";
import CheckCircleOutlineIcon from '@material-ui/icons/CheckCircleOutline';
import "react-loader-spinner/dist/loader/css/react-spinner-loader.css"
import Loader from 'react-loader-spinner';
import Chargelist from './Components/ChargeList'
import OrderDoneModal from './Components/OrderDoneModal'
import swal from 'sweetalert';
import * as API from '../../src/API';
var base64 = require('base-64');
class ThankYou extends PureComponent {
    state = {
        cartItems: [],
        selectItemID: null,
        charges: [],
        itemTotal: 0,
        total: 0,
        selectedOrderItemId: null,
        itemQty: null,
        loading: false,
        completeOrder: false,
        tempItemTotal: 0,
        requestPayment: false
    }

    componentDidMount() {
        this.fetchOrderData();

        this.interval = setInterval(this.checkOredrStatus, 2000);

        if(localStorage.getItem("requestPayment")){
            this.setState({requestPayment:true})
        }

    }

    

    

    componentWillUnmount() {
        clearInterval(this.interval);
    }


    checkOredrStatus = () => {
        var config = {
            method: 'get',
            url: API.CHECK_IF_ORDER_IS_COMPLETE+'?order_id=' + localStorage.getItem("orderID"),
            headers: {}
        };
        axios(config)
            .then((response) => {
                console.log(response.data);
                if (response.data === 0) {
                    this.setState({ completeOrder: true });
                    clearInterval(this.interval);
                    localStorage.clear();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }



    fetchOrderData = () => {
        this.setState({ loading: true });
        var config = {
            method: 'get',
            url: API.GET_ORDER_BY_ORDER_ID+'?order_id=' + localStorage.getItem("orderID"),
            headers: {}
        };
        axios(config)
            .then((response) => {
                let itemsd = response.data;
                this.setState({ cartItems: itemsd.cart, loading: false });
            })
            .catch(function (error) {
                console.log(error);
            });
    }






    buttonadd = (id, order_item_id, qty, total) => {
        this.setState({ selectItemID: id, selectedOrderItemId: order_item_id, itemQty: qty, tempItemTotal: total });
        this.props.drawerOpend(true);
    }


    requestPayment = () => {

        swal({
            title: "Are you sure?",
            text: "You want to complete the order!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              this.setState({loading: true});
                var config = {
                    method: 'get',
                    url: API.REQUEST_CASH_PAYMENT+'?order_id=' + localStorage.getItem("orderID"),
                    headers: {}
                };
                axios(config)
                    .then((response) => {
                        console.log(response.data);
                        if (response.data === 1) {
                            localStorage.setItem("requestPayment", 1);
                            this.setState({requestPayment:true, loading: false})
                            swal("Please Wait!", "We will collect the payment!", "success");
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            } 
          });

        

    }


    render() {
        const Cart = this.state.cartItems.length > 0 ? this.state.cartItems.map(item => {
            let img = API.FOOD_IMG_LINK + item.itemDetails.img;
            return (
                <Row>
                    <Col xs={2}>
                        <div className="dish-img">
                            <img
                                className="rounded desc_t"
                                src={img}
                                alt={item.itemDetails.title}
                                style={{ height: 50, width: 50 }}
                            />
                        </div>
                    </Col>
                    <Col xs={8} className="desc_t">
                        <div className="dish-content">
                            <h5 className="dish-title">
                                <a className="title_text">{item.itemDetails.title.substring(0, 30)}</a>
                            </h5>
                            <span className="dish-meta">QTY: {item.qty}</span>
                            <p style={{ fontSize: 12, textAlign: "left" }} className="price_" >₹{item.totalItemPrice}</p>
                        </div>
                    </Col>
                    <Col xs={2} style={{ paddingRight: 0, paddingLeft: 5 }}>
                        <div className="dish-price">
                            <Button
                                // variant="contained"
                                variant="outlined"
                                color="primary"
                                onClick={(event) => this.buttonadd(item.itemDetails.id, item.order_item_id, item.qty, item.totalItemPrice)}
                                style={{ fontSize: 12, padding: "6px 6px", fontWeight: 600 }}>
                                View
                                </Button>
                        </div>
                    </Col>
                </Row>
            )
        }) : (
                <div>
                    No item in order
                </div>
            );

        return (
            <Fragment>
                <OrderDoneModal open={this.state.completeOrder} />
                {this.state.selectItemID ? <ThankYouPageDrawer orderdata={this.state.cartItems} itemtotal={this.state.tempItemTotal} item={this.state.selectItemID} orderitemid={this.state.selectedOrderItemId} itemQty={this.state.itemQty} /> : ""}
                { !this.state.loading ? (
                    <div>
                        <Container style={{ marginTop: 15, display: 'grid' }}>
                            <Row className="mb-4">
                                <Col lg={12} md={12} sm={12} xs={12}>
                                    <CheckCircleOutlineIcon style={{ fontSize: 50, margin: 10, color: '#038e03bf' }} />
                                    <h5 style={{ fontSize: 14 }}>Your Order Placed Successfully</h5>
                                    <h5 style={{ fontSize: 16, fontWeight: 300 }}>Order# {base64.decode(localStorage.getItem("orderID"))}</h5>
                                </Col>
                            </Row>
                            {Cart}
                            <Row>
                                <Col></Col>
                                <Col>
                                {/* {!this.state.requestPayment ? (
                                    <Link to={"/menu/" + localStorage.getItem("token")} >
                                        <Button
                                            variant="outlined"
                                            color="secondary"
                                            style={{ width: 120, fontSize: 11, float: 'right', paddingRight: 8 }}>
                                            <AddIcon style={{ marginLeft: 5, paddingRight: 3 }} />
                                            Add Item
                                        </Button>
                                    </Link >
                                ):""} */}
                                    

                                </Col>
                            </Row>
                            <Row>
                                <Col style={{ padding: '10px 0px 0px 0px' }}>

                                    <Chargelist cartItems={this.state.cartItems} fetchOrderData={this.fetchOrderData}/>

                                </Col>
                            </Row>
                        </Container>
                        <Container className=" p-5"></Container>

                        {/* {localStorage.getItem("requestPayment") && localStorage.getItem("requestPayment")? ( */}
                        {this.state.requestPayment? (
                            <Container
                                
                                style={{ position: 'fixed', bottom: 0, width: "100%", backgroundColor: '#f50057', color: 'white', fontSize: 18, fontWeight: 600 }} fluid>
                                <Row style={{ padding: '15px 0px' }}>
                                    <Col>
                                     <span>Please wait...</span>
                                     <br/>
                                      <span style={{fontSize:10}}>We Will Collect Your Payment</span>
                                    </Col>
                                </Row>
                            </Container>
                        ) : (
                            <Container
                                onClick={(event) => this.requestPayment()}
                                style={{ position: 'fixed', bottom: 0, width: "100%", backgroundColor: '#f50057', color: 'white', fontSize: 18, fontWeight: 600 }} fluid>
                                <Row style={{ padding: '15px 0px' }}>
                                    <Col>
                                        Pay Bill 
                                        {/* ₹{this.props.totalAmount ? Math.round(this.props.totalAmount).toFixed(2) : "0.00"} */}
                                    </Col>
                                </Row>
                            </Container>
                        )}



                    </div>
                ) : (
                        <Container>
                            <Row>
                                <Col className="loader">
                                    <Loader
                                        type="Bars"
                                        color="rgb(245 0 87)"
                                        height={70}
                                        width={70}
                                        visible={this.state.loading}
                                    />
                                </Col>
                            </Row>
                        </Container>
                    )}
            </Fragment>
        )
    }
}
const mapStateToProps = state => {
    return {
        itemAdd: state.auth.itemAdd,
        cart: state.auth.cart,
        totalAmount: state.auth.totalAmount
    };
}

const mapDispatchToProps = dispatch => {
    return {
        drawerOpend: (itemAdd) => dispatch(actions.itemAdd(itemAdd)),
        addCart: (data) => dispatch(actions.cart(data)),
        totalamount: (total) => dispatch(actions.totalAmount(total))
    };
}

export default connect(mapStateToProps, mapDispatchToProps)(ThankYou);
