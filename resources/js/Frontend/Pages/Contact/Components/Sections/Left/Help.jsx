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

function Help() {
    const axios = useAxios();
    const { yup } = useYup();
    const { t } = useLaravelReactI18n();

    const schema = yup.object().shape({
        message: (yup
            .string().required()
        ),
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
            name: null, email: null, message: null
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
                email: data['email'],
                message: data['message']
            },
            endpoint: backendRoute('ContactStore')
        });
    };

    useEffect(() => {
        if (isEmpty(axios.context.errors)) {
            return;
        }

        setError('form#result', {
            type: "manual", message: axios.context.message
        });

        Object.entries(axios.context.errors).map(
            ([key, value]) => setError(key, {
                type: "manual", message: value.at(0)
            })
        );
    }, [axios.context.errors]);

    return (
        <div className="w-full px-4 lg:w-7/12 xl:w-8/12">
            <div className="wow fadeInUp mb-12 rounded-md bg-primary/[3%] py-11 px-8 dark:bg-dark sm:p-[55px] lg:mb-5 lg:px-8 xl:p-[55px]" data-wow-delay=".15s ">
                <h2 className="mb-3 text-2xl font-bold text-black dark:text-white sm:text-3xl lg:text-2xl xl:text-3xl">
                    {t('frontend.Need Help? Open a Ticket')}
                </h2>

                <p className="mb-12 text-base font-medium text-body-color  text-black dark:text-white">
                    {t('frontend.Our support team will get back to you ASAP via email.')}
                </p>

                <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="-mx-4 flex flex-wrap">
                        <div className="w-full px-4 md:w-1/2">
                            <div className="mb-8">
                                <label htmlFor="name" className="mb-3 block text-sm font-medium text-black dark:text-white">
                                    {t('frontend.Your Name')}
                                </label>

                                <ErrorMessage
                                    name="name"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <input
                                    type="text"
                                    {...register("name")}
                                    placeholder={t('Enter your name')}
                                    className="mb-4 w-full rounded-md border border-body-color border-opacity-10 py-3 px-6 text-base font-medium text-body-color placeholder-body-color outline-none focus:border-primary focus:border-opacity-100 focus-visible:shadow-none border-black dark:border-white dark:border-opacity-10 dark:bg-[#242B51] focus:dark:border-opacity-50 dark:text-white"
                                />
                            </div>
                        </div>

                        <div className="w-full px-4 md:w-1/2">
                            <div className="mb-8">
                                <label htmlFor="email" className="mb-3 block text-sm font-medium text-black dark:text-white">
                                    {t('frontend.Your Email')}
                                </label>

                                <ErrorMessage
                                    name="email"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <input
                                    type="email"
                                    {...register("email")}
                                    placeholder={t('Enter your email')}
                                    className="mb-4 w-full rounded-md border border-body-color border-opacity-10 py-3 px-6 text-base font-medium text-body-color placeholder-body-color outline-none focus:border-primary focus:border-opacity-100 focus-visible:shadow-none border-black dark:border-white dark:border-opacity-10 dark:bg-[#242B51] focus:dark:border-opacity-50 dark:text-white"
                                />
                            </div>
                        </div>

                        <div className="w-full px-4">
                            <div className="mb-8">
                                <label htmlFor="message" className="mb-3 block text-sm font-medium text-dark dark:text-white">
                                    {t('frontend.Your Message')}
                                </label>

                                <ErrorMessage
                                    name="message"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <textarea
                                    rows="5"
                                    name="message"
                                    {...register("message")}
                                    placeholder={t('Enter your Message')}
                                    className="mb-4 w-full rounded-md border border-body-color border-opacity-10 py-3 px-6 text-base font-medium text-body-color placeholder-body-color outline-none focus:border-primary focus:border-opacity-100 focus-visible:shadow-none border-black dark:border-white dark:border-opacity-10 dark:bg-[#242B51] focus:dark:border-opacity-50 dark:text-white"
                                ></textarea>
                            </div>
                        </div>

                        <div className="w-full px-4">
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
                                className="duration-80 mb-4 w-full cursor-pointer rounded-md bg-primary py-3 px-6 text-center text-base font-medium text-white outline-none transition ease-in-out bg-slate-700 hover:bg-slate-500 focus-visible:shadow-none dark:border-opacity-10 disabled:opacity-50">
                                {t('frontend.Submit Ticket')}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    )
}

export default Help;