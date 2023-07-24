import Home from "@/Pages/Home";
import Error from "@/Pages/Error";
import Search from "@/Pages/Search";
import SignIn from "@/Pages/SignIn";
import SignUp from "@/Pages/SignUp";

/**
 * This module give us a single location for altering any
 * route in the entire application at any point of 
 * time in the future.
 * 
 * @var const Object routes
 */
export const routes = {
    Error: {
        name: "Error",
        path: "*",
        element: <Error />
    },
    Home: {
        name: "Home",
        path: '/',
        element: <Home />
    },
    SignIn: {
        name: "Sign In",
        path: '/sign-in',
        element: <SignIn />
    },
    SignUp: {
        name: "Sign Up",
        path: '/sign-up',
        element: <SignUp />
    },
    Search: {
        name: "Search",
        path: '/search',
        element: <Search />
    }
};