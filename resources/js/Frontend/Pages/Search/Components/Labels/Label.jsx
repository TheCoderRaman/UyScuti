import React, {
    useRef, useEffect
} from 'react';

import { useSelector } from 'react-redux';
import { usePaginate } from '@/Hooks/hooks';
import { isEmpty, backendRoute } from '@/Utils/util';
import ContentLoader from '@/Components/Preloaders/ContentLoader.jsx';
import SiteLabel from '@/Pages/Search/Components/Labels/SiteLabel.jsx';
import ImageLabel from '@/Pages/Search/Components/Labels/ImageLabel.jsx';
import VideoLabel from '@/Pages/Search/Components/Labels/VideoLabel.jsx';
import DocumentLabel from '@/Pages/Search/Components/Labels/DocumentLabel.jsx';

function Label(props) {
    const data = useRef([]);
    const { labelType } = props;

    const searches = useSelector(
        (state) => state.searches.value
    );

    const paginateConfig = useRef({
        method: 'post',
        payload: {
            total: 10,
            label: labelType,
            searchTerm: searches.searchTerm
        }
    });

    const paginate = usePaginate(
        backendRoute('SearchResult'), paginateConfig.current
    );

    useEffect(() => {
        if (paginate.axios.loading) {
            return;
        }

        if (isEmpty(
            labelType
        )) {
            return;
        }

        (paginateConfig.current.payload.label =
            labelType
        );

        paginate.configure({
            axiosConfig: paginateConfig.current
        });
    }, [labelType]);

    useEffect(() => {
        if (paginate.axios.loading) {
            return;
        }

        if (isEmpty(
            searches.searchForTerm
        )) {
            return;
        }

        (paginateConfig.current.payload.searchTerm =
            searches.searchTerm
        );

        paginate.configure({
            axiosConfig: paginateConfig.current
        });
    }, [searches.searchForTerm]);

    if (null === labelType) {
        return <></>;
    }

    switch (labelType?.toUpperCase()) {
        case 'SITE':
            return (
                <ContentLoader loading={paginate.axios.loading}>
                    <SiteLabel
                        {...props}
                        storage={data}
                        paginate={paginate}
                        key={new Date().getTime()}
                        paginateConfig={paginateConfig.current}
                    />
                </ContentLoader>
            );
        case 'IMAGE':
            return (
                <ContentLoader loading={paginate.axios.loading}>
                    <ImageLabel
                        {...props}
                        storage={data}
                        paginate={paginate}
                        key={new Date().getTime()}
                        paginateConfig={paginateConfig.current}
                    />
                </ContentLoader>
            );
        case 'VIDEO':
            return (
                <ContentLoader loading={paginate.axios.loading}>
                    <VideoLabel
                        {...props}
                        storage={data}
                        paginate={paginate}
                        key={new Date().getTime()}
                        paginateConfig={paginateConfig.current}
                    />
                </ContentLoader>
            );
        case 'DOCUMENT':
            return (
                <ContentLoader loading={paginate.axios.loading}>
                    <DocumentLabel
                        {...props}
                        storage={data}
                        paginate={paginate}
                        key={new Date().getTime()}
                        paginateConfig={paginateConfig.current}
                    />
                </ContentLoader>
            );
    }

    return (<ContentLoader loading={paginate.axios.loading}></ContentLoader>);
}

export default Label;