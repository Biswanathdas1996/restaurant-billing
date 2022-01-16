import React, { Component } from 'react';

import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import CardMedia from '@material-ui/core/CardMedia';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';
import '../Assect/style.css';
import Carousel from 'react-bootstrap/Carousel';
import axios from 'axios';
import * as API from '../../../src/API';
class Carrusel extends React.Component {

    state={
      data:[]
    }
    componentDidMount(){
      var config = {
        method: 'get',
        url: API.SLIDER_DATA,
        headers: {}
    };
    axios(config)
        .then((response) => {
            console.log(response.data);
           this.setState({data:response.data});
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    render() {
        
        return (
            <Carousel>

          {this.state.data.length > 0 ? (

              this.state.data.map((item,i)=>(
                <Carousel.Item style={{height:200}}>
                <img
                  className="d-block w-100"
                  src={API.SLIDER_FOOD_IMG_LINK+item.img}
                  alt="First slide"
                  style={{filter: "brightness(60%)"}}
                />
                <Carousel.Caption>
                  <h4>{item.title}</h4>
                  <p>{item.body}</p>
                </Carousel.Caption>
                <div />
              </Carousel.Item>

              ))

          ):""}
            

            

            
          </Carousel>
        )
    }
}

export default Carrusel;