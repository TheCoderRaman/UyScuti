import React,{ 
    useState, useEffect 
} from 'react';

import { localStorage as ls } from '@/Modules/module';
import { useDispatch, useSelector } from 'react-redux';
import { LaravelReactI18nProvider } from 'laravel-react-i18n';
import TranslationHandler from '@/Providers/Handlers/TranslationHandler';
import { setLocale as setCurrentLocale } from '@/Redux/features/translations/translationsSlice';

function TranslationProvider(props) {
    const dispatch = useDispatch();

    const translations = useSelector(
        (state) => state.translations.value
    );

    const [ locale, setLocale ] = useState(
        translations.locale
    );

    useEffect(() => {
        const locale = ls.get('locale', {
            decrypt: false
        });

        setLocale((null !== locale)
            ? locale : translations.locale
        );

        dispatch(setCurrentLocale(locale));
    });

    return (
        <LaravelReactI18nProvider
            locale={locale}
            fallbackLocale={translations.fallbackLocale}
            files={import.meta.glob('/lang/*.json', { eager: true })}
        >
            <TranslationHandler>
                {props.children}
            </TranslationHandler>
        </LaravelReactI18nProvider>
    );
}

export default TranslationProvider;