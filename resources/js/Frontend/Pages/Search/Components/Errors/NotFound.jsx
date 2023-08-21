import React from 'react';
import { useNavigate } from 'react-router';
import MainLogo from '@/Components/Logos/MainLogo';
import { route } from '@/Utils/func/frontendRoute';
import { useLaravelReactI18n } from 'laravel-react-i18n';

function NotFound() {
  const navigate = useNavigate();
  const { t } = useLaravelReactI18n();

  return (
    <div
      className="p-5"
    >
      <div
        className="flex flex-col md:flex-row gap-5 rounded-t-3xl rounded-r-3xl rounded-bl-3xl rounded-br-3xl border-2 border-[#f1f3f4] dark:border-[#3c4043] dark:bg-[#3c4043] bg-[#e9f5ff] p-5"
      >
        <MainLogo className="cursor-pointer" onClick={() => {navigate(route('Home'))}} />
        <div className='flex flex-col text-gray-700 dark:text-gray-200'>
          <p className='text-2xl font-bold'>
            {t('frontend.Looks like there aren\'t any matches for your search')}
          </p>
          <div className='p-2'>
            <span>
              {t('frontend.Search tips')}
            </span>
            <ul className='pl-5 list-disc'>
              {[
                'Make sure all words are spelled correctly',
                'Try different or more general words',
                'Try fewer words',
              ].map((tip,index) => {
                return (
                  <li key={`tip#${index}`}>
                    {t(`frontend.${tip}`)}
                  </li>
                );
              })}
            </ul>
          </div>
        </div>
      </div>
    </div>
  )
}

export default NotFound;