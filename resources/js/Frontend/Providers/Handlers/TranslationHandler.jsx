import React, {
    useState, useEffect
} from 'react';

import { localStorage as ls } from '@/Modules/module';
import { useSelector, useDispatch } from 'react-redux';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import { setLoading, setAvailableLocales } from '@/Redux/features/translations/translationsSlice';

function TranslationHandler(props) {
    const dispatch = useDispatch();
    const [LocalesAvailable, setLocalesAvailable] = useState([]);
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
        ls.set('availableLocales',
           LocalesAvailable, { encrypt: false }
        );
        setAvailableLocales(LocalesAvailable);
    }, [LocalesAvailable])

    useEffect(() => {
        setLocalesAvailable(getLocales('en'));
    });

    return (
        <>
            {props.children}
        </>
    );
}

export default TranslationHandler;