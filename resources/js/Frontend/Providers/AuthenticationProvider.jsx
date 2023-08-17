import React, {
    useRef,
    useState,
    useEffect
} from 'react';

import moment from 'moment';
import { useAxios } from '@/Hooks/hooks.jsx';
import { localStorage as ls } from '@/Modules/module';
import { useSelector, useDispatch } from 'react-redux';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import { useLocation, useNavigate } from 'react-router-dom';
import { frontendRoute, frontendRouteName, backendRoute } from '@/Utils/util';
import FullScreenPreloader from '@/Components/Preloaders/FullScreenPreloader.jsx';
import { setUser, setAccessToken, setIsLoggged } from '@/Redux/features/authentications/authenticationsSlice';

function AuthenticationProvider(props) {
    const axios = useAxios();

    const navigate = useNavigate();
    const location = useLocation();
    const dispatch = useDispatch();
    const request = useRef('profile');
    const { t } = useLaravelReactI18n();
    const previousRoute = useRef(location.pathname);
    const [authentication, setAuthentication] = useState(false);

    const authentications = useSelector(
        (state) => state.authentications.value
    );

    useEffect(() => {
        if (axios.loading) {
            return;
        }

        if(authentications.isLogged){
            return;
        }

        if(null === ls.get(
            'auth.accessToken',{ decrypt: false }
        )){
            setAuthentication(true);
            return;
        }

        const accessToken = ls.get(
            'auth.accessToken',{ decrypt: false }
        );

        let finalTime = (
            Date.now()
        );
        let initialTime =(
            accessToken.timestamp
        );

        if(
            moment.duration(moment.unix(
                finalTime).diff(moment.unix(initialTime))
            ).asMinutes() < accessToken.expires_in
        ){
            request.current = 'profile';
            axios.createRequest({
                method: 'get',
                headers: {
                    Authorization: `Bearer ${accessToken.token}`
                },
                endpoint: backendRoute('AuthProfile')
            });
        } else {
            request.current = 'refresh';
            axios.createRequest({
                method: 'post',
                headers: {
                    Authorization: `Bearer ${accessToken.token}`
                },
                endpoint: backendRoute('AuthRefresh')
            });
        }
    },[]);

    useEffect(() => {
        if (axios.loading) {
          return;
        }
    
        if(!axios.context.success){
            return;
        }
    
        dispatch(setIsLoggged(true));

        switch(request.current){
            case 'profile':
                dispatch(setUser(
                    axios.data
                ));
                break;
            case 'refresh':
                let accessToken = {};

                dispatch(setUser(
                    axios.data?.user
                ));

                ls.set('auth.accessToken',
                    accessToken = {
                        timestamp: Date.now(),
                        type: axios.data?.token_type,
                        token: axios.data?.access_token,
                        expires_in: axios.data?.expires_in
                    }, { encrypt: false }
                );

                dispatch(setAccessToken(accessToken));
                break;
        }
        
        setAuthentication(true);

        if(['Sign In','Sign Up'].includes(
            frontendRouteName(location.pathname)
        )){
            return navigate(frontendRoute('Home'));
        }
    },[axios.context]);

    if (authentication) {
        return (
            <>
                {props.children}
            </>
        );
    }

    return (
        <FullScreenPreloader placeholder={t('frontend.Loading ...')}/>
    );
}

export default AuthenticationProvider;