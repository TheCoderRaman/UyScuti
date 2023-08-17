import React from 'react';
import { getCountry } from '@/Utils/util';
import { useNavigate } from 'react-router';
import { frontendRoute as route } from '@/Utils/util';
import { useLaravelReactI18n } from 'laravel-react-i18n';

function Footer() {
    const navigate = useNavigate();
    const { t } = useLaravelReactI18n();

    return (
        <footer className="mt-auto bottom-0 left-0 w-full">
            <div className="flex-1 flex-wrap text-[#70757a] dark:text-[#9aa0a6] bg-[#f2f2f2] dark:bg-[#171717] inset-x-0 bottom-0">
                <div className="flow-root p-2.5 border-[#dadce0] dark:border-[#3c4043] border-b-[1px]">
                    <div className="float-left">{getCountry()}</div>
                </div>

                <div className="flex flex-row p-2.5">
                    {['Home', 'About', 'Contact'].map((value, index) => {
                        return (
                            <div
                                key={`Footer#${index}@${value}`}
                                className="pl-2 pr-2 cursor-pointer"
                                onClick={() => { navigate(route(value)) }}
                            >
                                {t(`frontend.${value}`)}
                            </div>
                        )
                    })}
                </div>

                <hr className="h-px bg-gray-200 border-0 dark:bg-gray-700"></hr>

                <p className="text-sm text-center text-black dark:text-white border-b border-body-color border-opacity-25 leading-relaxed text-body-color dark:border-white dark:border-opacity-25">
                    {t('frontend.UyScuti is the Internet privacy company for everyone who\'s had enough of hidden online tracking and wants to take back their privacy now.')}
                </p>
            </div>
        </footer>
    )
}

export default Footer;