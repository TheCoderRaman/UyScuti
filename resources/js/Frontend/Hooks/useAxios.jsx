import React, {
    useState, useEffect
} from "react";

export function useAxios(configuration = {}) {
    const [config, setConfig] = useState({
        headers: {},
        payload: {},
        status: false,
        method: 'get', 
        endpoint: null, 
        cleanUp: () => { },
        success: () => { }, 
        failure: () => { }, ...configuration
    })

    const [data, setData] = useState(null);
    const [context, setContext] = useState({});
    const [loading, setLoading] = useState(false);
    const [fetched, setFetched] = useState(false);

    const createRequest = (args) => {
        config.status = true;
        setConfig({...config,...args});
    };

    axios.interceptors.request.use((config) => {
        return config;
    }, (error) => {
        return Promise.reject(error);
    });

    axios.interceptors.response.use((response) => {
        return response;
    }, (error) => {
        return Promise.reject(error);
    });
    
    useEffect(() => {
        if(!config.status){
            return;
        }

        config.status = !config.status;

        setData(null);
        setContext({});
        setLoading(true);
        setConfig(config);

        axios({
            url: config.endpoint, 
            data: config.payload, 
            method: config.method,
            headers: config.headers
        }).then((...args) => {
            const [rspn] = args;
            const result = rspn.data;

            if (!result.success) {
                setFetched(false);
            } else {
                setFetched(true);
                setData(result.data);
            }

            setContext({
                "code": result.code,
                "locale": result.locale,
                "success": result.success,
                "message": result.message,
                "errors": {}
            });

            config.success(...args);
        }).catch((...args) => {
            const [er] = args;
            const result = er.response?.data;

            setFetched(false);

            setContext({
                "code": result.code,
                "locale": result.locale,
                "success": result.success,
                "message": result.message,
                "errors": result.data?.messages
            });

            config.failure(...args);
        }).finally(() => {
            setLoading(false);
            
            config.cleanUp();
        });
    }, [config]);

    return { createRequest, data, loading, fetched, context };
}