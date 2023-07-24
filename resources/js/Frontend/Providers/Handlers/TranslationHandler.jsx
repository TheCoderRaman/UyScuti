import React, {
    useState, useEffect
} from 'react';

import { localStorage as ls } from '@/Modules/module';
import { useSelector, useDispatch } from 'react-redux';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import { setLoading, setLocales } from '@/Redux/features/translations/translationsSlice';

function TranslationHandler(props) {
    const dispatch = useDispatch();
    const [availableLocales, setAvailableLocales] = useState([]);
    const { loading, setLocale, getLocales } = useLaravelReactI18n();
    const locale = useSelector((state) => state.translations.value.locale);

    useEffect(() => {
        setLocale(locale);
        ls.set('locale',
            locale, { encrypt: false }
        );
    }, [locale]);

    useEffect(() => {
        dispatch(setLoading(loading));
    }, [loading]);

    useEffect(() => {
        ls.set('locales',
            availableLocales, { encrypt: false }
        );
        setLocales(availableLocales);
    }, [availableLocales])

    useEffect(() => {
        setAvailableLocales(getLocales('en'));
    });

    return (
        <>
            {props.children}
        </>
    );
}

export default TranslationHandler;