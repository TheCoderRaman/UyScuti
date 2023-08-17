import React from 'react';

function FullScreenPreloader({
    placeholder
}) {
    return (
        <div className="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden opacity-75 flex flex-col items-center justify-center">
            <svg fill="none" className="w-20 h-20 fill-white animate-spin" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <path clipRule="evenodd" d="M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z" fill="currentColor" fillRule="evenodd" />
            </svg>
            <div>{placeholder}</div>
        </div>
    )
}

export default FullScreenPreloader;