import React, {
    useState,
    useEffect,
    createContext,
    useLayoutEffect
} from 'react';

import { themes as uiStyles } from '@/Data/themes';
import { localStorage as ls } from '@/Modules/module';
import { useSelector, useDispatch } from 'react-redux';
import { setTheme as setCurrentTheme } from '@/Redux/features/themes/themesSlice';

export const ThemeContext = createContext({
    theme: uiStyles.theme, setTheme: () => { }
});

function ThemeProvider(props) {
    const dispatch = useDispatch();

    const themes = useSelector(
        (state) => state.themes.value
    );

    const [theme, setTheme] = useState(
        ls.get('theme', {
            decrypt: false
        }) !== null ? ls.get('theme', {
            decrypt: false
        }) : themes.theme
    );

    useEffect(() => {
        dispatch(setCurrentTheme(theme));

        ls.set('theme',
            theme, { encrypt: false }
        );
    }, [theme]);

    useEffect(() => {
        setTheme(themes.theme);

        ls.set('theme',
            themes.theme, { encrypt: false }
        );
    }, [themes.theme]);

    useLayoutEffect(() => {
        const schema = uiStyles.themes[theme]['schema'];

        document.getElementsByTagName("html")[0].className = (
            `${theme} bg-[${schema.background}]`
        );
        document.getElementsByTagName("body")[0].className = (
            `${theme} bg-[${schema.background}]`
        );
    }, [theme, themes.theme]);

    return (
        <ThemeContext.Provider value={{
            theme: theme, setTheme: setTheme
        }}>
            <div className={"app-uyscuti " + theme}>
                {props.children}
            </div>
        </ThemeContext.Provider>
    )
}

export default ThemeProvider;