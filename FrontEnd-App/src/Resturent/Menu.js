import React, { Fragment } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/css/bootstrap.min.css";
import Card from "react-bootstrap/Card";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Form from "react-bootstrap/Form";
import { Button } from "@material-ui/core";
import { CopyToClipboard } from "react-copy-to-clipboard";
import Spinner from "react-bootstrap/Spinner";
import axios from "axios";
import "./Assect/style.css";
import NumericInput from "react-numeric-input";
import Drawer from "./Components/Drawer";
import CategoryView from "./Components/CategoryView";
import Carrusel from "./Components/Carrusel";
import { connect } from "react-redux";
import * as actions from "../store/actions/index";
import Fab from "@material-ui/core/Fab";
import EditIcon from "@material-ui/icons/Edit";
import BottomNavigation from "@material-ui/core/BottomNavigation";
import BottomNavigationAction from "@material-ui/core/BottomNavigationAction";
import HomeIcon from "@material-ui/icons/Home";
import FavoriteIcon from "@material-ui/icons/Favorite";
import LocationOnIcon from "@material-ui/icons/LocationOn";
import ShoppingCartIcon from "@material-ui/icons/ShoppingCart";
import AddIcon from "@material-ui/icons/Add";
import DoubleArrowIcon from "@material-ui/icons/DoubleArrow";
import { Link } from "react-router-dom";
import { Skeleton } from "@material-ui/lab";

import { makeStyles } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import InputBase from "@material-ui/core/InputBase";
import IconButton from "@material-ui/core/IconButton";
import SearchIcon from "@material-ui/icons/Search";
import CustomerForm from "./Components/CustomerForm";
import "react-loader-spinner/dist/loader/css/react-spinner-loader.css";
import Loader from "react-loader-spinner";
import * as API from "../../src/API";

class Menu extends React.Component {
  state = {
    getMenu: [],
    addItem: [],
    sessionId: null,
    tableNo: null,
    loadding: false,
    addItemId: null,
    selectItemID: null,
    cartItems: [],
    activeMenu: 0,
    loader: false,
    viewMoreCategiry: false,
    viewMore: false,
    ip: null,
    scanTime: null,
    searchData: null,
    invalidRequest: "",
    authPass: false,
  };

  componentDidMount() {
    this.auth();
    if (localStorage.getItem("requestPayment")) {
      this.props.history.push("/thankyou");
    }
  }

  //

  auth = () => {
    this.setState({ loader: true });
    var config = {
      method: "get",
      url: API.AUTH + "?token=" + this.props.match.params.id,
      headers: {},
    };
    axios(config)
      .then((response) => {
        if (response.data.status === 1) {
          this.setState({
            scanTime: response.data.data.date,
            ip: response.data.data.ip,
            tableNo: response.data.data.table_no,
            openCustomerFrom: true,
            authPass: true,
          });
          if (
            localStorage.getItem("token") &&
            localStorage.getItem("token") !== null
          ) {
            if (localStorage.getItem("token") !== this.props.match.params.id) {
              localStorage.clear();
              localStorage.setItem("token", response.data.data.token);
            } else {
              localStorage.setItem("token", response.data.data.token);
            }
          } else {
            localStorage.setItem("token", response.data.data.token);
          }

          this.getMenus();
          this.getCart();
        } else {
          this.setState({
            invalidRequest: "Please Scan QR-Code Again",
            authPass: false,
          });
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  };

  async getCart() {
    if (localStorage.getItem("cart") !== null) {
      let itemsd = JSON.parse(localStorage.getItem("cart"));
      await this.setState({ cartItems: itemsd });
      let tempTotal = 0;
      this.state.cartItems.map((item) => {
        tempTotal = (Number(tempTotal) + Number(item.totalItemPrice)).toFixed(
          2
        );
      });
      this.props.totalamount(tempTotal);
      this.props.addCart(itemsd);
    } else {
      this.props.addCart([]);
    }
  }

  getMenus(search = null) {
    let url = "";
    if (search !== null && search !== "" && search !== " ") {
      this.setState({ searchData: search });
      url = API.INDEX_PAGE_MENU + "?search=" + search;
    } else {
      this.setState({ searchData: null });
      url = API.INDEX_PAGE_MENU;
    }
    this.setState({ loader: true });
    axios.get(url).then((response) => {
      this.setState({ getMenu: response.data.data, loader: false });
    });
  }

  search = (value) => {
    this.getMenus(value);
  };

  buttonadd = (id) => {
    this.setState({ selectItemID: id });
    this.props.drawerOpend(true);
  };

  render_itrms(val) {
    const MenuItem = val.map((post, index) => {
      let img = API.FOOD_IMG_LINK + post.img;
      let id = post.id;
      let loader = "";
      let dynamicClass = "show";
      if (this.state.loadding && this.state.addItemId === id) {
        dynamicClass = "hide";
        loader = <Spinner animation="grow" variant="danger" />;
      } else {
        dynamicClass = "show";
      }

      return (
        <Row
          onClick={(event) => this.buttonadd(post.id)}
          key={post.title + index}
        >
          <Col xs={2} id={"img_" + index}>
            <div className="dish-img">
              <img
                className="rounded desc_t"
                src={img}
                alt={post.title}
                style={{ height: 50, width: 50 }}
                // onerror={(e)=>this.hideImg(index)}
              />
            </div>
          </Col>

          <Col xs={8} className="desc_t">
            <div className="dish-content">
              <h5 className="dish-title">
                <a className="title_text" style={{ fontWeight: 600 }}>
                  {post.title.substring(0, 30)}
                </a>
              </h5>
              <span className="dish-meta">
                {post.description.substring(0, 40) + "..."}
              </span>
              <p style={{ fontSize: 12, textAlign: "left" }} className="price_">
                ₹{post.price}
              </p>
            </div>
          </Col>
          <Col xs={2} style={{ paddingRight: 0, paddingLeft: 5 }}>
            <div className="dish-price">
              {this.props.cart.filter((item) => item.item_id == post.id)
                .length > 0 ? (
                <Button
                  // variant="contained"
                  variant="outlined"
                  color="primary"
                  style={{ fontSize: 12, padding: "6px 6px", fontWeight: 600 }}
                >
                  View
                </Button>
              ) : (
                <Button
                  // variant="contained"
                  variant="outlined"
                  color="secondary"
                  // onClick={(event) => this.buttonadd(post.id)}
                  style={{ fontSize: 12, padding: "6px 6px", fontWeight: 600 }}
                >
                  ADD
                  <AddIcon style={{ fontSize: 16, marginLeft: 2 }} />
                </Button>
              )}
            </div>
          </Col>
        </Row>
      );
    });
    return <div>{MenuItem}</div>;
  }

  render() {
    const Menu =
      this.state.getMenu.length > 0 ? (
        this.state.getMenu.map((post) => {
          return (
            <Col xs={12} sm={12} lg={12}>
              <h5
                className="cat_name_text text-bold"
                id={post.category}
                style={{ fontWeight: 600 }}
              >
                {post.category}
              </h5>
              {this.render_itrms(post.items)}
            </Col>
          );
        })
      ) : (
        <Container>
          <Row>
            <Col className="loader">
              <Loader
                type="Bars"
                color="rgb(245 0 87)"
                height={70}
                width={70}
                visible={this.state.loader}
              />
            </Col>
          </Row>
        </Container>
      );
    let categoryViewTemp = "";
    categoryViewTemp =
      this.state.getMenu.length > 0
        ? this.state.getMenu.slice(0, 6).map((item, index) => {
            return (
              <Col xs={4} lg={2} md={2} sm={4} style={{ padding: 10 }}>
                <a
                  href={
                    "menu/" +
                    localStorage.getItem("token") +
                    "#" +
                    item.category
                  }
                >
                  <CategoryView
                    name={item.category}
                    image={item.items[item.items.length - 1].img}
                  />
                </a>
              </Col>
            );
          })
        : "";
    let categoryView = "";
    categoryView =
      this.state.getMenu.length > 0
        ? this.state.getMenu
            .slice(6, this.state.getMenu.length)
            .map((item, index) => {
              return (
                <Col xs={4} lg={2} md={2} sm={4} style={{ padding: 10 }}>
                  <a
                    href={
                      "menu/" +
                      localStorage.getItem("token") +
                      "#" +
                      item.category
                    }
                  >
                    <CategoryView
                      name={item.category}
                      image={item.items[item.items.length - 1].img}
                    />
                  </a>
                </Col>
              );
            })
        : "";

    return (
      <Fragment>
        <CustomerForm />

        <Container fluid>
          <Row>
            <Col
              style={{
                padding: "10px 0px",
                background: "#f50057",
                color: "white",
                textAlign: "left",
              }}
            >
              <b className="pl-2" style={{ fontSize: 15 }}>
                Table No: {this.state.tableNo ? this.state.tableNo : ""}
              </b>
              <br />
              {/* <b className="pl-2" style={{fontSize:10, fontWeight:400}}>Scanned at: {this.state.scanTime ? this.state.scanTime : ""}</b> */}
            </Col>
            {/* <Col style={{ padding: '0px 10px' }} xs={12} sm={12} lg={12} md={12}>
                            
                            <h5 style={{fontSize:10}}>Scanned at: {this.state.scanTime ? this.state.scanTime : ""}</h5>
                            <h5 style={{fontSize:10}}>IP: {this.state.ip ? this.state.ip : ""}</h5>
                        </Col> */}
            <Col style={{ padding: "0px 0px" }} xs={12} sm={12} lg={12} md={12}>
              <Carrusel />
            </Col>
          </Row>
        </Container>

        {this.state.authPass ? (
          <div>
            <Container
              style={this.state.searchData !== null ? { display: "none" } : {}}
            >
              <Row>{categoryViewTemp}</Row>
              {this.state.viewMore ? <Row>{categoryView}</Row> : ""}
              <Row
                onClick={(event) =>
                  this.setState({ viewMore: !this.state.viewMore })
                }
              >
                <Col style={{ padding: "0px 10px" }}>
                  <Button
                    size="small"
                    variant="outlined"
                    style={{
                      width: "100%",
                      margin: "8px 0px",
                      fontSize: 10,
                      borderRadius: 3,
                    }}
                  >
                    {this.state.viewMore ? "View Less" : "View More"}
                  </Button>
                </Col>
              </Row>
            </Container>
            <Container>
              {this.state.selectItemID ? (
                <Drawer item={this.state.selectItemID} />
              ) : (
                ""
              )}
              <Row>
                <Col
                  style={{ padding: "0px 10px", marginTop: 10 }}
                  xs={12}
                  sm={12}
                  lg={12}
                >
                  <Paper component="form">
                    <InputBase
                      onChange={(event) => this.search(event.target.value)}
                      placeholder="What are you looking for?"
                      inputProps={{ "aria-label": "What are you looking for?" }}
                    />
                    <IconButton
                      type="submit"
                      aria-label="search"
                      style={{ padding: "5px 5px", float: "right" }}
                    >
                      <SearchIcon />
                    </IconButton>
                  </Paper>
                </Col>
                {Menu}
                <Col>
                  <h3 style={{ padding: "30px 0px", color: "#DC3546" }}>
                    {this.state.invalidRequest}
                  </h3>
                </Col>
              </Row>
            </Container>
          </div>
        ) : (
          ""
        )}
        <Col>
          <h3 style={{ padding: "30px 0px", color: "#DC3546" }}>
            {this.state.invalidRequest}
          </h3>
        </Col>

        <Container className=" p-5"></Container>
        {this.props.cart.length > 0 ? (
          <Container
            style={{
              position: "fixed",
              bottom: 0,
              width: "100%",
              backgroundColor: "white",
              boxShadow: "5px 10px 8px 10px #888888",
            }}
          >
            <Row>
              <Col style={{ padding: "15px 0px" }}>
                <span>
                  {" "}
                  <b>₹{this.props.totalAmount}</b> + Taxes
                </span>
              </Col>
              <Col
                style={{
                  background: "rgb(245, 0, 87)",
                  padding: 15,
                  color: "white",
                }}
              >
                <Link
                  to="/checkout"
                  style={{ color: "white", padding: "15px 15px" }}
                >
                  <ShoppingCartIcon style={{ marginRight: 5 }} />
                  Checkout
                </Link>
              </Col>
            </Row>
          </Container>
        ) : (
          <div></div>
          // <BottomNavigation
          //     value={this.state.activeMenu}
          //     onChange={(event, newValue) => {
          //         this.setState({ activeMenu: newValue })
          //     }}
          //     showLabels
          //     style={{ position: 'fixed', bottom: 0, width: "100%" }}>
          //     <BottomNavigationAction label="Home" icon={<HomeIcon />} />
          //     <BottomNavigationAction label="Favorite" icon={<FavoriteIcon />} />
          //     <BottomNavigationAction label="Nearby" icon={<LocationOnIcon />} />
          // </BottomNavigation>
        )}
      </Fragment>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    itemAdd: state.auth.itemAdd,
    cart: state.auth.cart,
    totalAmount: state.auth.totalAmount,
  };
};

const mapDispatchToProps = (dispatch) => {
  return {
    drawerOpend: (itemAdd) => dispatch(actions.itemAdd(itemAdd)),
    addCart: (data) => dispatch(actions.cart(data)),
    totalamount: (total) => dispatch(actions.totalAmount(total)),
  };
};

export default connect(mapStateToProps, mapDispatchToProps)(Menu);
