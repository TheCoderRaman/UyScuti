import React, { 
    useRef,
    useEffect
} from 'react';

import { isEmpty } from '@/Utils/util';
import { useForm } from 'react-hook-form';
import { useNavigate } from 'react-router';
import { frontendRoute } from '@/Utils/util';
import GlobeIcon from '@/Components/Icons/GlobeIcon';
import { useDispatch, useSelector } from 'react-redux';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import ClearIcon from '@/Components/Icons/ClearIcon.jsx';
import SearchIcon from '@/Components/Icons/SearchIcon.jsx';
import { setIsTyping, setSearchTerm, setSearchForTerm } from '@/Redux/features/searches/searchesSlice';

function SearchBox() {
    const {
        register,
        setValue,
        handleSubmit,
        formState: { errors },
    } = useForm({
        defaultValues: { searchTerm: null }
    });

    const submitButtonRef = useRef(null);

    const navigate = useNavigate();
    const dispatch = useDispatch();
    const { t } = useLaravelReactI18n();

    const searches = useSelector(
        (state) => state.searches.value
    );

    const handleOnFocus = () => {
        dispatch(setIsTyping(true));
    };

    const handleOnBlur = () => {
        dispatch(setIsTyping(false));
    };

    const handleClear = () => {
        setValue("searchTerm", null);
        dispatch(setSearchTerm(null));
    };

    const handleKeyDown = (e) => {
        if (e.key !== 'Enter') {
          return;
        }

        if(isEmpty(e.target.value)){
            return;
        }

        dispatch(setSearchForTerm(
            e.target.value
        ));

        navigate(frontendRoute('Search'), {
            state: {
                searchTerm: e.target.value
            }
        });
    };

    const handleTyping = (e) => {
        setValue("searchTerm", e.target.value);
        dispatch(setSearchTerm(e.target.value));
    };

    useEffect(() => {
        dispatch(setIsTyping(false));
    },[]);

    const handleSearchSubmit = () => {
        dispatch(setSearchForTerm(
            searches.searchTerm
        ));

        submitButtonRef.current.click();
    };

    const onSubmit = (data, e) => {
        e.preventDefault();

        dispatch(setSearchForTerm(
            e.target.value
        ));

        navigate(frontendRoute('Search'), {
            state: {
                searchTerm: data["searchTerm"]
            }
        });
    };

    return (
        <>
            <div className="flex flex-grow">
                <label className="relative">
                    {!isEmpty(searches.searchTerm) ? (
                        <span className="pl-3 pt-3 text-[#9aa0a6] dark:text-[#DDDDDD] absolute">
                            <SearchIcon title={t('frontend.Search')} />
                        </span>
                    ) : (
                        <span className="pl-3 pt-3 text-[#9aa0a6] dark:text-[#DDDDDD] absolute">
                            <GlobeIcon />
                        </span>
                    )}

                    <form onSubmit={handleSubmit(onSubmit)}>
                        {register("searchTerm", { required: true }) && ''}
                        <input
                            type="text"
                            style={{
                                width: '80vw',
                                maxWidth: '600px',
                                minWidth: '300px',
                            }}
                            onBlur={handleOnBlur}
                            onFocus={handleOnFocus}
                            onChange={handleTyping}
                            onKeyDown={handleKeyDown}
                            value={searches.searchTerm ?? ''}
                            placeholder={t('frontend.Rocks are space, and space is illusion')}
                            className="bg-[#f8f9fa] dark:bg-[#303134] rounded-t-2xl rounded-r-2xl rounded-bl-2xl rounded-br-2xl focus:rounded-br-none focus:rounded-bl-none h-[45px] hover:shadow-md placeholder:italic dark:text-white placeholder:text-slate-400 block border border-slate-300 dark:border-[#5f6368] py-2 pl-12 pr-3 shadow-sm focus:outline-none focus:border-sky-300 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                        ></input>

                        <button
                            type="submit"
                            ref={submitButtonRef}
                            style={{ display: 'none' }}
                        ></button>
                    </form>

                    <div className='flex'>
                        {!isEmpty(searches.searchTerm) && (
                            <button onClick={handleClear} className="absolute top-[25%] right-[5%] pr-3">
                                <span className="text-[#9aa0a6] dark:text-[#DDDDDD]">
                                    <ClearIcon title={t('frontend.Clear')} />
                                </span>
                            </button>
                        )}

                        <button
                            type="submit"
                            className="absolute top-[25%] right-[1%]"
                            onClick={handleSearchSubmit}
                        >
                            <span className="text-[#9aa0a6] dark:text-[#DDDDDD]">
                                <SearchIcon title={t('frontend.Search')} />
                            </span>
                        </button>
                    </div>
                </label>
            </div>
        </>
    )
}

export default SearchBox;