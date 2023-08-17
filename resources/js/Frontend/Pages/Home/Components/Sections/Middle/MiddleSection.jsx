import React from 'react';
import SearchBox from '@/Pages/Home/Components/Sections/Middle/Boxes/SearchBox.jsx';
import SuggestionBox from '@/Pages/Home/Components/Sections/Middle/Boxes/SuggestionBox.jsx';

function MiddleSection(props) {
    return (
        <>
            <SearchBox />
            <SuggestionBox />
            {props.children}
        </>
    )
}

export default MiddleSection;