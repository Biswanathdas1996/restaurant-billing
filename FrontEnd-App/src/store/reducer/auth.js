import * as actionTypes from '../actions/actionsTypes';
// import state from 'sweetalert/typings/modules/state';

import {updateObject} from '../utility';

const initialState ={
    key:null,
    userId:null,
    loading: false,
    error:null, 
    itemAdd:false,
    cart:[],
    viewAddedItemDrawer:false,
    totalAmount:null 
}

const itemAdd =(state,action)=>{
    return updateObject(state, {
        itemAdd:action.itemAdd
    });
}


const viewAddedItemDrawer =(state,action)=>{
    return updateObject(state, {
        viewAddedItemDrawer:action.viewAddedItemDrawer
    });
}

const cart =(state,action)=>{
    return updateObject(state, {
        cart:action.cart
    });
}

const totalAmount =(state,action)=>{
    return updateObject(state, {
        totalAmount:action.totalAmount
    });
}



const authStart =(state,action)=>{
    return updateObject(state, {error:null, loading:true});
}




const authSuccess =(state,action)=>{
    return updateObject(state, {
        key:action.key,
        userId:action.userId,
        error:null, 
        loading:false,
       
    });
}

const authFail =(state ,action)=>{
    return updateObject(state, {
        error:action.error, 
        loading:false
    });
}

const authLogout =(state,action)=>{
    return updateObject(state, {
        key:null,
        userId:null,
    });
}



const reducer =(state = initialState ,action)=>{

    switch(action.type){
        case actionTypes.ITEM_ADDED: return itemAdd(state,action);
        case actionTypes.OPEN_ADDED_ITEM_DRAWER: return viewAddedItemDrawer(state,action);
        case actionTypes.CART: return cart(state,action);
        case actionTypes.TOATL_AMOUNT: return totalAmount(state,action);

        case actionTypes.AUTH_START: return authStart(state,action);
        case actionTypes.AUTH_SUCCESS: return authSuccess(state,action);  
        case actionTypes.AUTH_FAIL: return authFail(state,action); 
        case actionTypes.AUTH_LOGOUT: return authLogout(state);   
        default:
        return state;    
    }

}

export default reducer;