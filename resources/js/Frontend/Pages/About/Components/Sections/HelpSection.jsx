import React, {
    useState
} from 'react';

import ModalVideo from 'react-modal-video';
import { useLaravelReactI18n } from 'laravel-react-i18n';

function HelpSection() {
    const { t } = useLaravelReactI18n();
    const [isOpen, setOpen] = useState(false);

    return (
        <section className="relative z-10 py-16 md:py-20 lg:py-28">
            <div className="container">
                <div className="wow fadeInUp w-full mx-auto text-center" data-wow-delay=".1s" style={{ maxWidth: '570px', marginBottom: '100px' }}>
                    <h2 className="mb-4 text-3xl font-bold !leading-tight text-black dark:text-white sm:text-4xl md:text-[45px]">
                        {t('frontend.The Internet: How Search Works')}
                    </h2>
                    <p className="text-base text-black dark:text-white !leading-relaxed text-body-color md:text-lg">
                        {t('frontend.Lets find out how search engine really works. Find out how search algorithms bust spammers, manage location services and even use machine learning to make search better every year.')}
                    </p>
                </div>
                <div className="-mx-4 flex flex-wrap">
                    <div className="w-full px-4">
                        <div className="wow fadeInUp mx-auto max-w-[770px] overflow-hidden rounded-md" data-wow-delay=".15s">
                            <div className="relative aspect-[77/40] items-center justify-center">
                                <img
                                    sizes="100vw"
                                    loading="lazy"
                                    decoding="async"
                                    data-nimg="fill"
                                    alt="about image"
                                    style={{
                                        top: 0,
                                        left: 0,
                                        right: 0,
                                        bottom: 0,
                                        width: '100%',
                                        height: '100%',
                                        position: 'absolute',
                                        color: 'transparent'
                                    }}
                                    src="https://i3.ytimg.com/vi/LVV_93mBfSU/maxresdefault.jpg"
                                />
                                <div className="absolute top-0 right-0 flex h-full w-full items-center justify-center">
                                    <React.Fragment>
                                        <ModalVideo
                                            isOpen={isOpen}
                                            channel="youtube"
                                            videoId="LVV_93mBfSU"
                                            onClose={() => setOpen(false)}
                                            youtube={{ mute: 0, autoplay: 0 }}
                                        />
                                        <button className="flex h-[70px] w-[70px] items-center justify-center rounded-full bg-white bg-opacity-75 text-primary transition hover:bg-opacity-100" onClick={() => setOpen(true)}>
                                            <svg width="16" height="18" viewBox="0 0 16 18" className="fill-current">
                                                <path d="M15.5 8.13397C16.1667 8.51888 16.1667 9.48112 15.5 9.86602L2 17.6603C1.33333 18.0452 0.499999 17.564 0.499999 16.7942L0.5 1.20577C0.5 0.43597 1.33333 -0.0451549 2 0.339745L15.5 8.13397Z"></path>
                                            </svg>
                                        </button>
                                    </React.Fragment>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="absolute bottom-0 left-0 right-0 z-[-1]">
                <img src="/assets/images/about/shape.svg" alt="shape" className="w-full" />
            </div>
        </section>
    )
}

export default HelpSection;