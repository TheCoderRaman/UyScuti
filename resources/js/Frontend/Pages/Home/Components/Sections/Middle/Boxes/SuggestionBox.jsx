import React, {
    useState,
    useEffect
} from 'react';

import { isEmpty } from '@/Utils/util';
import { useSelector } from 'react-redux';
import { useNavigate } from 'react-router';
import { useDebounce } from 'use-debounce';
import { useAxios } from '@/Hooks/hooks.jsx';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import SearchIcon from '@/Components/Icons/SearchIcon.jsx';
import { backendRoute, frontendRoute } from '@/Utils/util';
import HiglightSearchTerm from '@/Pages/Home/Components/Sections/Middle/Utils/HiglightSearchTerm.jsx';

function SuggestionBox() {
    const searches = useSelector(
        (state) => state.searches.value
    );

    const axios = useAxios();
    const navigate = useNavigate();
    const { t } = useLaravelReactI18n();
    const [suggestions, setSuggestions] = useState([]);
    const [debounceSearchTerm] = useDebounce(searches.searchTerm, 100);

    const handleSearchClick = () => {
        navigate(frontendRoute('Search'), {
            state: {
                searchTerm: searches.searchTerm
            }
        });
    };

    const handleSuggestionClick = (suggestion) => {
        navigate(frontendRoute('Search'), {
            state: {
                searchTerm: suggestion.title
            }
        });
    };

    useEffect(() => {
        if(!axios.fetched){
            return;
        }

        setSuggestions(axios.data?.values ?? suggestions);
    },[axios.data])

    useEffect(() => {
        if (!debounceSearchTerm) {
            setSuggestions([]);
            return;
        }

        axios.createRequest({
            method: 'post',
            payload: {
                total: 20,
                searchTerm: debounceSearchTerm
            },
            endpoint: backendRoute('SearchSuggest')
        });
    }, [debounceSearchTerm]);

    return (searches.isTyping &&
        <div className="grid place-items-center left-0 right-0 py-2 ml-[auto] mr-[auto] mt-[-85px] z-0 h-[200px]">
            <div 
                style={{
                    width: '80vw',
                    maxWidth: '602px',
                    minWidth: '300px',
                }}
                className="bg-[#fff] dark:bg-[#303134] rounded-bl rounded-br divide-y divide-gray-100 shadow"
            >
                <div className="border-t-[1px] border-solid bg-[#e8eaed] dark:border-[#5f6368]"></div>
                {suggestions.length <= 0 ? (
                    <div className="py-2 text-gray-700 dark:text-gray-200 h-[200px]">
                        <ul className="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <div className="text-center">
                                    {t((!isEmpty(searches.searchTerm) && debounceSearchTerm) ?
                                        `frontend.No Result Found` : `frontend.THAT\'S ONE SMALL STEP FOR MAN, ONE GIANT LEAP FOR MANKIND`
                                    )}
                                </div>
                            </li>
                        </ul>
                    </div>
                ) : (
                    <ul className="py-2 text-sm text-gray-700 dark:text-gray-200 h-[200px] overflow-y-auto no-scrollbar">
                        {Object.entries(suggestions).map(([, value]) => {
                            return (
                                <li key={value.id}>
                                    <div className="flex flex-wrap justify-center items-center ml-1 mr-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <span className="w-[10%] text-left">
                                            <SearchIcon title={t(`frontend.${value.type}`)} />
                                        </span>
                                        <div className="w-[70%] text-left" onMouseDown={() => { handleSuggestionClick(value) }}>
                                            <HiglightSearchTerm searchText={debounceSearchTerm} textToHighlight={value?.title?.replace(/<\/?[^>]+(>|$)/g, "")} />
                                        </div>
                                        <div className="w-[20%] text-right hover:underline hover:text-blue-300">
                                            {/* Tools related to suggestion for example: */}
                                            {/* delete, Can be added here in future versions */}
                                        </div>
                                    </div>
                                </li>
                            );
                        })}
                    </ul>
                )}
                <center>
                    <button
                        type="button"
                        onMouseDown={handleSearchClick}
                        className="bg-[#f8f9fa] dark:bg-[#3c4043] text-[#4d5156] dark:text-[#bdc1c6] p-2 rounded-md mt-2 mb-2 hover:border-white border-transparent border-2"
                    >
                        {t('frontend.UyScuti')} {t('frontend.Search')}
                    </button>
                </center>
            </div>
        </div>
    )
}

export default SuggestionBox;