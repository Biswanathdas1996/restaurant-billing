import React, { Component } from 'react';
import Button from '@material-ui/core/Button';
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import TextField from '@material-ui/core/TextField';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import axios from 'axios';
import CheckCircleOutlineIcon from '@material-ui/icons/CheckCircleOutline';
import * as API from '../../../src/API';

export default class OrderDoneModal extends React.Component {


    completeOrder = () => {
        
        localStorage.clear();
        window.location.replace("/");
    }
    


    componentDidMount() {

    }

    render() {
        return (
            <div>

                <Dialog open={this.props.open} aria-labelledby="form-dialog-title">
                    <DialogContent>
                        <Container >
                            <Row className="mb-4">
                                <Col lg={12} md={12} sm={12} xs={12}>
                                    <center>
                                        <CheckCircleOutlineIcon style={{ fontSize: 50, margin: 10, color: '#038e03bf' }} />
                                        <h5 style={{ fontSize: 14 }}>Thank You </h5>
                                        <h5 style={{ fontSize: 16, fontWeight: 300 }}>Have a nice day!  Visit Again!</h5>
                                    </center>

                                </Col>
                            </Row>
                        </Container>


                    </DialogContent>
                    <DialogActions>
                        
                        <Button onClick={(event)=>this.completeOrder()} color="primary">
                            Ok
                        </Button>
                    </DialogActions>
                </Dialog>
            </div>
        )
    }

}
