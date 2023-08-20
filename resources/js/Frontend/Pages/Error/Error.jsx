import React, {
  useState,
  useEffect
} from 'react';

import UrlPattern from 'url-pattern';
import { frontendRoute as route } from '@/Utils/util';
import MainLogo from '@/Components/Logos/MainLogo.jsx';
import { useLocation, useNavigate } from 'react-router';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import ThemeSwitch from '@/Components/Utils/ThemeSwitch.jsx';
import Status from '@/Pages/Error/Components/Statuses/Status.jsx';
import RobotLogo from '@/Pages/Error/Components/Logos/RobotLogo.jsx';

function Error() {
  const statusCode = 404;

  const navigate = useNavigate();
  const { pathname } = useLocation();
  const { t } = useLaravelReactI18n();

  const [code, setCode] = useState(statusCode);

  useEffect(() => {
    let pattern = new UrlPattern(
      '/error(/:code)'
    );

    setCode(pattern.match(
      pathname)?.code ?? statusCode
    );
  }, []);

  return (
    <div className='md:grid md:h-screen md:place-items-center p-[10%] overflow-hidden'>
      <div className='flex mt-[-5%]'>
        <div className='flex-none pr-1'>
          <div
            onClick={() => navigate(route('Home'))}
            className='ml-[-50%] pb-[5%] cursor-pointer'
          >
            <MainLogo className='ml-[-5%] w-[30%] sm:w-[60%]' />
          </div>

          <Status code={code} />
        </div>

        <div className='md:flex-1 md:pl-[5%] md:mt-[-5%] hidden md:block justify-center'>
          <RobotLogo className='w-[70%]' />
          <div className='flex justify-center text-4xl text-blue-600 dark:text-blue-50'>
            <div className='rounded-full text-white bg-gray-600 dark:bg-yellow-600 mr-2'>
              <ThemeSwitch />
            </div>
            {t('Lost In Space')}
          </div>
        </div>
      </div>
    </div>
  );
}

export default Error;