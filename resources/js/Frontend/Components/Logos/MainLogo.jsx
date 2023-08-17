import React from 'react';
import { useSelector } from 'react-redux';

function MainLogo(props) {
    const uiStyles = useSelector(
        (state) => state.themes.value
    );

    return (
        <div className="grid place-items-center">
            {/* Logo base on current theme */}
            <img
                className="object-cover"
                src={`/assets/images/uyscuti-${uiStyles.theme}.png`} {...props}
            />
        </div>
    )
}

export default MainLogo;