import React from 'react';
import { isEmpty } from '@/Utils/util';
import parser from 'html-react-parser';
import MainLogo from '@/Components/Logos/MainLogo.jsx';
import { useLaravelReactI18n } from 'laravel-react-i18n';

function Pagination(props) {
    const { result, paginate } = props;
    const { t } = useLaravelReactI18n();

    return (
        <div>
            {!isEmpty(result) && (
                <div className="mt-[10%] flex flex-col items-center">
                    <MainLogo />

                    <span className="text-sm text-gray-700 dark:text-gray-400">
                        UyScu{paginate.data.last_page > 2 && !isEmpty(paginate.data.links) && (
                            paginate.data.links.map((value, index) => {
                                return "u"
                            }
                            ))}ti
                    </span>

                    <div className="mb-[1%] border-t-[1px] border-solid bg-[#e8eaed] dark:border-[#5f6368]"></div>

                    <span className="text-sm text-gray-700 dark:text-gray-400">
                        {parser(t('frontend.Showing :from to :to of :entries Entries', {
                            from: (`
                              <span className="font-semibold text-gray-900 dark:text-white">
                                ${paginate.data.showing.from ?? 0}
                              </span>
                          `),
                            to: (`
                              <span className="font-semibold text-gray-900 dark:text-white">
                                ${paginate.data.showing.to ?? 0}
                              </span>
                          `),
                            entries: (`
                              <span className="font-semibold text-gray-900 dark:text-white">
                                ${paginate.data.total ?? 0}
                              </span>
                          `)
                        }))}
                    </span>

                    <div className="inline-flex mt-2 xs:mt-0">
                        {paginate.data.current_page > 1 && (
                            <button
                                onClick={() => { paginate.previousPage() }}
                                className="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                <svg className="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                </svg>
                                {t('frontend.Prev')}
                            </button>
                        )}

                        {paginate.data.last_page > 2 && (
                            <nav className="px-1 hidden md:block">
                                <ul className="flex items-center -space-x-px h-10 text-base">
                                    {!isEmpty(paginate.data.links) && (
                                        paginate.data.links.map((value, index) => {
                                            if (!parseInt(value.label)) {
                                                return;
                                            }

                                            return (
                                                <li
                                                    key={`${index}:${value.label}`}
                                                    onClick={() => { paginate.changePage(value.label) }}
                                                    className='hover:dark:bg-[#3c4043] hover:bg-[#e9f5ff]'
                                                >
                                                    <span
                                                        className={(paginate.data.current_page == value.label)
                                                            ? "flex items-center justify-center px-4 h-10 leading-tight border border-[#e9f5ff] dark:border-[#3c4043] text-gray-500 dark:text-gray-400 dark:bg-[#3c4043] bg-[#e9f5ff]"
                                                            : "flex items-center justify-center px-4 h-10 leading-tight border border-[#e9f5ff] dark:border-[#3c4043] text-gray-500 dark:text-gray-400 hover:dark:bg-[#3c4043] hover:bg-[#e9f5ff]"
                                                        }
                                                    >
                                                        {value.label}
                                                    </span>
                                                </li>
                                            )
                                        })
                                    )}
                                </ul>
                            </nav>
                        )}

                        {paginate.data.current_page < paginate.data.last_page && (
                            <button
                                onClick={() => { paginate.nextPage() }}
                                className="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                {t('frontend.Next')}
                                <svg className="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </button>
                        )}
                    </div>
                </div>
            )}
        </div>
    )
}

export default Pagination;