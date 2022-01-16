import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Navbar, Nav, NavDropdown } from 'react-bootstrap';
import { BrowserRouter } from 'react-router-dom';
import { Route, NavLink, Switch , withRouter} from 'react-router-dom'





import Home from './Home';
import Menu from './Resturent/Menu';
import CheckOut from './Resturent/CheckOut';
import ThankYou from './Resturent/ThankYou';




import {connect} from 'react-redux';
import * as actions from './store/actions/index';

class App extends Component {
  state={
      loggedIn: false,
  }
  
  componentDidMount(){
    this.props.onTryAutoSignup();
  }
 
  componentWillMount(){
    console.log(localStorage.getItem('Encryptloggedin'));
      if(localStorage.getItem('Encryptloggedin') === true ){
          this.setState({loggedIn: true}); 
      }
      else{
          this.setState({loggedIn: false}); 
      } 
  }


  render() {
    return (
      <BrowserRouter>
        <div className="App">
        
         
          <Switch>
            
            <Route path="/" exact component={Home} />
            <Route path="/menu/:id?" exact component={Menu} />
            
            

            <Route path="/checkout" exact component={CheckOut} />



            <Route path="/thankyou" exact component={ThankYou} />
            
          



          </Switch>
        
        </div>
      </BrowserRouter>
    );
  }
}


const mapDispatchToProps = dispatch =>{
  return {
    onTryAutoSignup: () =>dispatch(actions.authCheckState())
  }
}

export default connect(null,mapDispatchToProps)(App);
