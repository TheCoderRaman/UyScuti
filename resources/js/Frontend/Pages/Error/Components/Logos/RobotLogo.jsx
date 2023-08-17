import React from 'react';
import { useSelector } from 'react-redux';
import 'react-lazy-load-image-component/src/effects/blur.css';
import { LazyLoadImage } from 'react-lazy-load-image-component';

function RobotLogo(props) {
    const uiStyles = useSelector(
        (state) => state.themes.value
    );

    return (
        <div className="grid place-items-center">
            {/* Logo base on current theme */}
            <div className="object-cover">
                <LazyLoadImage
                    {...props}
                    effect="blur"
                    src={`/assets/images/errors/robot-${uiStyles.theme}.png`}
                />
            </div>
        </div>
    )
}

export default RobotLogo;