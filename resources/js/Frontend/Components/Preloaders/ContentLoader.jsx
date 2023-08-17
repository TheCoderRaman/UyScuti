import React from 'react';
import { Circles } from 'react-loader-spinner';

function ContentLoader(props) {
    const { loading, children } = props;

    if(!loading){
        return children;
    }

    return (
        <div className="flex justify-center items-center ">
            <Circles type="Puff" color="#00BFFF" height={550} width={80} />
        </div>
    );
}

export default ContentLoader;