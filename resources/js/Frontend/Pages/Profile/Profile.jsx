import React,{
    useEffect
} from 'react';
  
import { useYup } from '@/Hooks/hooks';
import { useForm } from 'react-hook-form';
import { useNavigate } from 'react-router';
import { useAxios } from '@/Hooks/hooks.jsx';
import Alert from '@/Components/Alerts/ALert.jsx';
import { yupResolver } from '@hookform/resolvers/yup';
import { localStorage as ls } from '@/Modules/module';
import { useDispatch, useSelector } from 'react-redux';
import { ErrorMessage } from '@hookform/error-message';
import MainLogo from '@/Components/Logos/MainLogo.jsx';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import ThemeSwitch from '@/Components/Utils/ThemeSwitch.jsx';
import { isEmpty, frontendRoute, backendRoute, isObject } from '@/Utils/util';
import { setUser } from '@/Redux/features/authentications/authenticationsSlice';

function Profile() {
  const axios = useAxios();
  const { yup } = useYup();
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { t } = useLaravelReactI18n();

  const authentications = useSelector(
      (state) => state.authentications.value
  );

  const schema = yup.object().shape({
      email: (yup
          .string().email()
      ),
      name: (yup
          .string().min(3).max(250)
      )
  });

  const {
      register,
      setValue,
      setError,
      handleSubmit,
      formState: { errors },
  } = useForm({
      resolver: yupResolver(schema),
      defaultValues: {
          password: null,
          password_confirmation: null,
          name: authentications.user?.name,
          email: authentications.user?.email, 
      }
  });

  const onSubmit = (data, e) => {
    e.preventDefault();

    if (axios.loading) {
        return;
    }

    const accessToken = ls.get(
        'auth.accessToken', { decrypt: true }
    );

    axios.createRequest({
        method: 'post',
        payload: {
            name: data['name'],
            email: data['email'],
            password: data['password'],
            password_confirmation: data['password_confirmation'],
        },
        endpoint: backendRoute('AuthUpdate'),
        headers: {
            Authorization: `Bearer ${accessToken.token}` 
        }
    });
  };

  useEffect(() => {
    if(!isEmpty(authentications)){
        return;
    }

    navigate(frontendRoute('SignIn'));
  },[]);

  useEffect(() => {
    if(!isObject(authentications.user)){
        return;
    }

    ['name','email'].map((key) => {
        setValue(key, authentications.user[key] ?? null)
    });
  },[authentications.user]);

  useEffect(() => {
    if (axios.loading) {
      return;
    }

    if(!axios.context.success){
      return;
    }

    dispatch(setUser(axios.data));
  },[axios.context])

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
    <>
        <section className="bg-gray-50 dark:bg-gray-900 h-[150vh]">
            <div className="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div onClick={() => { navigate(frontendRoute('Home')) }} className="mt-[10%] xl:mt-[10%] flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white cursor-pointer" >
                    <MainLogo />
                </div>
        
                <div className="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div className="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div className='flex justify-between'>
                           <h1 className="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                               {t('frontend.Update account')}
                           </h1>

                          <div className='mr-[-25px] mt-[-25px]'>
                               <ThemeSwitch />
                          </div>
                        </div>
            
                        <form className="space-y-4 md:space-y-6" onSubmit={handleSubmit(onSubmit)}>
                            <div>
                                <label htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {t('frontend.Your name')}
                                </label>
                                
                                <ErrorMessage
                                    name="name"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <input
                                    type="text"
                                    {...register("name")}
                                    placeholder={t('frontend.John Doe')}
                                    className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>

                            <div>
                                <label htmlFor="email" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {t('frontend.Your email')}
                                </label>
                                
                                <ErrorMessage
                                    name="email"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <input
                                    type="email"
                                    {...register("email")}
                                    placeholder={t('frontend.johndoe@domain.tld')}
                                    className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
            
                            <div>
                                <label htmlFor="password" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {t('frontend.Password')}
                                </label>

                                <ErrorMessage
                                    name="password"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <input
                                    type="password"
                                    placeholder="••••••••"
                                    {...register("password")}
                                    className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>

                            <div>
                                <label htmlFor="password_confirmation" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {t('frontend.Password Confirmation')}
                                </label>

                                <ErrorMessage
                                    name="password_confirmation"
                                    errors={errors}
                                    render={({ message }) => <Alert type="warning" message={message} />}
                                />

                                <input
                                    type="password"
                                    placeholder="••••••••"
                                    {...register("password_confirmation")}
                                    className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
            
                            <div className="flex items-center justify-between">
                                {/* Forgot password feature can be added here */}
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
                                    className="duration-80 w-full text-white bg-slate-700 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:opacity-50"
                                >
                                    {t('frontend.Update')}
                                </button>
                            </div>

                            <div className="text-sm font-light text-gray-500 dark:text-gray-400">
                                {t('frontend.Go to home?')}
                                <div onClick={() => {navigate(frontendRoute('Home'))}} className="font-medium text-primary-600 hover:underline dark:text-primary-500 cursor-pointer">
                                    {t('frontend.Home')}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </>
  );
}

export default Profile;