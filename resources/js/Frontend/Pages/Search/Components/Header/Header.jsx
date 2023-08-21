import React from 'react';
import { useLocation } from 'react-router';
import { frontendRoute } from '@/Utils/util';
import SearchBox from '@/Pages/Search/Components/Header/Boxes/SearchBox.jsx';
import SuggestionBox from '@/Pages/Search/Components/Header/Boxes/SuggestionBox.jsx';

function Header() {
    const { pathname } = useLocation();
    
    return (frontendRoute('Search') === pathname && (
        <div className='relative'>
            <div>
                <SearchBox />
                <SuggestionBox />
            </div>
        </div>
    ));
}

export default Header;