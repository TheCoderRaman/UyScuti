import React from 'react';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import Help from '@/Pages/Contact/Components/Sections/Left/Help.jsx';
import NewsLetter from '@/Pages/Contact/Components/Sections/Right/NewsLetter.jsx';

function Contact() {
    const { t } = useLaravelReactI18n();

    return (
        <>
            <section id="contact" className="overflow-hidden py-16 md:py-20 lg:py-28">
                <div className="absolute opacity-[0.3] fade top-0 left-0 right-0 bottom-0">
                    <img src="/assets/images/contact/shape.svg" alt="shape" className="w-full" />
                </div>
                <div className="relative container mt-[-5%]">
                    <div className="wow fadeInUp w-full mx-auto text-center" data-wow-delay=".1s" style={{maxWidth: '570px', marginBottom: '100px'}}>
                        <h2 className="mb-4 text-3xl font-bold !leading-tight text-black dark:text-white sm:text-4xl md:text-[45px]">
                           {t('frontend.Contact Us')}
                        </h2>
                        <p className="text-base text-black dark:text-white !leading-relaxed text-body-color md:text-lg">
                           {t('frontend.Our mission is to organize the world\'s information and make it universally accessible and useful.')}
                        </p>
                    </div>
                    <div className="-mx-4 flex flex-wrap">
                        <Help />
                        <NewsLetter />
                    </div>
                </div>
            </section>
        </>
    )
}

export default Contact;