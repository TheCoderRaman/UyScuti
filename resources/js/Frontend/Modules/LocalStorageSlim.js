import ls from 'localstorage-slim';
import { env, stringToBoolean } from './../Utils/util';

export default function createLocalStorageSlim(){ 
    ls.config.secret = env('APP_SECRET');
    ls.config.encrypt = stringToBoolean(
        env('LOCAL_STORAGE_ENCRYPT')
    );
    
    return ls;
}

export const localStorage = createLocalStorageSlim();