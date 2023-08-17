import React from 'react';
import  { useSelector } from 'react-redux';
import TranslationSwitch from '@/Components/Utils/TranslationSwitch.jsx';

function BottomSection(props) {
    const translations = useSelector(
        (state) => state.translations.value
    );

    return (
        <div className="grid place-items-center box-border pt-5 text-[#4d5156] dark:text-[#bdc1c6]">
            <TranslationSwitch />
            {props.children}
        </div>
    )
}

export default BottomSection;