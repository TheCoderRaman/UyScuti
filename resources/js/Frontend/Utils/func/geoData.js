import { timeZoneToCountry } from '@/Data/geo';

/**
 * Get client timezone.
 * 
 * @returns String|null
 */
export function getTimeZone(){
    if(!Intl){
        return null;
    }

    return (Intl.DateTimeFormat()
        .resolvedOptions().timeZone
    );
}

/**
 * Get client region.
 * 
 * @returns String|null
 */
export function getRegion(){
    if(!Intl){
        return null;
    }

    return (getTimeZone()
        ?.split("/")[0] ?? null
    );
}

/**
 * Get client city.
 * 
 * @returns String|null
 */
export function getCity(){
    if(!Intl){
        return null;
    }

    let parsedArray = (
        getTimeZone()?.split("/")
    );

    return (parsedArray[
        parsedArray.length - 1] ?? null
    );
}

/**
 * Get client country.
 * 
 * @returns String|null
 */
export function getCountry(){
    if(!Intl){
        return null;
    }

    return (timeZoneToCountry[
        getTimeZone()] ?? null
    );
}

/**
 * Get geo data associated with client.
 * 
 * @returns Object
 */
export function getGeoData(){
    let geoData = {
        city: null,
        region: null,
        country: null,
        timeZone: null
    };

    if(!Intl){
        return geoData;
    }

    geoData.timeZone = (Intl
        .DateTimeFormat().resolvedOptions().timeZone
    );

    let parsedArray = (geoData
        .timeZone.split("/")
    );

    geoData.region = parsedArray[0];
    geoData.city = parsedArray[parsedArray.length - 1];
    geoData.country = timeZoneToCountry[geoData.timeZone];

    return geoData;
}