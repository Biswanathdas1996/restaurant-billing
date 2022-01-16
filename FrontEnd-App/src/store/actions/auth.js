
import fetch from 'isomorphic-fetch';
import * as actionTypes from './actionsTypes';

export const itemAdd = (status)=>{
    return{
        type:actionTypes.ITEM_ADDED,
        itemAdd:status
    };
}

export const viewAddedItemDrawer = (status)=>{
    return{
        type:actionTypes.OPEN_ADDED_ITEM_DRAWER,
        viewAddedItemDrawer:status
    };
}

export const totalAmount = (totalAmountValue)=>{
    return{
        type:actionTypes.TOATL_AMOUNT,
        totalAmount:totalAmountValue
    };
}


export const cart = (data)=>{
    return{
        type:actionTypes.CART,
        cart:data
    };
}



export const authStart = ()=>{
    return{
        type:actionTypes.AUTH_START
    };
};






export const authSuccess =(key,userId)=>{
    return{
        type: actionTypes.AUTH_SUCCESS,
        key: key,
        userId:userId
    };
};

export const authFail =(error) => {
    return{
        type: actionTypes.AUTH_FAIL,
        error: error
    };
};

export const logout =()=> {
    localStorage.removeItem('token');
    localStorage.removeItem('uname');
    localStorage.removeItem('Encryptloggedin');

    return{
        type:actionTypes.AUTH_LOGOUT
    }
}





export const auth = (username,password)=>{
    return dispatch =>{
        dispatch(authStart());
        const data = {
            username: username,
            password: password,
        }
        fetch('https://developerpoint.in/ReactWebApi/EncryptLogin.php', {
            method: 'POST',
            body: JSON.stringify(data),
            // headers: {
            //     'Content-Type': 'application/json'
            // }
        }).then(response => response.json())
            .then(data => {
                if(data.status==1){
                    console.log(data);
                    localStorage.setItem('token', data.uid);
                    localStorage.setItem('uname', data.uname);
                    localStorage.setItem('Encryptloggedin', true);

                    dispatch(authSuccess(data.uname, data.uid));
                }else{
                    dispatch(authFail(data.msg));
                    console.log("sorry");
                }
               

            })
            .catch(err => {
                console.log(err.msg);
                dispatch(authFail(err.msg));
            });
    };
};

export const authCheckState = ()=>{
    return dispatch =>{
        const token = localStorage.getItem('token');
        const Encryptloggedin = localStorage.getItem('Encryptloggedin');
        const uname = localStorage.getItem('uname');
        if(!token){
            dispatch(logout());
        }else{
            dispatch(authSuccess(uname, token));
        }

    }
}