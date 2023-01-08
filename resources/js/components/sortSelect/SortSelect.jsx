import React from 'react'
import StyledSortSelect from './Styled'

const SortSelect = ({onChange}) => {
    return (
        <StyledSortSelect onChange={onChange}>
            <option value='ascending'>Ascending order</option>
            <option value='descending'>Descending order</option>
        </StyledSortSelect>
    )
}

export default SortSelect