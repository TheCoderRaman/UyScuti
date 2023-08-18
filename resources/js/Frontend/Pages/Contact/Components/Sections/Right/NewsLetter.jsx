import React, {
    useEffect
} from 'react';

import { useYup } from '@/Hooks/hooks';
import { useForm } from 'react-hook-form';
import { useAxios } from '@/Hooks/hooks.jsx';
import Alert from '@/Components/Alerts/ALert.jsx';
import { isEmpty, backendRoute } from '@/Utils/util';
import { yupResolver } from '@hookform/resolvers/yup';
import { ErrorMessage } from '@hookform/error-message';
import { useLaravelReactI18n } from 'laravel-react-i18n';

function NewsLetter() {
    const axios = useAxios();
    const { yup } = useYup();
    const { t } = useLaravelReactI18n();

    const schema = yup.object().shape({
        email: (yup
            .string().email().required()
        ),
        name: (yup
            .string().min(3).max(225).required()
        )
    });

    const {
        reset,
        register,
        setError,
        handleSubmit,
        formState: { errors },
    } = useForm({
        resolver: yupResolver(schema),
        defaultValues: {
            name: null, email: null
        }
    });

    const onSubmit = (data, e) => {
        e.preventDefault();

        if (axios.loading) {
            return;
        }

        axios.createRequest({
            success: () => {reset()},
            method: 'post',
            payload: {
                name: data['name'],
                email: data['email']
            },
            endpoint: backendRoute('NewsletterStore')
        });
    };

    useEffect(() => {
        if (isEmpty(axios.context.errors)) {
            return;
        }

        setError('form#result',{
            type: "manual", message: axios.context.message
        });

        Object.entries(axios.context.errors).map(
            ([key, value]) => setError(key, {
                type: "manual", message: value.at(0)
            })
        );
    }, [axios.context.errors]);

    return (
        <div className="w-full px-4 lg:w-5/12 xl:w-4/12">
            <div className="wow fadeInUp relative z-10 rounded-md bg-primary/[3%] p-8 dark:bg-primary/10 sm:p-11 lg:p-8 xl:p-11" data-wow-delay=".2s">
                <h3 className="mb-4 text-center text-2xl font-bold leading-tight text-black dark:text-white">
                    {t('frontend.UyScuti')} {t('frontend.Newsletter')}
                </h3>

                <p className="mb-11 text-center text-black dark:text-white border-b border-body-color border-opacity-25 pb-11 text-base font-medium leading-relaxed text-body-color dark:border-white dark:border-opacity-25">
                    {t('frontend.Privacy tips and news, straight to your inbox.')} {' '}
                    {t('frontend.Stay protected and informed with our privacy newsletter.')}
                </p>

                <form onSubmit={handleSubmit(onSubmit)}>
                    <ErrorMessage
                        name="name"
                        errors={errors}
                        render={({ message }) => <Alert type="warning" message={message} />}
                    />
                    <input
                        type="text"
                        name="name"
                        {...register("name")}
                        placeholder={t('frontend.Enter your name')}
                        className="mb-4 w-full rounded-md border border-body-color border-opacity-10 py-3 px-6 text-base font-medium text-body-color text-black dark:text-white placeholder-body-color outline-none focus:border-primary focus:border-opacity-100 focus-visible:shadow-none border-black dark:border-white dark:border-opacity-10 dark:bg-[#242B51] focus:dark:border-opacity-50"
                    />

                    <ErrorMessage
                        name="email"
                        errors={errors}
                        render={({ message }) => <Alert type="warning" message={message} />}
                    />
                    <input
                        type="email"
                        name="email"
                        {...register("email")}
                        placeholder={t('frontend.Enter your email')}
                        className="mb-4 w-full rounded-md border border-body-color border-opacity-10 py-3 px-6 text-base font-medium text-body-color text-black dark:text-white placeholder-body-color outline-none focus:border-primary focus:border-opacity-100 focus-visible:shadow-none border-black dark:border-white dark:border-opacity-10 dark:bg-[#242B51] focus:dark:border-opacity-50"
                    />

                    {(!axios.loading && !isEmpty(axios.context.errors)) && (
                        <div className="mt-3 text-center">
                            <ErrorMessage
                                name="form#result"
                                errors={{ 'form#result': { message: axios.context.message } }}
                                render={({ message }) => <Alert type='success' message={message} />}
                            />
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={axios.loading}
                        className="duration-80 mb-4 w-full cursor-pointer rounded-md bg-primary py-3 px-6 text-center text-base font-medium text-white outline-none transition ease-in-out bg-slate-700 hover:bg-slate-500 focus-visible:shadow-none dark:border-opacity-10 disabled:opacity-50"
                    >
                        {t('frontend.Subscribe')}
                    </button>

                    <p className="text-center text-black dark:text-white text-base font-medium leading-relaxed text-body-color">
                        {t('frontend.No spam guaranteed.')}
                        <br />
                        {t('frontend.We\'ll never share your email address.')}
                    </p>
                </form>

                <div className="absolute top-0 left-0 z-[-1]">
                    <svg width="370" height="596" viewBox="0 0 370 596" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_88:141" style={{ maskType: 'alpha' }} maskUnits="userSpaceOnUse" x="0" y="0" width="370" height="596"><rect width="370" height="596" rx="2" fill="#1D2144"></rect></mask>
                        <g mask="url(#mask0_88:141)">
                            <path opacity="0.15" d="M15.4076 50.9571L54.1541 99.0711L71.4489 35.1605L15.4076 50.9571Z" fill="url(#paint0_linear_88:141)"></path>
                            <path opacity="0.15" d="M20.7137 501.422L44.6431 474.241L6 470.624L20.7137 501.422Z" fill="url(#paint1_linear_88:141)"></path>
                            <path
                                opacity="0.1"
                                d="M331.676 198.309C344.398 204.636 359.168 194.704 358.107 180.536C357.12 167.363 342.941 159.531 331.265 165.71C318.077 172.69 318.317 191.664 331.676 198.309Z"
                                fill="url(#paint2_linear_88:141)"
                            ></path>
                            <g opacity="0.3">
                                <path
                                    d="M209 89.9999C216 77.3332 235.7 50.7999 258.5 45.9999C287 39.9999 303 41.9999 314 30.4999C325 18.9999 334 -3.50014 357 -3.50014C380 -3.50014 395 4.99986 408.5 -8.50014C422 -22.0001 418.5 -46.0001 452 -37.5001C478.8 -30.7001 515.167 -45 530 -53"
                                    stroke="url(#paint3_linear_88:141)"
                                ></path>
                                <path
                                    d="M251 64.9999C258 52.3332 277.7 25.7999 300.5 20.9999C329 14.9999 345 16.9999 356 5.49986C367 -6.00014 376 -28.5001 399 -28.5001C422 -28.5001 437 -20.0001 450.5 -33.5001C464 -47.0001 460.5 -71.0001 494 -62.5001C520.8 -55.7001 557.167 -70 572 -78"
                                    stroke="url(#paint4_linear_88:141)"
                                ></path>
                                <path
                                    d="M212 73.9999C219 61.3332 238.7 34.7999 261.5 29.9999C290 23.9999 306 25.9999 317 14.4999C328 2.99986 337 -19.5001 360 -19.5001C383 -19.5001 398 -11.0001 411.5 -24.5001C425 -38.0001 421.5 -62.0001 455 -53.5001C481.8 -46.7001 518.167 -61 533 -69"
                                    stroke="url(#paint5_linear_88:141)"
                                ></path>
                                <path
                                    d="M249 40.9999C256 28.3332 275.7 1.79986 298.5 -3.00014C327 -9.00014 343 -7.00014 354 -18.5001C365 -30.0001 374 -52.5001 397 -52.5001C420 -52.5001 435 -44.0001 448.5 -57.5001C462 -71.0001 458.5 -95.0001 492 -86.5001C518.8 -79.7001 555.167 -94 570 -102"
                                    stroke="url(#paint6_linear_88:141)"
                                ></path>
                            </g>
                        </g>
                        <defs>
                            <linearGradient id="paint0_linear_88:141" x1="13.4497" y1="63.5059" x2="81.144" y2="41.5072" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint1_linear_88:141" x1="28.1579" y1="501.301" x2="8.69936" y2="464.391" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint2_linear_88:141" x1="338" y1="167" x2="349.488" y2="200.004" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint3_linear_88:141" x1="369.5" y1="-53" x2="369.5" y2="89.9999" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint4_linear_88:141" x1="411.5" y1="-78" x2="411.5" y2="64.9999" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint5_linear_88:141" x1="372.5" y1="-69" x2="372.5" y2="73.9999" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint6_linear_88:141" x1="409.5" y1="-102" x2="409.5" y2="40.9999" gradientUnits="userSpaceOnUse">
                                <stop stopColor="white"></stop>
                                <stop offset="1" stopColor="white" stopOpacity="0"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    )
}

export default NewsLetter;