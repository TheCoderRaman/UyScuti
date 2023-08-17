import React from 'react';
import MainLogo from '@/Components/Logos/MainLogo.jsx';

function TopSection(props) {
    return (
        <MainLogo>
            {props.children}
        </MainLogo>
    )
}

export default TopSection;