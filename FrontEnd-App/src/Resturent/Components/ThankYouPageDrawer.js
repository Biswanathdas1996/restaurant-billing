import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import { Drawer, Checkbox, Button, Input } from '@material-ui/core';

import axios from 'axios';
import { Container, Row, Col } from 'react-bootstrap'
import NumericInput from 'react-numeric-input';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import { connect } from 'react-redux';
import * as actions from '../../store/actions/index';

import Image from 'react-bootstrap/Image'

import AddBoxIcon from '@material-ui/icons/AddBox';
import AddToPhotosIcon from '@material-ui/icons/AddToPhotos';
import CancelIcon from '@material-ui/icons/Cancel';
import { Skeleton } from '@material-ui/lab';
import TextField from '@material-ui/core/TextField';
import CloseIcon from '@material-ui/icons/Close';
import * as API from '../../../src/API';
class ThankYouPageDrawer extends React.Component {


    state = {
        bottom: false,
        addOnes: [],
        drawerOpen: false,
        selectedAddOnes: [],
        qty: 1,
        cartItems: [],
        alreadyInCart: [],
        itemData: [],
        totalItemPrice: 0,
        addOnesAmout: 0,
        itemDetails: [],
        loader: false,
        itemQty:1
    };


    toggleDrawer = (anchor, open) => (event) => {
        this.setState({ ...this.state, [anchor]: open });
    };



    componentDidMount() {
        this.getData(this.props.item, this.props.orderitemid,this.props.itemQty);
        this.setState({itemQty:this.props.itemQty})
    }


    componentWillReceiveProps(nextProps) {
        this.getData(nextProps.item, nextProps.orderitemid,nextProps.itemQty);
        this.setState({itemQty:nextProps.itemQty})
    }

    getData = (id, orderitemid,qty) => {
        // console.log("getData");
        this.setState({ loader: true });
        var config = {
            method: 'get',
            url: API.GET_ADD_ONS_OF_ONE_ITEM_AFTER_ORDER+'?item_id=' + id + "&order_item_id=" + orderitemid + "&order_id=" + localStorage.getItem("orderID"),
            headers: {}
        };
        axios(config)
            .then((response) => {
                console.log(response);
                
                this.setState({
                    addOnes: response.data.addones,
                    drawerOpen: true,
                    itemDetails: response.data.item,
                    loader: false
                });
                if (this.props.orderdata.filter(item => item.item_id === id).length > 0) {
                    this.setState({
                        totalItemPrice: this.props.orderdata.filter(item => item.item_id === id)[0].totalItemPrice,
                        addOnesAmout: this.props.orderdata.filter(item => item.item_id === id)[0].addOnesAmout
                    })
                } else {
                    this.setState({ totalItemPrice: response.data.item.price, qty: 1, addOnesAmout: 0 });
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }


    render() {
        let img = API.FOOD_IMG_LINK + this.state.itemDetails.img;
        return (
            <div>
                {['bottom'].map((anchor) => (
                    <React.Fragment key={anchor}>
                        <Drawer anchor={anchor} open={this.props.itemAdd} >
                            <div
                                role="presentation"
                            // onClick={(event)=>this.props.drawerOpend(false)}
                            >
                                <br />
                                <Container>
                                    <Row onClick={(event) => this.props.drawerOpend(false)}>
                                        <Col>
                                            <CloseIcon style={{ 
                                                float: 'right',
                                                marginTop: -15,
                                                marginBottom: 20,
                                                fontSize: 35,
                                                color: '#f908085c',
                                                padding:3
                                            }}/>
                                        </Col>
                                    </Row>
                                    <Row>
                                        <Col xs={5}>
                                            {this.state.loader ? (
                                                <Skeleton variant="circle" width={40} height={40} />
                                            ) : (
                                                    <Image src={img} fluid />
                                                )}
                                        </Col>
                                        <Col xs={7}>
                                            {this.state.loader ? (
                                                <Skeleton animation="wave" />
                                            ) : (
                                                    <div>
                                                        <h5 style={{ fontSize: 12 }}>{this.state.itemDetails.title}</h5>
                                                        <p style={{ fontSize: 10, margin: '15px 0px' }}>{this.state.itemDetails.description}</p>
                                                    </div>
                                                )}
                                        </Col>
                                    </Row>
                                </Container>
                                <Container style={{ marginTop: 15 }}>
                                    {this.state.addOnes.length > 0 ? this.state.addOnes.map((data, index) => {
                                        return (
                                            <Row key={data.name+index}>
                                                <Col xs={6}>
                                                    <p>{data.name}</p>
                                                </Col>
                                                <Col xs={3}>
                                                    <p> {data.amount * this.state.itemQty}</p>
                                                </Col>
                                                <Col xs={3}>
                                                    <Checkbox disabled checked inputProps={{ 'aria-label': 'disabled checked checkbox' }} />
                                                </Col>
                                            </Row>
                                        )
                                    }) : ""
                                    }
                                    <Row className="mt-3">
                                        <Col xs={8}><h4><b>Total: Rs.{this.props.itemtotal}</b></h4></Col>
                                        <Col xs={4}>
                                            <TextField
                                                id="outlined-read-only-input"
                                                label="QTY"
                                                defaultValue={this.state.itemQty}
                                                InputProps={{
                                                    readOnly: true
                                                }}
                                                variant="outlined"
                                                size="small"
                                            />
                                        </Col>
                                    </Row>
                                    <br />
                                </Container>
                            </div>
                        </Drawer>
                    </React.Fragment>
                )
                )
                }
            </div>
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
        drawerOpend: (itemAdds) => dispatch(actions.itemAdd(itemAdds)),
        addCart: (data) => dispatch(actions.cart(data)),
        totalamount: (total) => dispatch(actions.totalAmount(total))
    };
}

export default connect(mapStateToProps, mapDispatchToProps)(ThankYouPageDrawer);
