import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import BulbIcon from '@/Components/Icons/BulbIcon.jsx';
import MoonIcon from '@/Components/Icons/MoonIcon.jsx';
import { setTheme as setCurrentTheme } from '@/Redux/features/themes/themesSlice';

function ThemeSwitch() {
    const dispatch = useDispatch();

    const uiStyles = useSelector(
        (state) => state.themes.value
    );

    const handleThemeChange = () => {
        Object.entries(uiStyles.themes).map(([key, value]) => {
            if (value.mode === uiStyles.themes[
                uiStyles.theme].mode
            ) {
                return;
            }

            dispatch(setCurrentTheme(key));
        });
    };

    return (
        <div className="flow-root">
            <div className="float-right">
                <button
                    type="button"
                    onClick={handleThemeChange}
                    className="dark:text-[#FEFF86] text-dark rounded-full-500 p-2"
                >
                    {/* Dark Mode Switch */}
                    {uiStyles.themes[uiStyles.theme].mode && (
                        <span className="font-bold text-3xl">
                            <MoonIcon />
                        </span>
                    )}

                    {/* Light Mode Switch */}
                    {!uiStyles.themes[uiStyles.theme].mode && (
                        <span className="font-bold text-3xl">
                            <BulbIcon />
                        </span>
                    )}
                </button>
            </div>
        </div>
    )
}

export default ThemeSwitch;