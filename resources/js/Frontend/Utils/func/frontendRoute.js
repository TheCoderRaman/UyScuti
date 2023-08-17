import { frontendRoutes } from '@/Router/Web/routes';

/**
 * Get specified route path by identifier.
 * 
 * @param String identifier
 * @param String|null fallBack
 * @returns String|null
 */
export function route(identifier, fallBack)
{
    let path = fallBack;

    try {
        let route = (Object.entries(
            frontendRoutes.web
        ).filter(
            ([name]) => name == identifier
        ).at(0)?.at(1));

        path = route?.path;
    } catch(e){
        return fallBack;
    }

    return path;
}

/**
 * Get specified route name by route path.
 * 
 * @param String path
 * @param String|null fallBack
 * @returns String|null
 */
export function routeName(path, fallBack = "*")
{
    let name = fallBack;

    try {
        let route = (Object.entries(
            frontendRoutes.web
        ).filter(
            ([,data]) => path == data.path
        )?.at(0).at(1));

        name = route?.name;
    } catch (e){
        return fallBack;
    }
    
    return name;
}