import React from 'react';
import { useLocation, useNavigate } from 'react-router';
import { useLaravelReactI18n } from 'laravel-react-i18n';

function Status({
    code
}) {
    const { pathname } = useLocation();
    const { t } = useLaravelReactI18n();

    return (
        <div className='text-gray-500 dark:text-gray-400 w-[100vw] sm:w-full'>
            {code !== 404 ? (
                <>
                    <div className='text-4xl pb-5'>
                        <b>{t(`${code}`)} {' '}</b>
                    </div>
                    {t('frontend.That\'s an error.')}
                    <p>
                        <div className='text-2xl'>
                            {t(`api.${code}`)}
                        </div>
                    </p>
                </>
            ) : (
                <>
                    <p className='pb-5'>
                        <b>{t(`frontend.${code}.`)} {' '}</b>
                        {t('frontend.That\'s an error.')}
                    </p>
                    <p>
                        {t('frontend.The requested URL')}
                        <code>{pathname}{' '}</code>

                        {t('frontend.was not found on this server.')} {' '}
                        <br />
                        <ins>{t('frontend.That\'s all we know.')}</ins>
                    </p>
                </>
            )}
        </div>
    )
}

export default Status;