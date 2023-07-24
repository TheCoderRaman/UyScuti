import { routes } from '@/Router/Web/routes';

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
        path = (Object.entries(routes).filter(
            ([name]) => {
              return name == identifier
            }).at(0)?.at(1)?.path
        );
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
        name = (Object.entries(routes).filter(
            ([,data]) => {
                return path == data.path
            })?.at(0).at(1)?.name
        );
    } catch (e){
        return fallBack;
    }

    return name;
}