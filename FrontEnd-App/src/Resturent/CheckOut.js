import React, { Fragment, Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Card from 'react-bootstrap/Card'
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import Form from 'react-bootstrap/Form';
import { Button } from '@material-ui/core';
import { CopyToClipboard } from 'react-copy-to-clipboard';
import Spinner from 'react-bootstrap/Spinner'
import axios from 'axios';
import './Assect/style.css';
import NumericInput from 'react-numeric-input';

import Drawer from './Components/Drawer';

import { connect } from 'react-redux';
import * as actions from '../store/actions/index';


import Fab from '@material-ui/core/Fab';
import EditIcon from '@material-ui/icons/Edit';

import BottomNavigation from "@material-ui/core/BottomNavigation";
import BottomNavigationAction from "@material-ui/core/BottomNavigationAction";
import HomeIcon from '@material-ui/icons/Home';
import FavoriteIcon from "@material-ui/icons/Favorite";
import LocationOnIcon from "@material-ui/icons/LocationOn";
import ShoppingCartIcon from '@material-ui/icons/ShoppingCart';
import AddIcon from '@material-ui/icons/Add';
import DoubleArrowIcon from '@material-ui/icons/DoubleArrow';
import { Link } from "react-router-dom";
import CheckCircleIcon from '@material-ui/icons/CheckCircle';

import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import ArrowBackIcon from '@material-ui/icons/ArrowBack';
import DoneIcon from '@material-ui/icons/Done';
import BackspaceIcon from '@material-ui/icons/Backspace';

import "react-loader-spinner/dist/loader/css/react-spinner-loader.css"
import Loader from 'react-loader-spinner';
import * as API from '../../src/API';
class CheckOut extends Component {

    state = {
        cartItems: [],
        selectItemID: null,
        charges: [],
        tableNo: null,
        loading: false
    }

    componentDidMount() {
        this.auth();
        if(localStorage.getItem("requestPayment")){
            this.props.history.push('/thankyou');
        }
    }


    auth = () => {
        this.setState({loading:true});
        var config = {
            method: 'get',
            url: API.AUTH+'?token=' + localStorage.getItem("token"),
            headers: {}
        };
        axios(config)
            .then((response) => {
                console.log(response.data);
                if (response.data.status === 1) {
                    this.setState({

                        tableNo: response.data.data.table_no,
                        loading:false
                    })
                    this.getCart();
                } else {
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }


  


    async getCart() {
        if (localStorage.getItem("cart") !== null) {
            let itemsd = JSON.parse(localStorage.getItem("cart"));
            await this.setState({ cartItems: itemsd });
            this.props.addCart(itemsd);
            // var config = {
            //     method: 'get',
            //     url: 'http://localhost:3009/OflineResturent/food/component/ReactWebApi/current_charges_api.php?total_amount=' + this.props.totalAmount,
            //     headers: {}
            // };
            // axios(config)
            //     .then((response) => {
            //         this.setState({ charges: response.data });
            //         console.log(this.state.charges);
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
        }
    }


    buttonadd = (id) => {
        this.setState({ selectItemID: id });
        this.props.drawerOpend(true);
    }

    addMoreItemsToOrder = () => {
        this.setState({loading:true});
        let orderID = localStorage.getItem("orderID");
        let cart = JSON.parse(localStorage.getItem("cart"));

        var config = {
            method: 'get',
            url: API.GET_ORDER_BY_ORDER_ID+'?order_id=' + localStorage.getItem("orderID"),
            headers: {}
        };
        axios(config)
            .then((response) => {
                let itemsd =response.data;
                this.setState({ cartItems: itemsd.cart});
                let orderedData = itemsd;
                orderedData.cart.map((items, index) => {
                    cart.push(items);
                })
                let totalAmount = 0;
                cart.map((item, index) => {
                    totalAmount = Number(totalAmount) + Number(item.totalItemPrice);
                })
                console.log(totalAmount);
                var myHeaders = new Headers();
                myHeaders.append("Content-Type", "application/json");
                let responce = {};
                responce.old_order_id = orderID;
                responce.total = totalAmount;
                responce.cart = cart;
                responce.table = this.state.tableNo;
                responce.token = localStorage.getItem("token");
                responce.user_id = localStorage.getItem("customerId");
                var raw = JSON.stringify(responce);
                var requestOptions = {
                    method: 'POST',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                };
                fetch(API.ADD_NEW_ORDER, requestOptions)
                    .then(response => response.json())
                    .then(result => {
                        console.log(result)
                        if (result.status === 1) {
                            localStorage.removeItem("cart");
                            // localStorage.setItem("orderedData", result.confirm_order_data);
                            localStorage.setItem("orderID", result.order_id);
                            this.setState({loading:false});
                            this.props.history.push('/thankyou')
                        }
                    })
                    .catch(error => console.log('error', error));
            })
            .catch(function (error) {
                console.log(error);
            });

        



        
    }


    submitForm = () => {
        // let totalAmount=0;
        // this.props.cart.map((item,index)=>{
        //     totalAmount=Number(totalAmount) + Number(item.totalItemPrice);
        // })
        this.setState({loading:true});
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        let responce = {};
        responce.total = this.props.totalAmount;
        responce.cart = this.props.cart;
        responce.table = this.state.tableNo;
        responce.token = localStorage.getItem("token");
        responce.user_id = localStorage.getItem("customerId");
        var raw = JSON.stringify(responce);
        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
        };

        fetch(API.ADD_NEW_ORDER, requestOptions)
            .then(response => response.json())
            .then(result => {
                console.log(result)
                if (result.status === 1) {
                    localStorage.removeItem("cart");
                    this.props.addCart([]);
                    // localStorage.setItem("orderedData", result.confirm_order_data);
                    localStorage.setItem("orderID", result.order_id);
                    this.setState({loading:false})
                    this.props.history.push('/thankyou')
                }
            })
            .catch(error => console.log('error', error));
    }



    render() {
        let tempTotal = 0;
        this.props.cart.map((item) => {
            tempTotal = (Number(tempTotal) + Number(item.totalItemPrice)).toFixed(2);
        })
        this.props.totalamount(tempTotal);
        const Cart = this.props.cart.length > 0 ? this.props.cart.map(item => {
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
                                onClick={(event) => this.buttonadd(item.itemDetails.id)}
                                style={{ fontSize: 12, padding: "6px 6px", fontWeight: 600 }}>
                                View
                                </Button>
                        </div>
                    </Col>
                </Row>
            )
        }) : (
                <div>
                    No item in cart
                </div>
            );

        let charge = "";
        if (this.state.charges.charges && this.state.charges.charges.length > 0) {
            charge = this.state.charges.charges.map((row) => (
                <TableRow key={row.name}>
                    <TableCell component="th" scope="row">
                        {row.name}
                    </TableCell>
                    <TableCell align="right">
                        {row.amount}
                    </TableCell>
                </TableRow>
            ));
        }


        return (
            <Fragment>

                {this.state.selectItemID ? <Drawer item={this.state.selectItemID} /> : ""}

                { !this.state.loading ? (
                    <div>
                        <Container style={{ marginTop: 15, display: 'grid' }}>
                            {Cart}
                            <Row>
                                <Col style={{ padding: '10px 0px 0px 0px' }}>
                                    <TableContainer component={Paper} style={{ borderRadius: '0px', background: '#8080801f', boxShadow: 'none' }}>
                                        <Table aria-label="simple table" >
                                            <TableBody>
                                                <TableRow >
                                                    <TableCell component="th" scope="row">
                                                        Item Total
                                            </TableCell>
                                                    <TableCell align="right">
                                                        {/* ₹{this.state.charges.item_total ? this.state.charges.item_total.toFixed(2) : "--"} */}
                                                        <b>₹{this.props.totalAmount}</b>  + Taxes
                                            </TableCell>
                                                </TableRow>
                                                {/* {charge} */}
                                                {/* <TableRow >
                                            <TableCell component="th" scope="row">
                                                Today's Total
                                            </TableCell>
                                            <TableCell align="right">
                                                ₹{this.state.charges.amount_paid ? this.state.charges.amount_paid.toFixed(2) : "--"}
                                            </TableCell>
                                        </TableRow> */}
                                            </TableBody>
                                        </Table>
                                    </TableContainer>
                                </Col>
                            </Row>
                        </Container>
                        <Container className=" p-5"></Container>
                        <Container
                            style={{ position: 'fixed', bottom: 0, width: "100%", backgroundColor: 'white', boxShadow: '5px 10px 8px 10px #888888' }}>
                            <Row >
                                <Col xs={6} style={{
                                    background: '#3f51b5',
                                    padding: 15,
                                    color: 'white'
                                }}>
                                    <Link to={"/menu/" + localStorage.getItem("token")} style={{ color: 'white', padding: '20px 20px' }}>
                                        <ArrowBackIcon style={{ marginRight: 5 }} />
                                    Back
                            </Link>
                                </Col>
                                {localStorage.getItem("orderID") ? (
                                    <Col xs={6} onClick={(event) => this.addMoreItemsToOrder()}
                                        style={{
                                            background: 'rgb(245, 0, 87)',
                                            padding: 15,
                                            color: 'white'
                                        }}>
                                        <CheckCircleIcon style={{ marginRight: 5 }} />
                                       Modify Order
                                    </Col>
                                ) : (
                                        <Col xs={6} onClick={(event) => this.submitForm()} style={{
                                            background: 'rgb(245, 0, 87)',
                                            padding: 15,
                                            color: 'white'
                                        }}>
                                            <CheckCircleIcon style={{ marginRight: 5 }} />
                                        Confirm Order
                                        </Col>
                                    )}
                            </Row>
                        </Container>
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

export default connect(mapStateToProps, mapDispatchToProps)(CheckOut);
