import React, { Fragment, PureComponent } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import { connect } from 'react-redux';
import * as actions from '../../store/actions/index';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import * as API from '../../../src/API';
class ChargeList extends PureComponent {

    state = {
        charges: [],
        itemTotal: 0,
        subTotal:0,
        total: 0,
        packingCharges: 0,
        add_ons_charges:0
    }

    componentDidMount() {
        this.fetchCharges();
        this.interval = setInterval(this.fetchCharges, 2000);
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }

    fetchCharges = () => {
        var config = {
            method: 'get',
            url: API.CURRENT_CHARGES + '?order_id=' + localStorage.getItem("orderID"),
            headers: {}
        };
        axios(config)
            .then((response) => {
                this.setState({
                    charges: response.data.charges,
                    itemTotal: response.data.item_total,
                    total: response.data.amount_paid,
                    packingCharges: response.data.packing_charges,
                    subTotal: response.data.sub_total,
                    add_ons_charges: response.data.add_ons_charges,
                  
                });
                this.props.totalamount(response.data.amount_paid.toFixed(2));

                if(localStorage.getItem("currentTotal") !==response.data.amount_paid.toFixed(2) ){
                    localStorage.setItem("currentTotal", response.data.amount_paid.toFixed(2));
                    this.props.fetchOrderData();
                }
                

                console.log(this.state.charges);
                
            })
            .catch(function (error) {
                console.log(error);
            });
    }



    render() {
        let tempTotal = 0;
        this.props.cartItems && this.props.cartItems.length > 0 ? this.props.cartItems.map((item) => {
            tempTotal = (Number(tempTotal) + Number(item.totalItemPrice)).toFixed(2);
        }) : "";



        let charge = this.state.charges ? this.state.charges.map((row) => (
            <TableRow key={row.name}>
                <TableCell component="th" scope="row">
                    {row.name} <b>{row.percent_or_fixed && row.percent_or_fixed !== null ? " ("+parseFloat(row.percent_or_fixed).toFixed(2)+"%)":""}</b>
                </TableCell>
                <TableCell align="right">
                    {row.amount}
                </TableCell>
            </TableRow>
        )) : [];

        return (
            <Fragment>



                <TableContainer component={Paper} style={{ borderRadius: '0px', background: '#8080801f', boxShadow: 'none' }}>
                    <Table aria-label="simple table" >
                        <TableBody>
                            <TableRow >
                                <TableCell component="th" scope="row">
                                    Item Total
                                            </TableCell>
                                <TableCell align="right">
                                    ₹{this.state.itemTotal ? this.state.itemTotal.toFixed(2) : "--"}

                                    {this.state.add_ons_charges ? " + ₹"+this.state.add_ons_charges.toFixed(2) : ""}
                                </TableCell>
                            </TableRow>

                            {/* <TableRow >
                                <TableCell component="th" scope="row">
                                    Sub Total
                                            </TableCell>
                                <TableCell align="right">
                                    ₹{this.state.subTotal ? this.state.subTotal.toFixed(2) : "--"}
                                </TableCell>
                            </TableRow> */}


                            {charge}


                            {this.state.packingCharges !== 0 ? (
                                <TableRow >
                                    <TableCell component="th" scope="row">
                                        Packing Charges
                                            </TableCell>
                                    <TableCell align="right">
                                        ₹{this.state.packingCharges ? parseFloat(this.state.packingCharges).toFixed(2) : "0.00"}
                                    </TableCell>
                                </TableRow>

                            ) : ""}



                            <TableRow >
                                <TableCell component="th" scope="row">
                                   <b style={{fontSize:20}}> Today's Total</b>
                                            </TableCell>
                                <TableCell align="right">
                                <b style={{fontSize:20}}>  ₹{this.state.total ? Math.round(this.state.total).toFixed(2) : "--"}</b>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </TableContainer>




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

export default connect(mapStateToProps, mapDispatchToProps)(ChargeList);
