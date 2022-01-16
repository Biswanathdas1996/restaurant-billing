import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import { Drawer, Checkbox, Button } from '@material-ui/core';
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
import CloseIcon from '@material-ui/icons/Close';
import swal from 'sweetalert';
import '../Assect/style.css';
import * as API from '../../../src/API';
class Drawers extends React.Component {


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
        loader: false
    };


    toggleDrawer = (anchor, open) => (event) => {

        this.setState({ ...this.state, [anchor]: open });

    };



    componentDidMount() {
        // console.log("componentDidMount");

        this.getData(this.props.item);
        this.getCart(this.props.item);

    }


    componentWillReceiveProps(nextProps) {
        // console.log("componentWillReceiveProps");


        this.getData(nextProps.item);
        this.getCart(nextProps.item);



    }






    getData = (id) => {
        // console.log("getData");
        this.setState({ loader: true });
        var config = {
            method: 'get',
            url: API.GET_ADD_ONS_OF_ONE_ITEM+'?item_id=' + id,
            headers: {}
        };
        axios(config)
            .then((response) => {
                this.setState({ loader: false });
                this.setState({
                    addOnes: response.data.addones,
                    drawerOpen: true,
                    itemDetails: response.data.item,
                });
                if (this.props.cart.filter(item => item.item_id === id).length > 0) {
                    this.setState({
                        totalItemPrice: this.props.cart.filter(item => item.item_id === id)[0].totalItemPrice,
                        addOnesAmout: this.props.cart.filter(item => item.item_id === id)[0].addOnesAmout
                    })
                } else {
                    this.setState({ totalItemPrice: response.data.item.price, qty: 1, addOnesAmout: 0 });
                }
                console.log("qty-getData", this.state.qty)
            })
            .catch(function (error) {
                console.log(error);
            });
    }


    getCart = (id) => {
        // console.log("getCart");
        if (this.props.cart) {
            let itemsd = this.props.cart;
            this.setState({ cartItems: itemsd });
            let filteredObject = this.props.cart.filter(item => item.item_id === id);
            this.setState({ alreadyInCart: filteredObject });
            if (filteredObject.length > 0) {
                let quantity = 1;
                if (filteredObject[0].qty > 0) {
                    quantity = filteredObject[0].qty;
                } else {
                    quantity = 1;
                }
                this.setState({
                    qty: quantity,
                    totalItemPrice: filteredObject[0].totalItemPrice,
                    selectedAddOnes: filteredObject[0].add_ones
                })
            }
        }
        // console.log("qty-getCart", this.state.qty)

    }



    updateStateList = (e, value, amount) => {
        // console.log("updateStateList");
        // console.log(e.target.checked);
        // let amount = (addoneAmount * this.state.qty);

        if (e.target.checked) {
            //append to array
            let tAdAmt = (Number(this.state.addOnesAmout) + Number(amount));
            this.setState({
                selectedAddOnes: this.state.selectedAddOnes.concat([value]),
                totalItemPrice: (Number(this.state.itemDetails.price * this.state.qty) + Number(tAdAmt * this.state.qty)).toFixed(2),
                addOnesAmout: (Number(this.state.addOnesAmout) + Number(amount)).toFixed(2),
            })
        } else {
            //remove from array
            let tAdAmt = (Number(this.state.addOnesAmout) - Number(amount));
            this.setState({
                selectedAddOnes: this.state.selectedAddOnes.filter(function (val) { return val !== value }),
                totalItemPrice: (Number(this.state.itemDetails.price * this.state.qty) + Number(tAdAmt * this.state.qty)).toFixed(2),
                addOnesAmout: (tAdAmt).toFixed(2),
            })
        }

    }

    async removeItem(id) {
        let prevItems = this.props.cart;
        let removeOld = prevItems.filter(item => item.item_id != id);
        await localStorage.setItem("cart", JSON.stringify(removeOld));
        await this.props.addCart(removeOld);
        await this.setState({ qty: 1, addOnesAmout: 0, totalItemPrice: 0, selectedAddOnes: [] });
        swal("Deleted!", "Item is Removed ", "success")
            .then((value) => {
                this.props.drawerOpend(false);
                this.updateTotalPrie();
            });
    }



    addItems = (itemId) => {
        // console.log("addItems");
        let prevItems = [];
        if (this.props.cart.length > 0) {
            // prevItems = JSON.parse(localStorage.getItem("cart"));
            prevItems = this.props.cart;
            let itemData = {
                "item_id": this.props.item,
                "add_ones": this.state.selectedAddOnes,
                "qty": this.state.qty,
                "totalItemPrice": this.state.totalItemPrice,
                "addOnesAmout": this.state.addOnesAmout,
                "itemDetails": this.state.itemDetails,
            }
            if (this.state.alreadyInCart.length > 0) {
                let removeOld = prevItems.filter(item => item.item_id != this.state.alreadyInCart[0].item_id)
                removeOld.push(itemData);
                localStorage.setItem("cart", JSON.stringify(removeOld));
                this.props.addCart(removeOld);
            } else {
                prevItems.push(itemData);
                localStorage.setItem("cart", JSON.stringify(prevItems));
                this.props.addCart(prevItems);
            }
        } else {
            let itemData = {
                "item_id": this.props.item,
                "add_ones": this.state.selectedAddOnes,
                "qty": this.state.qty,
                "totalItemPrice": this.state.totalItemPrice,
                "addOnesAmout": this.state.addOnesAmout,
                "itemDetails": this.state.itemDetails,
            }
            prevItems.push(itemData);
            localStorage.setItem("cart", JSON.stringify(prevItems));
            this.props.addCart(prevItems);
        }

        swal("Added!", "Item is Added", "success")
            .then((value) => {
                this.props.drawerOpend(false);
                this.updateTotalPrie();
                this.setState({ selectedAddOnes: [], qty: 1, totalItemPrice: 0, addOnesAmout: 0 });
            });

    }

    updateQty = (value) => {
        // console.log("updateQty");
        let tempPrice = (Number(this.state.itemDetails.price * value) + Number(this.state.addOnesAmout * value)).toFixed(2);
        this.setState({ qty: value, totalItemPrice: tempPrice });
    }


    updateTotalPrie = () => {
        let tempTotal = 0;
        this.props.cart.map((item) => {
            tempTotal = (Number(tempTotal) + Number(item.totalItemPrice)).toFixed(2);
        })
        this.props.totalamount(tempTotal);
    }


    render() {

        let img = API.FOOD_IMG_LINK + this.state.itemDetails.img;

        return (
            <div>
                {['bottom'].map((anchor) => (

                    <React.Fragment key={anchor}>
                        <Drawer anchor={anchor} open={this.props.itemAdd} >
                            <div role="presentation"
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
                                                padding: 3
                                            }}
                                            />
                                        </Col>
                                    </Row>
                                    <Row>
                                        <Col xs={5} lg={5} md={5} sm={5}>
                                            {this.state.loader ? (
                                                <Skeleton variant="circle" width={40} height={40} />
                                            ) : (
                                                    <div >
                                                        <Image src={img} className="menu_width" />
                                                    </div>
                                                )}
                                        </Col>
                                        <Col xs={7} lg={5} md={5} sm={5}>
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
                                            <Row key={data.id}>
                                                <Col xs={6}>
                                                    <p>{data.name}</p>
                                                </Col>
                                                <Col xs={3}>
                                                    <p> ₹{parseFloat(data.amount * this.state.qty).toFixed(2)}</p>
                                                </Col>
                                                <Col xs={3}>
                                                    {this.state.alreadyInCart.length > 0 ?
                                                        <FormControlLabel
                                                            control={
                                                                <Checkbox
                                                                    inputProps={{ 'aria-label': 'uncontrolled-checkbox' }}
                                                                    defaultChecked={this.state.alreadyInCart.length > 0 ? this.state.alreadyInCart[0].add_ones.includes(data.id) : false}
                                                                    onChange={
                                                                        (e) => this.updateStateList(e, data.id, data.amount)
                                                                    }
                                                                    name="checkedA" />
                                                            }
                                                        />
                                                        : (
                                                            <FormControlLabel
                                                                control={
                                                                    <Checkbox
                                                                        inputProps={{ 'aria-label': 'uncontrolled-checkbox' }}
                                                                        onChange={
                                                                            (e) => this.updateStateList(e, data.id, data.amount)
                                                                        }
                                                                        name="checkedA" />
                                                                }
                                                            />
                                                        )}
                                                </Col>
                                            </Row>
                                        )
                                    }) : ""
                                    }

                                    <Row style={{ marginBottom: 20 }}>
                                        <Col xs={8} lg={4} sm={4} md={4}><h4><b>Total: ₹{this.state.totalItemPrice}</b></h4></Col>
                                        <Col xs={4} lg={4} sm={4} md={4} style={{ display: "flex" }}>

                                            <NumericInput mobile
                                                className="form-control"
                                                // onChange={value => this.setState({ qty: value })}
                                                onChange={value => this.updateQty(value)}
                                                // onLimitReached={(isMax, msg) => console.log(isMax, msg)}
                                                min={1}
                                                defaultValue={this.state.qty}
                                                step={1}
                                                style={{
                                                    input: {
                                                        width: 100,
                                                        border: 'none',
                                                    }
                                                }}
                                            />
                                        </Col>
                                    </Row>
                                    <Row>
                                        {this.state.alreadyInCart && this.state.alreadyInCart.length > 0 ? (
                                            <Col xs={6} sm={6} lg={6}
                                                onClick={(event) => this.removeItem(this.state.itemDetails.id)}
                                                style={{
                                                    background: '#3f51b5',
                                                    padding: 15,
                                                    color: 'white',
                                                    textAlign: 'center'
                                                }}>
                                                <CancelIcon style={{ color: "white", marginRight: 3 }} />
                                                Remove
                                            </Col>
                                        ) : <Col xs={6} sm={6} lg={6}></Col>}

                                        <Col xs={6} sm={6} lg={6}
                                            onClick={(event) => this.addItems()}
                                            style={{
                                                background: 'rgb(245, 0, 87)',
                                                padding: 15,
                                                color: 'white',
                                                textAlign: 'center',
                                                cursor: 'pointer'
                                            }}>

                                            <AddToPhotosIcon style={{ color: "white", marginRight: 3 }} />
                                            {this.state.alreadyInCart && this.state.alreadyInCart.length > 0 ? "Update Item" : "Add Item"}

                                        </Col>
                                    </Row>
                                    <br />

                                </Container>
                                <Container className=" p-2"></Container>
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

export default connect(mapStateToProps, mapDispatchToProps)(Drawers);
