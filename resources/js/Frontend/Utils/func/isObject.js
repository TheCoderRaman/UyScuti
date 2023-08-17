 /**
 * Check given value is an object.
 *
 * @param any value
 * @return bool
 */
export function isObject(value){
    return (
        (
            typeof value === "object" || 
            typeof value === 'function'
        ) && (value !== null)
    );
}