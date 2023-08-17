import React from 'react';
import AuthLayout from '@/Components/Layouts/AuthLayout.jsx';
import MinimalLayout from '@/Components/Layouts/MinimalLayout.jsx';
import MaximalLayout from '@/Components/Layouts/MaximalLayout.jsx';

function Layout({ layout, children }) {
    switch (layout.toUpperCase()) {
        case 'AUTH':
            return (
                <AuthLayout>
                    {children}
                </AuthLayout>
            );
        case 'MINIMAL':
            return (
                <MinimalLayout>
                    {children}
                </MinimalLayout>
            );
        case 'MAXIMAL':
            return (
                <MaximalLayout>
                    {children}
                </MaximalLayout>
            );
    }

    return (<>{children}</>);
}

export default Layout;