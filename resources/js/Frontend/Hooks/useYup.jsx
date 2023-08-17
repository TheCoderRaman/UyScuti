import * as yup from 'yup';
import YupPassword from 'yup-password';
import { useLaravelReactI18n } from 'laravel-react-i18n';

export function useYup(){
    YupPassword(yup);

    const locales = {};
    const { t } = useLaravelReactI18n();
    
    yup.setLocale(locales.data = {
        mixed: {
          default: ({ path }) => (
            t(`frontend.:field is invalid`,{
              field: path
            })
          ),
          required: ({ path }) => (
            t(`frontend.:field is a required field`,{
              field: path
            })
          ),
          email: ({ path }) => (
            t(`frontend.:field must be a valid email`,{
              field: path
            })
          ),
        },
        string: {
          min: ({ min, path }) => (
            t(`frontend.:field must be at least :min characters`,{
              field: path, min: min
            })
          ),
          max: ({ max, path }) => (
            t(`frontend.:field must be at most :max characters`,{
              field: path, max: max
            })
          ),
          minNumbers: ({ number , path }) => (
            t(`frontend.:field must contain :number amount of numbers or more.`,{
              field: path,number: number
            })
          ),
          minSymbols: ({ number , path }) => (
            t(`frontend.:field must contain :number amount of symbols or more.`,{
              field: path,number: number
            })
          ),
          minLowercase: ({ number , path }) => (
            t(`frontend.:field must contain :number amount of lowercase letters or more.`,{
              field: path,number: number
            })
          ),
          minUppercase: ({ number , path }) => (
            t(`frontend.:field must contain :number amount of uppercase letters or more.`,{
              field: path,number: number
            })
          )
        },
    });

    return { yup, locales};
}