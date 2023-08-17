import ls from 'localstorage-slim';
import { env } from '@/Utils/func/env';
import { stringToBoolean } from '@/Utils/func/stringToBoolean';

export default function createLocalStorageSlim(){ 
    ls.config.secret = env('APP_SECRET');
    ls.config.encrypt = stringToBoolean(
        env('LOCAL_STORAGE_ENCRYPT')
    );
    
    return ls;
}

export const localStorage = createLocalStorageSlim();