import { isEmpty } from './isEmpty';

/**
 * Get environment variable from .env file.
 * 
 * @param string key
 * @param any value
 * @return any
 */
export function env(key, value = null)
{
    key = `VITE_${key}`;

    if(isEmpty(import.meta.env[key])){
        return value;
    }

    return import.meta.env[key];
}