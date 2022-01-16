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
import * as API from '../../../src/API';
class CategoryView extends React.Component {



    render() {
        let img = API.FOOD_IMG_LINK+this.props.image;
        return (
            <Card style={{borderRadius: 3}}>
      <CardActionArea>
        <CardMedia
          component="img"
          alt="Contemplative Reptile"
          height="140"
          image={img}
          title="Contemplative Reptile"
          style={{height:70}}
        />
        <CardContent style={{padding:"2px 0px"}}>
    
           <b style={{fontSize:10, marginButtom:0, fontWeight:500}}>{this.props.name}</b> 
    
        </CardContent>
      </CardActionArea>
      
    </Card>
        )
    }
}

export default CategoryView;