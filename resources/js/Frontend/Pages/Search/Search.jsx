import React, {
  useState,
  useEffect
} from 'react';

import { backendRoute } from '@/Utils/util';
import { useAxios } from '@/Hooks/hooks.jsx';
import { useHorizontalScroll } from '@/Hooks/hooks.jsx';
import Label from '@/Pages/Search/Components/Labels/Label.jsx';

function Search() {
  const axios = useAxios();
  const scrollRef = useHorizontalScroll();
  const [label, setLabel] = useState(null);
  const [labels, setLabels] = useState(['site']);

  useEffect(() => {
    setLabel(labels.at(0));
  }, [labels]);

  useEffect(() => {
    if (axios.loading) {
      return;
    }

    axios.createRequest({
      method: 'post',
      payload: {
        total: 50
      },
      endpoint: backendRoute('SearchLabel')
    });
  }, []);

  useEffect(() => {
    if (axios.loading) {
      return;
    }

    if(!axios.context.success){
      return;
    }

    setLabels(axios.data?.values ?? ['site']);
  },[axios.context]);

  return (
    <section className="relative z-10 overflow-hidden pb-16 md:pt-[70px] md:pb-[120px] xl:pt-[70px] xl:pb-[160px] 2xl:pt-[210px] 2xl:pb-[200px] min-h-[100vh]">
      <div className='flex sm:justify-around justify-between items-center h-[70px] pl-10 pr-10 text-[#3c4043] dark:text-[#f1f3f4]'>
        <div className='flex space-x-4'>
          <div ref={scrollRef} className='flex flex-1 space-x-2 justify-center uppercase overflow-x-auto w-[600px] ml-[-25%] hover:scroll-auto hide-scrollbar'>
            {labels.map((value, index) => {
              return (
                <span
                  key={`${index}#${value}`}
                  onClick={() => { setLabel(value) }}
                  className={label == value 
                    ? "cursor-pointer text-xs font-semibold inline-block p-3 rounded-t-3xl rounded-r-3xl rounded-bl-3xl rounded-br-3xl border-2 border-[#f1f3f4] dark:border-[#3c4043] dark:bg-[#3c4043] bg-[#e9f5ff]"
                    : "cursor-pointer text-xs font-semibold inline-block p-3 rounded-t-3xl rounded-r-3xl rounded-bl-3xl rounded-br-3xl border-2 border-[#f1f3f4] dark:border-[#3c4043] dark:hover:bg-[#3c4043] hover:bg-[#e9f5ff]"
                  }
                >
                  {value.charAt(0).toUpperCase() + value.slice(1)}
                </span>
              )
            })}
          </div>
          <div className='flex space-x-4'>
            {/* Setting Can Be Added Here */}
          </div>
        </div>
        <div className='flex space-x-4'>
          {/* Safe Search Filter Can Be Added Here */}
          {/* With Options Like: [mean => mean,median => moderate,mode => Strict] options */}
        </div>
      </div>

      <div className="mb-[1%] border-t-[1px] border-solid bg-[#e8eaed] dark:border-[#5f6368]"></div>

      <Label {...{ labelType: label }} />
    </section>
  );
}

export default Search;