/**
 * Check wheather given value is empty.
 * 
 * This types will be treated as empty..
 * - [0, false, null, undefined]
 * 
 * @param any value
 * @return bool
 */
export function isEmpty(value){
    switch(typeof(value))
    {
        case 'undefined':
            return true;
        case 'boolean':
            return !value;
        case 'number':
            return value === 0;
        case 'string':
          return value.length <= 0 || value === '';
        case 'object': 
          return value.length <= 0 || value === {} || value === [] || value === null;
    }

    return false;
}