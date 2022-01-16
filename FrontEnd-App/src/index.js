import React from 'react';
import ReactDOM from 'react-dom';
import { createStore, applyMiddleware ,combineReducers} from 'redux';
import { Provider } from 'react-redux';
import reducer from './store/reducer/reducer';
import thunk from 'redux-thunk';

import './index.css';
import App from './App';
import registerServiceWorker from './registerServiceWorker';

import authReducer from './store/reducer/auth';


const rootReducer = combineReducers({
    auth:authReducer
});

const store = createStore(rootReducer, applyMiddleware(thunk));
// const store = createStore();


const app = [
    <Provider store={store} >
        <App />
    </Provider>
];


ReactDOM.render( app , document.getElementById('root'));
registerServiceWorker();
