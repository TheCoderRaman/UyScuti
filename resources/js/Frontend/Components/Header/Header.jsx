import React, {
    useState,
    useEffect
} from 'react';

import MainLogo from '../Logos/MainLogo';
import { useSelector } from 'react-redux';
import { frontendRoute as route } from '@/Utils/util';
import { useLocation, useNavigate } from 'react-router';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import ThemeSwitch from '@/Components/Utils/ThemeSwitch.jsx';
import SearchBox from '@/Components/Header/Boxes/SearchBox.jsx';
import SuggestionBox from '@/Components/Header/Boxes/SuggestionBox.jsx';

function Header() {
    const navigate = useNavigate();
    const { pathname } = useLocation();
    const { t } = useLaravelReactI18n();
    
    const authentications = useSelector(
        (state) => state.authentications.value
    );

    const [prevScrollPos, setPrevScrollPos] = useState(0);
    const [isStickyNavbar, setStickyNavbar] = useState(false);

    const handleScroll = () => {
        setPrevScrollPos(window.scrollY);
        setStickyNavbar(prevScrollPos > 100);
    };

    useEffect(() => {
        if (pathname === route('Home')) {
            setStickyNavbar(false);
            return;
        }

        window.addEventListener(
            'scroll', handleScroll
        );

        return () => {
            window.removeEventListener(
                'scroll', handleScroll
            )
        };
    }, [prevScrollPos, isStickyNavbar, handleScroll]);

    return (
        <header className={!isStickyNavbar ? 'top-0 left-0 z-40 flex w-full h-[70px] items-center bg-transparent absolute' : 'top-0 left-0 flex w-full items-center bg-transparent !fixed !z-[9999] !bg-white !bg-opacity-80 shadow-sticky backdrop-blur-sm !transition dark:!bg-primary dark:!bg-opacity-20 h-[70px]'}>
            <div className="container">
                <div className="relative -mx-4 flex items-center justify-between">
                    {route('Search') === pathname && (
                        <div className="max-w-full hidden md:block">
                            <div
                                onClick={() => navigate(route('Home'))}
                                className='header-logo block w-full py-8 mt-[10%] mx-[-30%] cursor-pointer'
                            >
                                <MainLogo className='w-[92px] h-[30px]' decoding="async" data-nimg="1" loading="lazy" style={{ color: 'transparent' }} />
                            </div>
                        </div>
                    )}

                    <div 
                        style={{
                            minWidth: '350px',
                        }}
                        className="flex justify-between w-full"
                    >
                        {route('Search') !== pathname ? <div></div> :(
                            <div className="max-w-full">
                                <div
                                    onClick={() => navigate(route('Home'))}
                                    className='header-logo block w-full cursor-pointer md:hidden'
                                >
                                    <MainLogo className='w-[150px] h-[50px]' decoding="async" data-nimg="1" loading="lazy" style={{ color: 'transparent' }} />
                                </div>
                                
                                <div className='p-3 m-0 hidden md:block'>
                                    {route('Search') === pathname && (
                                        <>
                                            <SearchBox />
                                            <SuggestionBox />
                                        </>
                                    )}
                                </div>
                            </div>
                        )}
                        <div className='flex items-center'>
                            {authentications.isLogged ? (
                                <div 
                                    onClick={() => {navigate(route('Profile'))}}
                                    className='rounded-full ring-2 ring-gray-300 dark:ring-gray-500 cursor-pointer' 
                                >
                                    <img className="w-10 h-10 p-1" src={authentications.user?.avatar} alt={authentications.user?.name} />
                                </div>
                            ) : (
                                <button
                                    type="button"
                                    onClick={() => {navigate(route('SignIn'))}}
                                    className="ease-in-up hidden rounded-md py-3 px-1 text-base font-bold text-white transition duration-300 hover:bg-opacity-90 hover:shadow-signUp md:block md:px-9 lg:px-6 xl:px-9 bg-slate-700 hover:bg-slate-500"
                                >
                                    {t('frontend.Sign In')}
                                </button>
                            )}
                            <div>
                                <ThemeSwitch />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    )
}

export default Header;