import React, { Component } from 'react';
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import axios from 'axios';
import * as API from '../../../src/API';
export default class CustomerForm extends React.Component {

    state = {
        open: false,
        name: null,
        contact: null,
        email: null,
        remark: null
    }
    handleClickOpen = () => {

    }
    handleClose = () => {

        localStorage.setItem("customerId", null);
        this.setState({ open: false })
    }


    componentDidMount() {

        setTimeout(()=>{ 
            if (!localStorage.getItem("customerId")) {
                this.setState({ open: true })
            }
         }, 1000)

        

    }



    submitFrom = () => {
        var FormData = require('form-data');
        var data = new FormData();
        data.append('name', this.state.name);
        data.append('contact', this.state.contact);
        data.append('email', this.state.email);
        data.append('remark', this.state.remark);

        var config = {
            method: 'post',
            url: API.SAVE_CUSTOMER,
            headers: {},
            data: data
        };

        axios(config)
            .then((response) => {

                localStorage.setItem("customerId", response.data);
                this.setState({ open: false })


            })
            .catch(function (error) {
                console.log(error);
            });

    }

    render() {
        return (
            <div>

                <Dialog open={this.state.open} aria-labelledby="form-dialog-title">

                    <DialogTitle 
                    id="form-dialog-title"
                    style={{background:"rgb(245, 0, 87)",color:"white"}}
                    >Customer Details</DialogTitle>


                    <DialogContent style={{textAlign:'left'}}>

                        <TextField
                            autoFocus
                            margin="dense"
                            id="name"
                            label="Full Name"
                            type="text"
                            onChange={(event) => this.setState({ name: event.target.value })}
                            fullWidth
                            
                        />
                        <TextField
                            onChange={(event) => this.setState({ contact: event.target.value })}
                            margin="dense"
                            id="contact"
                            label="Contact Number"
                            type="number"
                            fullWidth
                        />
                        <TextField
                            onChange={(event) => this.setState({ email: event.target.value })}
                            margin="dense"
                            id="name"
                            label="Email Address"
                            type="email"
                            fullWidth
                        />

                        <TextField
                            onChange={(event) => this.setState({ remark: event.target.value })}
                            margin="dense"
                            id="remark"
                            label="Remark"
                            type="text"
                            fullWidth
                        />


                    </DialogContent>
                    <DialogActions>
                        <Button onClick={(event) => this.handleClose()} color="primary">
                            Cancel
          </Button>
                        <Button onClick={(event) => this.submitFrom()} color="primary">
                            Submit
          </Button>
                    </DialogActions>
                </Dialog>
            </div>
        )
    }

}
