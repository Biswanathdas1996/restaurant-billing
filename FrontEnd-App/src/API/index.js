const ip = window.location.hostname;
export const Base_URL = `http://${ip}:3100/restaurant-billing`;
// export const Base_URL = "https://scanncatch.com";

export const FOOD_IMG_LINK =
  Base_URL + "/food/control/pages/addNewFood/food_demo_img/";
export const SLIDER_FOOD_IMG_LINK =
  Base_URL + "/food/control/pages/slider/slider_settings_img/";
export const AUTH = Base_URL + "/food/component/ReactWebApi/auth.php";
export const INDEX_PAGE_MENU =
  Base_URL + "/food/component/ReactWebApi/index_page_menu.php";
export const GET_ORDER_BY_ORDER_ID =
  Base_URL + "/food/component/ReactWebApi/get_order_by_orderid.php";
export const ADD_NEW_ORDER =
  Base_URL + "/food/component/ReactWebApi/add_new_order.php";
export const CHECK_IF_ORDER_IS_COMPLETE =
  Base_URL + "/food/component/ReactWebApi/check_if_order_is_complete.php";
export const REQUEST_CASH_PAYMENT =
  Base_URL + "/food/component/ReactWebApi/request_cash_payment.php";
export const SLIDER_DATA =
  Base_URL + "/food/component/ReactWebApi/slider_data.php";
export const CURRENT_CHARGES =
  Base_URL + "/food/component/ReactWebApi/current_charges_api.php";
export const SAVE_CUSTOMER =
  Base_URL + "/food/component/ReactWebApi/save_customer.php";
export const GET_ADD_ONS_OF_ONE_ITEM =
  Base_URL + "/food/component/ReactWebApi/get_add_ones_for_one_item.php";
export const GET_ADD_ONS_OF_ONE_ITEM_AFTER_ORDER =
  Base_URL +
  "/food/component/ReactWebApi/get_add_ones_for_one_item_after_order.php";
