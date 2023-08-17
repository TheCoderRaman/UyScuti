import React from 'react';

function ClearIcon({
    fill = "none",
    strokeWidth = 1.5,
    className = "w-6 h-6",
    viewBox = "0 0 24 24",
    stroke = "currentColor"
}) {
    return (
        <svg xmlns="http://www.w3.org/2000/svg" fill={fill} viewBox={viewBox} strokeWidth={strokeWidth} stroke={stroke} className={className}>
            <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    )
}

export default ClearIcon;