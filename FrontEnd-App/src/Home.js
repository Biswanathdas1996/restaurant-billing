import React from 'react';

import Video from "./Assect/video2.mp4";
export default class Home extends React.Component {



    render(){
        return(
            <div>
                <video ref="vidRef" src={Video} type="video/mp4"></video>
            </div>
        )
    }
}