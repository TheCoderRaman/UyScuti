// Get geo data
export {
    getCity,
    getRegion,
    getCountry,
    getTimeZone,
    getGeoData
} from '@/Utils/func/geoData';

// Frontend routes
export {
    route as frontendRoute,
    routeName as frontendRouteName,
} from '@/Utils/func/frontendRoute';

// Backend routes
export {
    route as backendRoute,
    routeName as backendRouteName,
} from '@/Utils/func/backendRoute';

// Get environment variable from the env file.
export { env } from '@/Utils/func/env';
// Check given value is empty.
export { isEmpty } from '@/Utils/func/isEmpty';
// Check given value is object.
export { isObject } from '@/Utils/func/isObject';
// Convert given string to boolean
export { stringToBoolean } from '@/Utils/func/stringToBoolean';
