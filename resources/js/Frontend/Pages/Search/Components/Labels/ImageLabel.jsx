import React, {
  useState, useEffect
} from 'react';

import { isEmpty } from '@/Utils/util';
import PhotoAlbum from 'react-photo-album';
import Lightbox from 'yet-another-react-lightbox';
import { useDebouncedCallback } from 'use-debounce';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import Zoom from 'yet-another-react-lightbox/plugins/zoom';
import Share from 'yet-another-react-lightbox/plugins/share';
import Video from 'yet-another-react-lightbox/plugins/video';
import Counter from 'yet-another-react-lightbox/plugins/counter';
import Download from 'yet-another-react-lightbox/plugins/download';
import Captions from 'yet-another-react-lightbox/plugins/captions';
import NotFound from '@/Pages/Search/Components/Errors/NotFound.jsx';
import Slideshow from 'yet-another-react-lightbox/plugins/slideshow';
import Fullscreen from 'yet-another-react-lightbox/plugins/fullscreen';
import Pagination from '@/Pages/Search/Components/Footer/Pagination.jsx';

function ImageLabel(props) {
  const { t } = useLaravelReactI18n();

  const captionsRef = React.useRef(null);
  
  const [index, setIndex] = useState(-1);
  const [ result, setResult ] = useState(['']);
  const { loading, labelType, paginate } = props;

  const debouncedInfiniteScroll = useDebouncedCallback(
    () => {
      if(loading){
        return;
      }

      paginate.nextPage();
    }, 1000
  );

  const getImages = () => {
    if(isEmpty(result)){
      return [];
    }

    return Object.values((result).map(
      (value) => {
        if(isEmpty(value)) return;
        
        const { root_url, sub_url, redirect } = value;

        return {
          width: '1280',height: '720',
          src: `//${root_url.url}/${sub_url.url}`,
          title: sub_url.title ?? root_url.title,
          downloadUrl: `//${root_url.url}/${sub_url.url}`,
          downloadFilename: sub_url.title ?? root_url.title,
          description: sub_url.description ?? root_url.description,
          share: { url: `//${root_url.url}/${sub_url.url}`, title: sub_url.title ?? root_url.title }
        };
      }
    ))
  }

  useEffect(() => {
    if (paginate.axios.loading) {
      return;
    }

    if (!paginate.axios.fetched) {
      return;
    }

    if (isEmpty(
      paginate.axios.data?.data
    )) {
      setResult([]); return;
    }

    setResult(paginate.axios.data?.data ?? []);
  }, [paginate.axios.data]);

  return (isEmpty(result) ? <NotFound /> : !isEmpty(result.filter((value) => !isEmpty(value))) &&
    <div className='p-10'>
      {!isEmpty(result) && (
        <div className='text-slate-500 dark:text-slate-100 pb-10'>
          {t(`About :results results (:seconds seconds)`,{
            results: paginate.data.total,
            seconds: (
              new Date(paginate.data.duration.finalTime) -
              new Date(paginate.data.duration.initialTime)
            ) / 1000
          })}
        </div>
      )}

      <PhotoAlbum
        layout="rows"
        photos={getImages()}
        targetRowHeight={150}
        onClick={({ index }) => setIndex(index)}
      />
  
      <Lightbox
        index={index}
        layout="columns"
        open={index >= 0}
        slides={getImages()}
        close={() => setIndex(-1)}
        counter={{ container: { style: { top: "unset", bottom: '20px' } } }}
        plugins={[Fullscreen, Slideshow, Zoom, Captions, Counter, Download, Share, Video]}
        on={{
          click: () => {
            (captionsRef.current?.visible ? captionsRef.current?.hide : captionsRef.current?.show)?.();
          },
        }}
      />

      <Pagination result={result} paginate={paginate} />
    </div>
  )
}

export default ImageLabel;