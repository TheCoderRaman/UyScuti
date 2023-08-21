import React, {
  useState, useEffect
} from 'react';

import parse from 'url-parse';
import { isEmpty } from '@/Utils/util';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import NotFound from '@/Pages/Search/Components/Errors/NotFound.jsx';
import Pagination from '@/Pages/Search/Components/Footer/Pagination.jsx';

function VideoLabel(props) {
    const { t } = useLaravelReactI18n();
    const [ result, setResult ] = useState(['']);
    const { loading, labelType, paginate } = props;

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
      <div className="flex flex-col md:flex-row p-5 md:p-0">
          <div className="flex-none w-[10%] h-auto"></div>
      
          <div className="flex-1">
              {!isEmpty(result) && (
                <div className='text-slate-500 dark:text-slate-100'>
                  {t(`About :results results (:seconds seconds)`,{
                    results: paginate.data.total,
                    seconds: (
                      new Date(paginate.data.duration.finalTime) -
                      new Date(paginate.data.duration.initialTime)
                    ) / 1000
                  })}
                </div>
              )}
  
              {result.map((value, index) => {if(isEmpty(value)) return; const { root_url, sub_url, redirect } = value; return (
              <div key={`${index}:${root_url.id}-${sub_url.id}`} className="rounded-xl hover:dark:bg-[#3c4043] hover:bg-[#e9f5ff] p-5 mt-[5%]">
                  <div className="flex gap-[20px]">
                      <div className="flex gap-[20px]">
                          <div className="min-w-[40px] max-w-[30px] min-h-[47px] max-h-[47px] rounded-full ring-2 ring-gray-300 dark:ring-gray-500 cursor-pointer">
                              <img className="hover:mt-2 w-10 h-10 p-1" src={root_url.favicon ?? '/assets/images/logo.png'} onError={(e) => { e.target.src = '/assets/images/logo.png' }} />
                          </div>
                          <div className="flex flex-col text-slate-500 dark:text-slate-100 cursor-pointer">
                              <span className="font-bold">
                                  <a href={redirect} title={`${root_url.url}/${sub_url.url}`} target="_blank" rel="noreferrer">
                                      {root_url.title}
                                  </a>
                              </span>
      
                              <p className="cursor-pointer">
                                  <a href={redirect} title={`${root_url.url}/${sub_url.url}`} target="_blank" rel="noreferrer">
                                      {root_url.url} {(parse(sub_url.url ?? '/') .pathname.split('/').map((value) => { if (isEmpty(value)) { return; } else { return (` » ${value}`) } }) )}
                                  </a>
                              </p>
                          </div>
                      </div>
                      <div className="bg-white">
                          {/* Site poster can be added here */}
                      </div>
                  </div>
      
                  <div className="mt-3">
                      <span className="text-xl text-blue-900 dark:text-blue-500 hover:underline cursor-pointer">
                          <a href={redirect} title={`${root_url.url}/${sub_url.url}`} target="_blank" rel="noreferrer">
                              {sub_url.title ?? root_url.title}
                          </a>
                      </span>
      
                      <p className="text-ellipsis overflow-hidden text-slate-500 dark:text-slate-100">
                          {sub_url.description ?? root_url.description}
                      </p>
                  </div>
              </div>
              ) })}
  
              <Pagination result={result} paginate={paginate} />
          </div>
      
          <div className="flex-none w-[35%] h-auto">
              {/* Search information can be added here */}
          </div>
      </div>
    )
}

export default VideoLabel;