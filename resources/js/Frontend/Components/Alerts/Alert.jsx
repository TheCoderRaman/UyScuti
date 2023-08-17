import React from 'react';

function Alert({
    type = 'green', message
}) {
    switch (type.toUpperCase()) {
        case 'DANGER':
            return (
                <div className="bg-teal-100 dark:bg-[#242B51] border-t-4 border-red-500 rounded-b text-teal-900 px-1 py-1 mb-1 shadow-md" role="alert">
                    <p className="font-bold text-xs text-black dark:text-white">
                        {message}
                    </p>
                </div>
            );
        case 'WARNING':
            return (
                <div className="bg-teal-100 dark:bg-[#242B51] border-t-4 border-yellow-500 rounded-b text-teal-900 px-1 py-1 mb-1 shadow-md" role="alert">
                    <p className="font-bold text-xs text-black dark:text-white">
                        {message}
                    </p>
                </div>
            );
        case 'SUCCESS':
            return (
                <div className="bg-teal-100 dark:bg-[#242B51] border-t-4 border-green-500 rounded-b text-teal-900 px-1 py-1 mb-1 shadow-md" role="alert">
                    <p className="font-bold text-xs text-black dark:text-white">
                        {message}
                    </p>
                </div>
            );
    }
}

export default Alert;