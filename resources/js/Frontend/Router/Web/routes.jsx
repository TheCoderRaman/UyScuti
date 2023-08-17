import Home from '@/Pages/Home/Home.jsx';
import Error from '@/Pages/Error/Error.jsx';
import About from '@/Pages/About/About.jsx';
import Search from '@/Pages/Search/Search.jsx';
import SignIn from '@/Pages/SignIn/SignIn.jsx';
import SignUp from '@/Pages/SignUp/SignUp.jsx';
import Profile from '@/Pages/Profile/Profile.jsx';
import Contact from '@/Pages/Contact/Contact.jsx';

/**
 * All application backend routes will be defined here.
 *
 * @var const backends
 */
export const backendRoutes = {
    version: 'v1',
    baseUrl: "/api",
    web: {
        AuthProfile: {
            name: "Profile",
            path: "profile",
            prefix: "auth",
        },
        AuthUpdate: {
            name: "Update",
            path: "update",
            prefix: "auth",
        },
        AuthLogin: {
            name: "Login",
            path: "login",
            prefix: "auth",
        },
        AuthRegister: {
            name: "Register",
            path: "register",
            prefix: "auth",
        },
        AuthRefresh: {
            name: "Refresh",
            path: "refresh",
            prefix: "auth",
        }
    }
};

/**
 * All application frontend routes will be defined here.
 *
 * @var const frontendRoutes
 */
export const frontendRoutes = {
    baseUrl: "/",
    web: {
        Error: {
            name: "Error",
            path: "*",
            layout: 'minimal',
            element: <Error />
        },
        Home: {
            name: "Home",
            path: '/',
            layout: 'maximal',
            element: <Home />
        },
        SignIn: {
            name: "Sign In",
            path: '/sign-in',
            layout: 'auth',
            element: <SignIn />
        },
        SignUp: {
            name: "Sign Up",
            path: '/sign-up',
            layout: 'auth',
            element: <SignUp />
        },
        Profile: {
            name: "Profile",
            path: '/profile',
            layout: 'auth',
            element: <Profile />
        },
        Search: {
            name: "Search",
            path: '/search',
            layout: 'maximal',
            element: <Search />
        },
        About: {
            name: "About",
            path: '/about',
            layout: 'maximal',
            element: <About />
        },
        Contact: {
            name: "Contact",
            path: '/contact',
            layout: 'maximal',
            element: <Contact />
        }
    }
};