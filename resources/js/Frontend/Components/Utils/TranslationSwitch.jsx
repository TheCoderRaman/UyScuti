import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import { setLocale } from '@/Redux/features/translations/translationsSlice';

function TranslationSwitch() {
    const dispatch = useDispatch();
    const { t } = useLaravelReactI18n();

    const translations = useSelector(
        (state) => state.translations.value
    );

    const handleLocaleChange = (locale) => {
        dispatch(setLocale(locale))
    };

    return (
        <div className="inline-block leading-5 justify-center">
            {t('frontend.UyScuti')} {t('frontend.Offered In')}:{" "}
            {Object.entries(translations.locales).map(([key, value]) => {
                return (
                    <span
                        key={key}
                        onClick={() => { handleLocaleChange(key) }}
                        className="text-blue-600 pr-1 hover:underline hover:cursor-pointer"
                    >
                        {t(`frontend.${value}`)}
                    </span>
                );
            })}
        </div>
    )
}

export default TranslationSwitch;