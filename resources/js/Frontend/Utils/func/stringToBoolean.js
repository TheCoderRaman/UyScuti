/**
 * Convert given string value to boolean equivalent.
 * 
 * @param String boolVal
 * @returns String|null
 */
export const stringToBoolean = (boolVal) => {
    switch(boolVal?.toLowerCase()?.trim()){
        case "true": 
        case "yes": 
        case "1": 
          return true;
        case "false": 
        case "no": 
        case "0": 
        case null: 
        case undefined:
          return false;
    }

    try {
        return JSON.parse(boolVal);
    } catch(e){
        return false;
    }
}