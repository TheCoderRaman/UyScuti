import React from 'react';
import parser from 'html-react-parser';
import { isEmpty } from '@/Utils/util';

function HiglightSearchTerm({
    searchText, textToHighlight
}) {
    return (
        <div>
            {!isEmpty(textToHighlight) && parser(
                textToHighlight?.replace(
                    searchText, `<b>${searchText}</b>`)
                )
            }
        </div>
    )
}

export default HiglightSearchTerm;