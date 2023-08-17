import React, {
    useRef, useState, useEffect
} from "react";

import { useAxios } from '@/Hooks/hooks.jsx';

export function usePaginate(
    endpoint,axiosConfig
) {
    const init = useRef(true);
    const duration = useRef({
        finalTime: 0,
        initialTime: 0,
    })
    
    const axios = useAxios();
    const [page, setPage] = useState(1);
    const [config, setConfig] = useState({
        endpoint: endpoint, axiosConfig: axiosConfig
    });

    const [data, setData] = useState({
        total: 0,
        links: {},
        per_page: 0,
        path: endpoint,
        current_page: 1,
        duration: duration,
        showing: {
            from: 0, to: 0
        },
    });

    const configure = (store = config) => {
        setPage(1);
        setConfig({
            ...config,...store
        });
    };

    const paginate = (items) => {
        setData({
            ...data, ...{
                links: items?.links,
                path: items?.path,
                total: items?.total,
                duration: items?.duration,
                per_page: items?.per_page,
                last_page: items?.last_page,
                current_page: items?.current_page,
                showing: {
                    from: items?.from, to: items?.to
                }
            }
        });
    };

    const changePage = (pageNo) => {
        if (pageNo < 1) {
            return;
        }

        if (pageNo > data?.last_page) {
            return;
        }

        if (pageNo == data?.current_page) {
            return;
        }

        setPage(pageNo);
    };

    const nextPage = () => {
        if (data.current_page >= data?.last_page) {
            return;
        }

        setPage(data.current_page + 1);
    };

    const previousPage = () => {
        if (data.current_page <= 1) {
            return;
        }

        setPage(data.current_page - 1);
    };

    useEffect(() => {
        if (axios.loading) {
            return;
        }

        if (!axios.fetched) {
            return;
        }

        duration.current.finalTime = Date.now();

        paginate({...axios.data,...{duration: duration.current}});
    }, [axios.data])

    useEffect(() => {
        if (axios.loading) {
            return;
        }

        if(init.current){
            init.current = !init.current;
            return;
        }

        duration.current.initialTime = Date.now();

        axios.createRequest({
            ...config.axiosConfig,
            ...{ endpoint: `${config.endpoint}?page=${page}` }
        });
    }, [page, config]);

    return { axios, data, configure, paginate, nextPage, changePage, previousPage };
}