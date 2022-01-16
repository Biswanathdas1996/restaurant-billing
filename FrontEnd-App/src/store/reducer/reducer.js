import * as actionTypes from '../actions/actionsTypes';


const initialState ={
      apiKey:"" 
};

const reducer =(state = initialState,action)=>{
    switch(action.type){
        case actionTypes.ENCRYPT_API_KEY:
        return{
            ...state,
            apiKey:action.apiKey
        };
        default:
        return state;
    }

    
}

export default reducer;